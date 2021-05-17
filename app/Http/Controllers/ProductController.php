<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(20);

        return view('dashboard.products.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create');
//        return redirect('/')->with('flash', 'Uw bericht is geplaatst!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price ? str_replace(",", "", $request->price) : null,

            'percentage_increase' => $request->percentage / 100,

            'stock' => $request->stock,
            'status' => 1,
            'visibility' => 1,
            'description' => $request->description,
            'thumbnail' => $request->file('thumbnail'),
            'visualisation' => $request->file('visualisation'),
            'weight' => $request->weight,
            'height' => $request->height,
            'length' => $request->length,
            'width' => $request->width,
            'url_key' => strtolower(str_replace(' ', '_', $request->name)),
            'new_from' => $request->newFrom,
            'new_to' => $request->newTo,
            'sku' => $request->sku,
            'configurable' => $request->configurable_product ? 1 : null,

            'interaction_type' => $request->interaction_type,

            'user_id' => auth()->user()->id,
            'manufacturer_id' => $request->manufacturer,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect('/dashboard/product/' . $product->id)->with('flash', 'Successful aangemaakt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('dashboard.products.index', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('/dashboard/products')->with('flash', "Succesvol verwijderd");
    }


    // Vue methods

    public function getConfigurableProducts() {
        return response()->json(Product::where('configurable', 1)->get());
    }


    public function getAllRelatedSteps($id) {
        return response()->json(Product::where('id', $id)->with('steps.options')->get());
    }

    public function getInteractionTypeProducts($interaction_type) {
        return response()->json(Product::where('interaction_type', $interaction_type)->whereNull('step_id')->with('interactionType')->get());
    }
}
