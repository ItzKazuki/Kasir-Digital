<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function showCart(Request $request)
    {
        $itemsCart = \Cart::getContent();
        $subTotalWithoutConditions = \Cart::getSubTotalWithoutConditions();

        return response()->json($itemsCart->count() > 0 ? [
            'cartItems' => $itemsCart,
            'subtotal' => number_format($subTotalWithoutConditions, 0, ',', '.')
        ] : [
            'data' => 'Cart is empty'
        ]);
    }

    public function storeCart(Product $product)
    {
        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $product->image,
                'category' => $product->category->name
            ]
        ]);

        return response()->json(
            [
                'message' => 'Product added to cart'
            ]
        );
    }

    public function removeItemCart($cartProductId)
    {
        \Cart::remove($cartProductId);

        return response()->json(
            [
                'message' => 'Product removed from cart'
            ]
        );
    }

    public function incrementItemCart($cartProductId)
    {
        \Cart::update(
            $cartProductId,
            [
                'quantity' => +1, //
            ]
        );

    }

    public function decrementItemCart($cartProductId)
    {
        \Cart::update(
            $cartProductId,
            [
                'quantity' => -1, //
            ]
        );
    }

}
