<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddProductController extends Controller
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

        if(Product::where('id', $request->product_id)->exists()){

            $cartItem = Cart::where('product_id', $request->product_id)->first();

            if($cartItem){
                $cartItem->quantity += 1;
                $cartItem->save();
            }else{
                $cartItem = new Cart([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity' => 1
                ]);
                $cartItem->save();
            }
            return response()->json(['message' => 'Product added to cart successfully']);
        }

        return response()->json(['message' => 'Product does not exist']);
    }
}
