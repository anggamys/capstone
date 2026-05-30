<section>
    <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
        <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
            <x-lucide-lock class="w-5 h-5" stroke-width="2.5" />
        </span>
        <h2 class="text-base font-bold text-[#2B3674]">{{ __('Update Password') }}</h2>
    </div>

    <p class="text-sm text-slate-400 mt-1 font-medium mb-6">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-bold text-[#2B3674] mb-2">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" 
                   name="current_password" 
                   type="password" 
                   autocomplete="current-password"
                   class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-bold text-[#2B3674] mb-2">{{ __('New Password') }}</label>
            <input id="update_password_password" 
                   name="password" 
                   type="password" 
                   autocomplete="new-password"
                   class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-bold text-[#2B3674] mb-2">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" 
                   name="password_confirmation" 
                   type="password" 
                   autocomplete="new-password"
                   class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 bg-[#3F5C7D] hover:bg-[#344d6b] text-white text-sm font-bold rounded-2xl shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-semibold"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
