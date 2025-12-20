<h1>Proizvodi</h1>

<form method="GET" action="{{ route('public.proizvodi.index') }}">
    <input type="text" name="q" value="{{ $q }}" placeholder="Pretraga..." />
    <button type="submit">Traži</button>
</form>

<ul>
@foreach ($proizvodi as $p)
    <li>
        <a href="{{ route('public.proizvodi.show', $p) }}">
            {{ $p->naziv_proizvoda }}
        </a>
        - {{ number_format($p->prodajna_cena, 2) }} RSD
    </li>
@endforeach
</ul>

{{ $proizvodi->links() }}
