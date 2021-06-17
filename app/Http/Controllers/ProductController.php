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
            'stock' => filter_var($request->stock, FILTER_VALIDATE_BOOLEAN),
            'status' => filter_var($request->isEnabled , FILTER_VALIDATE_BOOLEAN),
            'visibility' => filter_var($request->isVisible, FILTER_VALIDATE_BOOLEAN),
            'description' => $request->description,
            'thumbnail' => $request->thumbnail_upload ? '/storage/images/' . $imageName : '/storage/images/placeholder.png',
            'visualisation' => $request->visualisation_upload ? '/storage/visualisations/' . $visuName : null,
            'weight' => $request->weight,
            'height' => $request->height,
            'length' => $request->length,
            'width' => $request->width,
            'url_key' => strtolower(str_replace(' ', '_', $request->name)),
            'new_from' => $request->new_from,
            'new_to' => $request->new_to,
            'sku' => $request->sku,
            'configurable' => filter_var($request->configurable_product, FILTER_VALIDATE_BOOLEAN),
            'interaction_type' => $request->interaction_type,
            'user_id' => auth()->user()->id,
            'manufacturer_id' => $request->manufacturer,
            'configurator_id' => $request->configurator,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect('/dashboard/product/' . $product->id)->with('flash', 'Successful aangemaakt!');
        return response()->json();
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
//        dd($request->thumbnail_upload);
        $product = Product::find($id);

        if($request->thumbnail_upload) {
            $imageName = time() . '.' . $request->thumbnail_upload->extension();
            $request->thumbnail_upload->storeAs('public/images', $imageName);
        }
        if($request->visualisation_upload) {
            $visuName = time().'.'.$request->visualisation_upload->extension();
            $request->visualisation_upload->storeAs('public/visualisations', $visuName);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price ? str_replace(",", "", $request->price) : null,
            'percentage_increase' => $request->percentage / 100,
            'stock' => filter_var($request->stock, FILTER_VALIDATE_BOOLEAN),
            'status' => filter_var($request->isEnabled, FILTER_VALIDATE_BOOLEAN),
            'visibility' => filter_var($request->isVisible, FILTER_VALIDATE_BOOLEAN),
            'description' => $request->description,
            'thumbnail' => $request->thumbnail_upload ? '/storage/images/' . $imageName : $product->thumbnail,
            'visualisation' => $request->visualisation_upload ? '/storage/visualisations/' . $visuName : $product->visualisation,
            'weight' => $request->weight,
            'height' => $request->height,
            'length' => $request->length,
            'width' => $request->width,
            'url_key' => strtolower(str_replace(' ', '_', $request->name)),
            'new_from' => $request->new_from,
            'new_to' => $request->new_to,
            'sku' => $request->sku,
            'configurable' => filter_var($request->configurable_product, FILTER_VALIDATE_BOOLEAN),
            'interaction_type' => $request->interaction_type,
            'manufacturer_id' => $request->manufacturer,
            'configurator_id' => $request->configurator,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->back();
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
        return response()->json(Product::where(['configurable' => 1, 'visibility' => 1])->where('configurator_id', $id)->get());
    }

    public function getConfigurableProducts() {
        return response()->json(Product::where(['configurable' => 1, 'step_id' => null, 'visibility' => 1])->get());
    }

    public function getAllProductsWithNoConfigurator()
    {
        return response()->json(Product::where(['configurator_id' => null, 'visibility' => 1])->get());
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
