<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    html {
        height: 100%;
        width: 100%;
      }

    body {
    height: 100%;
    width: 100%;
    }

    main {
        height: 92%;
        width: 100%;
    }



    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-dark bg-dark ">
            <a href="{{ route('home')}}" class="navbar-brand">YP</a>
            <button class="navbar-toggler" type="button"
                data-toggle="collapse"
                data-target="#navmenu1"
                aria-controls="navmenu1"
                aria-expanded="false"
                aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navmenu1">
              <div class="navbar-nav">
                <a class="nav-item nav-link" href="#">Menu</a>
                <a class="nav-item nav-link" href="#">Menu</a>
                <a class="nav-item nav-link" href="#">Menu</a>
              </div>
            </div>
          </nav>
    </header>
    <main class="py-4">
        @yield('main')
    </main>
</body>
</html>
