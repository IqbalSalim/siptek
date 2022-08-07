<div>
    <div x-show="modalVerifikasi"
        class="fixed top-0 left-0 right-0 z-50 flex items-center w-full overflow-x-hidden overflow-y-auto bg-black bg-opacity-50 md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-4xl p-4 mx-auto md:h-auto">
            <!-- Modal content -->
            <div
                class="relative h-full my-auto transition duration-150 ease-in-out bg-white rounded-lg shadow dark:bg-gray-800">
                <button type="button" wire:click='closeForm'
                    class="absolute  top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <button type="button" wire:click='approve'
                    class="absolute btn-primary top-3 right-20  px-2 py-1.5 ml-auto inline-flex items-center ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="pl-1">Setujui</span>
                </button>
                <button type="button" wire:click='rejected'
                    class="absolute btn-danger top-3 right-44  px-2 py-1.5 ml-auto inline-flex items-center ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="pl-1">Tolak</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Verifikasi</h3>
                    <table class="mt-1">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td class="pl-3">{{ $nama }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td class="pl-3">{{ $keterangan }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td class="pl-3">{{ $tanggal }}</td>
                        </tr>
                    </table>
                    <div class="mt-1">
                        <div>
                            <embed class="w-full h-screen" src="{{ $file }}" type="application/pdf"
                                style="height: 70vh">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
