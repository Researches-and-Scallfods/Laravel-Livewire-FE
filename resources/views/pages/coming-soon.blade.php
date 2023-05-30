@extends('layouts.app')

@push('styles')

@section('content')

@include('components.navbar-top', ['title' => 'Segera Hadir'])

<div class="py-20 px-32">
    <div class="text-center bg-white rounded-xl p-32 space-y-7">
        <img src="{{ asset('images/coming-soon.png') }}" alt="Coming Soon" class="h-[150px] w-auto m-auto">
        <div class="text-[24px] font-bold">Fitur Ini Akan Segera Hadir</div>
    </div>
</div>

@include('components.footer')

@endsection