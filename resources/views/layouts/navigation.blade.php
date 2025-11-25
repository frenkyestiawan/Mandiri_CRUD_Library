<nav 
    x-data="{
        open: false, 
        dark: false,
        init() {
            const storedTheme = localStorage.getItem('theme');
            if (storedTheme === 'dark') {
                this.dark = true;
            } else if (storedTheme === 'light') {
                this.dark = false;
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                this.dark = true;
            }

            this.$watch('dark', value => {
                if (value) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            });
        }
    }"
    :class="dark ? 'bg-[#0f172a] border-slate-700' : 'bg-gradient-to-r from-slate-50/80 to-blue-50/80 border-slate-200/80'"
    class="sticky top-0 w-full border-b shadow-lg backdrop-blur-md transition duration-300"
>
    <!-- Primary Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left: Logo & Menu -->
            <div class="flex items-center gap-4">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-2 group hover:scale-105 transition">
                    <div 
                        :class="dark ? 'bg-indigo-600' : 'bg-gradient-to-tr from-blue-500 to-indigo-500'"
                        class="h-9 w-9 flex items-center justify-center rounded-xl shadow-lg text-white"
                    >
                        <i class="bi bi-book-fill text-lg"></i>
                    </div>
                    <span 
                        :class="dark ? 'text-white' : 'text-slate-700'"
                        class="hidden md:block text-sm font-semibold tracking-wide"
                    >
                        Perpustakaan Digital
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex space-x-8 sm:ms-10">

                    @auth
                        @if(Auth::user()->hasRole('Admin'))
                            <x-nav-link 
                                :href="route('admin.dashboard')" 
                                :active="request()->routeIs('admin.dashboard')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 hover:text-blue-600 transition duration-150 ease-in-out"
                            >
                                <i class="bi bi-speedometer2 me-1 text-xs"></i>
                                Dashboard Admin
                            </x-nav-link>

                            <x-nav-link 
                                :href="route('admin.books.index')" 
                                :active="request()->routeIs('admin.books.*')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 hover:text-blue-600 transition duration-150 ease-in-out"
                            >
                                <i class="bi bi-journal-bookmark me-1 text-xs"></i>
                                Buku
                            </x-nav-link>

                            <x-nav-link 
                                :href="route('admin.loans.index')" 
                                :active="request()->routeIs('admin.loans.*')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 hover:text-blue-600 transition duration-150 ease-in-out"
                            >
                                <i class="bi bi-arrow-left-right me-1 text-xs"></i>
                                Peminjaman
                            </x-nav-link>

                            <x-nav-link 
                                :href="route('admin.returns.index')" 
                                :active="request()->routeIs('admin.returns.*')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 hover:text-blue-600 transition duration-150 ease-in-out"
                            >
                                <i class="bi bi-arrow-repeat me-1 text-xs"></i>
                                Pengembalian
                            </x-nav-link>

                        @elseif(Auth::user()->hasRole('Anggota'))

                            <x-nav-link 
                                :href="route('member.dashboard')" 
                                :active="request()->routeIs('member.dashboard')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 hover:text-blue-600 transition duration-150 ease-in-out"
                            >
                                <i class="bi bi-house-door me-1 text-xs"></i>
                                Dashboard
                            </x-nav-link>

                            <x-nav-link 
                                :href="route('member.books.index')" 
                                :active="request()->routeIs('member.books.*')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 hover:text-blue-600 transition duration-150 ease-in-out"
                            >
                                <i class="bi bi-journal-bookmark me-1 text-xs"></i>
                                Buku
                            </x-nav-link>

                            <x-nav-link 
                                :href="route('member.loans.index')" 
                                :active="request()->routeIs('member.loans.*')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 hover:text-blue-600 transition duration-150 ease-in-out"
                            >
                                <i class="bi bi-bookmark-heart me-1 text-xs"></i>
                                Peminjaman Saya
                            </x-nav-link>

                        @endif
                    @endauth

                </div>
            </div>

            <!-- Right Menu: Dark Mode + Profile/Auth -->
            <div class="hidden sm:flex items-center gap-3">

                <!-- Dark Mode Toggle -->
                <button 
                    @click="dark = !dark" 
                    class="p-2 rounded-lg border transition duration-300"
                    :class="dark 
                        ? 'bg-slate-800 border-slate-600 text-white hover:bg-slate-700' 
                        : 'bg-white border-slate-200 text-slate-700 hover:bg-blue-50'"
                >
                    <template x-if="!dark">
                        <i class="bi bi-moon"></i>
                    </template>
                    <template x-if="dark">
                        <i class="bi bi-sun"></i>
                    </template>
                </button>

                @auth
                    <!-- Profile Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button 
                                class="inline-flex items-center px-3 py-2 rounded-lg border transition duration-300"
                                :class="dark 
                                    ? 'bg-slate-800 border-slate-600 text-white hover:text-blue-300' 
                                    : 'bg-white border-slate-200 text-slate-700 hover:text-blue-600'"
                            >
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <i class="bi bi-chevron-down text-xs"></i>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link 
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                >
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Auth buttons for guests -->
                    <a href="{{ route('login') }}" class="btn btn-outline">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="bi bi-person-plus"></i>
                            Daftar
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button 
                    @click="open = !open" 
                    class="p-2 rounded-lg transition duration-300"
                    :class="dark ? 'text-white hover:bg-slate-700' : 'text-slate-700 hover:bg-blue-50'"
                >
                    <i :class="open ? 'bi bi-x-lg' : 'bi bi-list'" class="text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div 
        :class="open ? 'block' : 'hidden'" 
        class="sm:hidden border-t transition"
        :class="dark ? 'bg-slate-900 border-slate-700' : 'bg-white border-slate-200'"
    >
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(Auth::user()->hasRole('Admin'))
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        Dashboard Admin
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.books.index')" :active="request()->routeIs('admin.books.*')">
                        Buku
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.loans.index')" :active="request()->routeIs('admin.loans.*')">
                        Peminjaman
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.returns.index')" :active="request()->routeIs('admin.returns.*')">
                        Pengembalian
                    </x-responsive-nav-link>
                @elseif(Auth::user()->hasRole('Anggota'))
                    <x-responsive-nav-link :href="route('member.dashboard')" :active="request()->routeIs('member.dashboard')">
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('member.books.index')" :active="request()->routeIs('member.books.*')">
                        Buku
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('member.loans.index')" :active="request()->routeIs('member.loans.*')">
                        Peminjaman Saya
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Mobile Profile -->
        @auth
            <div 
                class="pt-4 pb-1 border-t"
                :class="dark ? 'bg-slate-800 border-slate-700' : 'bg-slate-50 border-slate-200'"
            >
                <div class="px-4">
                    <div 
                        :class="dark ? 'text-white' : 'text-slate-800'" 
                        class="font-medium"
                    >
                        {{ Auth::user()->name }}
                    </div>
                    <div 
                        :class="dark ? 'text-slate-300' : 'text-slate-500'" 
                        class="text-sm"
                    >
                        {{ Auth::user()->email }}
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        Profile
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link 
                            :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                        >
                            Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
