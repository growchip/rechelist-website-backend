<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        Mail::raw("New contact form submission:\n\n" . json_encode($request->all(), JSON_PRETTY_PRINT), function ($message) {
            $message->to('chaturbhuj.wh@gmail.com')
                ->subject('New Contact Form Submission');
        });

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting us. We will get back to you soon.',
        ]);
    }
}
