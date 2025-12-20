@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Raspored</h1>
    <p class="text-muted">Ovaj ekran je deo use-case-a “Organizacija rada i zadataka”.</p>

    <div class="alert alert-info">
        Trenutno je implementiran osnovni ekran (placeholder). Sledeće: tabela smena (nedelja), dodela zadataka radnicima.
    </div>

    <a class="btn btn-secondary" href="{{ route('dashboard') }}">Nazad na meni</a>
</div>
@endsection
