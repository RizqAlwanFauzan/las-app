<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        @auth
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Detail Pengguna</span>
                    <div class="dropdown-divider"></div>
                    <span class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> {{ auth()->user()->name }}
                    </span>
                    <div class="dropdown-divider"></div>
                    <span class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{ auth()->user()->email }}
                    </span>
                    <div class="dropdown-divider"></div>
                    <span class="dropdown-item">
                        <i class="fas fa-tag mr-2"></i>
                        @foreach (auth()->user()->getRoleNames() as $role)
                            <span class="badge badge-light">{{ $role }}</span>
                        @endforeach
                    </span>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('auth.masuk.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Keluar</button>
                    </form>
                </div>
            </li>
        @endauth
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
