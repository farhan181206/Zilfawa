<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('dashboard.layouts.include')
</head>
<body>


    <div class="layout-wrapper layout-content-navbar">
        @include('dashboard.layouts.sidebar')
            @yield('content')
    </div>



    @include('dashboard.layouts.script')
</body>
</html>