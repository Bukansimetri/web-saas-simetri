<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'old_price' => $product->old_price,
            'discount_percentage' => $product->discount_percentage,
            'image_url' => $product->getImageUrl('large'), // Adjust based on your image handling
            'url_grab_mart' => $product->url_grab_mart,
            'category' => $product->category ? [
                'name' => $product->category->name,
                'slug' => $product->category->slug,
            ] : null,
            'tag' => $product->tag,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ]);
    }
}
