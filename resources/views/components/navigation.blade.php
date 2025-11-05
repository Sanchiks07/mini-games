<nav>
    @auth
        @if (Route::currentRouteName() !== 'welcome')
            <button class="small-pretty" type="button" onclick="window.location='{{ route('welcome') }}'">Games</button>
        @endif 

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <p>Welcome, {{ Auth::user()->name }}</p>
            <button class="small-pretty" type="submit">Logout</button>
        </form>
    @endauth
</nav>
