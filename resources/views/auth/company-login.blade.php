@extends('app')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="text-primary fw-bolder">Bedrijf Login</h2>
                        <p class="text-muted">Log in om het CV van Musabe Coucou te bekijken</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Wachtwoord</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Inloggen</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ url('/') }}" class="text-decoration-none">
                            <i class="bi bi-arrow-left me-2"></i>Terug naar portfolio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 