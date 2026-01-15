<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    <!-- PEMBAYARAN MENU -->
                     <x-nav-link href="{{ route('pembayaran.index') }}" 
                    :active="request()->routeIs('pembayaran.*')">
                    Pembayaran
                    </x-nav-link>


                    <!-- TAMU MENU -->
                    <x-nav-link href="{{ route('tamu.index') }}" :active="request()->routeIs('tamu.*')">
                        Tamu
                    </x-nav-link>

                    <!-- KAMAR MENU -->
                    <x-nav-link href="{{ route('kamar.index') }}" :active="request()->routeIs('kamar.*')">
                        Kamar
                    </x-nav-link>

                    <!-- RESERVASI MENU -->
                    <x-nav-link href="{{ route('reservasi.index') }}" :active="request()->routeIs('reservasi.*')">
                        Reservasi
                    </x-nav-link>

                </div>
            </div>
