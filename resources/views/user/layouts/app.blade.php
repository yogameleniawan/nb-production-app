<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TOKO | NB PRODUCTION</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ url('admin/images/favicon.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('mazer/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/choices.js/choices.min.css') }}" />
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('mazer/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ url('mazer/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/summernote/summernote-lite.min.css') }}">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/toastify/toastify.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    {{-- <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.js">

    @yield('css')
    <style>
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #ea342a;
            border-color: #ea342a;
        }

        .sidebar-wrapper .sidebar-header img {
            height: 5.299999999999997rem;
        }

        .sidebar-wrapper {
            width: 300px;
            height: 100vh;
            position: fixed;
            top: 0;
            z-index: 10;
            overflow-y: auto;
            background-color: #272727;
            bottom: 0;
            transition: left .5s ease-out;
        }

        .sidebar-wrapper .menu .sidebar-link {
            display: block;
            padding: 0.7rem 1rem;
            font-size: 1rem;
            display: flex;
            align-items: center;
            border-radius: 0.5rem;
            transition: all .5s;
            text-decoration: none;
            color: #ffffff;
        }

        .sidebar-wrapper .menu .sidebar-link i, .sidebar-wrapper .menu .sidebar-link svg {
            color: #857f3d;
        }

        a {
            color: #857f3d;
            text-decoration: underline;
        }

        .navbar {
            height: 90px;
            padding: 1.5rem;
            background-color: #272727;
        }

        #main #main-content {
            padding: 1rem;
        }

        .img-product{
            width:100%;
            border-radius: 10px;
        }

        .add-to-cart{
            background-color: #4fbe87;
            border-radius: 10px;
            color: white;
            text-align: -webkit-center;
            padding: 5px;
        }

        .remove-from-cart{
            background-color: #f3616d;
            border-radius: 10px;
            color: white;
            text-align: -webkit-center;
            padding: 5px;
        }

        .form-disabled {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #607080;
            background-color: #e3e3e3;
            background-clip: padding-box;
            border: 1px solid #dce7f1;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .delete-button{
            text-align: -webkit-center;
        }

        .foot-accordion{
            background-color: #4fbe87;
            text-align: center;
            color: white;
            padding: 8px;
            border-radius: 10px;
        }



    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="{{ url('img/logo.jpeg') }}"></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        @can('admin')
                        <li class="sidebar-item ">
                            <a href="{{route('user.index')}}" class='sidebar-link'>
                                <i class="bi bi-person-fill"></i>
                                <span>
                                    Data Seller
                                </span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="{{route('store.index')}}" class='sidebar-link'>
                                <i class="bi bi-house-fill"></i>
                                <span>
                                    Data Toko
                                </span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="{{route('seller-toko.index')}}" class='sidebar-link'>
                                <i class="bi bi-briefcase-fill"></i>
                                <span>
                                    Data Toko Seller
                                </span>
                            </a>
                        </li>
                        @endcan

                        @can('user')
                        <li class="sidebar-item ">
                            <a href="{{url('/toko?name=')}}{{app('request')->input('name')}}" class='sidebar-link'>
                                <i class="bi bi-hdd-stack-fill"></i>
                                <span>
                                    PRODUK
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{url('/pesanan?name=')}}{{app('request')->input('name')}}" class='sidebar-link'>
                                <i class="bi bi-cart-fill"></i>
                                <span>
                                    PESANAN
                                </span>
                            </a>
                        </li>
                        @endcan
                        {{-- <li
                            class="sidebar-item has-sub {{ Route::is('program.create') || Route::is('program.index') || Route::is('history.index') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class='sidebar-link'>
                                <i class="bi bi-book-half"></i>
                                <span>
                                    {{ __('student.menu.application') }}
                                </span>
                            </a>
                            <ul
                                class="submenu {{ Route::is('program.create') || Route::is('program.index') || Route::is('history.index') ? 'active' : '' }}">
                                <li
                                    class="submenu-item {{ Route::is('program.create') || Route::is('program.index') ? 'active' : '' }}">
                                    <a href="{{ route('program.index') }}">
                                        {{ __('student.menu.startnewapplication') }}
                                    </a>
                                </li>
                                <li class="submenu-item {{ Route::is('history.index') ? 'active' : '' }}">
                                    <a href="{{ route('history.index') }}">
                                        {{ __('student.menu.applyhistory') }}
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
            <header>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">

                                            </h6>
                                            <p class="mb-0 text-sm text-gray-600">

                                            </p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img
                                                src="{{url('mazer/assets/images/faces/1.jpg') }}">
                                           </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">

                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" role="button">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                        Keluar
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            @yield('page-heading')
            <div id="main-content">

                <div class="page-heading">

                    @yield('content')
                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2022 &copy; NB Production</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="{{ url('mazer/assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="{{ url('mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('mazer/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('mazer/assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ url('mazer/assets/vendors/toastify/toastify.js') }}"></script>
    <script src="{{ url('mazer/assets/js/extensions/toastify.js') }}"></script>

    <script src="{{ url('mazer/assets/vendors/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
        })

        $('#summernote1').summernote({
            tabsize: 2,
            height: 120,
        })
    </script>

    <script>
        function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    </script>

    @yield('script')
</body>

</html>
