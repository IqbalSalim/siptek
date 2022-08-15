<div x-cloak x-data="{ rekapan: false }" x-on:close-rekapan="rekapan=false">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Rekapan') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div>Rekapan</div>
        </div>
    </x-slot>



    <div id="content">
        {{-- Tabel Rekapan --}}
        <div class="relative overflow-x-auto border shadow-md sm:rounded-lg dark:border-gray-700">
            <div class="p-4 bg-white dark:bg-gray-800">
                <div>
                    <h2 class="mb-2 text-xl font-semibold dark:text-white">Rekapan</h2>
                </div>
            </div>
            <div class="flex flex-row items-end justify-between p-4 space-x-4 bg-white dark:bg-gray-800">
                <div class="flex flex-row items-end space-x-4">
                    <div>
                        <label for="table-search">Pilih Bulan Rekapan</label>
                        <input type="month" wire:model='perMonth' class="mt-1">
                    </div>
                    <div>
                        <button class="btn-primary btn-icon" @click="rekapan=true" wire:click='filter'>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>
                <div x-show='rekapan'>
                    <button wire:click='cetakExcel' class="btn-primary">Cetak Excel</button>
                    {{-- <form action="{{ route('cetak-rekapan') }}" method="POST" target="_blank" novalidate>
                        @csrf
                        <input type="hidden" name="tanggal" value="{{ $perMonth }}">
                        <button type="submit" class="btn-primary">Cetak Excel</button>
                    </form> --}}
                </div>
            </div>

            <div x-show='rekapan' class="overflow-x-auto">
                @if (count($rekapan) > 0)
                    <table
                        class="w-full text-sm text-left text-gray-500 border border-collapse table-auto border-slate-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 border border-slate-600">
                                    Nama
                                </th>
                                @for ($i = 1; $i <= $this->countDays; $i++)
                                    <th scope="col" class="px-6 py-3 font-bold border border-slate-600">
                                        {{ $i }}
                                    </th>
                                @endfor
                                <th scope="col" class="px-6 py-3 border border-slate-600">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekapan as $row)
                                @php
                                    $totalTerlambat = 0;
                                    $totalCepat = 0;
                                @endphp
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-bold border border-slate-600">
                                        {{ $row['nama'] }}
                                    </td>
                                    @if (count($rekapan) > 0)
                                        @for ($i = 1; $i <= $this->countDays; $i++)
                                            <td class="px-6 py-4 border border-slate-600">
                                                {{ $row['pertanggal'][$i]['code'] }}
                                                {{ $row['pertanggal'][$i]['come_presence'] ? 'Jam Masuk: ' . \Carbon\Carbon::createFromFormat('H:i:s', $row['pertanggal'][$i]['come_presence'])->format('H:i') : null }}
                                                {{ $row['pertanggal'][$i]['go_presence'] ? 'Jam Pulang: ' . \Carbon\Carbon::createFromFormat('H:i:s', $row['pertanggal'][$i]['go_presence'])->format('H:i') : null }}
                                                <br>
                                                {{ $row['pertanggal'][$i]['late_minutes'] ? 'Terlambat :' . $row['pertanggal'][$i]['late_minutes'] . ' (' . $row['pertanggal'][$i]['come_code'] . ')' : null }}
                                                <br>
                                                {{ $row['pertanggal'][$i]['quick_minutes'] ? 'Cepat Pulang :' . $row['pertanggal'][$i]['quick_minutes'] . ' (' . $row['pertanggal'][$i]['go_code'] . ')' : null }}
                                            </td>
                                            @php
                                                $totalTerlambat = $row['pertanggal'][$i]['late_minutes'] ? $totalTerlambat + $row['pertanggal'][$i]['late_minutes'] : $totalTerlambat;
                                                $totalCepat = $row['pertanggal'][$i]['quick_minutes'] ? $totalCepat + $row['pertanggal'][$i]['quick_minutes'] : $totalCepat;
                                            @endphp
                                        @endfor
                                    @endif
                                    <td class="px-6 py-4 border border-slate-600">
                                        <p> {{ $totalTerlambat }}</p>
                                        <p> {{ $totalCepat }}</p>
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
