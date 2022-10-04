<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\ProductVariation;
use Illuminate\Http\Request;
use App\Mail\PaymentVerified;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    public function webtruck()
    {
        $orders = Order::where('status', 'success')->get();
        foreach ($orders as $order) {
            $dimensions = ["height" => (float)80, "length" => (float)35, "width" => (float)25];
            $weight = (float)0;

            foreach ($order->cart_products as $productInCart) {
                if ($productInCart->product_variant == 'product') {
                    $productToUpdate = Product::findOrFail($productInCart->product_variant_id);

                    $productToUpdate->update([
                        'stock' => $productToUpdate['stock'] - 1,
                    ]);

                    if (preg_match("/Bluza /mi", $productToUpdate->title) == 1) {
                        $dimensions = ["height" => (float)190, "length" => (float)35, "width" => (float)25];
                        $weight = $weight + (float)1000;
                    }
                    if (preg_match("/Płyta  /mi", $productToUpdate->title) == 1) {
                        $weight = $weight + (float)300;
                    }
                    if (preg_match("/Planner /mi", $productToUpdate->title) == 1) {
                        $weight = $weight + (float)300;
                    }
                } else if ($productInCart->product_variant == 'variant') {

                    $productToUpdate = ProductVariation::findOrFail($productInCart->product_variant_id);

                    $productToUpdate->update([
                        'stock' => $productToUpdate['stock'] - 1,
                    ]);

                    if (preg_match("/Bluza /mi", $productToUpdate->title) == 1) {
                        $dimensions = ["height" => (float)190, "length" => (float)35, "width" => (float)25];
                        $weight = $weight + (float)1000;
                    }
                    if (preg_match("/Płyta  /mi", $productToUpdate->title) == 1) {
                        $weight = $weight + (float)300;
                    }
                    if (preg_match("/Planner /mi", $productToUpdate->title) == 1) {
                        $weight = $weight + (float)300;
                    }
                }
            }

            $addressReceiver = [
                "street" => $order->road,
                "building_number" => (string)$order->houseno . '/' . (string)$order->flatno,
                "city" => "$order->city",
                "post_code" => "$order->postcode",
                "country_code" => "PL"
            ];
            $receiver = ["email" => $order->email,
                "address" => $addressReceiver,
                "phone" => $order->phone,
                "first_name" => $order->name,
                "last_name" => $order->surname
            ];
            $parcels = [
                'dimensions' => $dimensions,
                'weight' => [
                    'amount' => $weight,
                    'unit' => 'g'
                    ]
                ];
            $shipment = json_encode([
                "receiver" => $receiver,
                "parcels" => $parcels,
                "service" => "inpost_courier_standard",
                "reference" => $order->id
            ]);

            $curl = curl_init();
            $bearerToken = config('inpost.bearerToken');
            $organizationNumber = config('inpost.organizationNumber');

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api-shipx-pl.easypack24.net/v1/organizations/$organizationNumber/shipments?",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $shipment,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $bearerToken",
                    "Content-Type: application/json",
                    "Postman-Token: cec960ea-488f-42d1-b2db-5ffb64443dda",
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
        }
    }


    public function create()
    {
        return view('shop.order.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate(
            [
                'basketContent' => ['required', 'json'],
                'name' => ['required', 'max:255'],
                'surname' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:400'],
                'phone' => ['required', 'max:20'],
                'road' => ['required', 'max:255'],
                'houseno' => ['required', 'max:255'],
                'flatno' => ['max:255'],
                'postcode' => ['required', 'max:255'],
                'city' => ['required', 'max:255'],
                'message' => ['max:2500'],
            ],
            ['email.email' => 'Proszę podać prawidłowy E-mail']
        );
        $session_id = $request->session()->getId();

        $products = json_decode($data['basketContent']);


        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->price;
        }
        $totalPrice += 1300;
        $order = Order::create([
            'session_id' => $request->session()->getId(),
            'status' => 'not processed',
            'price' => $totalPrice,
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'road' => $data['road'],
            'houseno' => $data['houseno'],
            'flatno' => $data['flatno'],
            'postcode' => $data['postcode'],
            'city' => $data['city'],
            'message' =>  $data['message'],
        ]);

        $cart = [];
        $merchantId = (int)config('przelewy24.merchantId');
        $crc = config('przelewy24.crc');
        $posId = (int)config('przelewy24.posId');
        $raportKey = config('przelewy24.raportKey');
        $amount = $totalPrice;
        $currency = 'PLN';
        $description = 'QoQos by Szymon Reich Order';
        $email = $data['email'];
        $country = 'PL';
        $languaage = 'pl';
        $urlReturn = config('przelewy24.urlReturn');
        $urlStatus = config('przelewy24.urlStatus');


        foreach ($products as $product) {
            $order->cart_products()->create([
                'product_variant_id' => $product->id,
                'product_variant' => $product->productOrVariant,

            ]);
            array_push($cart, [
                'sellerId' => $merchantId,
                'price' => $product->price,
                'quantity' => 1,
                'name' => $product->title,
                'sellerCategory' => 'qoqos'
            ]);
        }

        array_push($cart, [
            'sellerId' => $merchantId,
            'price' => 1300,
            'quantity' => 1,
            'name' => 'Przesyłka Kurierska Inpost',
            'sellerCategory' => 'qoqos'
        ]);

        $sign = hash('sha384', json_encode(
            [
                "sessionId" => $session_id,
                "merchantId" => $merchantId,
                "amount" => $amount,
                "currency" => $currency,
                "crc" => $crc
            ],
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        ));



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
            'urlStatus' => $urlStatus,
            'sign' => $sign,
            'cart' => $cart
        ]);

        $basicauth = base64_encode($merchantId . ":" . $raportKey);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            // CURLOPT_URL => "https://sandbox.przelewy24.pl/api/v1/transaction/register?$p24variables",
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

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

        $response = json_decode($response);
        $token = $response->data->token;
        return redirect("https://sandbox.przelewy24.pl/trnRequest/$token");
    }


    public function verify(Request $request)
    {
        $cart = [];
        $merchantId = (int)config('przelewy24.merchantId');
        $crc = config('przelewy24.crc');
        $posId = (int)config('przelewy24.posId');
        $raportKey = config('przelewy24.raportKey');
        $currency = 'PLN';


        $data = $request->validate([
            'merchantId' => ['integer', Rule::in([$merchantId]), 'required'],
            'posId' => ['integer', Rule::in([$posId]), 'required'],
            'sessionId' => 'required',
            'amount' => ['required', 'integer'],
            'originAmount' => '',
            'currency' => '',
            'orderId' => '',
            'methodId' => '',
            'statement' => '',
            'sign' => ''
        ]);


        $order = Order::where([
            ['session_id', '=', $data['sessionId']],
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
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        ));



        if ($data['sign'] == $hashCalculated) {
            $order->update([
                'status' => 'processed'
            ]);

            $session_id = $order->session_id;
            $orderId = $data['orderId'];
            $amount = (int)$order->price;


            $sign = hash('sha384', json_encode(
                [
                    "sessionId" => $session_id,
                    "orderId" => $orderId,
                    "amount" => $amount,
                    "currency" => $currency,
                    "crc" => $crc
                ],
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            ));


            $p24variables = http_build_query([
                'merchantId' => $merchantId,
                'posId' => $posId,
                'crc' => $crc,
                'sessionId' => $session_id,
                'amount' => $amount,
                'currency' => $currency,
                'orderId' => $orderId,
                'sign' => $sign
            ]);

            $basicauth = base64_encode($posId . ":" . $raportKey);


            $curl = curl_init();

            curl_setopt_array($curl, array(
                // CURLOPT_URL => "https://sandbox.przelewy24.pl/api/v1/transaction/verify?$p24variables",
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
                $response = json_decode($response);
                $order->update([
                    'status' => $response->data->status
                ]);

                if ($response->data->status == 'success') {

                    $dimensions = ["height" => (float)80, "length" => (float)35, "width" => (float)25];
                    $weight = (float)0;

                    foreach ($order->cart_products as $productInCart) {

                        if ($productInCart->product_variant == 'product') {
                            $productToUpdate = Product::findOrFail($productInCart->product_variant_id);

                            $productToUpdate->update([
                                'stock' => $productToUpdate['stock'] - 1,
                            ]);

                            if (preg_match("/Bluza /mi", $productToUpdate->title) == 1) {
                                $dimensions = ["height" => (float)190, "length" => (float)35, "width" => (float)25];
                                $weight = $weight + (float)1000;
                            }
                            if (preg_match("/Płyta  /mi", $productToUpdate->title) == 1) {
                                $weight = $weight + (float)300;
                            }
                            if (preg_match("/Planner /mi", $productToUpdate->title) == 1) {
                                $weight = $weight + (float)300;
                            }
                        } else if ($productInCart->product_variant == 'variant') {

                            $productToUpdate = ProductVariation::findOrFail($productInCart->product_variant_id);

                            $productToUpdate->update([
                                'stock' => $productToUpdate['stock'] - 1,
                            ]);

                            if (preg_match("/Bluza /mi", $productToUpdate->title) == 1) {
                                $dimensions = ["height" => (float)190, "length" => (float)35, "width" => (float)25];
                                $weight = $weight + (float)1000;
                            }
                            if (preg_match("/Płyta  /mi", $productToUpdate->title) == 1) {
                                $weight = $weight + (float)300;
                            }
                            if (preg_match("/Planner /mi", $productToUpdate->title) == 1) {
                                $weight = $weight + (float)300;
                            }
                        }
                    }

                    $addressReceiver = ["street" => $order->road, "building_number" => (string)$order->houseno . '/' . (string)$order->flatno, "city" => "$order->city", "post_code" => "$order->postcode", "country_code" => "PL"];
                    $receiver = ["email" => $order->email, "address" => $addressReceiver, "phone" => $order->phone, "first_name" => $order->name, "last_name" => $order->surname];
                    $parcels = ['dimensions' => $dimensions, 'weight' => ['amount' => $weight, 'unit' => 'g']];
                    $shipment = json_encode(["receiver" => $receiver, "parcels" => $parcels, "service" => "inpost_courier_standard", "reference" => $order->id]);

                    $bearerToken = config('inpost.bearerToken');
                    $organizationNumber = config('inpost.organizationNumber');

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api-shipx-pl.easypack24.net/v1/organizations/$organizationNumber/shipments?",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => $shipment,
                        CURLOPT_HTTPHEADER => array(
                            "Authorization: Bearer $bearerToken",
                            "Content-Type: application/json",
                            "Postman-Token: cec960ea-488f-42d1-b2db-5ffb64443dda",
                            "cache-control: no-cache"
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);
                    Mail::send(new PaymentVerified($order));
                }
            }
        } else {
            $order->delete();
        }

        return 1;
    }

    public function thankyou()
    {
        return view('shop.order.thankyou');
    }
}
