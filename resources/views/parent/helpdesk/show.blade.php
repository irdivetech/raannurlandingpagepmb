@extends('layouts.parent')

@section('title', 'Detail Tiket #' . $ticket->id . ' | RA AN-NUUR')

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
    
    /* Star Rating */
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    .star-rating input {
        display: none;
    }
    .star-rating label {
        color: #e5e7eb;
        font-size: 32px;
        cursor: pointer;
        transition: color 0.2s;
    }
    .star-rating label .material-symbols-outlined {
        font-variation-settings: 'FILL' 1;
    }
    .star-rating :checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #fbbf24;
    }
</style>
@endsection

@section('content')
<main class="md:ml-[280px] min-h-screen px-4 md:px-8 py-8 bg-gray-50">

    {{-- Header --}}
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 fade-in">
        <div>
            <nav class="flex items-center text-gray-400 gap-1 mb-2">
                <span class="text-xs">Portal</span>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <a href="{{ route('parent.helpdesk.index') }}" class="text-xs hover:text-emerald-500 transition-colors">Pusat Bantuan</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-xs font-semibold text-emerald-500">Tiket #{{ $ticket->id }}</span>
            </nav>
            <h2 class="font-display text-2xl md:text-3xl font-bold text-gray-900">{{ $ticket->subject }}</h2>
        </div>
        <a href="{{ route('parent.helpdesk.index') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 font-bold text-sm rounded-xl hover:bg-gray-50 transition-all shadow-sm w-fit">
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
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-xl mb-6 flex items-center gap-2 fade-in">
        <span class="material-symbols-outlined text-lg" style="font-variation-settings:'FILL' 1;">error</span>
        <span class="text-sm font-medium">{{ session('error') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        {{-- LEFT: Info & Rating (4 cols, order 2 on mobile) --}}
        <div class="lg:col-span-4 order-2 lg:order-1 space-y-6">

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
                            <span class="badge bg-emerald-100 text-emerald-700">Selesai</span>
                        @else
                            <span class="badge bg-gray-100 text-gray-500">Ditutup</span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Kategori</span>
                        <span class="text-sm font-semibold text-gray-700">{{ $ticket->category_label }}</span>
                    </div>
                    <div class="border-t border-gray-50 my-2"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Dibuat Pada</span>
                        <span class="text-xs text-gray-500">{{ $ticket->created_at->translatedFormat('d M Y, H:i') }}</span>
                    </div>
                    @if($ticket->resolved_at)
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Selesai Pada</span>
                        <span class="text-xs text-gray-500">{{ $ticket->resolved_at->translatedFormat('d M Y, H:i') }}</span>
                    </div>
                    @endif
                </div>

                {{-- Read only description --}}
                <div class="mt-6 pt-4 border-t border-gray-50">
                    <span class="text-xs text-gray-400 font-medium block mb-2">Deskripsi Awal</span>
                    <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $ticket->description }}</p>
                </div>
            </div>

            {{-- Rating Panel (Jika sudah resolved) --}}
            @if($ticket->status === 'resolved' && !$ticket->rating)
            <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 rounded-2xl border border-amber-200/50 shadow-sm p-6 fade-in" style="animation-delay:.15s">
                <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center text-amber-500 mb-3">
                    <span class="material-symbols-outlined text-2xl" style="font-variation-settings:'FILL' 1;">stars</span>
                </div>
                <h3 class="font-bold text-amber-900 mb-2">Beri Penilaian</h3>
                <p class="text-sm text-amber-800/80 mb-4 leading-relaxed">Masalah Anda telah ditandai selesai. Bagaimana layanan kami? Penilaian Anda sangat berarti bagi kami.</p>
                
                <form action="{{ route('parent.helpdesk.rate', $ticket) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required />
                            <label for="star5" title="5 stars"><span class="material-symbols-outlined">star</span></label>
                            
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="4 stars"><span class="material-symbols-outlined">star</span></label>
                            
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="3 stars"><span class="material-symbols-outlined">star</span></label>
                            
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="2 stars"><span class="material-symbols-outlined">star</span></label>
                            
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="1 star"><span class="material-symbols-outlined">star</span></label>
                        </div>
                    </div>
                    <textarea name="comment" rows="2" placeholder="Tulis komentar (opsional)..." class="w-full border-0 bg-white/60 rounded-xl p-3 text-sm focus:ring-2 focus:ring-amber-300 outline-none resize-none mb-3 placeholder:text-amber-900/40 text-amber-900"></textarea>
                    <button type="submit" class="w-full py-2.5 bg-amber-500 text-white font-bold text-sm rounded-xl hover:bg-amber-600 transition-all shadow-md shadow-amber-500/20 active:scale-95">
                        Kirim Penilaian
                    </button>
                </form>
            </div>
            @elseif($ticket->rating)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 fade-in" style="animation-delay:.15s">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg text-amber-500">stars</span> Penilaian Anda
                </h3>
                <div class="flex items-center gap-1 mb-3">
                    @for($s = 1; $s <= 5; $s++)
                        <span class="material-symbols-outlined text-2xl {{ $s <= $ticket->rating->rating ? 'text-amber-400' : 'text-gray-200' }}" style="font-variation-settings:'FILL' 1;">star</span>
                    @endfor
                </div>
                @if($ticket->rating->comment)
                <p class="text-sm text-gray-600 italic leading-relaxed">"{{ $ticket->rating->comment }}"</p>
                @endif
            </div>
            @endif

        </div>

        {{-- RIGHT: Chat Thread (8 cols, order 1 on mobile) --}}
        <div class="lg:col-span-8 order-1 lg:order-2 space-y-6">
            
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm fade-in flex flex-col h-[600px]" style="animation-delay:.05s">
                <div class="p-5 border-b border-gray-100 flex items-center gap-2 flex-shrink-0">
                    <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-500">
                        <span class="material-symbols-outlined text-lg">forum</span>
                    </div>
                    <h3 class="font-bold text-gray-900">Percakapan</h3>
                </div>

                <div class="p-5 space-y-5 overflow-y-auto flex-1 preview-scroll" id="chatContainer">
                    @forelse($ticket->responses as $idx => $response)
                    @php
                        // Bagi orang tua, pesan dari admin ada di kiri, pesan sendiri di kanan.
                        $isMe = $response->responder_id === Auth::id();
                        $isAuto = $response->is_auto_reply;
                    @endphp
                    <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} chat-bubble" data-id="{{ $response->id }}">
                        <div class="max-w-[85%] md:max-w-[75%]">
                            @if($isAuto)
                            <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} mb-1">
                                <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[10px]">smart_toy</span> Pesan Otomatis
                                </span>
                            </div>
                            @endif

                            <div class="{{ $isMe
                                ? 'bg-emerald-500 text-white rounded-2xl rounded-br-md shadow-emerald-500/10'
                                : 'bg-gray-100 text-gray-800 rounded-2xl rounded-bl-md shadow-gray-500/5' }} px-5 py-3 shadow-sm">
                                <p class="text-[15px] leading-relaxed whitespace-pre-line">{{ $response->message }}</p>
                            </div>
                            <div class="flex items-center gap-2 mt-1.5 {{ $isMe ? 'justify-end' : 'justify-start' }}">
                                <span class="text-[10px] font-medium text-gray-400">
                                    {{ $isMe ? 'Anda' : ($isAuto ? 'Sistem' : 'Admin / CS') }}
                                </span>
                                <span class="text-[10px] text-gray-300">•</span>
                                <span class="text-[10px] text-gray-400">{{ $response->created_at->translatedFormat('d M H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12 h-full flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-5xl text-gray-200 mb-3">chat_bubble_outline</span>
                        <p class="text-gray-400 text-sm">Belum ada percakapan. Mulai percakapan jika Anda memiliki pertanyaan tambahan.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Reply Form --}}
                @if($ticket->status !== 'closed')
                <div class="p-4 md:p-5 border-t border-gray-100 bg-gray-50/50 flex-shrink-0">
                    <form action="{{ route('parent.helpdesk.reply', $ticket) }}" method="POST">
                        @csrf
                        <div class="relative">
                            <textarea name="message" rows="2" required
                                      placeholder="Ketik pesan / pertanyaan tambahan Anda di sini..."
                                      class="w-full border border-gray-200 rounded-xl pl-4 pr-16 py-3.5 text-sm focus:ring-2 focus:ring-emerald-300 focus:border-emerald-400 outline-none resize-none transition-all shadow-sm"></textarea>
                            <button type="submit"
                                    class="absolute right-2.5 top-1/2 -translate-y-1/2 w-10 h-10 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-all shadow-md shadow-emerald-500/20 active:scale-95 flex items-center justify-center">
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings:'FILL' 1;">send</span>
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div class="p-5 border-t border-gray-100 text-center bg-gray-50/50 flex-shrink-0">
                    <p class="text-gray-400 text-sm font-medium">Tiket ini telah ditutup dan tidak dapat dibalas lagi.</p>
                </div>
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

            fetch(`{{ route('parent.helpdesk.messages', $ticket) }}?last_id=${lastId}`, {
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
                    const emptyState = chatContainer.querySelector('.text-center.py-12');
                    if (emptyState) emptyState.remove();

                    data.messages.forEach(msg => {
                        const justify = msg.is_me ? 'justify-end' : 'justify-start';
                        const bgColor = msg.is_me 
                            ? 'bg-emerald-500 text-white rounded-2xl rounded-br-md shadow-emerald-500/10' 
                            : 'bg-gray-100 text-gray-800 rounded-2xl rounded-bl-md shadow-gray-500/5';
                        const senderName = msg.is_me ? 'Anda' : (msg.is_auto ? 'Sistem' : 'Admin / CS');
                        
                        let autoReplyHtml = '';
                        if (msg.is_auto) {
                            autoReplyHtml = `
                            <div class="flex ${justify} mb-1">
                                <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[10px]">smart_toy</span> Pesan Otomatis
                                </span>
                            </div>`;
                        }

                        // Escape HTML to prevent XSS
                        const safeMessage = document.createElement('div');
                        safeMessage.textContent = msg.message;
                        const escapedMessage = safeMessage.innerHTML.replace(/\n/g, '<br>');

                        const bubbleHtml = `
                        <div class="flex ${justify} chat-bubble fade-in" data-id="${msg.id}" style="animation-duration: 0.3s">
                            <div class="max-w-[85%] md:max-w-[75%]">
                                ${autoReplyHtml}
                                <div class="${bgColor} px-5 py-3 shadow-sm">
                                    <p class="text-[15px] leading-relaxed">${escapedMessage}</p>
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
