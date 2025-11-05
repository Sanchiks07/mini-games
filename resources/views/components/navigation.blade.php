<style>
nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
}

nav > *:only-child {
    margin-left: auto;
}

nav form {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
}

</style>

<nav>
    @auth
        @if (Route::currentRouteName() !== 'welcome')
            <button type="button" onclick="window.location='{{ route('welcome') }}'">Games</button>
        @endif 

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <p>Welcome, {{ Auth::user()->name }}</p>
            <button type="submit">Logout</button>
        </form>
    @endauth
</nav>
