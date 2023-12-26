<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Jobs\ProcessNotification;

class ProductController extends Controller
{
    public function showAll()
    {
        return view('product', ['products' => Product::all()]);
    }

    public function showAllAvailable()
    {
        return view('product', ['products' => Product::available()->get()]);
    }

    public function addForm()
    {

    }

    public function add(ProductRequest $request)
    {
        $product = new Product();
        $product->article = $request->input('article');
        $product->name = $request->input('name');
        $product->status = $request->input('status');
        $product->data = json_encode(
            array_combine(
                $request->input('title') ?? [],
                $request->input('value') ?? []
            )
        );
        $product->save();
        dispatch(new ProcessNotification($product));
        return redirect()->route('product');
    }

    public function show($id)
    {
        return response()->json(Product::find($id));
    }

    public function delete(Request $request)
    {
        Product::destroy($request->input('id'));

        return response()->json(['deleted' => $request->input('id')]);
    }
}
