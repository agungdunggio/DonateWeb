@extends('dashboard.layouts.main')

@section('konten')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Charity</h1>
</div>

<div class="col-lg-10 mb-5">
    <form method="post" action="/dashboard/{{ $charity->slug }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input placeholder="Judul" type="text" id="title" class="form-control @error('title') is-invalid @enderror" required="" name="title" autofocus value="{{ old('title',$charity->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="daerah" class="form-label">Daerah Donasi</label>
            <input placeholder="Daerah" type="text" id="daerah" class="form-control @error('daerah') is-invalid @enderror" required="" name="daerah" autofocus value="{{ old('daerah',$charity->daerah) }}">
            @error('daerah')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="max_dana" class="form-label">Total Target Donasi</label>
            <input placeholder="Total Target Donasi" type="number" id="max_dana" class="form-control @error('max_dana') is-invalid @enderror" required="" name="max_dana" autofocus value="{{ old('max_dana',$charity->max_dana) }}">
            @error('max_dana')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exp_date" class="form-label">Batas Tanggal Donasi</label>
            <input placeholder="exp_date_berita" type="date" class="input form-control @error('exp_date') is-invalid @enderror" required="" name="exp_date" value="{{ old('exp_date',$charity->exp_date) }}" id="exp_date">
            @error('exp_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="hidden" name="oldImage" value="{{ $charity->foto }}">
            <label for="foto" class="form-label d-block">Foto Donasi</label>
            @if ($charity->foto)
                <img src={{ asset("storage/$charity->foto") }} class="img-preview img-fluid mb-3 mt-2 col-sm-3">   
            @else
                <img class="img-preview img-fluid mb-3 col-sm-3">
            @endif
            <input placeholder="foto" type="file" class="input form-control @error('foto') is-invalid @enderror" name="foto" id="foto" onchange="previewImage()">
            @error('foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="bd" class="form-label">Cerita</label>
            @error('cerita')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror
            <input id="bd" type="hidden" name="cerita" value="{{ old('cerita',$charity->cerita) }}">
            <trix-editor input="bd"></trix-editor>
            {{-- <textarea placeholder="Isi Berita" type="text" class="input form-control @error('body') is-invalid @enderror" required="" name="body">{{ old('body') }}</textarea> --}}
        </div>
        <button type="submit" class="btn btn-primary">Edit Charity</button>
    </form>
</div>


@endsection