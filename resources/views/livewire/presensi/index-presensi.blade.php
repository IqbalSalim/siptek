<div x-cloak x-data="{ modalEdit: false }" x-on:close-modal-edit="modalEdit=false">
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

    {{-- <livewire:waktu.edit-waktu></livewire:waktu.edit-waktu> --}}

    <div id="content">
        <div class="flex flex-row space-x-4">
            {{-- Tabel Waktu Presensi --}}
            <div class="relative w-full overflow-x-auto border shadow-md md:w-1/2 sm:rounded-lg dark:border-gray-700">
                <div class="p-4 bg-white dark:bg-gray-800">
                    <p class="text-lg font-semibold dark:text-white">Presensi Per Hari</p>
                    <span class="text-sm font-medium text-gray-400">Senin, 27-07-2022</span>
                </div>
                <div class="grid grid-cols-3 gap-6 py-4">
                    <div class="flex flex-col items-center">
                        <h2 class="text-2xl font-bold">09:00</h2>
                        <span class="font-medium text-gray-400">Datang</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <h2 class="text-2xl font-bold">09:00</h2>
                        <span class="font-medium text-gray-400">Pulang</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <h2 class="text-2xl font-bold uppercase">wfo</h2>
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
                        <x-datetime-picker label="Appointment Date" placeholder="Appointment Date"
                            wire:model.defer="normalPicker" />
                    </div>
                </div>
                <div class="flex flex-col divide-y-2">
                    <div class="flex flex-row items-center space-x-4">
                        <div class="px-6 py-2">
                            <img src="{{ asset('images/no-image.jfif') }}" alt=""
                                class="w-10 h-10 bg-cover rounded-lg">
                        </div>
                        <div class="flex-1 mx-auto">
                            <div class="relative mx-auto">
                                <p class="font-medium text">Senin, 27-07-2022</p>
                                <span class="block text-xs font-medium text-gray-800">Datang: 09:00 , Pulang:
                                    16:00</span>

                            </div>
                        </div>
                        <div class="px-6 py-2">
                            <div class="px-2 py-2 bg-blue-500 rounded-lg">
                                <span class="text-sm font-medium text-white uppercase">wfo</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row items-center space-x-4">
                        <div class="px-6 py-2">
                            <img src="{{ asset('images/no-image.jfif') }}" alt=""
                                class="w-10 h-10 bg-cover rounded-lg">
                        </div>
                        <div class="flex-1 mx-auto">
                            <div class="relative mx-auto">
                                <p class="font-medium text">Senin, 27-07-2022</p>
                                <span class="block text-xs font-medium text-gray-800">Datang: 09:00 , Pulang:
                                    16:00</span>

                            </div>
                        </div>
                        <div class="px-6 py-2">
                            <div class="px-2 py-2 bg-blue-500 rounded-lg">
                                <span class="text-sm font-medium text-white uppercase">wfo</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row items-center space-x-4">
                        <div class="px-6 py-2">
                            <img src="{{ asset('images/no-image.jfif') }}" alt=""
                                class="w-10 h-10 bg-cover rounded-lg">
                        </div>
                        <div class="flex-1 mx-auto">
                            <div class="relative mx-auto">
                                <p class="font-medium text">Senin, 27-07-2022</p>
                                <span class="block text-xs font-medium text-gray-800">Datang: 09:00 , Pulang:
                                    16:00</span>

                            </div>
                        </div>
                        <div class="px-6 py-2">
                            <div class="px-2 py-2 bg-blue-500 rounded-lg">
                                <span class="text-sm font-medium text-white uppercase">wfo</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row items-center space-x-4">
                        <div class="px-6 py-2">
                            <img src="{{ asset('images/no-image.jfif') }}" alt=""
                                class="w-10 h-10 bg-cover rounded-lg">
                        </div>
                        <div class="flex-1 mx-auto">
                            <div class="relative mx-auto">
                                <p class="font-medium text">Senin, 27-07-2022</p>
                                <span class="block text-xs font-medium text-gray-800">Datang: 09:00 , Pulang:
                                    16:00</span>

                            </div>
                        </div>
                        <div class="px-6 py-2">
                            <div class="px-2 py-2 bg-blue-500 rounded-lg">
                                <span class="text-sm font-medium text-white uppercase">wfo</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- End Tabel Waktu Presensi --}}

            <div class="w-full md:w-1/2">
                <div class="flex flex-row justify-center space-x-4">
                    <div class="flex flex-col items-center">
                        <button class="shadow-lg btn-primary">
                            <x-ilustration.wfo class="w-32 h-32" />
                            <span class="font-bold text-white">W F O</span>
                        </button>
                    </div>
                    <div class="flex flex-col items-center">
                        <button class="shadow-lg btn-primary">
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
