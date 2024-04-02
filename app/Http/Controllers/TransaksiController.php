<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donatur;

class TransaksiController extends Controller
{
    public function show($reference)
    {
        $tripay = new TransaksiTripay();
        $detail = $tripay->detailTransaction($reference);
        $chanels = $tripay->getPaymentChannels();
        $img = collect($chanels)->where('code', $detail->payment_method)->first();
        return view('transaksi.index', [
            'detail' => $detail,
            'img_icon' => $img->icon_url,
        ]);
    }

    public function store(Request $request)
    {
        $validDataDonasi = $request->validate([
            'donasi' => 'numeric|min:10000'
        ]);
        $validDataDonasi = implode($validDataDonasi);
        $nama = $request->nama;
        $method = $request->method;
        $tripay = new TransaksiTripay();
        $transaction = $tripay->requestTransaction($validDataDonasi, $method, $nama);

        Donatur::create([
            'charity_id' => $request->id,
            'nama' => $nama,
            'donasi' => $validDataDonasi,
            'cerita' => $request->cerita,
            'status' => $transaction->status,
            'invoice' => $transaction->reference
        ]);

        return redirect()->route('transaksi.show', [
            'reference' => $transaction->reference
        ]);
    }
}
