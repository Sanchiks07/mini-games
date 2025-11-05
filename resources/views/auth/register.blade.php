<x-layout>
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
    <form action="/register" method="POST">
        @csrf
        <label>
            Name:
            <input name="name" id="name" type="text" value="{{ old("name") }}"/>
        </label><br><br>
        <label>
            E-mail:
            <input name="email" id="email" type="email" value="{{ old("email") }}"/>
        </label><br><br>
        <label>
            Password:
            <input name="password" id="password" type="password"/>
        </label><br><br>
        <label>
            Password confirmation:
            <input name="password_confirmation" id="password_confirmation" type="password"/>
        </label><br><br>
        <button>Register</button>
    </form>
    <p>Already have an account?</p>
    <p><a href="{{ route('login.form') }}">Login</a></p>
</x-layout>