<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
       .button {
        padding: 10px;
        font-size: 15px;
        outline: none;
        border: 2px solid black;
        background-color: white;
        color: white;
        position: relative;
        letter-spacing: 1px;
        }

        .button::before {
        content: 'Cara Pembayaran';
        /*Button's value/text-content */
        position: absolute;
        top: -14%;
        left: 7%;
        background-color: black;
        width: 100%;
        height: 100%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.15s ease-in-out;
        font-weight: bold;
        }

        .button:hover::before {
        top: 0;
        left: 0;
        }
        .btnn {
        color: #ff2020;
        padding: 13px 20px;
        border: 2px solid #ff2020;
        font-size: 17px;
        transition: 0.3s;
        border-radius: 10px;
        font-family: Arial;
        font-weight: 600;
        }

        .btnn:hover {
        transition: 0.3s;
        background-color: #ff2020;
        margin-top: -20px;
        color: #fff;
        animation-name: button_animation;
        animation-duration: 3s;
        animation-iteration-count: infinite;
        }

        .btnn:active {
        transform: scale(0.97);
        }

        @keyframes button_animation {
        0% {
        background-color: #ff2020;
        }

        25% {
        background-color: #000000;
        }

        50% {
        background-color: #ff2020;
        }

        75% {
        background-color: #000000;
        }

        100% {
        background-color: #ff2020;
        }
        }
        .modal-alert .modal-dialog {
            width: 380px;
        }   
    </style>
    <link rel="shortcut icon" href="/img/coin.png">
  </head>
  <body style="background-image: url(/img/claudia-raya-1VOx-Ffbd9w-unsplash.jpg);background-position:background-attachment: fixed;background-position: center;background-repeat: no-repeat;background-size: cover;">
    <div class="container pt-4 pb-4">
        <div class="row">
            <div class="col-lg-8 col-12 m-auto">
                <div class="px-lg-5 py-lg-4 p-3 card bg-light">
                    <div class="merchant__logo text-end">
                        <img src="{{ $img_icon }}" style="height:100%;max-height:30px">
                    </div>
                    <div class="text-secondary mb-3 text-center">
                        <h5>Pembayaran dengan <b>{{ $detail->payment_name }}</b></h5>
                        Pastikan anda melakukan pembayaran sebelum melewati batas
                        <br>
                        pembayaran dan dengan nominal yang tepat
                    </div>
                    <div class="row">
                        <div class="col-lg-4 card me-auto">
                            <div class="mb-3">
                                <div class="payment__infoTitle">
                                    No. Invoice
                                </div>
                                <div class="payment__infoSubtitle">
                                    {{ $detail->merchant_ref }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="payment__infoTitle">
                                    Nama Donatur
                                </div>
                                <div class="payment__infoSubtitle">
                                    {{ $detail->customer_name }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="payment__infoTitle">
                                    Rincian Transaksi
                                </div>
                                <div class="payment__infoSubtitle">
                                    <div class="row mb-1">
                                        <div class="col-8">
                                            <a href="#!" target="_blank" class="text-decoration-none text-success">Donasi</a>
                                        </div>
                                        <div class="col-4 text-end font-weight-bold text-success" >
                                            {{ number_format($detail->amount,0,'',".") }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="payment__infoTitle">
                                    Status
                                </div>
                                <div class="payment__infoSubtitle">
                                    @if ($detail->status == "UNPAID")
                                    <div class="text-uppercase fw-semibold text-danger">
                                        {{ $detail->status }}
                                    </div>
                                    @else
                                    <div class="text-uppercase fw-semibold text-success">
                                        {{ $detail->status }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 payment-info" style="height: fit-content;">
                            <div class="mb-3">
                                <div class="payment__infoTitle">
                                    Nomor Referensi
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control border-right-0" id="refen" i="" data-toggle="tooltip" title="" value="{{ $detail->reference }}" aria-describedby="inputGroupPrepend" disabled="" readonly="" style="background: #fff" data-original-title="Berhasil menyalin teks">
                                    {{-- <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-left-0">
                                        <i class="zmdi-hc-lg icon-copy" data-toggle="tooltip" data-placement="top" title="" onclick="copy('{{ $detail->reference }}')" data-original-title="Salin"></i>
                                        </span>
                                    </div> --}}
                                  </div>
                                <div class="mb-3">
                                    <div class="payment__infoTitle">
                                        Kode Bayar/Nomor VA
                                    </div>
                                    <div class="payment__infoSubtitle">
                                        <div class="input-group pt-1">
                                            <input type="text" class="form-control border-right-0" id="noVA" i="" data-toggle="tooltip" title="" value="{{ $detail->pay_code }}" aria-describedby="inputGroupPrepend" disabled="" readonly="" style="background: #fff" data-original-title="Berhasil menyalin teks">
                                            {{-- <div class="input-group-prepend">
                                                <span class="input-group-text bg-white border-left-0">
                                                <i class="zmdi zmdi-copy zmdi-hc-lg icon-copy" data-toggle="tooltip" data-placement="top" title="" onclick="copy('{{ $detail->pay_code }}')" data-original-title="Salin"></i>
                                                </span>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="payment__infoTitle">
                                        Jumlah Tagihan
                                    </div>
                                    <div class="payment__infoSubtitle">
                                        <div class="input-group pt-1">
                                            <input type="text" class="form-control border-right-0" id="jumTagihan" i="" data-toggle="tooltip" title="" value="Rp {{ number_format($detail->amount,0,'','.')}}" aria-describedby="inputGroupPrepend" disabled="" readonly="" style="background: #fff" data-original-title="Berhasil menyalin teks">
                    
                                            {{-- <div class="input-group-prepend">
                                                <span class="input-group-text bg-white border-left-0">
                                                <i class="zmdi zmdi-copy zmdi-hc-lg icon-copy" data-toggle="tooltip" data-placement="top" title="" onclick="copy('{{ number_format($detail->amount) }}')" data-original-title="Salin"></i>
                                                </span>
                                            </div> --}}
                    
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="mb-3">
                                    <div class="payment__infoTitle">
                                        Batas Pembayaran
                                    </div>
                                    <div class="payment__expired">
                                        {{ date("l F Y 8+H:i", $detail->expired_time) }}
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="pb-2 mt-4">
                                <button class="btnn" data-bs-toggle="modal" data-bs-target="#kembali">Kembali</button>
                            </div>
                            <div class="ms-auto pb-2 mt-4">
                                <button class="button" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"> Cara Pembayaran
                                </button>
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>    
        </div>
    </div>

    <!-- Modal -->
    <div class="modal modal-alert fade" tabindex="-1" role="dialog" id="kembali">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content rounded-3 shadow">
            <div class="modal-body p-4 text-center">
              <h5 class="mb-0">Sudah membayar?</h5>
              <p class="mb-0">Jika ingin kembali harap membayar terlebih dahulu.</p>
            </div>
            <div class="modal-footer flex-nowrap p-0">
              <a href="/donate" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end"><strong>Ya, Saya Sudah membayar</strong></a>
              <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal">Belum, Saya belum membayar</button>
            </div>
          </div>
        </div>
      </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Petunjuk Pembayaran {{ $detail->payment_name }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @foreach ($detail->instructions as $instruction)
            <div class="d-grid gap-2 mt-3">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#jijhjh{{ $loop->iteration }}" aria-expanded="false" aria-controls="jijhjh{{ $loop->iteration }}">
                    Pembayaran Menggunakan {{ $instruction->title }}
                </button>
            </div>
            <div class="collapse" id="jijhjh{{ $loop->iteration }}">
                <div class="card card-body">
                  <ol>
                    @foreach ($instruction->steps as $step)
                        <li>{!! $step !!}</li>
                    @endforeach
                  </ol>
                </div>
            </div>
            @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    {{-- <script>
    function copy(text) {
            navigator.clipboard.writeText(text).then(function() {
                toastr.success('Teks berhasil disalin');
            }, function(err) {
                toastr.error('Teks gagal disalin');
            });
        }
    </script> --}}
  </body>
</html>