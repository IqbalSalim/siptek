<div x-cloak x-data="{ modalVerifikasi: false, modalCheckLocation: false }"
    x-on:close-modal-verifikasi="modalVerifikasi=false" x-on:close-modal-check-location="modalCheckLocation=false">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Verifikasi') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div>Verifikasi</div>
        </div>
    </x-slot>

    <livewire:verifikasi.modal-verifikasi></livewire:verifikasi.modal-verifikasi>
    
    <livewire:check-location></livewire:check-location>

    <div id="content">
        {{-- Tabel Tenaga Kontrak --}}
        <div class="relative overflow-x-auto border shadow-md sm:rounded-lg dark:border-gray-700">
            <div class="p-4 bg-white dark:bg-gray-800">
                <div class="flex flex-row items-center justify-between">
                    <div>
                        <h2 class="mb-2 text-xl font-semibold dark:text-white">Verifikasi Dinas Luar</h2>
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
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block md:w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Cari berdasarkan nama">
                        </div>
                    </div>
                </div>
            </div>

            @if ($presences->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Keterangan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presences as $row)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <div class="flex flex-row space-x-3">
                                    <div class="w-10 h-10">
                                        <img src="{{ asset($row->user->employee->image) }}" alt=""
                                            class="object-cover w-10 h-10 rounded-lg">
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800 dark:text-white">
                                            {{ $row->user->name }}</p>
                                        <span class="text-xs text-gray-400">{{ $row->member_id }}
                                            {{ $row->user->email }}</span>
                                    </div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ $row->created_at->isoFormat('dddd, D MMMM Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $row->description }}
                            </td>
                            <td @class([ 'px-6 py-4 uppercase font-medium' , 'text-yellow-500'=> $row->status ==
                                'submission',
                                'text-green-500' => $row->status == 'approved',
                                'text-red-500' => $row->status == 'rejected',
                                ])>
                                {{ $row->status }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button @click="modalCheckLocation=true"
                                    wire:click.prevent="$emit('checkLocation', {{ $row->id }})"
                                    class="px-3 bg-orange-500 btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>


                                </button>
                                <button @click="modalVerifikasi=true"
                                    wire:click.prevent="$emit('getVerifikasi', {{ $row->id }})"
                                    class="px-3 btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{ $presences->links() }}
            @else
            <p class="px-4 py-2 mt-2 text-2xl font-bold text-center text-red-500 animate-pulse">
                Data tidak ditemukan!
            </p>
            @endif
        </div>
        {{-- End Tabel Tenaga Kontrak --}}
    </div>
</div>