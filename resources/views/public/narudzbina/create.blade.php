@extends('layouts.app')

@section('content')
<h1>Nova narudžbina</h1>

<form method="POST" action="{{ route('public.narudzbina.store') }}">
    @csrf

    <div>
        <label>Kupac</label><br>
        <select name="kupac_id" required>
            @foreach($kupci as $k)
                <option value="{{ $k->id }}">{{ $k->naziv_kupca }}</option>
            @endforeach
        </select>
    </div>

    <div style="margin-top:10px;">
        <label>Radnik</label><br>
        <select name="radnik_id" required>
            @foreach($radnici as $r)
                <option value="{{ $r->id }}">{{ $r->ime }} {{ $r->prezime }}</option>
            @endforeach
        </select>
    </div>

    <div style="margin-top:10px;">
        <label>Napomena</label><br>
        <textarea name="napomena" rows="3" cols="50"></textarea>
    </div>

    <hr style="margin:16px 0;">

    <h3>Stavke (unesi bar jednu)</h3>

    @for($i = 0; $i < 3; $i++)
        <div style="margin-bottom:10px;">
            <select name="items[{{ $i }}][proizvod_id]" required>
                @foreach($proizvodi as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->naziv_proizvoda }} ({{ number_format($p->prodajna_cena, 2) }} RSD)
                    </option>
                @endforeach
            </select>

            <input type="number" step="0.001" name="items[{{ $i }}][kolicina]" placeholder="količina" required>
        </div>
    @endfor

    <button type="submit">Kreiraj fakturu</button>
</form>
@endsection
