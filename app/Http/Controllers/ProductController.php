<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // index method
    public function index() {
        return response()->json(Product::all());
    }

    // show method
    public function show(Product $product) {
        return response()->json($product);
    }

    // store method
    public function store(Request $request) {
        $productData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'sku' => 'required|string|unique:products,sku',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $productData['image'] = $imageName;

        // $user_id = Auth::user()->id;
        $productData['user_id'] = 1;


        $product = new Product();
        $product->image = $productData['image'];
        $product->name = $productData['name'];
        $product->price = $productData['price'];
        $product->sku = $productData['sku'];
        $product->user_id = $productData['user_id'];
        $product->save();

        return response($product, 201);
    }

    // update method
    public function update(Request $request, Product $product) {
        // $product = Product::find($product->id);
        $productData = $request->validate([
            'name' => 'string',
            'price' => 'numeric',
            'sku' => 'string|unique:products,sku,' . $product->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' ,
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $productData['image'] = $imageName;

        $productData['user_id'] = 1;

        $product->update([
            'name' => $productData['name'],
            'price' => $productData['price'],
            'sku' => $productData['sku'],
            'image' => $productData['image'],
            'user_id' => $productData['user_id'],
        ]);
        
        return response()->json($product,200);
    }

    // delete method
    public function delete(Product $product) {
        $prod = Product::find($product->id);
        $prod->delete();

        return response(null, 204);
    }
}
