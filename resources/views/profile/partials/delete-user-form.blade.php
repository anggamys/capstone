<section class="space-y-6">
    <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
        <span class="p-2 bg-rose-50 text-rose-600 rounded-xl">
            <x-lucide-alert-triangle class="w-5 h-5" stroke-width="2.5" />
        </span>
        <h2 class="text-base font-bold text-rose-600">{{ __('Delete Account') }}</h2>
    </div>

    <p class="text-sm text-slate-400 mt-1 font-medium mb-6">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center justify-center px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 cursor-pointer"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-[#2B3674] mb-3">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="text-sm text-slate-400 font-medium mb-6 leading-relaxed">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('Password') }}"
                    class="w-full sm:w-3/4 px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button 
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-6 py-3 border border-[#3F5C7D]/20 text-[#3F5C7D] hover:bg-[#3F5C7D]/5 text-sm font-bold rounded-2xl transition-all duration-200 cursor-pointer"
                >
                    {{ __('Cancel') }}
                </button>

                <button 
                    type="submit"
                    class="px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold rounded-2xl shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer"
                >
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
