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
//        dd($request);
        if($request->thumbnail_upload) {
            $imageName = time() . '.' . $request->thumbnail_upload->extension();
            $request->thumbnail_upload->storeAs('public/images', $imageName);
        }
        if($request->visualisation_upload) {
            $visuName = time().'.'.$request->visualisation_upload->extension();
            $request->visualisation_upload->storeAs('public/visualisations', $imageName);
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price ? str_replace(",", "", $request->price) : null,
            'percentage_increase' => $request->percentage / 100,
            'stock' => $request->stock,
            'status' => !$request->isEnabled ? 1 : 0,
            'visibility' => !$request->isVisible ? 1 : 0,
            'description' => $request->description,
            'thumbnail' => $request->visualisation_upload ? '/storage/images/' . $imageName : null,
            'visualisation' => $request->visualisation_upload ? '/storage/visualisations/' . $visuName : null,
            'weight' => $request->weight,
            'height' => $request->height,
            'length' => $request->length,
            'width' => $request->width,
            'url_key' => strtolower(str_replace(' ', '_', $request->name)),
            'new_from' => $request->new_from,
            'new_to' => $request->new_to,
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
        $product = Product::find($id);

        return view('dashboard.products.edit', compact('product'));
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
        $product = Product::find($id);

        if($request->data['fields']['thumbnail']) {
            $imageName = time() . '.' . $request->data['fields']['thumbnail']->extension();
            $request->data['fields']['thumbnail']->storeAs('public/images', $imageName);
        }
        if($request->data['fields']['visualisation']) {
            $visuName = time().'.'.$request->data['fields']['visualisation']->extension();
            $request->data['fields']['visualisation']->storeAs('public/visualisations', $imageName);
        }

        $product->update([
            'name' => $request->data['fields']['name'],
            'price' => $request->data['fields']['price'] ? str_replace(",", "", $request->data['fields']['price']) : null,
            'percentage_increase' => $request->data['fields']['priceIncrease'] / 100,
            'stock' => $request->data['fields']['stock'],
            'status' => $request->data['fields']['isEnabled'],
            'visibility' => $request->data['fields']['isVisible'],
            'description' => $request->data['fields']['description'],
            'thumbnail' => $request->data['fields']['thumbnail'] ? '/storage/images/' . $imageName : null,
            'visualisation' => $request->data['fields']['visualisation'] ? '/storage/visualisations/' . $visuName : null,
            'weight' => $request->data['fields']['weight'],
            'height' => $request->data['fields']['height'],
            'length' => $request->data['fields']['length'],
            'width' => $request->data['fields']['width'],
            'url_key' => strtolower(str_replace(' ', '_', $request->data['fields']['name'])),
            'new_from' => $request->data['fields']['newFrom'],
            'new_to' => $request->data['fields']['newTo'],
            'sku' => $request->data['fields']['sku'],
            'configurable' => $request->data['fields']['isConfigurableProduct'],
            'interaction_type' => $request->data['fields']['interactionType'],
            'manufacturer_id' => $request->data['fields']['manufacturer'],
            'updated_at' => Carbon::now()
        ]);

        return response()->json();
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

    public function getConfigurableProductsFromId($id) {
        return response()->json(Product::where('configurable', 1)->where('configurator_id', $id)->get());
    }

    public function getConfigurableProducts() {
        return response()->json(Product::where('configurable', 1)->get());
    }


    public function getAllRelatedSteps($id) {
        return response()->json(Product::where('id', $id)->with('steps.options')->get());
    }

    public function getInteractionTypeProducts($interaction_type) {
        return response()->json(Product::where('interaction_type', $interaction_type)->whereNull('step_id')->with('interactionType')->get());
    }

    public function getParentProducts($id) {
        return response()->json(Product::whereHas('steps', function($q) use ($id){
            $q->where('step_id', $id);
        })->get());
    }
}
