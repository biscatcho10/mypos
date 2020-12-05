<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->search, function($q) use ($request){
            return $q->whereTranslationLike('name',  '%' . $request->search . '%');
        })->when($request->category_id , function($query) use ($request) {
            return $query->where('category_id', $request->category_id);
        })->latest()->paginate(5);
        return view('dashboard.products.index', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required'
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locale . '.desc' => 'required'];
        }
        $rules += [
            'image' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];
        $request->validate($rules);

        $data = $request->all();

        if ($request->image) {
            $img = Image::make($request->image)->encode('jpg');
            Storage::disk('local')->put('public/images/Products/' . $request->image->hashName(), (string)$img, 'public');
            $data['image'] = request()->image->hashName();
        }

        Product::create($data);
        return redirect()->route('products.index')->with(['success' => 'The Product Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'category_id' => 'required'
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required']];
            $rules += [$locale . '.desc' => 'required'];
        }
        $rules += [
            // 'image' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];
        $request->validate($rules);

        $data = $request->all();

        if ($request->image) {

            if($request->image != 'image.png')
            {
                Storage::disk('public_uploads')->delete($product->image);
            }

            $img = Image::make($request->image)->encode('jpg');
            Storage::disk('local')->put('public/images/Products/' . $request->image->hashName(), (string)$img, 'public');
            $data['image'] = request()->image->hashName();
        }

        $product->update($data);
        return redirect()->route('products.index')->with(['success' => 'The Product Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image != 'image.png') {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with(['success' => 'The Product Deleted Successfully']);
    }

    public function related($id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->get();
        return view('dashboard.products.index', compact('categories', 'products'));
    }
}
