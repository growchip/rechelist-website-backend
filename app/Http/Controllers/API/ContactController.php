<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Botble\Contact\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    
    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'city'  => 'nullable|string|max:255',
             'message' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        // Contact::create($request->only('name','email','phone','city',message));
        // Mail::raw("New SEO lead from website:\n\n" . json_encode($request->all(), JSON_PRETTY_PRINT), function ($message) {
        //     $message->to('growchip.ai@gmail.com')
        //         ->subject('New SEO Lead from Website');
        // });

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Thank you for contacting us. We will get back to you soon.',
        // ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->city,
            'subject' => 'Contact Form',
            'content' => $request->message ?? '',
        ]);

        try {
        Mail::raw(
            "Name: {$request->name}\nEmail: {$request->email}\nPhone: {$request->phone}\nCity: {$request->city}\nMessage: {$request->message}",
            function ($message) {
                $message->to('growchip.ai@gmail.com')
                        ->subject('New SEO Query From Website');
            }
        );

        \Log::info('Mail sent successfully');
        } catch (\Exception $e) {
        \Log::error('Mail failed: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting us. We will get back to you soon.',
        ]);
    }
}
