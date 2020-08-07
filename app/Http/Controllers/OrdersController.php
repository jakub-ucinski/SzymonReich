<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    // public function create(Request $request)
    public function create()
    {
        // $data = $request->validate([
        //     'price' => ['integer']
        // ]);

        // return view('order.create', ['price' => $data['price']]);
        return view('order.create');

    }

    public function store(Request $request)
    {
    
        $data = $request->validate([
            'name' => ['required','max:255'],
            'surname' => ['required','max:255'],
            'email' => ['required','email', 'max:400'],
            'road' => ['required','max:255'],
            'houseno' => ['required','max:255', 'integer'],
            'flatno' => ['max:255'],
            'postcode' => ['required','max:255'],
            'city' => ['required','max:255'],
            'country' => ['max:255'],

        ]);
        // dd($data);
        $session_id = $request->session()->getId();
        // dd($request->session()->getId());
        $order = Order::create([
            'session_id' => $request->session()->getId(),
            'status' => 'not processed',
            'price' => '11111',
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'road' => $data['road'],
            'houseno' => $data['houseno'],
            'flatno' => $data['flatno'],
            'postcode' => $data['postcode'],
            'city' => $data['city'],
            'country' => $data['country']
            ]);

            $merchantId = 119225;
            $crc = "9337252a24a3f81d";
            $amount = 11111;
            $currency = 'PLN';
            $description = 'Test Order';
            // dd($description);
            $email = 'john.doe@example.com';
            $country = 'PL';
            $languaage = 'pl';
            $urlReturn = 'https://szymonreich.pl/order/create';
            $urlStatus = 'https://szymonreich.pl/order/verify';

            $sign = hash('sha384', json_encode(
                ["sessionId" => $session_id, 
                "merchantId" => $merchantId, 
                "amount" => $amount, 
                "currency" => $currency, 
                "crc" => $crc], 
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));



            $p24variables = http_build_query([
                'merchantId' => $merchantId,
                'posId' => $merchantId,
                'crc' => $crc,
                'sessionId' => $session_id,
                'amount' => $amount,
                'currency' => $currency,
                'description' => $description,
                'email' => $email,
                'country' => $country,
                'language' => $languaage,
                'urlReturn' => $urlReturn,
                'urlStatus'=> $urlStatus,
                'sign' => $sign
                ]);   
            
            $basicauth = base64_encode("119225".":"."5b819d528ebf3d88faf0fbb1390add84");

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://sandbox.przelewy24.pl/api/v1/transaction/register?$p24variables",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic $basicauth",
                "Content-Type: application/json",
                "Postman-Token: ff930d0f-66a2-4477-b9e5-0297f12ef39c",
                "cache-control: no-cache"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            // dd($response);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            } else {
            echo $response;
            }
            
            $response=json_decode($response);
            $token = $response->data->token;
            // dd()
            return redirect("https://sandbox.przelewy24.pl/trnRequest/$token");

    }


    public function verify(Request $request){

        $data = $request->validate([
            'merchantId' => ['integer', Rule::in([119225]), 'required'],
            'posId' => ['integer', Rule::in([119225]), 'required'],
            'sessionId' => 'required',
            'amount' => ['required', 'integer'],
            'originAmount' => '',
            'currency' => '',
            'orderId' => '',
            'methodId' => '',
            'statement' => '',
            'sign' => ''
        ]);


        $merchantId = 119225;
        $posId = 119225;

        $crc = "9337252a24a3f81d";
        $currency = 'PLN';

        
        $order = Order::where([
            ['session_id','=', $data['sessionId']],
            ['price', '=', $data['amount']],
            ['status', '=', 'not processed']
            ])->first();
         
        if (!isset($order)) {
            return 0;
        }
        
        $hashCalculated = hash('sha384', json_encode(
            [
                "merchantId" => $merchantId,    
                "posId" => $posId,
                "sessionId" => $order->session_id, 
                "amount" => $order->price,
                "originAmount" => $data['originAmount'],
                "currency" => $currency,
                "orderId" => $data['orderId'],
                "methodId" => $data['methodId'],
                "statement" => $data['statement'],
                "crc" => $crc
            ], 
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));



        if ($data['sign'] == $hashCalculated) {
            $order->update([
                'status'=>'processed'
            ]);
        
        

            $session_id = $order->session_id;
            $orderId = $data['orderId'];
            $amount = $order->price;


            $sign = hash('sha384', json_encode(
                ["sessionId" => $session_id, 
                "orderId" => $orderId, 
                "amount" => $amount, 
                "currency" => $currency, 
                "crc" => $crc], 
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));


            $p24variables = http_build_query([
                'merchantId' => $merchantId,
                'posId' => $merchantId,
                'crc' => $crc,
                'sessionId' => $session_id,
                'amount' => $amount,
                'currency' => $currency,
                'orderId' => $data['orderId'],
                'sign' => $sign
            ]);   

            $basicauth = base64_encode("119225".":"."5b819d528ebf3d88faf0fbb1390add84");


            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://sandbox.przelewy24.pl/api/v1/transaction/verify?$p24variables",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",

            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic $basicauth",
                "Content-Type: application/json",
                "Postman-Token: cec960ea-488f-42d1-b2db-5ffb64443dda",
                "cache-control: no-cache"
            ),
            ));

            

            $response = curl_exec($curl);
            $err = curl_error($curl);

            

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $response=json_decode($response);
                $order->update([
                    'status'=>$response->data->status
                ]);
            }
        }else{
            $order->delete();
        }



        return 1;
        // {
        //     "merchantId": 11111,
        //     "posId": 11111,
        //     "sessionId": "test7",
        //     "amount": 1,
        //     "originAmount": 1,
        //     "currency": "PLN",
        //     "orderId": 0,
        //     "methodId": 0,
        //     "statement": "string",
        //     "sign": "596af9bc39271b4cfdab45937"
        // }
    }

}
