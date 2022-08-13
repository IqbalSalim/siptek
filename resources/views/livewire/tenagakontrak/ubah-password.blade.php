<div x-cloak x-data="{ modalEdit: false }" x-on:close-modal-edit="modalEdit=false">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Ubah Password') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div>Ubah Password</div>
        </div>
    </x-slot>

    <livewire:waktu.edit-waktu></livewire:waktu.edit-waktu>

    <div id="content">
        {{-- Tabel Ubah Password --}}
        <div class="relative overflow-x-auto border shadow-md sm:rounded-lg dark:border-gray-700">
            <div class="flex flex-row justify-between p-4 bg-white dark:bg-gray-800">
                <div>
                    <h2 class="mb-2 text-xl font-semibold dark:text-white">Ubah Password</h2>
                </div>
                <div>
                    <button class="btn-primary">Kembali</button>
                </div>
            </div>
            <div class="flex flex-row items-start p-4 space-x-8 md:w-1/2">
                <div class="flex-1">
                    <label for="password">Password Baru</label>
                    <input type="password" wire:model='password' id="password" class="mt-1">
                    <span class="text-xs text-red-700">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="flex-1">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" wire:model='password_confirmation' id="password_confirmation" class="mt-1">
                </div>

            </div>
            <div class="p-4 align-baseline">
                <button wire:click.prevent='update' class="btn-primary">Simpan</button>
            </div>
        </div>
        {{-- End Tabel Tenaga Kontrak --}}
    </div>
</div>
