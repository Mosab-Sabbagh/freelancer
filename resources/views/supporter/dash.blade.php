<h1>SUPPORTER</h1>

<h1>holle {{Auth::user()->name}}</h1>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
