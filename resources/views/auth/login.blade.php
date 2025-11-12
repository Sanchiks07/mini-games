<x-layout>
    <div class="login">
        <h2>Login</h2>
        <form action="/login" method="POST" class="login-form">
            @csrf
            <input name="email" id="email" type="email" placeholder="E-mail..."/>
            <input name="password" id="password" type="password" placeholder="Password..."/>
            <button class="small-pretty">Login</button>
        </form>
        <p>Don't have an account?</p>
        <a href="{{ route('register') }}">Register</a>
    </div>
</x-layout>