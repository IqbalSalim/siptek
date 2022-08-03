<div x-cloak x-data="{ modalEdit: false }" x-on:close-modal-edit="modalEdit=false">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Waktu Presensi') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div>Waktu Presensi</div>
        </div>
    </x-slot>

    <livewire:waktu.edit-waktu></livewire:waktu.edit-waktu>

    <div id="content">
        {{-- Tabel Waktu Presensi --}}
        <div class="relative overflow-x-auto border shadow-md sm:rounded-lg dark:border-gray-700">
            <div class="p-4 bg-white dark:bg-gray-800">

                <div>
                    <h2 class="mb-2 text-xl font-semibold dark:text-white">Daftar Waktu Presensi</h2>
                </div>

            </div>

            @if ($times->isNotEmpty())
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th scope="col" class="px-6 py-3">
                                Hari
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rentang Waktu Datang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Waktu Datang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rentang Waktu Pulang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Waktu Pulang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($times as $row)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-bold">
                                    {{ $row->day }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->come_start_time)->format('H:i') . ' - ' . \Carbon\Carbon::createFromFormat('H:i:s', $row->come_end_time)->format('H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->come_time)->format('H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->go_start_time)->format('H:i') . ' - ' . \Carbon\Carbon::createFromFormat('H:i:s', $row->go_end_time)->format('H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->go_time)->format('H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button @click="modalEdit=true"
                                        wire:click.prevent="$emit('getTime', {{ $row->id }})"
                                        class="px-3 btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <p class="px-4 py-2 mt-2 text-2xl font-bold text-center text-red-500 animate-pulse">
                    Data tidak ditemukan!
                </p>
            @endif
        </div>
        {{-- End Tabel Tenaga Kontrak --}}
    </div>
</div>
