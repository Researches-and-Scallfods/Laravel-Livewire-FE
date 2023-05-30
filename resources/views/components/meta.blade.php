@if(isset($title))
<title>{{ $title }}</title>
@else
<title>Kampung Maghfirah</title>
@endif

@if(isset($description))
<meta name="description" content="{{$description}}"/>
@endif

{{-- open graph --}}
@if(isset($title))
<meta property="og:title" content="{{$title}}" />
@endif
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ request()->url() }}" />
@if(isset($image))
<meta property="og:image" content="{{ $image }}" />
@else
<meta property="og:image" content="{{ asset('/images/logo.png') }}" />
@endif

{{-- twitter --}}
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="{{ url()->to('/') }}" />
@if(isset($author))
<meta name="twitter:creator" content="{{$author}}" />
@endif
<meta property="og:url" content="{{ request()->url() }}"/>