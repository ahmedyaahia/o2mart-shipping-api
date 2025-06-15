<?php


namespace App\Services;

class ShippingCalculatorService
{
    public function calculate(array $data)
    {
        extract($data);

        $volumetricWeight = ($length * $width * $height) / 5000;
        $chargingWeight = max($weight, $volumetricWeight);
        $extraWeight = max(0, $chargingWeight - 5);
        $extraWeightCost = $extraWeight * 2;

        if ($monthly_shipments <= 250) {
            $baseCost = $destination_type === 'normal' ? 14 : 49;
        } elseif ($monthly_shipments <= 500) {
            $baseCost = $destination_type === 'normal' ? 12 : 47;
        } else {
            $baseCost = $destination_type === 'normal' ? 11 : 46;
        }

        $subtotal1 = $baseCost + $extraWeightCost;
        $fuel = $subtotal1 * 0.02;
        $subtotal2 = $subtotal1 + $fuel;
        $packaging = 5.25;
        $subtotal3 = $subtotal2 + $packaging;
        $epg = max($subtotal3 * 0.1, 2);
        $subtotal4 = $subtotal3 + $epg;
        $vat = $subtotal4 * 0.05;
        $final = $subtotal4 + $vat;

        return [
            'base_cost' => round($baseCost, 2),
            'charging_weight' => round($chargingWeight, 2),
            'extra_weight' => round($extraWeight, 2),
            'extra_weight_cost' => round($extraWeightCost, 2),
            'subtotal1' => round($subtotal1, 2),
            'fuel_surcharge' => round($fuel, 2),
            'subtotal2' => round($subtotal2, 2),
            'packaging' => round($packaging, 2),
            'subtotal3' => round($subtotal3, 2),
            'epg' => round($epg, 2),
            'subtotal4' => round($subtotal4, 2),
            'vat' => round($vat, 2),
            'final_price' => round($final, 2),
        ];
    }
}
