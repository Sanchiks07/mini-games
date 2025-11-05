<x-layout>
    <h2>Login</h2>
    <form action="/login" method="POST">
        @csrf
        <label>
            E-mail:
            <input name="email" id="email" type="email"/>
        </label><br><br>
        <label>
            Password:
            <input name="password" id="password" type="password"/>
        </label><br><br>
        <button>Login</button>
    </form>
    <p>Don't have an account?</p>
    <a href="{{ route('register') }}">Register</a>
</x-layout>