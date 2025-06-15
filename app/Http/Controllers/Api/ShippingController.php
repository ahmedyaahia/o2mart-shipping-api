<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShippingCalculatorService;

class ShippingController extends Controller
{
    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'monthly_shipments' => 'required|integer',
            'destination_type' => 'required|in:normal,remote',
            'weight' => 'required|numeric|max:20',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
        ]);

        $calculator = new ShippingCalculatorService();
        $result = $calculator->calculate($validated);

        return response()->json($result);
    }
}

