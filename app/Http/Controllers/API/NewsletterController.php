<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validate email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(), // returns as an object
            ], 400);
        }

        $email = $request->input('email');

        // Check if email already exists
        $exists = DB::table('newsletter')->where('email', $email)->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'You are Already Subscribed!'
            ], 422);
        }

        // Insert new record
        DB::table('newsletter')->insert([
            'email' => $email,
            'created_at' => now(),
        ]);

        // Send notification to admin
        $adminEmail = theme_option('contact_email', 'chaturbhuj.wh@gmail.com');

        Mail::raw("New newsletter subscriber: $email", function ($message) use ($adminEmail) {
            $message->to($adminEmail)
                    ->subject('New Newsletter Subscriber');
        });

        return response()->json([
            'status' => true,
            'message' => 'Thanks for subscribing!'
        ]);
    }
    
    
     public function talktohr(Request $request)
    {
        // Validate email input
        $validator = Validator::make($request->all(), [
            'emailCareer' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(), // returns as an object
            ], 400);
        }

        $email = $request->input('emailCareer');

     
        // Send notification to admin
        $adminEmail = theme_option('contact_email', 'chaturbhuj.wh@gmail.com');

        Mail::raw("New newsletter subscriber: $email", function ($message) use ($adminEmail) {
            $message->to($adminEmail)
                    ->subject('New Newsletter Subscriber');
        });

        return response()->json([
            'status' => true,
            'message' => 'Thanks! We will get back to you soon!'
        ]);
    }
    
    
    
    
    
    
}
