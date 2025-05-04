@extends('layouts.app')

@section('content')
    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Hero Section --}}
    @include('partials.hero')

    {{-- Featured Rooms Section --}}
    @include('partials.featured-rooms', ['roomTypes' => $roomTypes])

    {{-- About Section --}}
    @include('partials.about')

    {{-- Amenities Section --}}
    @include('partials.amenities', ['amenities' => $amenities])

    {{-- Contact Section --}}
    @include('partials.contact')

    {{-- Footer --}}
    @include('partials.footer')
@endsection
