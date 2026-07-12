<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpdeskController extends Controller
{
    /**
     * Daftar semua tiket dengan filter & search
     */
    public function index(Request $request)
    {
        $query = Ticket::with(['reporter', 'operator'])
            ->latest();

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search subject
        if ($request->filled('search')) {
            $query->where('subject', 'like', '%' . $request->search . '%');
        }

        $tickets = $query->paginate(15)->withQueryString();

        // Statistik cepat untuk header
        $stats = [
            'open'        => Ticket::where('status', 'open')->count(),
            'in_progress' => Ticket::where('status', 'in_progress')->count(),
            'resolved'    => Ticket::where('status', 'resolved')->count(),
            'total'       => Ticket::count(),
        ];

        return view('admin.helpdesk.index', compact('tickets', 'stats'));
    }

    /**
     * Detail tiket + thread percakapan
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['reporter', 'operator', 'responses.responder', 'rating']);
        $admins = User::where('role', 'admin')->get();

        return view('admin.helpdesk.show', compact('ticket', 'admins'));
    }

    /**
     * Update status, priority, atau assign operator
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status'      => 'nullable|in:open,in_progress,resolved,closed',
            'priority'    => 'nullable|in:low,medium,high',
            'operator_id' => 'nullable|exists:users,id',
        ]);

        $data = array_filter([
            'status'      => $request->status,
            'priority'    => $request->priority,
            'operator_id' => $request->operator_id,
        ], fn($v) => !is_null($v));

        // Jika status berubah ke resolved
        if (isset($data['status']) && $data['status'] === 'resolved' && !$ticket->resolved_at) {
            $data['resolved_at'] = now();
        }

        $ticket->update($data);

        return back()->with('success', 'Tiket berhasil diperbarui.');
    }

    /**
     * Admin membalas tiket
     */
    public function storeResponse(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // Set first_response_at jika ini balasan pertama admin
        if (!$ticket->first_response_at) {
            $ticket->update(['first_response_at' => now()]);
        }

        // Otomatis ubah status ke in_progress jika masih open
        if ($ticket->status === 'open') {
            $ticket->update(['status' => 'in_progress']);
        }

        TicketResponse::create([
            'ticket_id'    => $ticket->id,
            'responder_id' => Auth::id(),
            'message'      => $request->message,
            'is_auto_reply' => false,
        ]);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }

    /**
     * Tandai tiket sebagai resolved
     */
    public function resolve(Ticket $ticket)
    {
        $ticket->update([
            'status'      => 'resolved',
            'resolved_at' => now(),
        ]);

        return back()->with('success', 'Tiket telah ditandai sebagai Resolved.');
    }

    /**
     * Dashboard statistik
     */
    public function dashboard()
    {
        $stats = [
            'total'       => Ticket::count(),
            'open'        => Ticket::where('status', 'open')->count(),
            'in_progress' => Ticket::where('status', 'in_progress')->count(),
            'resolved'    => Ticket::where('status', 'resolved')->count(),
            'closed'      => Ticket::where('status', 'closed')->count(),
        ];

        // Rata-rata waktu respons pertama (dalam jam)
        $avgResponse = Ticket::whereNotNull('first_response_at')
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, first_response_at)) as avg_hours')
            ->value('avg_hours');

        // Data tiket per hari (7 hari terakhir)
        $ticketsPerDay = Ticket::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Tiket terbaru yang perlu perhatian
        $recentTickets = Ticket::with('reporter')
            ->where('status', 'open')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.helpdesk.dashboard', compact(
            'stats', 'avgResponse', 'ticketsPerDay', 'recentTickets'
        ));
    }

    /**
     * Get new messages for natural auto-reload
     */
    public function messages(Request $request, Ticket $ticket)
    {
        $lastId = $request->query('last_id', 0);

        $responses = $ticket->responses()
            ->with('responder')
            ->where('id', '>', $lastId)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function($response) {
                $isAdmin = $response->responder && $response->responder->role === 'admin';
                return [
                    'id' => $response->id,
                    'message' => $response->message,
                    'is_admin' => $isAdmin,
                    'is_auto' => $response->is_auto_reply,
                    'responder_name' => $response->responder->name ?? 'Sistem',
                    'time' => $response->created_at->diffForHumans(),
                ];
            });

        return response()->json(['messages' => $responses]);
    }
}
