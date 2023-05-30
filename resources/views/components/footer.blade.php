<footer class="border-stone-900 border-t-2 bg-white bg-youtube">
    <div class="p-10 lg:py-20 lg:px-32 space-y-10 lg:space-y-16">
        <div class="flex flex-col xl:flex-row space-y-5 xl:space-x-14 xl:space-y-0">
            <div class="space-y-3 w-full text-center lg:text-start xl:max-w-[500px]">
                <img src="{{ asset('images/logo.svg') }}" alt="Maghfirah" class="m-auto lg:m-0 w-auto h-[75px]">
                <div class="text-neutral">Kampung Maghfirah merupakan suatu kawasan pendidikan islam terpadu mulai dari anak-anak hingga usia lanjut</div>
            </div>

            <div class="space-y-5 text-center block sm:hidden">
                <div class="font-bold">Temukan Kami di</div>
                <div class="space-x-5 flex justify-center">
                    <a href="#">
                        <img src="{{ asset('images/icons/fb.png') }}" alt="Facebook" class="w-[35px] aspect-square">
                    </a>
                    <a href="#">
                        <img src="{{ asset('images/icons/ig.png') }}" alt="Instagram" class="w-[35px] aspect-square">
                    </a>
                    <a href="#">
                        <img src="{{ asset('images/icons/youtube.png') }}" alt="Youtube" class="w-[35px] aspect-square">
                    </a>
                    <a href="#">
                        <img src="{{ asset('images/icons/tiktok.png') }}" alt="Tiktok" class="w-[35px] aspect-square">
                    </a>
                </div>
            </div>

            <div class="flex justify-center sm:justify-between lg:justify-start items-start sm:space-x-12 sm:space-y-0 space-y-5 flex-wrap">
                <div class="space-y-5 w-full sm:w-1/3 lg:flex-auto">
                    <div class="flex justify-between items-center footer-nav-toggler" data-target="#footer-nav-pendidikan">
                        <div class="font-bold">Pendidikan</div>
                        <a href="javascript:void(0)" class="sm:hidden footer-nav-toggler-icon">
                            <img src="{{ asset('/images/icons/down.svg') }}" alt="Open">
                        </a>
                    </div>
                    <div class="space-y-5 hidden sm:block footer-nav" id="footer-nav-pendidikan">
                        <a href="#" class="text-neutral block">STIPI Maghfirah</a>
                        <a href="#" class="text-neutral block">MILBOS International</a>
                        <a href="#" class="text-neutral block">Pesantren Husnul Khatimah</a>
                    </div>
                </div>
                <div class="space-y-5 w-full sm:w-auto sm:flex-1 lg:flex-auto">
                    <div class="flex justify-between items-center footer-nav-toggler" data-target="#footer-nav-program">
                        <div class="font-bold">Program</div>
                        <a href="javascript:void(0)" class="sm:hidden footer-nav-toggler-icon">
                            <img src="{{ asset('/images/icons/down.svg') }}" alt="Open">
                        </a>
                    </div>
                    <div class="space-y-5 hidden sm:block footer-nav" id="footer-nav-program">
                        <a href="#" class="text-neutral block">Mabit</a>
                        <a href="#" class="text-neutral block">Kajian</a>
                        <a href="#" class="text-neutral block">Short Course</a>
                    </div>
                </div>
                <div class="space-y-5 w-full sm:w-auto sm:flex-1 lg:flex-auto">
                    <div class="flex justify-between items-center footer-nav-toggler" data-target="#footer-nav-tentang-kami">
                        <div class="font-bold">Tentang Kami</div>
                        <a href="javascript:void(0)" class="sm:hidden footer-nav-toggler-icon">
                            <img src="{{ asset('/images/icons/down.svg') }}" alt="Open">
                        </a>
                    </div>
                    <div class="space-y-5 hidden sm:block footer-nav" id="footer-nav-tentang-kami">
                        <a href="{{ url('/karir') }}" class="text-neutral block">Karir</a>
                        <a href="{{ url('/alamat') }}" class="text-neutral block">Alamat</a>
                        <a href="#" class="text-neutral block">Dokumentasi</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row space-y-5 items-center justify-between">
            <div class="flex space-x-8">
                <a href="{{ url('/kebijakan-privasi') }}" class="font-bold text-neutral">Kebijakan Privasi</a>
                <a href="{{ url('/faq') }}" class="font-bold text-neutral">FAQ</a>
                <a href="{{ url('/roadmap') }}" class="font-bold text-neutral">Road Map</a>
            </div>
            <div class="hidden space-x-5 sm:flex">
                <a href="#">
                    <img src="{{ asset('images/icons/fb.png') }}" alt="Facebook" class="w-[35px] aspect-square">
                </a>
                <a href="#">
                    <img src="{{ asset('images/icons/ig.png') }}" alt="Instagram" class="w-[35px] aspect-square">
                </a>
                <a href="#">
                    <img src="{{ asset('images/icons/youtube.png') }}" alt="Youtube" class="w-[35px] aspect-square">
                </a>
                <a href="#">
                    <img src="{{ asset('images/icons/tiktok.png') }}" alt="Tiktok" class="w-[35px] aspect-square">
                </a>
            </div>
        </div>

        <div class="text-neutral text-center lg:text-start text-[14px]">@ 2023 Kampung Maghfirah | Taman Nyaman Belajar Islam</div>
    </div>
</footer>

@push('scripts')
<script>
    $(document).ready(function(){
        $("body").on("click", ".footer-nav-toggler", function(){
            const target = $(this).data('target');
            const icon = $(this).children(".footer-nav-toggler-icon");
            $(target).toggle();
            icon.toggleClass("rotate-180");
        })
    })
</script>
@endpush