<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootsrab/bootsrab.css') }}"> --}}
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('fontawesome/fontawesome.css') }}"> --}}
    
    <!-- Custom Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/JobSeeker/dashbord.css') }}">
        <!-- sweetalert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
        {{-- jquery --}}
        <script src="{{asset('jquery/jquery-3.6.0.min.js')}}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}



    @yield('style')
</head>

    @include('JobSeeker.layouts.nav')

<div class="container mt-5">
    @yield('content')
</div>

@include('jobSeeker.layouts.footer')

@include('alert')

@yield('script')

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
{{-- <script src="{{asset('css/bootsrab/bootstrap.js')}}"></script> --}}

<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    {{-- <script src="{{asset('fontawesome/fontawesome.js')}}"></script> --}}