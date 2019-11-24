<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <style>
        .wapper {
            background-color: #F4F4F4;
        }

        div.wapper div.content div.container div.row {
            background-color: #ffffff;
        }

        div.wapper div.quangcaof div.container {
            background-color: #F4F4F4;
        }
    </style>
    <script src="js/file.js"></script>

    @yield('script')

    {{--    Tự tạo khi làm--}}
    <base href="{{asset('')}}" />
    <title>Cafebiz</title>
</head>

<body>
    <div class="wapper" style="">
        @include('layouts.header')
        @include('layouts.advertise.advertise_top')
        <!-- page content -->

        @yield('content')

        <!-- end_page_content -->

        @include('layouts.advertise.advertise_bottom')

        @include('layouts.footer')
    </div>
</body>

@yield('script')

</html>