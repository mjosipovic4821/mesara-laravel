@extends('layouts.app')

@section('content')
    <h1>{{ ucfirst($resource ?? 'Stranica') }}</h1>
    <p>CRUD stranica generisana Blueprint alatom.</p>
@endsection