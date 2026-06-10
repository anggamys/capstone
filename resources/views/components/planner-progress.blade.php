<div class="max-w-2xl mx-auto mb-8 font-sans">
    <div class="flex items-end justify-between mb-3">
        <!-- Left Side: Wording -->
        <div class="text-left select-none">
            <span class="text-[9px] md:text-[10px] font-bold tracking-wider uppercase text-[#3F5C7D]/70">
                AI Smart Trip Planner
            </span>
            <h4 class="text-slate-800 font-extrabold text-sm md:text-base mt-1">
                Langkah <span x-text="step"></span> dari <span x-text="totalSteps"></span>
            </h4>
        </div>
        
        <!-- Right Side: Percent Badge -->
        <div class="select-none">
            <span class="px-3 py-1.5 bg-[#E6F7FA] text-[#3F5C7D] text-[10px] md:text-[11px] font-bold rounded-full border border-[#CDEBF2] shadow-sm">
                <span x-text="getProgress()"></span>% Selesai
            </span>
        </div>
    </div>

    <!-- Progress Bar Track -->
    <div class="w-full bg-[#E5EFF8] h-2 rounded-full overflow-hidden">
        <!-- Active Progress Bar -->
        <div class="bg-[#3F5C7D] h-full rounded-full transition-all duration-500 ease-out" 
             :style="`width: ${getProgress()}%`"
             role="progressbar" 
             aria-valuemin="1" 
             :aria-valuemax="totalSteps" 
             :aria-valuenow="step">
        </div>
    </div>
</div>
