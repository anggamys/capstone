<section>
    <div class="flex items-center gap-3 mb-6 pb-2 border-b border-slate-100">
        <span class="p-2 bg-[#F4F7FE] text-[#3F5C7D] rounded-xl">
            <x-lucide-user class="w-5 h-5" stroke-width="2.5" />
        </span>
        <h2 class="text-base font-bold text-[#2B3674]">{{ __('Profile Information') }}</h2>
    </div>

    <p class="text-sm text-slate-400 mt-1 font-medium mb-6">
        {{ __("Update your account's profile information and email address.") }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-bold text-[#2B3674] mb-2">{{ __('Name') }}</label>
            <input id="name" 
                   name="name" 
                   type="text" 
                   value="{{ old('name', $user->name) }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-sm font-bold text-[#2B3674] mb-2">{{ __('Email') }}</label>
            <input id="email" 
                   name="email" 
                   type="email" 
                   value="{{ old('email', $user->email) }}" 
                   required 
                   autocomplete="username"
                   class="w-full px-5 py-4 bg-[#F4F7FE] text-[#2B3674] placeholder-[#8F9BBA] rounded-2xl border-none focus:ring-2 focus:ring-[#89A8E0]/40 focus:outline-none transition-all duration-200 text-sm font-semibold" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 bg-[#3F5C7D] hover:bg-[#344d6b] text-white text-sm font-bold rounded-2xl shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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
