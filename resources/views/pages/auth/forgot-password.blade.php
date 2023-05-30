@extends('layouts.app')

@push('styles')
@endpush

@section('content')

@push('meta')
@include('components.meta', [
    'title' => 'Lupa Password',
])
@endpush

@include('components.navbar-top', ['title' => 'Lupa Password'])

<div class="px-10 lg:px-32 py-32 lg:w-1/2 m-auto">
    @livewire('auth.forgot-password')
</div>

@include('components.footer')

@endsection

@push('scripts')
@endpush