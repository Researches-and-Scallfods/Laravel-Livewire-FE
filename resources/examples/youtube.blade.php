{{-- yuk mengenal --}}
<div class="p-10 lg:px-32">
    <div class="bg-white rounded-xl bg-youtube p-10 lg:px-10 lg:py-24 shadow-lg">
        <div class="flex flex-col lg:flex-row justify-between lg:items-center space-y-5 lg:space-x-16">
            <div>
                <img src="{{ asset('images/logo-v.png') }}" alt="Maghfirah" class="lg:w-[167px] w-[75px]">
            </div>
            <div>
                <div class="lg:block hidden text-[32px] text-neutral-black font-bold">Yuk Mengenal<br>Kampung Maghfirah Lebih Dekat</div>
                <div class="lg:hidden block text-[24px] text-neutral-black font-bold">Yuk Mengenal Kampung Maghfirah Lebih Dekat</div>
                <div class="text-neutral lg:text-[20px] text-[16px] my-3">Kampung Maghfirah merupakan suatu kawasan pendidikan islam terpadu mulai dari anak-anak hingga usia lanjut</div>
                <div class="mt-10">
                    <a href="javascript:void(0)" class="btn-youtube py-4 px-6 bg-main-gradient rounded-xl text-white">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="hidden lg:flex">
                <a href="javascript:void(0)" class="btn-youtube">
                    <img src="{{ asset('images/icons/youtube-play.png') }}" alt="Youtube" class="w-[147px]">
                </a>
            </div>
        </div>
    </div>
</div>

{{-- modal --}}
<div id="youtube" class="hidden fixed top-0 left-0 w-full h-full bg-[rgba(0,0,0,.8)] z-20 items-center justify-center">
    <div class="w-4/5 lg:w-3/5">
        <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/RvFdkKpV3eQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        $(".btn-youtube").on("click", function(){
            $("#youtube").removeClass("hidden");
            $("#youtube").addClass("flex");

            $("body").addClass("overflow-hidden");
        })

        $('body').on("click", "#youtube", function(){
            $("body").removeClass("overflow-hidden");
            $("#youtube").removeClass("flex");
            $("#youtube").addClass("hidden");

            $('#youtube iframe').each(function(){
                var el_src = $(this).attr("src");
                $(this).attr("src",el_src);
            });
        });
    });
</script>
@endpush