<h1>{{ $proizvod->naziv_proizvoda }}</h1>

<p>Tip: {{ $proizvod->tip ?? '—' }}</p>
<p>Cena: {{ number_format($proizvod->prodajna_cena, 2) }} RSD</p>
<p>Zaliha: {{ $proizvod->zaliha }}</p>

<a href="{{ route('public.proizvodi.index') }}">Nazad</a>
