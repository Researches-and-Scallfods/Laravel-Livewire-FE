@extends('layouts.app')

@push('meta')
@include('components.meta', [
    'description' => 'Kampung Maghfirah merupakan suatu kawasan pendidikan islam terpadu mulai dari anak-anak hingga usia lanjut. Yuk Mengenal Kampung Maghfirah Lebih Dekat'
])
@endpush

@push('styles')
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
@endpush

@section('content')

{{-- navbar --}}
@include('components.navbar-top')
@include('components.navbar-mobile')

{{-- footer --}}
@include('components.footer')

@endsection

@push('scripts')
<script src="{{ asset('js/splide.min.js') }}"></script>
@endpush