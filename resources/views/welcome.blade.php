@extends('layouts.main')
@section('content')
<section>
    <div class="container col-xxl-10 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6 ">
                <img src="/img/avel-chuklanov-9cx4-QowgLc-unsplash.jpg" class="d-block mx-lg-auto img-fluid rounded" alt="donasi" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6 text-start">
                <h1 class="display-5 fw-bold lh-1 mb-3">Welcome to Website Charity</h1>
                <p class="lead mt-5">A website which raises money for natural disasters or for people who needed</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="#charity">
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Donate</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>   
<section id="charity">
<div class="container px-4 py-5 mt-5" id="custom-cards">
    <h2 class="pb-2 border-bottom">Charity</h2>
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5 justify-content-center">
      @foreach ($charities as $charity)
      @if ((strtotime($charity->exp_date)) >= time())
      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('{{ asset("storage/$charity->foto") }}');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
            <a href="/donate/{{ $charity->slug }}" class="text-decoration-none text-white">
              <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">{{ $charity->title }}</h3>
            </a>
              <ul class="d-flex justify-content-end list-unstyled mt-auto">
                <li class="d-flex align-items-center me-3">
                  <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                  <small>{{ $charity->daerah }}</small>
                </li>
                <li class="d-flex align-items-center">
                  <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                  <small>{{ date('j', (strtotime($charity->exp_date))-time()) }}d</small>
                </li>
              </ul>
            </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
    <a href="/donate">
      <button type="button" class="btn btn-outline-secondary btn-lg px-4">See More</button>
    </a>
  </div>
</section>
@endsection