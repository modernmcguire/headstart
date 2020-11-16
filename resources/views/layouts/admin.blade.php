<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('page_title', 'Admin - '.env('APP_NAME'))</title>
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://kit.fontawesome.com/ca00268a38.js" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        @livewireStyles

        @stack('styles')
    </head>
    <body class="nav-fixed">
        @include('headstart::layouts.admin.nav')

        <div id="layoutSidenav">
            @include('headstart::layouts.admin.sidebar')

            <div id="layoutSidenav_content">
                <main>
                    @if (session('flash.success'))
                        <div class="bg-success-soft text-dark py-3 px-4">{!! session('flash.success') !!}</div>
                    @endif

                    @if (session('flash.warning'))
                        <div class="bg-warning-soft text-dark py-3 px-4">{!! session('flash.warning') !!}</div>
                    @endif

                    @if (session('flash.danger'))
                        <div class="bg-danger-soft text-dark py-3 px-4">{!! session('flash.danger') !!}</div>
                    @endif

                    @yield('content')
                </main>
                <footer class="footer mt-auto footer-light">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-md-right small">
                                Created by <a href="https://modernmcguire.com">Modern McGuire Productions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/admin.js') }}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js" integrity="sha512-ELgdXEUQM5x+vB2mycmnSCsiDZWQYXKwlzh9+p+Hff4f5LA+uf0w2pOp3j7UAuSAajxfEzmYZNOOLQuiotrt9Q==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.min.css" integrity="sha512-87wkTHUArAnTBwQ5XL6+G68i54R3TXYDZoXewRsdhIv/ztcEr2Z1Mrk+aXBCKOZUtih0XWiBhXv3/bWjHTL2Bw==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.default.min.css" integrity="sha512-htNvyHHSudmoBXn6EWHJNChOqj6bjdATOD9Cj63VcJKtonHBnWZmTiYaI+tUzVv4dZlE+SaWjoq6mhL3ztfAJg==" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha512-hgoywpb1bcTi1B5kKwogCTG4cvTzDmFCJZWjit4ZimDIgXu7Dwsreq8GOQjKVUxFwxCWkLcJN5EN0W0aOngs4g==" crossorigin="anonymous"></script>

        @livewireScripts

        @stack('scripts')
    </body>
</html>
