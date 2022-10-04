<?php

namespace App\Http\Controllers;

use App\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariationsController extends Controller
{
    public function returnVariation(Request $request)
    {
        $productVariationsPivot = [];
        foreach ($request->optionselectvalues as $optionselectvalue) {
            array_push($productVariationsPivot, DB::table('product_variation_product_variation_option')->where('product_variation_option_id', $optionselectvalue)->get());
        }
        
        $variationIdNumbersArray = [];

        foreach ($productVariationsPivot as $productVariationSingleOptionPivotArray) {
            foreach ($productVariationSingleOptionPivotArray as $productVariationSingleOptionPivot) {
                array_push($variationIdNumbersArray, $productVariationSingleOptionPivot->product_variation_id);
            }
        }
        $variationIdNumbersCountValues = array_count_values($variationIdNumbersArray);
        arsort($variationIdNumbersCountValues);
        $variationIdNumber = array_slice(array_keys($variationIdNumbersCountValues), 0, 1, true)[0];

        if ($variationIdNumbersCountValues[$variationIdNumber] >= count($request->productvariationcategories)) {
            $productVariation = ProductVariation::findOrFail($variationIdNumber);
            return $productVariation;
        }
        return abort(404);
    }
}
