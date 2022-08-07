<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block w-auto h-10 text-gray-600 fill-current" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @can('olah tk')
                        <x-nav-link :href="route('tenaga-kontrak')" :active="request()->routeIs('tenaga-kontrak')">
                            {{ __('Tenaga Kontrak') }}
                        </x-nav-link>
                    @endcan
                    @can('olah waktu')
                        <x-nav-link :href="route('waktu')" :active="request()->routeIs('waktu')">
                            {{ __('Waktu Presensi') }}
                        </x-nav-link>
                    @endcan
                    @can('buat presensi')
                        <x-nav-link :href="route('presensi')" :active="request()->routeIs('presensi')">
                            {{ __('Presensi') }}
                        </x-nav-link>
                    @endcan
                    @can('olah rekapan')
                        <x-nav-link :href="route('rekapan')" :active="request()->routeIs('rekapan')">
                            {{ __('Rekapan') }}
                        </x-nav-link>
                    @endcan
                    @can('olah verifikasi')
                        <x-nav-link :href="route('verifikasi-dl')" :active="request()->routeIs('verifikasi-dl')">
                            {{ __('Verifikasi') }}
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="flex flex-row items-center space-x-2">
                    <div class="font-medium text-gray-500 capitalize">{{ Auth::user()->name }}</div>
                    <x-dropdown>
                        <x-dropdown.header label="Settings">
                            <x-dropdown.item icon="cog" label="Preferences" />
                            <x-dropdown.item icon="user" label="My Profile" />
                        </x-dropdown.header>

                        <x-dropdown.item separator label="Help Center" />
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown.item label="Logout" :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();" />
                        </form>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
