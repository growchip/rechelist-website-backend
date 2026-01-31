<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminOfficeController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'address' => theme_option('admin_office_address'),
            ]
        ]);
    }
}
