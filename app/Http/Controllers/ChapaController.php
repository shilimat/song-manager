<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use Chapa\Chapa\Facades\Chapa as Chapa;

class ChapaController extends Controller
{
    /**
     * Initialize Rave payment process
     * @return void
     */
    protected $reference;
    private $songId;

    public function __construct(){
        $this->reference = Chapa::generateReference();

    }
    public function initialize(Request $request)
    {
        //This generates a payment reference
        $reference = $this->reference;

        $user = auth()->user();
        $user->is_subscribed = false; // Assuming you're setting it to false when starting a new payment
        $user->subscription_expires_at = null; // Reset the expiry date
        // $this->songId = $request->song_id;
        // $user->save(); 
        

        // Enter the details of the payment
        $data = [
            
            'amount' => $request->amount,
            'email' => $request->email,
            'tx_ref' => $reference,
            'currency' => "ETB",
            'callback_url' => route('callback',[$reference]),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            "customization" => [
                "title" => 'Dummy Laravel',
                "description" => "I amma test this"
            ]
        ];
        

        $payment = Chapa::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        dd($data);


        return redirect($payment['data']['checkout_url']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback($reference)
    {
        
        $data = Chapa::verifyTransaction($reference);

        //if payment is successful
        if ($data['status'] ==  'success') {
        

        redirect()->route('song.show')->with('success', 'Payment successful');
        }

        else{
            //oopsie something ain't right.
        }


    }

    public function showPaymentForm()
    {
        return view('payment');
    }
}

