<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Basic Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('backend/css/styles.css')}}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ asset('backend/css/custom.css')}}">
    </head>
    <body class="sb-nav-fixed">
        @include('admin.layouts.nav')
        <div id="layoutSidenav">
        @include('admin.layouts.sidebar')
            <div id="layoutSidenav_content">
                <main>
                  @yield('content')
                </main>
                @include('admin.layouts.footer')
            </div>
        </div>
        @include('admin.layouts.js')
    </body>
</html>
