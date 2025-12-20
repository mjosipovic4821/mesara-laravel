@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Raspored rada</h1>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Nedelja</label>
                    <input type="week" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Radnik</label>
                    <select class="form-select">
                        <option>Svi radnici</option>
                        <option>Marko Marković</option>
                        <option>Petar Petrović</option>
                    </select>
                </div>
            </div>

            <hr>

            <h5 class="mb-3">Pregled smena i zadataka</h5>

            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>Dan</th>
                        <th>Smena</th>
                        <th>Zadatak</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ponedeljak</td>
                        <td>Jutro</td>
                        <td>Priprema mesa</td>
                    </tr>
                    <tr>
                        <td>Utorak</td>
                        <td>Veče</td>
                        <td>Prodaja</td>
                    </tr>
                    <tr>
                        <td>Sreda</td>
                        <td>Slobodan dan</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>

            <div class="text-end">
                <button class="btn btn-primary" disabled>
                    Sačuvaj raspored
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
