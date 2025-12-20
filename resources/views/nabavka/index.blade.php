@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Nova nabavka</h1>

    <div class="card shadow-sm">
        <div class="card-body">

            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Dobavljač</label>
                        <select class="form-select">
                            <option>Izaberi dobavljača</option>
                            <option>Dobavljač A</option>
                            <option>Dobavljač B</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Datum nabavke</label>
                        <input type="date" class="form-control">
                    </div>
                </div>

                <hr>

                <h5 class="mb-3">Stavke nabavke</h5>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Materijal</th>
                            <th>Količina</th>
                            <th>Cena</th>
                            <th>Iznos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Govedina</td>
                            <td>10 kg</td>
                            <td>800 RSD</td>
                            <td>8.000 RSD</td>
                        </tr>
                        <tr>
                            <td>Ćumur</td>
                            <td>5 kg</td>
                            <td>300 RSD</td>
                            <td>1.500 RSD</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between">
                    <strong>Ukupno: 9.500 RSD</strong>
                    <button class="btn btn-primary" disabled>
                        Sačuvaj nabavku
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
