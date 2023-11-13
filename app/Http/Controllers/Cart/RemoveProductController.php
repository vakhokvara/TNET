<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class RemoveProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'product_id' => 'required|int'
        ]);

        $cartItem = Cart::where('product_id', $request->product_id)->first();

        if ($cartItem){
            $cartItem->decrement('quantity');

            if ($cartItem->quantity === 0) {
                $cartItem->delete();
            }
            return response()->json(['message' => 'Product removed from a cart successfully']);
        }

        return response()->json(['message' => 'Product does not exist']);
    }
}
