<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
            {{ __('Dashboard') }}
        </h2>
        <div class="flex flex-row space-x-1 text-sm text-gray-400">
            <div class="hover:text-primary"><a href="/dashboard">Dashboard</a></div>
        </div>
    </x-slot>


    <div id="content">


        @can('dashboard admin')
        <div class="flex flex-row w-full space-x-8">
            <div class="grid w-full gap-6 px-4 py-4 md:grid-cols-4">
                <a href="{{ route('verifikasi-dl') }}"
                    class="p-4 text-xl rounded-lg from-orange-500 via-yellow-500 bg-gradient-to-r to-amber-500">
                    <div class="flex flex-col space-y-4">
                        <h2 class="font-medium text-white">Submission</h2>
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-center text-white h-36" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-4xl font-medium text-right text-white">{{ $submission ? $submission : 0 }}</h1>
                </a>
                <a href="{{ route('verifikasi-dl') }}"
                    class="p-4 rounded-lg from-red-500 via-rose-500 bg-gradient-to-r to-pink-500">
                    <div class="flex flex-col space-y-4">
                        <h2 class="text-xl font-medium text-white">Rejected</h2>
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white h-36" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-4xl font-medium text-right text-white">{{ $rejected ? $rejected : 0 }}
                    </h1>
                </a>
                <a href="{{ route('verifikasi-dl') }}"
                    class="p-4 rounded-lg from-blue-500 via-indigo-500 bg-gradient-to-r to-violet-500">
                    <div class="flex flex-col space-y-4">
                        <h2 class="text-xl font-medium text-white">Approve</h2>
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-36 h-36" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-4xl font-medium text-right text-white">{{ $approve ? $approve : 0 }}</h1>
                </a>
                <a href="{{ route('tenaga-kontrak') }}"
                    class="p-4 rounded-lg from-cyan-500 via-teal-500 bg-gradient-to-r to-emerald-500">
                    <div class="flex flex-col space-y-4">
                        <h2 class="text-xl font-medium text-white">Tenaga Kontrak</h2>
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-36 h-36" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-4xl font-medium text-right text-white">{{ $employees ? $employees : 0 }}</h1>
                </a>
            </div>
        </div>
        @endcan

        @can('dashboard tk')
        <div class="flex flex-col space-y-8 md:space-y-0 md:flex-row md:space-x-8">
            <div class="relative w-full overflow-x-auto border shadow-md md:w-1/2 sm:rounded-lg dark:border-gray-700">
                <div class="flex flex-row items-center justify-between p-4 bg-white dark:bg-gray-800">
                    <div>
                        <p class="text-lg font-semibold dark:text-white">Presensi Hari Ini</p>
                        <span class="text-sm font-medium text-gray-400">
                            Tanggal
                        </span>
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
            </div>
            <div class="relative w-full overflow-x-auto border shadow-md md:w-1/2 sm:rounded-lg dark:border-gray-700">
                <div class="flex flex-row items-center justify-between p-4 bg-white dark:bg-gray-800">
                    <div>
                        <p class="text-lg font-semibold dark:text-white">Varifikasi Dinas Luar</p>
                        <span class="invisible">
                            {{ $date->isoFormat('dddd, D MMMM Y') }}
                        </span>
                    </div>

                </div>
                <div class="grid grid-cols-3 gap-6 px-4 py-4">
                    <div class="p-4 rounded-lg from-orange-500 via-yellow-500 bg-gradient-to-r to-amber-500">
                        <div class="flex flex-row items-start justify-between">
                            <h2 class="font-medium md:text-base text-xs text-white">Submission</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="md:w-8 md:h-8 w-4 h-4 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                        </div>
                        <h1 class="text-2xl md:text-4xl font-medium text-white">{{ $submission ? $submission : 0 }}</h1>
                    </div>
                    <div class="p-4 rounded-lg from-red-500 via-rose-500 bg-gradient-to-r to-pink-500">
                        <div class="flex flex-row items-start justify-between">
                            <h2 class="font-medium md:text-base text-xs text-white">Rejected</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="md:w-8 md:h-8 w-4 h-4 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                        <h1 class="text-2xl md:text-4xl font-medium text-white">{{ $rejected ? $rejected : 0 }}</h1>
                    </div>
                    <div class="p-4 rounded-lg from-blue-500 via-indigo-500 bg-gradient-to-r to-violet-500">
                        <div class="flex flex-row items-start justify-between">
                            <h2 class="font-medium md:text-base text-xs text-white">Approve</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="md:w-8 md:h-8 w-4 h-4 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h1 class="text-2xl md:text-4xl font-medium text-white">{{ $approve ? $approve : 0 }}</h1>
                    </div>
                </div>
            </div>
        </div>
        @endcan



    </div>
</div>