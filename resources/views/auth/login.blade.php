<x-layout>
    <x-slot:title>
        Login
    </x-slot>

    <div class="login">
        <h2>Login</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/login" method="POST" class="login-form">
            @csrf
            <input name="email" id="email" type="email" placeholder="E-mail..."/>
            <input name="password" id="password" type="password" placeholder="Password..."/>
            <button class="login-small-pretty">Login</button>
        </form>
        <p>Don't have an account?</p>
        <a href="{{ route('register') }}">Register</a>
    </div>
</x-layout>