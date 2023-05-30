@extends('layouts.app')

@push('styles')
@endpush

@section('content')

@push('meta')
@include('components.meta', [
    'title' => 'Login',
    'description' => 'Login ke Akun Kampung Maghfirah'
])
@endpush

@include('components.navbar-top', ['title' => 'Login'])

<div class="px-10 lg:px-32 py-32 lg:w-1/2 m-auto">
    @livewire('auth.login', ['isModal' => false])
</div>

@include('components.footer')

@endsection

@push('scripts')
@endpush