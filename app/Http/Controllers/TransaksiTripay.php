<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use Illuminate\Http\Request;

class TransaksiTripay extends Controller
{
    public function getPaymentChannels()
    {


        $apiKey = env('TRIPAY_API_KEY');


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;
        return $response ? $response : $error;
    }

    public function requestTransaction($donasi, $method, $nama)
    {
        $apiKey       = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_KODE');
        $merchantRef  = 'PX-' . time();
        $amount       = $donasi;
        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $nama,
            'customer_email' => 'abc@example.com',
            'order_items'    => [
                [
                    'name'        => 'Donasi',
                    'price'       => $amount,
                    'quantity'    => 1,
                ]
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;

        return $response ? $response : $error;
    }

    public function detailTransaction($reference)
    {

        $apiKey = env('TRIPAY_API_KEY');

        $payload = ['reference'    => $reference];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;
        return $response ?: $error;
    }




    // public function opent()
    // {
    //     $merchantRef = 'DONASIOPENTRX'; //your merchant reference
    //     $init = $this->tripay->initTransaction($merchantRef);

    //     $init->setMethod('BRIVAOP'); // for open payment

    //     $transaction = $init->openTransaction(); // define your transaction type, for close transaction use `openTransaction()`
    //     $transaction->setPayload([
    //         'method'            => $init->getMethod(),
    //         'merchant_ref'      => $merchantRef,
    //         'customer_name'     => 'Nama Pelanggan',
    //         'signature'         => $init->createSignature()
    //     ]); // set your payload, with more examples https://tripay.co.id/developer
    // }
    // public function process(Request $request)
    // {
    //     $nama = $request->nama;
    //     $donasi = $request->donasi;
    //     $doa = $request->cerita;

    //     $transaksi = new Donatur;
    //     $transaksi->nama = $nama;
    //     $transaksi->donasi = $donasi;
    //     $transaksi->cerita = $doa;
    //     $transaksi->invoice = "donasi_" . rand(20, 200);
    //     $transaksi->save();

    //     $merchantRef = $transaksi->invoice; //your merchant reference
    //     $init = $this->tripay->initTransaction($merchantRef);

    //     $init->setAmount($transaksi->donasi); // for close payment
    //     // $init->setMethod('BRIVAOP'); // for open payment

    //     $signature = $init->createSignature();
    //     $transaction = $init->closeTransaction(); // define your transaction type, for close transaction use `closeTransaction()`
    //     $result = $transaction->setPayload([
    //         'method'            => 'BRIVA', // IMPORTANT, dont fill by `getMethod()`!, for more code method you can check here https://tripay.co.id/developer
    //         'merchant_ref'      => $merchantRef,
    //         'amount'            => $init->getAmount(),
    //         'customer_name'     => $transaksi->nama,
    //         'customer_email'    => ' ',
    //         'customer_phone'    => ' ',
    //         'order_items'       => [
    //             [
    //                 'sku'       => 'Donasi',
    //                 'name'      => 'donasi sosial',
    //                 'price'     => $init->getAmount(),
    //                 'quantity'  => 1
    //             ]
    //         ],
    //         // 'callback_url'      => 'https://domainanda.com/donate/api/callback',
    //         // 'return_url'        => 'https://domainanda.com/donate',
    //         'expired_time'      => (time() + (24 * 60 * 60)), // 24 jam
    //         'signature'         => $init->createSignature()
    //     ]); // set your payload, with more examples https://tripay.co.id/developer

    //     $getPayload = $transaction->getPayload();

    //     return response()->json($getPayload->getData());
    // }

    // public function callback(Request $request)
    // {
    //     $init = $this->tripay->initCallback();
    //     $result = $init->getJson(); // get json callback

    //     if ($request->header("X-Callback-Event") != "payment_status") {
    //         die("akses dilarang");
    //     }

    //     $transaksi = Donatur::where('invoice', $result->merchant_ref)->first();

    //     if ($transaksi) {
    //         if ($result->status == "PAID") {
    //             $transaksi->status = "PAID";
    //         }

    //         $transaksi->status = $result->status;

    //         $transaksi->update();
    //         return response()->json($transaksi);
    //     }

    //     return response()->json(['message' => "transaksi tidak ada"]);
    // }
}
