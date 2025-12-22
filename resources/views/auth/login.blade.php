@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 480px;">
    <h1 class="mb-4">Prijava</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Prijavi se</button>
            </form>
        </div>
    </div>

    <p class="text-muted mt-3 mb-0">
        (Test nalog ćemo dodati kroz seeder.)
    </p>
</div>
@endsection
