<?php

namespace App\Http\Controllers\ParentPortal;

use App\Http\Controllers\Controller;
use App\Models\SatisfactionRating;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpdeskController extends Controller
{
    /**
     * Daftar tiket milik orang tua yang sedang login
     */
    public function index()
    {
        $tickets = Ticket::where('reporter_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('parent.helpdesk.index', compact('tickets'));
    }

    /**
     * Form buat tiket baru
     */
    public function create()
    {
        return view('parent.helpdesk.create');
    }

    /**
     * Simpan tiket baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject'     => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|in:teknis,akademik,informasi,lainnya',
            'priority'    => 'required|in:low,medium,high',
        ]);

        $ticket = Ticket::create([
            'reporter_id' => Auth::id(),
            'subject'     => $request->subject,
            'description' => $request->description,
            'category'    => $request->category,
            'priority'    => $request->priority,
            'status'      => 'open',
        ]);

        // Auto-reply: cari admin pertama untuk dijadikan responder sistem
        $adminUser = User::where('role', 'admin')->first();

        if ($adminUser) {
            TicketResponse::create([
                'ticket_id'    => $ticket->id,
                'responder_id' => $adminUser->id,
                'message'      => 'Terima kasih telah menghubungi kami. Tiket Anda dengan nomor #' . $ticket->id . ' telah kami terima. Tim kami akan segera merespons dalam waktu 1x24 jam. Harap tunggu balasan dari admin.',
                'is_auto_reply' => true,
            ]);
        }

        return redirect()->route('parent.helpdesk.show', $ticket)
            ->with('success', 'Tiket berhasil dibuat! Kami akan segera merespons.');
    }

    /**
     * Detail tiket + thread percakapan (hanya pemilik tiket)
     */
    public function show(Ticket $ticket)
    {
        // Otorisasi: hanya pemilik tiket yang bisa melihat
        abort_unless($ticket->reporter_id === Auth::id(), 403, 'Anda tidak memiliki akses ke tiket ini.');

        $ticket->load(['reporter', 'operator', 'responses.responder', 'rating']);

        return view('parent.helpdesk.show', compact('ticket'));
    }

    /**
     * Orang tua membalas tiket
     */
    public function storeResponse(Request $request, Ticket $ticket)
    {
        // Otorisasi: hanya pemilik tiket yang bisa membalas
        abort_unless($ticket->reporter_id === Auth::id(), 403);

        // Tidak bisa membalas tiket yang sudah closed
        if ($ticket->status === 'closed') {
            return back()->with('error', 'Tiket yang sudah ditutup tidak bisa dibalas.');
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        TicketResponse::create([
            'ticket_id'    => $ticket->id,
            'responder_id' => Auth::id(),
            'message'      => $request->message,
            'is_auto_reply' => false,
        ]);

        // Jika status resolved, kembalikan ke in_progress karena user merespons
        if ($ticket->status === 'resolved') {
            $ticket->update(['status' => 'in_progress']);
        }

        return back()->with('success', 'Balasan berhasil dikirim.');
    }

    /**
     * Simpan rating kepuasan setelah tiket resolved
     */
    public function storeRating(Request $request, Ticket $ticket)
    {
        // Otorisasi
        abort_unless($ticket->reporter_id === Auth::id(), 403);

        // Hanya bisa dirating jika status resolved
        abort_unless($ticket->status === 'resolved', 422, 'Tiket belum diselesaikan.');

        // Cek apakah sudah pernah dirating
        if ($ticket->rating) {
            return back()->with('error', 'Anda sudah memberikan penilaian untuk tiket ini.');
        }

        $request->validate([
            'rating'  => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500',
        ]);

        SatisfactionRating::create([
            'ticket_id' => $ticket->id,
            'rating'    => $request->rating,
            'comment'   => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas penilaian Anda!');
    }

    /**
     * Get new messages for natural auto-reload
     */
    public function messages(Request $request, Ticket $ticket)
    {
        // Otorisasi
        abort_unless($ticket->reporter_id === Auth::id(), 403);

        $lastId = $request->query('last_id', 0);

        $responses = $ticket->responses()
            ->with('responder')
            ->where('id', '>', $lastId)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function($response) {
                return [
                    'id' => $response->id,
                    'message' => $response->message,
                    'is_me' => $response->responder_id === Auth::id(),
                    'is_auto' => $response->is_auto_reply,
                    'responder_name' => $response->responder->name ?? 'Sistem',
                    'time' => $response->created_at->translatedFormat('d M H:i'),
                ];
            });

        return response()->json(['messages' => $responses]);
    }
}
