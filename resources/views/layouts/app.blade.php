<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" value="{{ csrf_token() }}"/>
    
    @stack('meta')
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('./css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.31/dist/sweetalert2.min.css">

    @livewireStyles
    @stack('styles')
</head>
<body class="bg-[#f3f3f3]">

    @yield('content')

    <div class="fixed bottom-7 right-7 hover:cursor-pointer group">
        <div class="relative">
            <img src="{{ asset('images/beramal.png') }}" alt="Beramal" style="height: 44px">
            <div style="left: -255px" class="absolute top-0 bottom-0 pr-2 hidden group-hover:block">
                <div class="rounded-xl text-white bg-main-gradient px-4 py-2">
                    <a href="https://amal.kampungmaghfirah.id" target="_blank">Beramal Bersama Kami Disini..</a>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="copy-target">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.31/dist/sweetalert2.all.min.js"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FCZZ28T04Z"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-FCZZ28T04Z');
    </script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        })
        
        $(document).ready(function(){
            $('.lazy').Lazy();
            $("#btn-bottom-nav").on("click", function(){
                const bNav = $("#bottom-nav")
                if(bNav.length && typeof bNav.attr('is-active') == 'undefined'){
                    bNav.attr('is-active', true)
                }else{
                    bNav.removeAttr('is-active')
                }
            })
            $("#bottom-nav").on("click", function(){
                $(this).removeAttr('is-active')
            })
            $("a.btn-back").on("click", function(e){
                e.preventDefault()
                
                if(history.length > 1){
                    history.back();
                    return;
                }
                
                window.location.href = "/";
            })
            $(".password-icon").on("click", function(){
                const icon = $(this).find("ion-icon")
                const input = $(this).prev('input')
                
                if(input.attr('type') == 'password'){
                    icon.attr('name', 'eye-off')
                    input.attr('type', 'text')
                }else{
                    icon.attr('name', 'eye')
                    input.attr('type', 'password')
                }
            })
            
            $("body").on("click", ".input-copy" , function(){
                const target = $(this).find(".copy-target");
                target.select();
                document.execCommand("copy");
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Disalin'
                })
            });

            $("body").on("click", ".btn-copy" , function(){
                const target = $("#copy-target");
                target.val($(this).data('target'));
                target.select();
                // target.setSelectionRange(0, 99999);

                navigator.clipboard.writeText(target.val());
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Disalin'
                })
            });

            $("body").on("keyup", ".input-price", function(){
                $(this).val(formatRupiah($(this).val()));
            })
        })

        function formatRupiah(angka){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
            
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah ? rupiah : '';
        }
    </script>
    
    @livewireScripts
    @stack('scripts')

</body>
</html>
