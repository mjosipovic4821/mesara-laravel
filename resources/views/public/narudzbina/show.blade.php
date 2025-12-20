@extends('layouts.app')

@section('content')
<h1>Faktura #{{ $faktura->id }}</h1>

<p><strong>Kupac:</strong> {{ $faktura->kupac->naziv_kupca }}</p>
<p><strong>Radnik:</strong> {{ $faktura->radnik->ime }} {{ $faktura->radnik->prezime }}</p>
<p><strong>Datum:</strong> {{ $faktura->datum }}</p>
<p><strong>Napomena:</strong> {{ $faktura->napomena ?? '—' }}</p>

<hr>

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
    <tr>
        <th>Proizvod</th>
        <th>Količina</th>
        <th>Cena</th>
        <th>Iznos</th>
    </tr>
    </thead>
    <tbody>
    @foreach($faktura->stavkaFaktures as $s)
        <tr>
            <td>{{ $s->proizvod->naziv_proizvoda }}</td>
            <td>{{ $s->kolicina }}</td>
            <td>{{ number_format($s->cena, 2) }} RSD</td>
            <td>{{ number_format($s->iznos, 2) }} RSD</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h3>Ukupno: {{ number_format($faktura->ukupno ?? 0, 2) }} RSD</h3>

<p><a href="{{ route('public.narudzbina.create') }}">+ Nova narudžbina</a></p>
@endsection
