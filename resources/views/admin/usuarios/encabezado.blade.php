    <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
        <a class="navbar-brand" href="#">
            <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
            Delivery
        </a>    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            @if (Route::has('login'))
                @auth
                    <a class="nav-item nav-link active" href="{{ url('/home') }}">Home <span class="sr-only">(current)</span></a>
                @else
                    <a class="nav-item nav-link" href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a class="nav-item nav-link" href="{{ route('register') }}">Register</a>
                    @endif
            @endif
            @endauth
            </div>
        </div>
    </nav>