<link rel="stylesheet" href="{{ asset('css/splide.min.css') }}">
<style>
    .splide__pagination{
        bottom: -50px;
    }
    .splide__pagination__page{
        background: #000;
        width: 10px;
        margin: 0 5px;
        height: 10px;
        border-radius: 5px;
    }
    .splide__pagination__page.is-active{
        width: 30px;
        height: 10px;
        background: linear-gradient(86.28deg, #2F8651 -17.15%, #FFCF49 253.1%);
    }
</style>

<div class="p-10 pt-40 lg:px-32 lg:py-40" wire:init="loadData">
    @if(count($datas) == 0)
    <div class="flex lg:flex-row flex-col items-center justify-between space-x-5">
        <div class="flex flex-col items-center space-y-3 flex-1">
            <div class="shine" style="height: 40px; width: 150px"></div>
            <div class="shine" style="height: 35px; width: 120px"></div>
            <div class="shine" style="height: 35px; width: 100px"></div>
        </div>
        <div class="shine w-full lg:flex-1 order-first mb-5 lg:mb-0 lg:order-last" style="height: 400px"></div>
    </div>
    @else
    <section id="slider" class="splide" aria-label="Slider">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach($datas as $k => $v)
                <li class="splide__slide">
                    <div class="flex lg:flex-row flex-col items-center justify-between space-x-5">
                        <div class="w-full lg:flex-1 text-center lg:text-start">
                            <div class="lg:text-[50px] text-[32px] lg:leading-[59px] font-black">
                                <div class="text-neutral">{{ $v->text1 }}</div>
                                <div class="text-main-gradient">{{ $v->text2 }}</div>
                            </div>
                            <div class="mt-5 lg:text-[32px] text-[24px] text-neutral">{{ $v->text3 }}</div>
                        </div>
                        
                        <div class="w-full lg:flex-1 order-first mb-5 lg:mb-0 lg:order-last">
                            <img src="{{ cms_asset($v->path) }}" alt="Slider" class="w-full aspect-video object-cover">
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    @endif
</div>

<script src="{{ asset('js/splide.min.js') }}"></script>
<script>
     Livewire.on('home-slider.loaded', () => {
        $('.lazy').Lazy();
        new Splide('#slider', {
            focus: 'center',
            arrows: false,
            autoplay: true,
            interval: 2000,
            type: 'loop',
            pagination: true
        }).mount();
    })
</script>