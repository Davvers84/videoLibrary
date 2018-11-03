<div class="container">
    <div class="col-md-3">
        <a class="navbar-brand" href="/">Vibrary</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="col-md-5">
        @if(!empty($user['email']))
            <p class="sign-in-text">Welcome {{ $user['name'] }}, thank you for signing in!</p>
        @endif
    </div>
    <div class="col-md-4">
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link"href="/video/search">Search</a>
                </li>
                @if(!empty($user['email']))
                    <li class="nav-item">
                        <a class="nav-link"href="/video/downloads">My Vibrary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/auth/signout">Sign out</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/auth/google">Sign In</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>