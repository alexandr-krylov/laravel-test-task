<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

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
        //        dd($request);
        $product = new Product();
        $product->article = $request->input('article');
        $product->name = $request->input('name');
        $product->status = $request->input('status');
        $product->data =
            json_encode(
                array_combine(
                    $request->input('title') ?? [],
                    $request->input('value') ?? []
                )
            );
        //        dd(json_encode(""));
        $product->save();

        return redirect()->route('product');
    }
}
