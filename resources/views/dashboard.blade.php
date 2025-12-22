@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Glavni meni</h1>
    <p class="text-muted mb-4">Izaberite akciju:</p>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Nova prodaja</h5>
                    <p class="card-text">Kreiraj novu narudžbinu i izdaj račun (fakturu).</p>
                    <a class="btn btn-primary w-100" href="{{ route('public.narudzbina.create') }}">
                        Pokreni prodaju
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Nabavka</h5>
                    <p class="card-text">Unos nabavke i stavki nabavke, ažuriranje zaliha.</p>
                    <a class="btn btn-outline-primary w-100" href="{{ route('nabavka.wizard.create') }}">
                        Otvori nabavke
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Raspored</h5>
                    <p class="card-text">Pregled i planiranje smena i zadataka radnika.</p>
                    <a class="btn btn-outline-primary w-100" href="{{ route('raspored.index') }}">
                        Otvori raspored
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
