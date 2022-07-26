<div x-cloak x-data="{ modalWfo: false, modalDl: false }" x-on:close-modal-wfo="modalWfo=false" x-on:close-modal-dl="modalDl=false">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Presensi') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
            <div>-</div>
            <div>Presensi</div>
        </div>
    </x-slot>

    <livewire:presensi.wfo-presensi></livewire:presensi.wfo-presensi>
    <livewire:presensi.dl-presensi></livewire:presensi.dl-presensi>

    <div id="content">
        <div class="flex flex-row space-x-4">
            {{-- Tabel Waktu Presensi --}}
            <div class="relative w-full overflow-x-auto border shadow-md md:w-1/2 sm:rounded-lg dark:border-gray-700">
                <div class="flex flex-row items-center justify-between p-4 bg-white dark:bg-gray-800">
                    <div>
                        <p class="text-lg font-semibold dark:text-white">Presensi Per Hari</p>
                        <span class="text-sm font-medium text-gray-400">
                            {{ $presence ? $presence->created_at->isoFormat('dddd, D MMMM Y') : $date->isoFormat('dddd, D MMMM Y') }}
                        </span>
                    </div>
                    <div class="flex flex-row space-x-4">
                        <button class="p-1 font-medium rounded-full btn-primary" wire:click='plusDay'>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="p-1 font-medium rounded-full btn-primary" wire:click='minusDay'>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-6 py-4">
                    <div class="flex flex-col items-center">
                        <h2 class="text-2xl font-bold">
                            {{ $come ? \Carbon\Carbon::createFromFormat('H:i:s', $come)->format('H:i') : '--:--' }}
                        </h2>
                        <span class="font-medium text-gray-400">Datang</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <h2 class="text-2xl font-bold">
                            {{ $go ? \Carbon\Carbon::createFromFormat('H:i:s', $go)->format('H:i') : '--:--' }}
                        </h2>
                        <span class="font-medium text-gray-400">Pulang</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <h2 class="text-2xl font-bold uppercase">
                            {{ $status ? $status : '--' }}
                        </h2>
                        <span class="font-medium text-gray-400">Status</span>
                    </div>
                </div>

                {{-- Tabel Presensi Bulan --}}
                <div class="flex flex-row items-start justify-between p-4 bg-white dark:bg-gray-800">
                    <div>
                        <p class="text-lg font-semibold dark:text-white">Presensi Per Bulan</p>
                        <span class="text-sm font-medium text-gray-400">Juli, 2022</span>
                    </div>
                    <div>
                        <input type="month" wire:model='perMonth' wire:change='changePerMonth'>
                    </div>
                </div>
                <div class="flex flex-col divide-y-2">
                    @if ($presences)
                        @foreach ($presences as $row)
                            <div class="grid items-center grid-cols-4 space-x-4">
                                <div class="px-6 py-2">
                                    <img src="{{ $row->come_photo ? asset($row->come_photo) : asset('images/no-image.jfif') }}"
                                        alt="" class="w-10 h-10 bg-cover rounded-lg">
                                </div>
                                <div class="col-span-2 mx-auto">
                                    <div class="relative mx-auto">
                                        <p class="font-medium text">{{ $row->created_at->isoFormat('dddd, D MMMM Y') }}
                                        </p>
                                        <span class="block text-xs font-medium text-gray-800">Datang:
                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $row->come_presence)->format('H:i') }},
                                            Pulang:
                                            {{ $row->go_presence ? \Carbon\Carbon::createFromFormat('H:i:s', $row->go_presence)->format('H:i') : '--:--' }}</span>

                                    </div>
                                </div>
                                <div class="px-6 py-2">
                                    <div class="px-2 py-2 text-center bg-blue-500 rounded-lg">
                                        <span
                                            class="text-sm font-medium text-white uppercase">{{ $row->type }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="px-4 py-2">
                            {{ $presences->links() }}
                        </div>
                    @else
                        <div class="flex flex-col justify-center text-red-500">
                            Data Kosong
                        </div>
                    @endif


                </div>

            </div>
            {{-- End Tabel Waktu Presensi --}}

            <div class="w-full md:w-1/2">
                <div class="flex flex-row justify-center space-x-4">
                    <div class="flex flex-col items-center">
                        <button {{ $typeToDay == 'DL' ? 'disabled' : null }}
                            class="shadow-lg {{ $typeToDay == 'DL' ? 'btn-danger cursor-not-allowed' : 'btn-primary' }}"
                            @click='modalWfo=true'>
                            <x-ilustration.wfo class="w-32 h-32" />
                            <span class="font-bold text-white">W F O</span>
                        </button>
                    </div>
                    <div class="flex flex-col items-center">
                        <button {{ $typeToDay == 'WFO' || $file ? 'disabled' : null }}
                            class="shadow-lg {{ $typeToDay == 'WFO' || $file ? 'btn-danger cursor-not-allowed' : 'btn-primary' }}"
                            @click='modalDl=true'>
                            <x-ilustration.dl class="w-32 h-32" />
                            <span class="font-bold text-white">D L</span>
                        </button>
                    </div>
                </div>

                <div class="p-4 mt-4 bg-blue-500 bg-opacity-50 rounded-lg">
                    <h2 class="font-bold text-white">Rule Presensi Online</h2>
                    <ul class="px-4 font-medium text-gray-800 list-decimal">
                        <li>Jam datang/presensi datang: mulai pukul <span class="text-blue-700">06:00</span>, ditutup
                            jam
                            <span class="text-blue-700">
                                10:00
                            </span> waktu setempat
                        </li>
                        <li>Jam pulang/presensi pulang: mulai pukul <span class="text-blue-700">16:00</span>, ditutup
                            sebelum <span class="text-blue-700">memasuki tanggal berikutnya</span>
                            waktu setempat</li>
                    </ul>
                </div>
            </div>


        </div>
    </div>
</div>
