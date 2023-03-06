<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, Product $products)
    {
        //
        $query = $request->query();
        $params = [];
        $min = null;
        $max = null;
        if (array_key_exists('name', $query)) $params[] = ['name', 'like', '%' . $query['name'] . '%'];
        if (array_key_exists('code', $query)) $params[] = ['code', $query['code']];
        if (array_key_exists('color', $query)) $params[] = ['color', $query['color']];
        if (array_key_exists('size', $query)) $params[] = ['size', $query['size']];
        if (array_key_exists('min_price', $query)) $min = $query['min_price'];
        if (array_key_exists('max_price', $query)) $max = $query['max_price'];
        if ($min && !$max) $params[] = ['price', $min];
        if (array_key_exists('description', $query)) $params[] = ['description', 'like', '%' . $query['description'] . '%'];
        $interResult = Product::query()->select()
            ->where($params);
        if ($min && $max) $result = $interResult->whereBetween('price', [$min, $max])->get();
        else $result = $interResult->get();
        return response()->json(['data' => $result]);
    }
}
