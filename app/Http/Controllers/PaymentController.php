<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Booking;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Transaction;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$clientKey = config('midtrans.clientKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        \Log::info('💡 Konfigurasi Midtrans:', [
            'serverKey' => config('midtrans.serverKey'),
            'isProduction' => config('midtrans.isProduction')
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => 50000,
            ],
            'customer_details' => [
                'first_name' => $request->nama,
                'phone' => $request->nomor_whatsapp,
            ],
            'callbacks' => [
                'finish' => ''
            ]
        ];

        Log::info('🚀 Mengambil Snap Token dengan data:', $params);

        try {
            $snapToken = Snap::getSnapToken($params);
            Log::info('✅ Snap Token berhasil didapat:', ['token' => $snapToken]);

            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('❌ Gagal mendapatkan Snap Token:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal mendapatkan token'], 500);
        }
    }

   public function afterPayment(Request $request)
    {
        Log::info('🔁 afterPayment dipanggil dengan data:', $request->all());
        Log::info('🔐 ID user login saat afterPayment:', ['user_id' => auth()->id()]);
        try {
            $status = Transaction::status($request->order_id);
            Log::info('📦 Status transaksi dari Midtrans:', (array) $status);
            Log::info('🧾 Booking pakai user_id:', ['user_id_dari_request' => $request->user_id]);
            if (in_array($status->transaction_status, ['settlement', 'capture'])) {
                Booking::create([
                    'user_id' => $request->user_id,     
                    'layanan_id' => $request->layanan_id,
                    'nomor_whatsapp' => $request->nomor_whatsapp,
                    'nama' => $request->nama,
                    'tanggal' => $request->tanggal,
                    'jam' => $request->jam,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'transaction_id' => $request->transaction_id,
                    'order_id' => $request->order_id,
                    'gross_amount' => $request->gross_amount,
                ]);

                Log::info('✅ Booking berhasil disimpan ke database.');
                    $this->sendWA($request->nomor_whatsapp, "Halo {$request->nama}, reservasi kamu untuk tanggal {$request->tanggal} jam {$request->jam} berhasil. Kami tunggu ya di salon! 💇‍♀️");
                return response()->json(['success' => true]);
            } else {
                Log::warning('⚠️ Transaksi belum berhasil. Status: ' . $status->transaction_status);
                return response()->json(['success' => false, 'message' => 'Transaksi belum berhasil.']);
            }
        } catch (\Exception $e) {
            Log::error('❌ Gagal memproses afterPayment:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    
    public function sendWA($nomor_whatsapp, $message)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $nomor_whatsapp,
                'message' => $message,
            ]);

            \Log::info('📤 WA berhasil dikirim:', ['response' => $response->json()]);
            return $response->json();
        } catch (\Exception $e) {
            \Log::error('❌ Gagal kirim WA:', ['error' => $e->getMessage()]);
            return null;
        }
    }
}
