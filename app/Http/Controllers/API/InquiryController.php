<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'product' => 'required|string|max:255',
            'message' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        // Create inquiry object
        $inquiry = (object) $request->only([
            'name', 'email', 'phone', 'product',
        ]);

        // Send email
        try {
            Mail::raw("
                New Product Inquiry:

                Name: {$inquiry->name}
                Email: {$inquiry->email}
                Contact No: {$inquiry->phone}
                Product: {$inquiry->product}
            ", function($msg) use ($inquiry) {
                $msg->to('chaturbhuj.wh@gmail.com')
                    ->subject('New Inquiry: '.$inquiry->product);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Inquiry email failed: '.$e->getMessage(),
            ], 500);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Inquiry submitted successfully and email sent',
        ], 200);
    }
}
