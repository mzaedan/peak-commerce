<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;



class CheckoutController extends Controller
{
    public function proses(Request $request)
    {
        //Save user Data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //proses checkout
        $code = 'PEAK-' .mt_rand(0000,9999);
        $cart = Cart::with(['product', 'user'])
            ->where('users_id', Auth::user()->id)
            ->get();

        //Transaction Create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($cart as $cartItem) { // Changed $carts to $cart
            $TRX = 'TRX-' . mt_rand(0000, 9999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cartItem->product->id,
                'price' => $cartItem->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code' => $TRX
            ]);
        }

        //Delete Cart Data
        Cart::where('users_id', Auth::user()->id)
            ->delete();
            

        //konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        //Buat array untuk dikirim ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtWeb' => [],
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function callback(Request $request)
    {

    }
}
