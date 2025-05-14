<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    {{-- offline --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/bootsrab/bootsrab.css') }}"> --}}

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- offline --}}
    {{-- <link rel="stylesheet" href="{{ asset('fontawesome/fontawesome.css') }}"> --}}

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    {{-- offline --}}
    {{-- <link rel="stylesheet" href="{{ asset('swiper/swiper.css') }}"> --}}

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    {{-- offline --}}
    {{-- <link rel="stylesheet" href="{{ asset('swiper/swiper.js') }}"> --}}

    @yield('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Tajawal', 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
        }

        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            color: white;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            margin-left: 15px;
            transition: all 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
            transform: translateY(-2px);
        }

        .main-container {
            padding: 20px;
            margin-top: 20px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: none;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
            font-weight: bold;
            padding: 15px 20px;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-body {
            padding: 25px;
        }

        .amount {
            font-size: 28px;
            font-weight: bold;
            color: var(--dark-color);
            margin-top: 5px;
        }

        .steps-container {
            background-color: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            /* margin-top: 30px; */
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--dark-color);
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .step {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background-color: var(--light-color);
            border-radius: 10px;
            transition: all 0.3s;
        }

        .step:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }

        .step-number {
            width: 35px;
            height: 35px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
            font-weight: bold;
            font-size: 18px;
        }

        .step-text {
            flex: 1;
            font-size: 16px;
        }

        .color-title {
            color: var(--primary-color);
            margin-top: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            color: white;
        }

        .user-icon {
            margin-left: 10px;
            font-size: 20px;
        }

        .swiper {
            padding-bottom: 50px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #333;
        }

        @media (max-width: 768px) {
            .amount {
                font-size: 22px;
            }

            .card-body {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    @include('guest.layouts.nav')
<div>

    @yield('content')
</div>


    @include('guest.layouts.footer')
    @yield('script')

        <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{asset('css/bootsrab/bootstrap.js')}}"></script> --}}
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    {{-- <script src="{{asset('fontawesome/fontawesome.js')}}"></script> --}}

</body>

</html>