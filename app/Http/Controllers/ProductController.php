<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Jobs\ProcessNotification;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function showAll()
    {
        return view(
            'product',
            [
                'products' => Product::all(),
                'canChangeArticle' => Gate::allows('update-article'),
            ]
        );
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
            array_filter(
                array_combine(
                    $request->input('title') ?? [],
                    $request->input('value') ?? []
                ), function ($attr) {
                    return is_null($attr) ? false : true;
                }
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

    public function update(ProductRequest $request)
    {
        $product = Product::find($request->input('id'));
        $product->article = $request->input('article');
        $product->name = $request->input('name');
        $product->status = $request->input('status');
        $product->data = json_encode(
            array_filter(
                array_combine(
                    $request->input('title') ?? [],
                    $request->input('value') ?? []
                ), function ($attr) {
                    return is_null($attr) ? false : true;
                }
            )
        );
        $product->save();

        return redirect()->route('product');
    }
}
