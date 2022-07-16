<div x-cloak x-data="{ modalTambah: false, modalEdit: false }" x-on:close-modal-tambah="modalTambah=false" x-on:close-modal-edit="modalEdit=false">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Tenaga Kontrak') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div>Tenaga Kontrak</div>
        </div>
    </x-slot>

    <livewire:tenagakontrak.tambah-tenagakontrak></livewire:tenagakontrak.tambah-tenagakontrak>
    <livewire:tenagakontrak.edit-tenagakontrak></livewire:tenagakontrak.edit-tenagakontrak>

    <div id="content">
        {{-- Tabel Tenaga Kontrak --}}
        <div class="relative overflow-x-auto border shadow-md sm:rounded-lg dark:border-gray-700">
            <div class="p-4 bg-white dark:bg-gray-800">
                <div class="flex flex-row items-center justify-between">
                    <div>
                        <h2 class="mb-2 text-xl font-semibold dark:text-white">Daftar Tenaga Kontrak</h2>
                    </div>
                    <div>
                        <button class="btn-primary btn-icon" @click="modalTambah=true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 -ml-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah
                        </button>
                    </div>
                </div>
                <div class="flex flex-row items-center justify-between mt-2">
                    <div>
                        <label for="table-search" class="sr-only">Item</label>
                        <select wire:model='paginate'
                            class="text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <div>
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="table-search" wire:model='search'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Cari berdasarkan nama">
                        </div>
                    </div>
                </div>
            </div>

            @if ($employees->isNotEmpty())
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tempat Tanggal Lahir
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pendidikan Terakhir
                            </th>
                            <th scope="col" class="px-6 py-3">
                                No Telepon
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Alamat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $row)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    <div class="flex flex-row space-x-3">
                                        <div class="w-10 h-10">
                                            <img src="{{ asset($row->image) }}" alt=""
                                                class="object-cover w-10 h-10 rounded-lg">
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800 dark:text-white">
                                                {{ $row->user->name }}</p>
                                            <span class="text-xs text-gray-400">{{ $row->user->email }}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $row->birthplace . ', ' . $row->birthdate }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $row->last_education }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $row->phone }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $row->address }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button @click="modalEdit=true"
                                        wire:click.prevent="$emit('getEmployee', {{ $row->user_id }})"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $employees->links() }}
            @else
                <p class="px-4 py-2 mt-2 text-2xl font-bold text-center text-red-500 animate-pulse">
                    Data tidak ditemukan!
                </p>
            @endif
        </div>
        {{-- End Tabel Tenaga Kontrak --}}
    </div>
</div>
