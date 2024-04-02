@extends('dashboard.layouts.main')

@section('konten')
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Charity</h1>
  </div>
  @if (session('success'))
    <div class="col-lg-8">
        <div class="alert alert-success alert-dismissible fade show" role="alert">    
            {{ session('success') }}    
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
  <a href="/dashboard/create">
    <button type="button" class="btn btn-primary my-3">Tambah Charity</button>
  </a>
  <div class="d-flex justify-content-start">
    {{ $charities->links() }}
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Judul</th>
          <th scope="col">Daerah</th>
          <th scope="col">Batas Donasi</th>
          <th scope="col">Dana terkumpul</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($charities as $charity)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $charity->title }}</td>
            <td>{{ $charity->daerah }}</td>
            <td>{{ date('l, j F Y',strtotime($charity->exp_date)) }}</td>
            <td>Rp. {{ number_format($charity->dana_terkumpul,0,'',".") }}</td>
            <td>
                <a href="/dashboard/{{ $charity->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                <a href="/dashboard/{{ $charity->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <form action="/dashboard/{{ $charity->slug }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="badge bg-danger border-0" onclick="return confirm('Are you Sure?')"><span data-feather="x-circle"></span></button>
                </form>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection