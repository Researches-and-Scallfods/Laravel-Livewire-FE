<nav class="flex lg:hidden bg-white py-5 px-10 justify-between items-center shadow-xl fixed left-0 right-0 top-0 w-full z-10" id="navbar-mobile">
    <a href="{{ url('/') }}">
        <img src="{{ asset('images/logo.svg') }}" alt="Maghfirah" class="h-[51px]">
    </a>
    <div class="flex items-center space-x-4">
        <a href="#">
            <img src="{{ asset('images/icons/home-search.png') }}" alt="Search" class="h-[28px]">
        </a>
        <a href="javascript:void(0)" id="btn-menu-mobile">
            <img src="{{ asset('images/icons/menu.png') }}" alt="Search" class="h-[28px]">
        </a>
    </div>

    <div class="absolute top-full left-0 right-0 bg-white h-screen hidden" id="menu-mobile">
        <div class="flex flex-col">
            <div class="nav-top">
            <a href="{{ url('/') }}" @if(request()->is('/')) class="active" @endif>
                <div class="flex py-5 items-center space-x-3 border-b-2 px-10">
                    <img src="{{ asset('images/nav/beranda.png') }}" alt="Beranda" class="h-5">
                    <span>Beranda</span>
                </div>
            </a>
            <a href="{{ url('/program') }}" @if(request()->is('program*')) class="active" @endif>
                <div class="flex py-5 items-center space-x-3 border-b-2 px-10">
                    <img src="{{ asset('images/nav/program.png') }}" alt="Program" class="h-5">
                    <span>Program</span>
                </div>
            </a>
            <a href="{{ url('/kelas-online') }}" @if(request()->is('kelas-online*')) class="active" @endif>
                <div class="flex py-5 items-center space-x-3 border-b-2 px-10">
                    <img src="{{ asset('images/nav/kelas.png') }}" alt="Kelas Online" class="h-5">
                    <span>Kelas Online</span>
                </div>
            </a>
            <a href="{{ url('/ruang-edukasi') }}" @if(request()->is('ruang-edukasi*')) class="active" @endif>
                <div class="flex py-5 items-center space-x-3 border-b-2 px-10">
                    <img src="{{ asset('images/nav/edukasi.png') }}" alt="Ruang Edukasi" class="h-5">
                    <span>Ruang Edukasi</span>
                </div>
            </a>
            <a href="{{ url('/tentang-kami') }}" @if(request()->is('tentang-kami')) class="active" @endif>
                <div class="flex py-5 items-center space-x-3 border-b-2 px-10">
                    <img src="{{ asset('images/nav/tentang.png') }}" alt="Tentang Kami" class="h-5">
                    <span>Tentang Kami</span>
                </div>
            </a>
            </div>
            <hr>
            <div class="p-10">
                @guest
                <a href="{{ url('/login') }}">
                    <div class="py-2 text-center px-5 rounded-xl bg-main-gradient text-white">Masuk</div>
                </a>
                <a href="{{ url('/register') }}" class="btn-register">
                    <div class="p-0.5 rounded-xl bg-main-gradient mt-5">
                        <div class="py-1.5 text-center rounded-xl px-[1.125rem] bg-white">Daftar</div>
                    </div>
                </a>
                @else
                <a href="{{ url('/logout') }}" class="btn-register">
                    <div class="p-0.5 rounded-xl bg-main-gradient">
                        <div class="py-1.5 rounded-xl px-[1.125rem] bg-white">Logout</div>
                    </div>
                </a>
                @endguest
            </div>
        </div>
    </div>
</nav>