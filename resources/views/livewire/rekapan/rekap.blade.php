<div x-cloak x-data="{ rekapan: false }" x-on:close-rekapan="rekapan=false">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Laporan') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div>Laporan</div>
        </div>
    </x-slot>


    <div id="content">
        {{-- Tabel Rekapan --}}
        <div class="relative overflow-x-auto border shadow-md sm:rounded-lg dark:border-gray-700">
            <div class="p-4 bg-white dark:bg-gray-800">

                <div>
                    <h2 class="mb-2 text-xl font-semibold dark:text-white">Laporan Presensi</h2>
                </div>

            </div>
            <div class="flex flex-row items-end p-4 space-x-4 bg-white dark:bg-gray-800">
                <div>
                    <label for="table-search">Pilih Bulan dan Tahun</label>
                    <input type="month" wire:model='perMonth' class="mt-1">
                </div>
                <div>
                    <button class="btn-primary btn-icon" @click="rekapan=true" wire:click='filter'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filter
                    </button>
                </div>
            </div>

            <div x-show='rekapan' class="overflow-x-auto">
                @if (count($rekapan) > 0)
                    <table
                        class="w-full text-sm text-left text-gray-500 table-auto border-slate-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr>

                                <th scope="col" class="px-6 py-3 border border-slate-600 ">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 border border-slate-600">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 border border-slate-600">
                                    Waktu Datang
                                </th>
                                <th scope="col" class="px-6 py-3 border border-slate-600">
                                    Waktu Pulang
                                </th>
                                <th scope="col" class="px-6 py-3 border border-slate-600">
                                    Terlambat (menit)
                                </th>
                                <th scope="col" class="px-6 py-3 border border-slate-600">
                                    Pulang Cepat (menit)
                                </th>
                                <th scope="col" class="px-6 py-3 border border-slate-600">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekapan as $key => $row)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 border border-slate-600">
                                        {{ $key }}
                                    </td>
                                    <td class="px-6 py-4 font-bold border border-slate-600">
                                        {{ $row['tanggal'] }}
                                    </td>
                                    <td class="px-6 py-4 border border-slate-600">
                                        {{ $row['come_presence'] }}
                                    </td>
                                    <td class="px-6 py-4 border border-slate-600">
                                        {{ $row['go_presence'] }}
                                    </td>
                                    <td class="px-6 py-4 border border-slate-600">
                                        {{ $row['late_minutes'] }}
                                    </td>
                                    <td class="px-6 py-4 border border-slate-600">
                                        {{ $row['quick_minutes'] }}
                                    </td>
                                    <td class="px-6 py-4 border border-slate-600">
                                        {{ $row['code'] }}
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
        </div>
        {{-- End Tabel Tenaga Kontrak --}}
    </div>
</div>
