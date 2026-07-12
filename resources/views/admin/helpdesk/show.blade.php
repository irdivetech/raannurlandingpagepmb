@extends('layouts.admin')

@section('title', 'Detail Tiket #' . $ticket->id . ' | Admin RA AN-NUUR')

@section('styles')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInBubble {
        from { opacity: 0; transform: translateY(8px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    .fade-in { animation: fadeInUp 0.4s ease both; }
    .chat-bubble { animation: fadeInBubble 0.35s ease both; }
    .badge { display: inline-flex; align-items: center; padding: 2px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }
</style>
@endsection

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    {{-- Header --}}
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 fade-in">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Admin</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <a href="{{ route('admin.helpdesk.index') }}" class="text-xs hover:text-emerald-500 transition-colors">Helpdesk</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Tiket #{{ $ticket->id }}</span>
            </nav>
            <h2 class="font-display text-2xl md:text-3xl font-bold text-gray-900">{{ $ticket->subject }}</h2>
        </div>
        <a href="{{ route('admin.helpdesk.index') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 font-bold text-sm rounded-xl hover:bg-gray-50 transition-all shadow-sm">
            <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali
        </a>
    </section>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3 rounded-xl mb-6 flex items-center gap-2 fade-in">
        <span class="material-symbols-outlined text-lg" style="font-variation-settings:'FILL' 1;">check_circle</span>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        {{-- LEFT: Chat Thread (8 cols) --}}
        <div class="lg:col-span-8 space-y-6">

            {{-- Deskripsi Tiket --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 fade-in" style="animation-delay:.05s">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                        <span class="material-symbols-outlined text-lg">description</span>
                    </div>
                    <h3 class="font-bold text-gray-900">Deskripsi Masalah</h3>
                </div>
                <div class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $ticket->description }}</div>
            </div>

            {{-- Chat Thread --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm fade-in" style="animation-delay:.1s">
                <div class="p-5 border-b border-gray-100 flex items-center gap-2">
                    <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                        <span class="material-symbols-outlined text-lg">forum</span>
                    </div>
                    <h3 class="font-bold text-gray-900">Percakapan</h3>
                    <span class="ml-auto bg-gray-100 text-gray-500 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $ticket->responses->count() }} pesan</span>
                </div>

                <div class="p-5 space-y-4 max-h-[500px] overflow-y-auto preview-scroll" id="chatContainer">
                    @forelse($ticket->responses as $idx => $response)
                    @php
                        $isAdmin = $response->responder && $response->responder->role === 'admin';
                        $isAuto  = $response->is_auto_reply;
                    @endphp
                    <div class="flex {{ $isAdmin ? 'justify-end' : 'justify-start' }} chat-bubble" data-id="{{ $response->id }}">
                        <div class="max-w-[80%]">
                            {{-- Auto Reply Badge --}}
                            @if($isAuto)
                            <div class="flex {{ $isAdmin ? 'justify-end' : 'justify-start' }} mb-1">
                                <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[10px]">smart_toy</span> Auto-reply
                                </span>
                            </div>
                            @endif

                            <div class="{{ $isAdmin
                                ? 'bg-emerald-500 text-white rounded-2xl rounded-br-md'
                                : 'bg-gray-100 text-gray-800 rounded-2xl rounded-bl-md' }} px-5 py-3 shadow-sm">
                                <p class="text-sm leading-relaxed whitespace-pre-line">{{ $response->message }}</p>
                            </div>
                            <div class="flex items-center gap-2 mt-1.5 {{ $isAdmin ? 'justify-end' : 'justify-start' }}">
                                <span class="text-[10px] font-medium {{ $isAdmin ? 'text-gray-400' : 'text-gray-400' }}">
                                    {{ $response->responder->name ?? 'Sistem' }}
                                </span>
                                <span class="text-[10px] text-gray-300">•</span>
                                <span class="text-[10px] text-gray-400">{{ $response->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-4xl text-gray-200 mb-2">chat_bubble_outline</span>
                        <p class="text-gray-400 text-sm">Belum ada percakapan.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Reply Form --}}
                @if($ticket->status !== 'closed')
                <div class="p-5 border-t border-gray-100">
                    <form action="{{ route('admin.helpdesk.reply', $ticket) }}" method="POST">
                        @csrf
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Balas sebagai Admin</label>
                        <textarea name="message" rows="3" required
                                  placeholder="Tulis balasan Anda di sini..."
                                  class="w-full border border-gray-200 rounded-xl p-3.5 text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none resize-none transition-all">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <div class="flex justify-end mt-3">
                            <button type="submit"
                                    class="px-6 py-2.5 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all flex items-center gap-2 shadow-md shadow-emerald-500/20 active:scale-95">
                                <span class="material-symbols-outlined text-lg">send</span> Kirim Balasan
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div class="p-5 border-t border-gray-100 text-center">
                    <p class="text-gray-400 text-sm font-medium">Tiket ini sudah ditutup. Tidak bisa dibalas lagi.</p>
                </div>
                @endif
            </div>
        </div>

        {{-- RIGHT: Info & Actions (4 cols) --}}
        <div class="lg:col-span-4 space-y-6">

            {{-- Ticket Info Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 fade-in" style="animation-delay:.1s">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg text-emerald-500">info</span> Informasi Tiket
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Status</span>
                        @if($ticket->status === 'open')
                            <span class="badge bg-red-100 text-red-600">Open</span>
                        @elseif($ticket->status === 'in_progress')
                            <span class="badge bg-amber-100 text-amber-700">In Progress</span>
                        @elseif($ticket->status === 'resolved')
                            <span class="badge bg-emerald-100 text-emerald-700">Resolved</span>
                        @else
                            <span class="badge bg-gray-100 text-gray-500">Closed</span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Prioritas</span>
                        @if($ticket->priority === 'high')
                            <span class="badge bg-red-100 text-red-600">High</span>
                        @elseif($ticket->priority === 'medium')
                            <span class="badge bg-amber-100 text-amber-700">Medium</span>
                        @else
                            <span class="badge bg-emerald-100 text-emerald-700">Low</span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Kategori</span>
                        <span class="text-sm font-semibold text-gray-700">{{ $ticket->category_label }}</span>
                    </div>
                    <div class="border-t border-gray-50 my-2"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Reporter</span>
                        <span class="text-sm font-semibold text-gray-700">{{ $ticket->reporter->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Operator</span>
                        <span class="text-sm font-semibold text-gray-700">{{ $ticket->operator->name ?? 'Belum di-assign' }}</span>
                    </div>
                    <div class="border-t border-gray-50 my-2"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Dibuat</span>
                        <span class="text-xs text-gray-500">{{ $ticket->created_at->translatedFormat('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Respons Pertama</span>
                        <span class="text-xs text-gray-500">{{ $ticket->first_response_at ? $ticket->first_response_at->diffForHumans() : '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Resolved</span>
                        <span class="text-xs text-gray-500">{{ $ticket->resolved_at ? $ticket->resolved_at->translatedFormat('d M Y, H:i') : '-' }}</span>
                    </div>

                    {{-- Rating (if exists) --}}
                    @if($ticket->rating)
                    <div class="border-t border-gray-50 my-2"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Rating</span>
                        <div class="flex items-center gap-0.5">
                            @for($s = 1; $s <= 5; $s++)
                                <span class="material-symbols-outlined text-base {{ $s <= $ticket->rating->rating ? 'text-amber-400' : 'text-gray-200' }}" style="font-variation-settings:'FILL' 1;">star</span>
                            @endfor
                        </div>
                    </div>
                    @if($ticket->rating->comment)
                    <div>
                        <span class="text-xs text-gray-400 font-medium">Komentar Rating</span>
                        <p class="text-xs text-gray-500 mt-1 italic">"{{ $ticket->rating->comment }}"</p>
                    </div>
                    @endif
                    @endif
                </div>
            </div>

            {{-- Update Panel --}}
            @if($ticket->status !== 'closed')
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 fade-in" style="animation-delay:.15s">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg text-amber-500">tune</span> Kelola Tiket
                </h3>
                <form action="{{ route('admin.helpdesk.update', $ticket) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Status</label>
                            <select name="status" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none">
                                <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Prioritas</label>
                            <select name="priority" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none">
                                <option value="low" {{ $ticket->priority === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $ticket->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $ticket->priority === 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Assign Operator</label>
                            <select name="operator_id" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none">
                                <option value="">-- Belum di-assign --</option>
                                @foreach($admins as $admin)
                                <option value="{{ $admin->id }}" {{ $ticket->operator_id == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                                class="w-full py-2.5 bg-amber-500 text-white font-bold text-sm rounded-xl hover:bg-amber-600 transition-all shadow-md shadow-amber-500/20 flex items-center justify-center gap-2 active:scale-95">
                            <span class="material-symbols-outlined text-lg">save</span> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
            @endif

            {{-- Quick Actions --}}
            <div class="space-y-3 fade-in" style="animation-delay:.2s">
                @if(!in_array($ticket->status, ['resolved', 'closed']))
                <form action="{{ route('admin.helpdesk.resolve', $ticket) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full py-3 bg-emerald-500 text-white font-bold text-sm rounded-xl hover:bg-emerald-600 transition-all flex items-center justify-center gap-2 shadow-md shadow-emerald-500/20 active:scale-95"
                            onclick="return confirm('Tandai tiket ini sebagai Resolved?')">
                        <span class="material-symbols-outlined text-lg">check_circle</span> Resolve Tiket
                    </button>
                </form>
                @endif
                @if($ticket->status !== 'closed')
                <form action="{{ route('admin.helpdesk.update', $ticket) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="closed">
                    <button type="submit"
                            class="w-full py-3 bg-gray-500 text-white font-bold text-sm rounded-xl hover:bg-gray-600 transition-all flex items-center justify-center gap-2 active:scale-95"
                            onclick="return confirm('Tutup tiket ini? Tiket yang ditutup tidak bisa dibalas lagi.')">
                        <span class="material-symbols-outlined text-lg">lock</span> Tutup Tiket
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatContainer = document.getElementById('chatContainer');
        if (!chatContainer) return;
        
        // Auto scroll chat to bottom on load
        chatContainer.scrollTop = chatContainer.scrollHeight;
            
        let isPolling = false;

        // Auto reload chat smoothly every 5 seconds
        setInterval(function() {
            if (isPolling) return;
            isPolling = true;

            // Get last message ID
            const bubbles = chatContainer.querySelectorAll('.chat-bubble');
            let lastId = 0;
            if (bubbles.length > 0) {
                const lastBubble = bubbles[bubbles.length - 1];
                lastId = lastBubble.getAttribute('data-id') || 0;
            }

            fetch(`{{ route('admin.helpdesk.messages', $ticket) }}?last_id=${lastId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.messages && data.messages.length > 0) {
                    const isScrolledToBottom = chatContainer.scrollHeight - chatContainer.clientHeight <= chatContainer.scrollTop + 50;
                    
                    // Remove empty state message if it exists
                    const emptyState = chatContainer.querySelector('.text-center.py-8');
                    if (emptyState) emptyState.remove();

                    data.messages.forEach(msg => {
                        const justify = msg.is_admin ? 'justify-end' : 'justify-start';
                        const bgColor = msg.is_admin 
                            ? 'bg-emerald-500 text-white rounded-2xl rounded-br-md' 
                            : 'bg-gray-100 text-gray-800 rounded-2xl rounded-bl-md';
                        const senderName = msg.responder_name;
                        
                        let autoReplyHtml = '';
                        if (msg.is_auto) {
                            autoReplyHtml = `
                            <div class="flex ${justify} mb-1">
                                <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[10px]">smart_toy</span> Auto-reply
                                </span>
                            </div>`;
                        }

                        // Escape HTML
                        const safeMessage = document.createElement('div');
                        safeMessage.textContent = msg.message;
                        const escapedMessage = safeMessage.innerHTML.replace(/\n/g, '<br>');

                        const bubbleHtml = `
                        <div class="flex ${justify} chat-bubble fade-in" data-id="${msg.id}" style="animation-duration: 0.3s">
                            <div class="max-w-[80%]">
                                ${autoReplyHtml}
                                <div class="${bgColor} px-5 py-3 shadow-sm">
                                    <p class="text-sm leading-relaxed">${escapedMessage}</p>
                                </div>
                                <div class="flex items-center gap-2 mt-1.5 ${justify}">
                                    <span class="text-[10px] font-medium text-gray-400">${senderName}</span>
                                    <span class="text-[10px] text-gray-300">•</span>
                                    <span class="text-[10px] text-gray-400">${msg.time}</span>
                                </div>
                            </div>
                        </div>`;

                        chatContainer.insertAdjacentHTML('beforeend', bubbleHtml);
                    });

                    // Update message count badge if exists
                    const countBadge = document.querySelector('.bg-gray-100.text-gray-500.text-xs.font-bold.px-2\\.5.py-0\\.5');
                    if (countBadge) {
                        const newCount = chatContainer.querySelectorAll('.chat-bubble').length;
                        countBadge.textContent = newCount + ' pesan';
                    }

                    if (isScrolledToBottom) {
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }
                }
            })
            .catch(err => console.error('Error fetching new messages:', err))
            .finally(() => {
                isPolling = false;
            });
        }, 5000);
    });
</script>
@endsection
