<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductGroupItem;
use App\Models\UserProductGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetCartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        $userId = Auth::id();
        $userCart = Cart::where('user_id', $userId)->with('product')->get();

        $userProductGroupItems = ProductGroupItem::whereIn('product_id', $userCart->pluck('product_id'))
            ->get();

        $discountAmount = $this->calculateDiscount($userCart, $userProductGroupItems);

        $cartData = [
            'products' => $userCart->map(function ($cartItem) {
                return [
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price
                ];
            })->toArray(),
            'discount' => $discountAmount
        ];

        return response()->json($cartData);

    }

    private function calculateDiscount($userCart, $userProductGroupItems)
    {
        $discount = 0;
        $userCartProductIds = $userCart->pluck('product_id')->toArray();
        $allItemsInCart = $userProductGroupItems->every(function ($item) use ($userCartProductIds) {
            return in_array($item->product_id, $userCartProductIds);
        });

        if (!$allItemsInCart) {
            return 0;
        }


        $mins = [];
        foreach ($userProductGroupItems as $groupItem) {
            $cartItem = $userCart->where('product_id', $groupItem->product_id)->first();

            $mins[] =$cartItem->quantity;
        }
        $minDiscountQuantity = min($mins);
        $percent = UserProductGroup::where('user_id', Auth::id())->first();

        foreach ($userProductGroupItems as $groupItem){
            $product = Product::where('id', $groupItem->product_id)->first();

            $discount += ($product->price * $minDiscountQuantity) * $percent->discount/100;

        }

        return $discount;

    }
}
