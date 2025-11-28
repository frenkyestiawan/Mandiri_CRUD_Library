<nav x-data="{
    open: false,
    dark: false,
    init() {
        const storedTheme = localStorage.getItem('theme')
        if (storedTheme === 'dark') {
            this.dark = true
        } else if (storedTheme === 'light') {
            this.dark = false
        } else if (
            window.matchMedia &&
            window.matchMedia('(prefers-color-scheme: dark)').matches
        ) {
            this.dark = true
        }

        this.$watch('dark', (value) => {
            if (value) {
                document.documentElement.classList.add('dark')
                localStorage.setItem('theme', 'dark')
            } else {
                document.documentElement.classList.remove('dark')
                localStorage.setItem('theme', 'light')
            }
        })
    },
}"
    :class="dark ? 'bg-[#0f172a] border-slate-700' : 'bg-gradient-to-r from-slate-50/80 to-blue-50/80 border-slate-200/80'"
    class="sticky top-0 w-full border-b shadow-lg backdrop-blur-md transition duration-300">
    <!-- Primary Navigation -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <!-- Left: Logo & Menu -->
            <div class="flex items-center gap-4">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="group flex items-center gap-2 transition hover:scale-105">
                    <div :class="dark ? 'bg-indigo-600' : 'bg-gradient-to-tr from-blue-500 to-indigo-500'"
                        class="flex h-9 w-9 items-center justify-center rounded-xl text-white shadow-lg">
                        <i class="bi bi-book-fill text-lg"></i>
                    </div>
                    <span :class="dark ? 'text-white' : 'text-slate-700'"
                        class="hidden text-sm font-semibold tracking-wide md:block">
                        Perpustakaan Digital
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden space-x-8 sm:ms-10 sm:flex">
                    @auth
                        @if (Auth::user()->hasRole('Admin'))
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 transition duration-150 ease-in-out hover:text-blue-600">
                                <i class="bi bi-speedometer2 me-1 text-xs"></i>
                                Dashboard Admin
                            </x-nav-link>

                            <x-nav-link :href="route('admin.books.index')" :active="request()->routeIs('admin.books.*')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 transition duration-150 ease-in-out hover:text-blue-600">
                                <i class="bi bi-journal-bookmark me-1 text-xs"></i>
                                Buku
                            </x-nav-link>

                            <x-nav-link :href="route('admin.loans.index')" :active="request()->routeIs('admin.loans.*')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 transition duration-150 ease-in-out hover:text-blue-600">
                                <i class="bi bi-arrow-left-right me-1 text-xs"></i>
                                Peminjaman
                            </x-nav-link>

                            <x-nav-link :href="route('admin.returns.index')" :active="request()->routeIs('admin.returns.*')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 transition duration-150 ease-in-out hover:text-blue-600">
                                <i class="bi bi-arrow-repeat me-1 text-xs"></i>
                                Pengembalian
                            </x-nav-link>
                        @elseif (Auth::user()->hasRole('Anggota'))
                            <x-nav-link :href="route('member.dashboard')" :active="request()->routeIs('member.dashboard')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 transition duration-150 ease-in-out hover:text-blue-600">
                                <i class="bi bi-house-door me-1 text-xs"></i>
                                Dashboard
                            </x-nav-link>

                            <x-nav-link :href="route('member.books.index')" :active="request()->routeIs('member.books.*')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 transition duration-150 ease-in-out hover:text-blue-600">
                                <i class="bi bi-journal-bookmark me-1 text-xs"></i>
                                Buku
                            </x-nav-link>

                            <x-nav-link :href="route('member.loans.index')" :active="request()->routeIs('member.loans.*')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-slate-700 transition duration-150 ease-in-out hover:text-blue-600">
                                <i class="bi bi-bookmark-heart me-1 text-xs"></i>
                                Peminjaman Saya
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Menu: Dark Mode + Profile/Auth -->
            <div class="hidden items-center gap-3 sm:flex">
                <!-- Dark Mode Toggle -->
                <button @click="dark = !dark" dark" ed-lg border transition duration-300" 800 border-slate-600
                    text-white hover:bg-slate-700' border-slate-200 text-slate-700 hover:bg-blue-50'" B3AxjDlB">
                    bi-moon"></i>
                    BNyvmsB">
                    bi-sun"></i>
                    pdown -->
                    n="right" width="48">
                    ="trigger">
                    s="inline-flex items-center px-3 py-2 rounded-lg border transition duration-300"
                    ss="dark
                          ? 'bg-slate-800 border-slate-600 text-white hover:text-blue-300'
                          : 'bg-white border-slate-200 text-slate-700 hover:text-blue-600'"
                    >{{ Auth::user()->name }}
            </div>
            class="ms-1">
            <i class="bi bi-chevron-down text-xs"></i>
            v>
            >
            ="content">
            own-link :href="route('profile.edit')">
            ile
            down-link>
            thod="POST" action="{{ route('logout') }}">
            NnB />
            ropdown-link
            :href="route('logout')"
            onclick="
                              event.preventDefault();
                              this.closest('form').submit();
                          "
            dark = !dark"
            -2 rounded-lg border transition duration-300"
            dark
            g-slate-800 border-slate-600 text-white hover:bg-slate-700'
            g-white border-slate-200 text-slate-700 hover:bg-blue-50'"
            e x-if="!dark">
            lass="bi bi-moon"></i>
            te>
            e x-if="dark">
            lass="bi bi-sun"></i>
            te>
            file Dropdown -->
            own align="right" width="48">
            lot name="trigger">
            <button class="inline-flex items-center rounded-lg border px-3 py-2 transition duration-300"
                :class="dark
                    ?
                    'bg-slate-800 border-slate-600 text-white hover:text-blue-300' :
                    'bg-white border-slate-200 text-slate-700 hover:text-blue-600'">
                <div>{{ Auth::user()->name }}</div>
                <div class="ms-1">
                    <i class="bi bi-chevron-down text-xs"></i>
                </div>
            </button>
            slot>
            lot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                Profile
            </x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    onclick="
                                      event.preventDefault();
                                      this.closest('form').submit();
                                  ">
                    Log Out
                </x-dropdown-link>
            </form>
            slot>
            down>
            FKtQRM5qTdV152uEFPB />
            h buttons for guests -->
            "{{ route('login') }}" class="btn btn-outline">
            lass="bi bi-box-arrow-in-right"></i>
            n
            Pam1ZNZOaRtiZrP5kNSR2B>
            ref="{{ route('register') }}" class="btn btn-primary">
            <i class="bi bi-person-plus"></i>
            Daftar
            RPam1ZNZOaRtiZrP5kNSR2B>
            urger -->
            2 flex items-center sm:hidden">
            open = !open"
            -2 rounded-lg transition duration-300"
            dark ? 'text-white hover:bg-slate-700' : 'text-slate-700 hover:bg-blue-50'"
            s="open ? 'bi bi-x-lg' : 'bi bi-list'" class="text-xl"></i>
            k' : 'hidden'"
            der-t transition"
            late-900 border-slate-700' : 'bg-white border-slate-200'"
            3 space-y-1">
            FEMaJ5LABWtiDYWKIgC0mT67B>
            nsive-nav-link
            dneBHX4TJgdD1HntByDVuvOzblUGB
            6ocBv2dTdWPuN5dBqBJVm1qVA8R302srKbAHJUqonYTB
            board Admin
            onsive-nav-link>
            nsive-nav-link
            fXB9yVOOYk5AIysWBqvHqmmljSdGHwB
            AU1C9LLDaJbBF05w4xUyoztETGC6NIsVsjkzBfPSqB
            onsive-nav-link>
            nsive-nav-link
            jhyOsrUNsK0Iga9IzYcXqjYlx2fJVfB
            a4YtF0UzAJydmwFL8PWpnYDQgq29Z2eyKgIwlNgmHB
            njaman
            onsive-nav-link>
            nsive-nav-link
            7GGKc1GGTaRzTZbp5qWqBPZIwFibtrWzB
            Ui4PDTDlg6mlLaoC7l0emb0Y9PBCcrAxSOTTWW2xYwUB
            embalian
            onsive-nav-link>
            0FEMaJ5LABWtiDYWKIgC0mT67B>
            7sG9SYkIi3s3wWlNs4Jgc8j9P7JVcMB>
            nsive-nav-link
            NeXi83zJEVIQW2SyI4VUU5L7SCAJIB
            9IARvEiSueXM4ENwS4rxgMRZtUusN9iVP7yqHEkSuk5zB
            board
            onsive-nav-link>
            nsive-nav-link
            8EM7uVOwfwGYZtcoFnxHYQLYvpyVJqtB
            1Tsywi1zR0cqSJEXsDDjPfUVevYfZAeng1kkmGx3riB
            onsive-nav-link>
            nsive-nav-link
            48ZlUV1QpW9kYtdJVlk5J6YiirluDxXB
            OSvQGlPc4qx7ZeWjQsm6SYKAcsKHWUh2v4rS8EZ9kOB
            njaman Saya
            onsive-nav-link>
            W7sG9SYkIi3s3wWlNs4Jgc8j9P7JVcMB>
            FJXVGNc0nquIzPHDbjB />
            nsive-nav-link
            1aPuse0vUtpHBtyiqmZ7caB
            lViqWsBaVaCtnr0PGhtHRAv42SPHQ4rebp0dNB
            board
            onsive-nav-link>
            -->
            pb-1 border-t"
            ? 'bg-slate-800 border-slate-700' : 'bg-slate-50 border-slate-200'"
            px-4">
            ass="dark ? 'text-white' : 'text-slate-800'" class="font-medium">
            TpnkZiyrxOPt6XOI55vMQB />
            ass="dark ? 'text-slate-300' : 'text-slate-500'" class="text-sm">
            QRarYx7ggvQF6Ejtm9Vdl8B />
            mt-3 space-y-1">
            nsive-nav-link :href="route('profile.edit')">
            ile
            onsive-nav-link>
            thod="POST" action="{{ route('logout') }}">
            smB />
            esponsive-nav-link
            :href="route('logout')"
            onclick="
            event.preventDefault();
            this.closest('form').submit();
            "
