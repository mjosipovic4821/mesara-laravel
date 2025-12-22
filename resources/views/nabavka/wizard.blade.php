@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Nova nabavka</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Greška:</strong> {{ $errors->first() }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('nabavka.wizard.store') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Dobavljač</label>
                        <select name="dobavljac_id" class="form-select" required>
                            <option value="">Izaberi dobavljača</option>
                            @foreach($dobavljacs as $d)
                                <option value="{{ $d->id }}" @selected(old('dobavljac_id') == $d->id)>
                                    {{ $d->naziv }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Datum</label>
                        <input type="date" name="datum_nabavke" class="form-control" value="{{ old('datum_nabavke', now()->toDateString()) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Napomena</label>
                    <textarea name="napomena" class="form-control" rows="2">{{ old('napomena') }}</textarea>
                </div>

                <hr>
                <h5 class="mb-3">Stavke nabavke (unesi bar 1)</h5>

                {{-- Minimalno: 3 reda bez JS --}}
                @for ($i = 0; $i < 3; $i++)
                    <div class="row g-2 align-items-end mb-2">
                        <div class="col-md-6">
                            <label class="form-label">Materijal</label>
                            <select name="items[{{ $i }}][materijal_id]" class="form-select">
                                <option value="">—</option>
                                @foreach($materijals as $m)
                                    <option value="{{ $m->id }}" @selected(old("items.$i.materijal_id") == $m->id)>
                                        {{ $m->naziv }} (zaliha: {{ $m->zaliha }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Količina</label>
                            <input type="number" step="0.001" name="items[{{ $i }}][kolicina]" class="form-control"
                                   value="{{ old("items.$i.kolicina") }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Cena / jedinici</label>
                            <input type="number" step="0.01" name="items[{{ $i }}][cena_po_jedinici]" class="form-control"
                                   value="{{ old("items.$i.cena_po_jedinici") }}">
                        </div>
                    </div>
                @endfor

                <div class="d-flex justify-content-between mt-3">
                    <a class="btn btn-secondary" href="{{ route('dashboard') }}">Nazad</a>
                    <button class="btn btn-primary">Sačuvaj nabavku</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
