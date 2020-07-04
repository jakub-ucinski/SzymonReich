<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Mail\HomeContactMail;
use Illuminate\Support\Facades\Mail;

class LandingController extends Controller
{
    public function index()
    {
        $socialStats = array();

       
                $JSON = file_get_contents("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=PL5j10znFxs6kiBRXe7w_hGQW4-k_8JVv0&key=AIzaSyDd4l4MjxSma2XxVew2vkLKIe3rrfABqfE");
                $JSON_Data = json_decode($JSON);
                // $total_views_youtube=0;
                $totalViews = 0;
                foreach ($JSON_Data->{'items'} as $video){
                    $video_ID = $video->{'snippet'}->{'resourceId'}->{'videoId'};
        
                    $JSON = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=statistics&id={$video_ID}&key=AIzaSyDd4l4MjxSma2XxVew2vkLKIe3rrfABqfE");
                    $JSON_Data = json_decode($JSON);
                    $views = $JSON_Data->{'items'}[0]->{'statistics'}->{'viewCount'};
        
        
                    $totalViews = $totalViews + $views;
                }
        
                $socialStats['youtube']['muzykViews'] = $totalViews;



                $JSON = file_get_contents("https://www.instagram.com/szymonreich/?__a=1");
                $JSON_Data = json_decode($JSON);
                $socialStats['instagram']['followers'] = isset($JSON_Data) ? $JSON_Data -> graphql -> user -> edge_followed_by -> count : 155000;


                $JSON = file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=UCFN12Qsy0h5kIXWvagUdlRQ&key=AIzaSyDd4l4MjxSma2XxVew2vkLKIe3rrfABqfE");
                $JSON_Data = json_decode($JSON);
                $socialStats['youtube']['totalViews'] = $JSON_Data -> {'items'}['0'] -> {'statistics'}->{'viewCount'};

                $JSON = file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=UCFN12Qsy0h5kIXWvagUdlRQ&key=AIzaSyDd4l4MjxSma2XxVew2vkLKIe3rrfABqfE");
                $JSON_Data = json_decode($JSON);
                $socialStats['youtube']['subscribers'] = $JSON_Data -> {'items'}['0'] -> {'statistics'} -> {'subscriberCount'};

        return view('landing.index', compact('socialStats'));
    }

    public function contact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'representation' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required',
            'message' => 'required',
        ]);

        $data = array(
            'name' => $request->name,
            'representation' => $request->representation,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        );

        try{
            Mail::send(new HomeContactMail($data));
            $response = [
                'status' => 'success',
                'message' => 'Thank you for contacting us!'
            ];
        }
        catch(Exception $e){
            $response = [
                'status' => 'error',
                'message' => 'An error occured while sending the message, please try again later.'
            ];
        }

        return back()->with(compact('response'));
    }
}
