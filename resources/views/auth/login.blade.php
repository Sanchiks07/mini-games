<x-layout>
    <h2>Pievienoties</h2>
    <form action="/login" method="POST">
        @csrf
        <label>
            E-pasts:
            <input name="email" id="email" type="email"/>
        </label><br><br>
        <label>
            Parole:
            <input name="password" id="password" type="password"/>
        </label><br><br>
        <button>Pievienoties</button>
    </form>
</x-layout>