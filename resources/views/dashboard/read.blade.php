@extends('dashboard.layouts.main')

@section('konten')
    <h1>asdw</h1>
    <a href="/dashboard" class="btn btn-success"><span data-feather="arrow-left"></span> Back</a>
    <a href="/dashboard/{{ $charity->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
    <form action="/dashboard/{{ $charity->slug }}" method="post" class="d-inline">
        @csrf
        @method('delete')
        <button class="btn btn-danger" onclick="return confirm('Are you Sure?')"><span data-feather="x-circle"></span> Delete</button>
    </form>

    <div class="container mt-5">
        <div class="col-lg-8 justify-content-center">
            <div style="max-height: 500px; overflow:hidden;">
                <img src="{{ asset("storage/$charity->foto") }}" class="img-fluid rounded img-thumbnail shadow" alt="{{ $charity->title }}">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg">
                <div class="card text-center text-dark my-4">
                    <div class="card-header">
                      ABOUT CHARITY
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $charity->title }}</h5>
                        <div class="progress mt-4">
                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{ $charity->dana_terkumpul/$charity->max_dana*100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $charity->dana_terkumpul/$charity->max_dana*100 }}%"></div>
                        </div>
                        <p class="card-text mt-2 fs-6">Rp. {{ number_format($charity->dana_terkumpul,0,'',".") }} terkumpul dari Rp. {{ number_format($charity->max_dana,0,'',".") }}</p>
                        <div class="text-start mt-5 mb-4">
                            <h6 class="fs-6">Cerita</h6>
                            <p>{!! $charity->cerita !!}</p>
                        </div>
                        <ul class="d-flex justify-content-end list-unstyled mt-auto mb-0">
                          <li class="d-flex align-items-center me-3 ">
                            <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                            <small>{{ $charity->daerah }}</small>
                          </li>
                          <li class="d-flex align-items-center">
                            <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                            <small>{{ date('j', (strtotime($charity->exp_date))-time()) }} hari Lagi</small>
                          </li>
                        </ul>
                      </div>
                    <div class="card-footer text-secondary">
                        Created at {{ $charity->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="card text-dark my-4">
                    <h5 class="card-header bg-success text-white">Donatur</h5>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($donaturs as $donatur)
                            @if ($donatur->status == "PAID")
                            <div class="col-lg-12 mt-3">
                                <div class="card text-start shadow">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $donatur->nama }}</h5>
                                        <p class="card-text text-secondary">Berdonasi Rp. {{ number_format($donatur->donasi,0,'',".") }}</p>
                                        <p class="card-text">{{ $donatur->cerita }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
      
@endsection