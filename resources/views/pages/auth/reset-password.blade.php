@extends('layouts.app')

@push('styles')
@endpush

@section('content')

@push('meta')
@include('components.meta', [
    'title' => 'Reset Password',
])
@endpush

@include('components.navbar-top', ['title' => 'Reset Password'])

<div class="px-10 lg:px-32 py-32 lg:w-1/2 m-auto">
    @livewire('auth.reset-password')
</div>

@include('components.footer')

@endsection

@push('scripts')
@endpush