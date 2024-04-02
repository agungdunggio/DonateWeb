@extends('layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5 form-signin w-100 m-auto">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">    
                {{ session('error') }}    
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="/login" method="post">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            
            <div class="form-floating text-dark ">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                <label for="email" >Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating text-dark ">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy;2022</p>
        </form>
    </div>
</div>
@endsection
