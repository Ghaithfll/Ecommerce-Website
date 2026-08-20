<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\postRequestValidator;
use Error;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function Illuminate\Log\log;

class ProductController extends Controller
{

    public function home()
    {
        $products = Product::all();

        return view('home', ['products' => $products]);
    }

    public function create()
    {

        return view('product.create');
    }


    public function store(postRequestValidator $request)
    {

        // authorization
        // validate data  Done by the header
        // add product
        $imgPath = null;
        if ($request->hasFile('image')) { //  there was a file submitted that bears the name 'image'
            $imgPath = $request->file('image') // Give me the uploaded file named image that was sent with the request (returns 'UploadedFile' obj not the img itself)
                ->store('photos', 'public');
        }

        /* UploadedFile obj is a built-in class contains methods like:
            - getClientOriginalName
            - getSize()
            - extension
            - store('photos','public') "Please save yourself inside the photos directory on the public disk."

                Laravel then:

                Generates a unique filename.
                Saves the file.
                Returns the relative PATH.
            */
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imgPath,
            'price' => $request->price,
            'currency' => $request->currency,
        ]);

        // redirect back to home page
        return redirect()->route('home'); // u may want to send some data
    }

    /**
     * Display the specified resource.
     */
    public function details(Product $product)
    {
        return view('product.details', ['product' => $product]);
    }
    public function checkout(Product $product)
    {
       
        $user = User::find(1);
        return view('checkout', ['product' => $product, 'user' => $user]);
    }


    public function checkout_submit(product $product)
    {
        try {

            $responseData  =   requestHyperpayCheckout($product); // this is copied from the hyperpay request()



            //session()->put('order' , $order);
            session()->put('order', [
                'amount' => $product->price,
                'user_id' => 1,
                'product_id' => $product->id,
                'currency' => $product->currency,
                'status' => 'pending',
            ]);
            //dd($order);


            // $order = Order::create([
            //     'amount' => $product->price,
            //     'user_id' => 1,  //               user id is hardcoded
            //     'product_id' => $product->id,
            //     'currency' => $product->currency,
            //     'status' => 'pending'
            // ]);
            //dd($order);
            $responseData = json_decode($responseData);
            if ($responseData != null) {


                return redirect()->route('payment', [

                    'integrity' => $responseData->integrity, // these 2 are NOT sent by the url (payment/{order}) 
                    'checkoutId' => $responseData->id, // so u should request them from the other function (payment_get)
                ]);
            }
            throw new Exception("Null Response");
        } catch (Exception $err) {
            Log::error("checkout Api failed", ['error' => $err->getMessage()]);
            return back()->withErrors(['error' => 'Prepare The Checkout Failed!, try again']);
        }

        // dd($order);


    }
    public function payment_get(Request $request)
    {

        $checkoutId = $request->checkoutId;
        $integrity = $request->integrity;
        // dd("we r here now, PAYMENT GET");
        return view('payment', ['checkoutId' => $checkoutId, 'integrity' => $integrity]);
    }

    public function payment_result(Request $request)
    {

        try {
        
            $checkoutId = $request['checkoutId'];

            // request hyperpay api to get the result
            //dd("checkoutID is : $request->checkoutId");
//dd("here");
            
            $responseData = json_decode(requestHyperpayResult($checkoutId));

            // dd($responseData);

            if ($responseData == null) {
                //dd("Null Api response while requesting the payment result");
                throw new Exception("Null Api response while requesting the payment result");
            }

            // verify the currency,amount,ID

            $paymentStatus = ExtractPatmentStatus($responseData->result->code);
            // update the order status
            //dd('payment status: success','1');
            //dd("Before redirecting, $paymentStatus");
            
            //dd(session()->all());
            $order = session()->get('order');
            //dd($order,session()->get('order'),'2');
            $order = Order::findorFail($order['id']);
            //dd($order);
            $order->status = $paymentStatus;
            //dd('order status success');
            //  dd("Unable to store the order",$responseData );
            $order->payment_id = $responseData->id;

            $order->save(); // should here store the order
            session()->forget('order');
            
            // $orders = Order::all();

            //  dd($order);
            // $ord = Order::create([
            //     'amount' => $order['amount'],
            //     'user_id' => $order['user_id'],
            //     'product_id' => $order['product_id'],
            //     'currency' => $order['currency'],
            //     'status' => $order['status'],
            //     'payment_id' => $order['payment_id']
            // ]);


            return redirect()->route('orders');
        } catch (Exception $err) {


            Log::error('Payment Api Failed', ['error' => $err->getMessage()]);
            return back()->withErrors(["error" => "we couldnt process your payment, please try again"]);
        }
    }
    public function TestPivot()
    {

            $products = Product::all();
            $order = Order::find(4);
            foreach ($products as $product) {
                
            
           
            AddProductToPivot($order, $product);
            print "This si";
    }}


    

    }

