@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Raspored i zadaci</h1>
        <a class="btn btn-secondary" href="{{ route('dashboard') }}">Nazad na meni</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('raspored.index') }}" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Nedelja (ponedeljak)</label>
                    <input type="date" name="week_start" class="form-control" value="{{ $weekStart }}">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary w-100">Prikaži</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-3">Dodeli smenu i zadatak</h5>

            <form method="POST" action="{{ route('raspored.store') }}" class="row g-2 align-items-end">
                @csrf

                <input type="hidden" name="week_start" value="{{ $weekStart }}">

                <div class="col-md-4">
                    <label class="form-label">Radnik</label>
                    <select name="radnik_id" class="form-select" required>
                        <option value="">Izaberi radnika</option>
                        @foreach($radnici as $r)
                            <option value="{{ $r->id }}">{{ $r->prezime }} {{ $r->ime }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Dan</label>
                    <select name="dan" class="form-select" required>
                        <option value="0">Ponedeljak</option>
                        <option value="1">Utorak</option>
                        <option value="2">Sreda</option>
                        <option value="3">Četvrtak</option>
                        <option value="4">Petak</option>
                        <option value="5">Subota</option>
                        <option value="6">Nedelja</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Smena</label>
                    <select name="smena" class="form-select" required>
                        <option value="jutro">Jutro</option>
                        <option value="vece">Veče</option>
                        <option value="slobodan">Slobodan</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Zadatak (opciono)</label>
                    <input type="text" name="zadatak" class="form-control" placeholder="npr. pečenje, prodaja, vitrina…">
                </div>

                <div class="col-md-12 d-grid mt-2">
                    <button class="btn btn-primary">Sačuvaj raspored</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Pregled za nedelju: {{ \Illuminate\Support\Carbon::parse($weekStart)->format('d.m.Y') }}</h5>

            @if($rasporedi->isEmpty())
                <p class="text-muted mb-0">Nema unosa za izabranu nedelju.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead>
                            <tr>
                                <th>Dan</th>
                                <th>Radnik</th>
                                <th>Smena</th>
                                <th>Zadatak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rasporedi as $x)
                                <tr>
                                    <td>
                                        @php
                                            $days = ['Pon', 'Uto', 'Sre', 'Čet', 'Pet', 'Sub', 'Ned'];
                                        @endphp
                                        {{ $days[$x->dan] ?? $x->dan }}
                                    </td>
                                    <td>{{ $x->radnik->prezime ?? '' }} {{ $x->radnik->ime ?? '' }}</td>
                                    <td>{{ ucfirst($x->smena) }}</td>
                                    <td>{{ $x->zadatak ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
