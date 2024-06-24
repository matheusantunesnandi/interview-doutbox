<div class="container">
    <header class="lh-1 py-3">

        <div class="row">
            <div class="col d-flex justify-content-start">
                @yield('navigation_button')
            </div>

            @guest
                <div class="col d-flex justify-content-end">
                    <a class="btn btn-sm btn-outline-secondary mx-2" href="{{ url('/login') }}">
                        Login
                    </a>

                    <a class="btn btn-sm btn-outline-secondary mx-2" href="{{ url('/register') }}">
                        Register
                    </a>
                </div>
            @endguest


            @auth
                <div class="col d-flex justify-content-end">
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        Hello <strong>{{ Auth::user()->name }}</strong>!
                        <input type="submit" value="Logout" class="btn btn-sm btn-outline-secondary mx-2">
                    </form>
                </div>
            @endauth
        </div>

        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-center">
                <a class="nav-item nav-link link-body-emphasis @yield('navbar_post_active')" href="{{ url('/posts') }}">
                    Feed
                </a>

                @auth
                    <a class="nav-item nav-link link-body-emphasis @yield('navbar_post_mine_active')" href="{{ url('/posts?my_posts') }}">
                        My posts
                    </a>

                    <a class="nav-item nav-link link-body-emphasis @yield('navbar_post_create_active')" href="{{ url('/posts/create') }}">
                        New post
                    </a>
                @endauth

                @can('isAdmin')
                    <a class="nav-item nav-link link-body-emphasis @yield('navbar_users_index')" href="{{ url('/users') }}">
                        Users
                    </a>
                @endcan
            </nav>
        </div>

    </header>
</div>
