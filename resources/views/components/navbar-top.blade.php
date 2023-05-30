<nav class="hidden lg:flex bg-white py-4 px-32 justify-between items-center shadow-xl fixed left-0 right-0 top-0 w-full z-10">
    <a href="{{ url('/') }}">
        <img src="{{ asset('images/logo.svg') }}" alt="Maghfirah" class="h-[51px]">
    </a>
    <div class="flex items-center space-x-7 nav-top">
        <a href="{{ url('/') }}" @if(request()->is('/')) class="active" @endif>
            <div class="flex py-2 items-center space-x-3">
                <img src="{{ asset('images/nav/beranda.png') }}" alt="Beranda" class="h-5">
                <span>Beranda</span>
            </div>
        </a>
        <a href="{{ url('/program') }}" @if(request()->is('program*')) class="active" @endif>
            <div class="flex py-2 items-center space-x-3">
                <img src="{{ asset('images/nav/program.png') }}" alt="Program" class="h-5">
                <span>Program</span>
            </div>
        </a>
        <a href="{{ url('/kelas-online') }}" @if(request()->is('kelas-online*')) class="active" @endif>
            <div class="flex py-2 items-center space-x-3">
                <img src="{{ asset('images/nav/kelas.png') }}" alt="Kelas Online" class="h-5">
                <span>Kelas Online</span>
            </div>
        </a>
        <a href="{{ url('/ruang-edukasi') }}" @if(request()->is('ruang-edukasi*')) class="active" @endif>
            <div class="flex py-2 items-center space-x-3">
                <img src="{{ asset('images/nav/edukasi.png') }}" alt="Ruang Edukasi" class="h-5">
                <span>Ruang Edukasi</span>
            </div>
        </a>
        <a href="{{ url('/tentang-kami') }}" @if(request()->is('tentang-kami')) class="active" @endif>
            <div class="flex py-2 items-center space-x-3">
                <img src="{{ asset('images/nav/tentang.png') }}" alt="Tentang Kami" class="h-5">
                <span>Tentang Kami</span>
            </div>
        </a>
    </div>
    <div class="flex items-center space-x-3">
        @guest
        <a href="javascript:void(0)" class="btn-login">
            <div class="py-2 px-5 rounded-xl bg-main-gradient text-white">Masuk</div>
        </a>
        <a href="javascript:void(0)" class="btn-register">
            <div class="p-0.5 rounded-xl bg-main-gradient">
                <div class="py-1.5 rounded-xl px-[1.125rem] bg-white">Daftar</div>
            </div>
        </a>
        @else
        <div class="flex items-start justify-between">
            <div class="mr-3 text-end">
                <div class="-mb-1 text-[18px] font-bold text-main-gradient">{{ auth()->user()->display_name }}</div>
                <a href="{{ url('/logout') }}" style="font-size: 14px" class="text-red-500">Keluar</a>
            </div>
            <a href="{{ url('/profil') }}">
                <img src="{{ asset('images/icons/profile.png') }}" alt="Profil" style="height: 40px" class="aspect-square object-cover">
            </a>
        </div>
        @endguest
    </div>

</nav>

<nav class="flex lg:hidden bg-white py-5 px-10 space-x-5 items-center shadow-xl fixed left-0 right-0 top-0 w-full z-10" id="navbar-back">
    <a href="javascript:void(0)" class="btn-back">
        <img src="{{ asset('images/icons/left.png') }}" alt="Maghfirah" class="h-[32px]">
    </a>
    <div class="text-black text-[20px] font-bold">{{ isset($title) ? $title : 'Kampung Maghfirah' }}</div>
</nav>

@guest
{{-- modal --}}
<div id="login" class="hidden fixed top-0 bottom-0 left-0 h-screen w-screen bg-[rgba(0,0,0,.8)] z-20 items-center justify-center py-20">
    <div class="w-3/5 overflow-y-auto" style="max-height: 75vh">
        @livewire('auth.login')
    </div>
</div>

<div id="register" class="hidden fixed top-0 bottom-0 left-0 h-screen w-screen bg-[rgba(0,0,0,.8)] z-20 items-center justify-center py-20">
    <div class="w-3/5 overflow-y-auto" style="max-height: 75vh">
        @livewire('auth.register')
    </div>
</div>
@endguest

@push('scripts')
<script>
    $(document).ready(function(){
        $("body").on("click", "#btn-menu-mobile", function(){
            $("#menu-mobile").toggleClass("hidden");
            $("body").toggleClass("overflow-hidden");
        })

        $("body").on("click", ".btn-login", function(){
            $("#register").addClass("hidden");
            $("#register").removeClass("flex");
            $("#login").removeClass("hidden");
            $("#login").addClass("flex");

            $("body").addClass("overflow-hidden");
        })

        $('body').on("click", "#login", function(e){
            if($(e.target).attr('id') == 'login'){
                $("body").removeClass("overflow-hidden");
                $("#login").removeClass("flex");
                $("#login").addClass("hidden");
            }
        });

        $('body').on("click", "#btn-close-login", function(){
            $("body").removeClass("overflow-hidden");
            $("#login").removeClass("flex");
            $("#login").addClass("hidden");
        });

        $("body").on("click", ".btn-register", function(){
            $("#register").removeClass("hidden");
            $("#register").addClass("flex");
            $("#login").addClass("hidden");
            $("#login").removeClass("flex");

            $("body").addClass("overflow-hidden");
        })

        $('body').on("click", "#register", function(e){
            if($(e.target).attr('id') == 'register'){
                $("body").removeClass("overflow-hidden");
                $("#register").removeClass("flex");
                $("#register").addClass("hidden");
            }
        });

        $('body').on("click", "#btn-close-register", function(){
            $("body").removeClass("overflow-hidden");
            $("#register").removeClass("flex");
            $("#register").addClass("hidden");
        });
    });
</script>
@endpush