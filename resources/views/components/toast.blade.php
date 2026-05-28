@if (session('success') || session('error') || session('status'))
    @php
        $message = session('success') ?? session('error') ?? session('status');
        $type = session('success') ? 'success' : (session('error') ? 'error' : 'info');
        $iconBg = match($type) {
            'success' => 'bg-emerald-500 text-white shadow-emerald-500/20',
            'error' => 'bg-rose-500 text-white shadow-rose-500/20',
            default => 'bg-blue-500 text-white shadow-blue-500/20'
        };
        $title = match($type) {
            'success' => 'Berhasil!',
            'error' => 'Gagal!',
            default => 'Informasi!'
        };
    @endphp

    <div x-data="{ 
            show: false,
            progress: 100,
            init() {
                setTimeout(() => this.show = true, 50);
                
                let duration = 4000; 
                let intervalTime = 40;
                let steps = duration / intervalTime;
                let step = 0;
                
                let timer = setInterval(() => {
                    step++;
                    this.progress = 100 - (step / steps * 100);
                    if (step >= steps) {
                        clearInterval(timer);
                        this.dismiss();
                    }
                }, intervalTime);
            },
            dismiss() {
                this.show = false;
            }
         }"
         x-show="show"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-x-full opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-x-0 opacity-100"
         x-transition:leave-end="translate-x-full opacity-0"
         class="fixed top-6 right-6 z-[9999] max-w-sm w-[calc(100vw-3rem)] sm:w-96 bg-white border {{ $type === 'success' ? 'border-emerald-100' : ($type === 'error' ? 'border-rose-100' : 'border-blue-100') }} rounded-2xl shadow-xl shadow-[#3F5C7D]/5 overflow-hidden flex flex-col"
         style="display: none;">
         
         <div class="p-4 flex items-center justify-between gap-3">
             <div class="flex items-center gap-3">
                 <span class="p-2 {{ $iconBg }} rounded-xl shadow-md shrink-0 flex items-center justify-center">
                     @if($type === 'success')
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                             <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                         </svg>
                     @elseif($type === 'error')
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                         </svg>
                     @else
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 1 1 1.085 1.086L12 13.5m0-5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                         </svg>
                     @endif
                 </span>
                 <div>
                     <p class="text-sm font-bold text-[#2B3674]">{{ $title }}</p>
                     <p class="text-xs text-slate-400 font-medium mt-0.5 leading-relaxed">{{ $message }}</p>
                 </div>
             </div>
             <button type="button" @click="dismiss()" class="text-slate-350 hover:text-slate-500 transition-colors p-1.5 hover:bg-slate-50 rounded-lg shrink-0">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                 </svg>
             </button>
         </div>

         <!-- Progress Bar -->
         <div class="h-1 w-full bg-slate-100">
             <div class="h-full {{ $type === 'success' ? 'bg-emerald-500' : ($type === 'error' ? 'bg-rose-500' : 'bg-blue-500') }} transition-all duration-75" 
                  :style="`width: ${progress}%`"
                  style="width: 100%;"></div>
         </div>
    </div>
@endif
