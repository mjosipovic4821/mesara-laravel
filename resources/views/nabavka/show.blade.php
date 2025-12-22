@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Nabavka #{{ $nabavka->id }}</h1>
        <a class="btn btn-secondary" href="{{ route('nabavka.wizard.create') }}">Nova nabavka</a>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <p class="mb-1"><strong>Dobavljač:</strong> {{ $nabavka->dobavljac->naziv ?? '-' }}</p>
            <p class="mb-1"><strong>Datum:</strong> {{ optional($nabavka->datum_nabavke)->format('d.m.Y') }}</p>
            <p class="mb-1"><strong>Napomena:</strong> {{ $nabavka->napomena ?? '-' }}</p>
            <p class="mb-0"><strong>Ukupno:</strong> {{ number_format((float)$nabavka->ukupno, 2) }} RSD</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Stavke</h5>

            @if(($nabavka->stavkaNabavkes ?? collect())->isEmpty())
                <p class="text-muted mb-0">Nema stavki.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Materijal</th>
                                <th class="text-end">Količina</th>
                                <th class="text-end">Cena</th>
                                <th class="text-end">Iznos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nabavka->stavkaNabavkes as $s)
                                <tr>
                                    <td>{{ $s->materijal->naziv ?? '-' }}</td>
                                    <td class="text-end">{{ $s->kolicina }}</td>
                                    <td class="text-end">{{ number_format((float)$s->cena_po_jedinici, 2) }}</td>
                                    <td class="text-end">{{ number_format((float)$s->iznos, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('dashboard') }}">← Nazad na meni</a>
    </div>
</div>
@endsection
