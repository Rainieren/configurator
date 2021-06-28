<?php

namespace App\Http\Controllers;

use App\Models\Configurator;
use App\Models\Product;
use App\Models\Summary;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use League\Flysystem\Config;

class ConfiguratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configurators = Configurator::all();
        $summaries = Summary::all();

        return view('dashboard.configurators.configurators', compact('configurators', 'summaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.configurators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->thumbnail_upload) {
            $imageName = time() . '.' . $request->thumbnail_upload->extension();
            $request->thumbnail_upload->storeAs('public/images', $imageName);
        }

         $configurator = Configurator::create([
            'name' => $request->name,
            'theme_color' => $request->theme_color,
            'thumbnail' => $request->thumbnail_upload ? '/storage/images/' . $imageName : '/storage/images/placeholder.png',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        foreach(json_decode($request->selectedConfigurableProducts[0]) as $product) {
            Product::where('id', $product)->update(['configurator_id' => $configurator->id]);
        }

        return redirect('/dashboard/configurators');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $configurator = Configurator::find($id);

        return view('dashboard.configurators.edit', compact('configurator'));
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
        dd($request);
        $configurator = Configurator::find($id);

        if($request->data['fields']['thumbnail']) {
            $imageName = time() . '.' . $request->data['fields']['thumbnail']->extension();
            $request->thumbnail_upload->storeAs('public/images', $imageName);
        }

        $configurator->update([
            'name' => $request->data['fields']['name'],
            'theme_color' => $request->data['fields']['themeColor'],
            'thumbnail' => $request->data['fields']['thumbnail'] ? '/storage/images/' . $imageName : '/storage/images/placeholder.png',
            'updated_at' => Carbon::now(),
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

        Configurator::destroy($id);
        Product::where('configurator_id', $id)->update(['configurator_id' => null]);

        return redirect('/dashboard/configurators')->with('flash', "Succesvol verwijderd");
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllConfiguratorsWithProducts()
    {
        return response()->json(Configurator::with('products')->whereHas('products', function ($query) {
            $query->where('configurable', '=', 1)->where('status', '=', 1);
        })->get());
    }



    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllConfigurators()
    {

        return response()->json(Configurator::all());
    }

    public function getConfigurator($id)
    {
        return response()->json(Configurator::find($id));
    }
}
