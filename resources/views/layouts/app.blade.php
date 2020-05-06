
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Soundy Liau">
    <title>Moo</title>
    <link href="{{ asset('css/c_bootstrap.min.css') }}" rel="stylesheet">
    @yield('css')
    <style>

        /* [v-cloak] > * { display:none } */
        /* [v-cloak]::before { content: "loading…" } */
        [v-cloak]>* {
            display: none;
        }

        [v-cloak]>.spinner-border {
            display: block;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">

        <div class="d-flex navbar-expand">
            <a class="navbar-brand" href="<?php echo route('home'); ?>">Keu. Iuran</a>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ action('PortfolioController@index') }}">Portfolio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ action('EmitenController@index') }}">Emiten</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Top Gain</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ action('EmitenController@toploss') }}">Top Loss</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">More Moo Menu</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
    <div style="height: .2rem; background-color: #828282"></div>

    <main role="main" class="container-lg mt-3" style="min-height: 75vh">
        @yield('content')
    </main>

    <footer class="footer mt-4">
        <div class="container">
            <span class="text-muted">
                <h4>Moo Footer</h4>
            </span>
        </div>
    </footer>
</body>

</html>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@yield('js')