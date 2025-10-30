<x-layout>
    <h2>Reģistrēties</h2>
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
            Vārds:
            <input name="name" id="name" type="text" value="{{ old("name") }}"/>
        </label><br><br>
        <label>
            E-pasts:
            <input name="email" id="email" type="email" value="{{ old("email") }}"/>
        </label><br><br>
        <label>
            Parole:
            <input name="password" id="password" type="password"/>
        </label><br><br>
        <label>
            Parole atkārtoti:
            <input name="password_confirmation" id="password_confirmation" type="password"/>
        </label><br><br>
        <button>Reģistrēties</button>
    </form>
</x-layout>