@extends('layouts.app')

@push('meta')
@include('components.meta', [
    'title' => 'Bergabung ke Kampung Maghfirah',
    'description' => 'Daftar akun Kampung Maghfirah'
])
@endpush

@push('styles')
@endpush

@section('content')

@include('components.navbar-top', ['title' => 'Daftar'])

<div class="px-10 lg:px-32 py-32 lg:w-1/2 m-auto">
    @livewire('auth.register', ['isModal' => false])
</div>

@include('components.footer')

@endsection

@push('scripts')
@endpush