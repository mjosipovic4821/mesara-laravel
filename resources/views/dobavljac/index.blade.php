@extends('layouts.app')

@section('content')
    <h1>Dobavljači</h1>

    <p><a href="{{ route('dobavljacs.create') }}">+ Dodaj dobavljača</a></p>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Telefon</th>
            <th>Email</th>
            <th>Akcije</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dobavljacs as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->naziv }}</td>
                <td>{{ $d->telefon ?? '—' }}</td>
                <td>{{ $d->email ?? '—' }}</td>
                <td>
                    <a href="{{ route('dobavljacs.show', $d) }}">Prikaži</a> |
                    <a href="{{ route('dobavljacs.edit', $d) }}">Izmeni</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
