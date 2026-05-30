<x-app-layout>
    <x-slot name="header">
        {{ __('Pengaturan Profil') }}
    </x-slot>

    <div class="py-2">
        <!-- Header Title & Action Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-[#2B3674]">Pengaturan Profil</h1>
                <p class="text-sm text-slate-400 mt-1 font-medium">Kelola data akun, kata sandi, dan keamanan</p>
            </div>
        </div>

        <div class="space-y-6 max-w-4xl">
            <!-- 1. Informasi Profil -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- 2. Perbarui Kata Sandi -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-indigo-100/10">
                @include('profile.partials.update-password-form')
            </div>

            <!-- 3. Hapus Akun -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-rose-100/50">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
