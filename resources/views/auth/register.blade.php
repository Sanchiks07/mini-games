<x-layout>
    <x-slot:title>
        Register
    </x-slot>

    <div class="login">
        <h2>Register</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/register" method="POST" class="login-form">
            @csrf
            <input name="name" id="name" type="text" placeholder="Name..." value="{{ old('name') }}"/>
            <input name="email" id="email" type="email" placeholder="E-mail..." value="{{ old('email') }}"/>
            <input name="password" id="password" type="password" placeholder="Password..."/>
            <input name="password_confirmation" id="password_confirmation" type="password" placeholder="Password confirmation..."/>
            <button class="login-small-pretty">Register</button>
        </form>
        <p>Already have an account?</p>
        <a href="{{ route('login.form') }}">Login</a>
    </div>
    
</x-layout>