<div>
    <div x-show="modalEdit"
        class="fixed top-0 left-0 right-0 z-50 flex items-center w-full overflow-x-hidden overflow-y-auto bg-black bg-opacity-50 md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-4xl p-4 mx-auto md:h-auto">
            <!-- Modal content -->
            <div
                class="relative my-auto transition duration-150 ease-in-out bg-white rounded-lg shadow dark:bg-gray-800">
                <button type="button" wire:click='closeForm'
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Tenaga Kontrak</h3>
                    <form class="space-y-6" wire:submit.prevent="update" novalidate>
                        @csrf
                        <div class="flex flex-row items-start justify-between space-x-6">
                            <div class="flex-1">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" wire:model.defer.defer='nama' class="mt-1">
                                <span class="text-xs text-red-700">
                                    @error('nama')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="flex-1">
                                <label for="email">Email</label>
                                <input type="email" wire:model.defer='email' name="email" id="email"
                                    class="mt-1">
                                <span class="text-xs text-red-700">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-row items-start justify-between space-x-6">
                            <div class="flex-1">
                                <label for="tempat">Tempat Lahir</label>
                                <input type="text" name="tempat" wire:model.defer='tempat' id="tempat"
                                    class="mt-1">
                                <span class="text-xs text-red-700">
                                    @error('tempat')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="flex-1">
                                <label for="tanggal">Tanggal Lahir</label>
                                <input type="date" name="tanggal" id="tanggal" wire:model.defer='tanggal'
                                    class="mt-1">
                                <span class="text-xs text-red-700">
                                    @error('tanggal')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-row items-start justify-between space-x-6">
                            <div class="flex-1">
                                <label for="pendidikan">Pendidikan Terakhir</label>
                                <input type="text" wire:model.defer='pendidikan' name="pendidikan" id="pendidikan"
                                    class="mt-1">
                                <span class="text-xs text-red-700">
                                    @error('pendidikan')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="flex-1">
                                <label for="nohp">Nomor Handphone</label>
                                <input type="tel" name="nohp" id="nohp" wire:model.defer='nohp'
                                    class="mt-1">
                                <span class="text-xs text-red-700">
                                    @error('nohp')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-row items-start justify-between space-x-6">
                            <div class="flex-1">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" wire:model.defer='alamat'
                                    class="mt-1">
                                <span class="text-xs text-red-700">
                                    @error('alamat')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div>
                                <label for="foto">Foto</label>
                                <div class="flex flex-row items-start mt-1 space-x-2">
                                    <div class="w-10 h-10">
                                        <img src="{{ $foto ? $foto->temporaryUrl() : asset($preview) }}"
                                            alt="" class="object-cover w-10 h-10 rounded-lg">
                                    </div>
                                    <div>
                                        <input type="file" wire:model.defer='foto' name="foto">
                                        <span class="block text-xs text-red-700">
                                            @error('foto')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
