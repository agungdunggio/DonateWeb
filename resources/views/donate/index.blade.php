@extends('layouts.main')
@section('content')
<section>
    <div class="container mt-5">
        <h2 class="pb-2 border-bottom">All Charity</h2>
        <div class="row justify-content-center">
          @foreach ($charities as $charity)
          @if ((strtotime($charity->exp_date)) >= time())
          <div class="card m-3 col-lg-6 text-dark text-start px-0" style="max-width: 540px;">
            <a href="/donate/{{ $charity->slug }}" class="text-decoration-none px-0 text-dark">
              <div class="row g-0">
                <div class="col-md-4" style="max-height:400px; overflow:hidden;">
                  <img src="{{ asset("storage/$charity->foto") }}" class="img-fluid rounded-start" alt="{{ $charity->title }}">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ $charity->title }}</h5>
                    <div class="progress mt-4">
                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{ $charity->dana_terkumpul/$charity->max_dana*100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $charity->dana_terkumpul/$charity->max_dana*100 }}%"></div>
                    </div>
                    <p class="card-text mt-2 fs-6">Rp. {{ number_format($charity->dana_terkumpul,0,'',".") }} terkumpul dari Rp. {{ number_format($charity->max_dana,0,'',".") }}</p>
                    <p class="card-text d-flex align-items-end"><small class="text-muted">Created at {{ $charity->created_at->diffForHumans() }}</small></p>
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
                </div>
              </div>
            </a>
          </div>
          @endif
          @endforeach
           
        </div>
    </div>
</section>

@endsection