function requestHyperpayCheckout($total)
{

    $url = "https://eu-test.oppwa.com/v1/checkouts";
    /*
    //dd(number_format($product->price,2));
    $data =
        "entityId=8a8294174d0595bb014d05d829cb01cd" . // ur merchant id
        "&amount=" . number_format($product->price, 2) .        //           the amount should be paid
        "&currency=EUR" .
        "&paymentType=DB" . //      debit pay: 'take the money from the customer'
        "&integrity=true"; //      "Perform integrity checks."


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization:Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8bk49a3NvQ3ROZjJacW9nOWYla0o='
    ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);                  // now execute the cURL

    if (curl_errno($ch)) {
        return curl_error($ch);
    }
    curl_close($ch);
    */

    $responseData = Http::asForm()->withHeaders([
        'Authorization' => "Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8bk49a3NvQ3ROZjJacW9nOWYla0o="
    ])->post($url, [
        'entityId' => '8a8294174d0595bb014d05d829cb01cd',
        'amount'   => number_format($total, 2),// total
        'currency' => 'EUR',
        'paymentType' => 'DB',
        'integrity' => true

    ]);

    if ($responseData->failed()) {
        $responseData->throw();
    }


    return $responseData;
}

function requestHyperpayResult($checkoutId)
{
    $url = "https://eu-test.oppwa.com/v1/checkouts/$checkoutId/payment";
    // $url .= "?entityId=8a8294174d0595bb014d05d829cb01cd";
    /*
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization:Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8bk49a3NvQ3ROZjJacW9nOWYla0o='
    ));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if (curl_errno($ch)) {
        return curl_error($ch);
    }
    curl_close($ch);*/
    //****************************** */
    $responseData = Http::withToken('OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8bk49a3NvQ3ROZjJacW9nOWYla0o=')
        ->withQueryParameters(['entityId' => '8a8294174d0595bb014d05d829cb01cd'])
        ->get($url);


    if ($responseData->failed()) {
      //  dd($responseData->body(),'why is that?!');
        $responseData->throw();
    }
    return $responseData->body();
}

function ExtractPatmentStatus($statusCode)
{


    $successfulPattern = '/^(000.000.|000.100.1|000.[36]|000.400.[1][12]0)/';
    $pendingPattern = '/^(000\.200)/';
    $reviewPattern = '/^(000.400.0[^3]|000.400.100)/';
    if (preg_match($successfulPattern, $statusCode)) {
        return 'Paid';
    } elseif (preg_match($pendingPattern, $statusCode)) {
        return 'Pending';
    } elseif (preg_match($reviewPattern, $statusCode)) {
        return 'Review';
    } else {
        return 'Failed';
    }
}


function AddProductToPivot($order, $product)
{

    $order->products()->attach($product->id, [
        'quantity' => '2',
        'unit_price' => $product->price,
        'total' => '123456'
    ]);
    //dd($newPivotRecord);
}
