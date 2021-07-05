<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="" type="image/x-icon" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>@yield('title')</title>

    <!-- Component CSS files -->
    @yield('stylesheet')
    <!-- /Component CSS files -->

    <!-- Core JS files -->

    <!-- Core JS files -->

    <!-- Component JS files -->
    @yield('components')
    <!-- /Component JS files -->
</head>

<body>
    @include('layouts._header')
    <main>
        <div class="">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </main>
    <!-- form's  Jquery files -->
    @yield('page_javascript')
    <!-- /form's  Jquery files -->

    <!-- form's hidden field (table add row, hidden textbox) -->
    @yield('content_hidden')
    <!-- /form's  hidden field -->
</body>

</html>
