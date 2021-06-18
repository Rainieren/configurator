<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::orderBy('created_at', 'desc')->paginate(20);;

        return view('dashboard.manufacturers.manufacturers', compact('manufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.manufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        if($request->logo_upload) {
            $imageName = time() . '.' . $request->logo_upload->extension();
            $request->logo_upload->storeAs('public/images', $imageName);
        }
        $manufacturer = Manufacturer::create([
            'name' => $request->name,
            'logo' => $request->logo_upload ? '/storage/images/' . $imageName : '/storage/images/placeholder.png',
            'address' => $request->street_address,
            'zip_code' => $request->postal_code,
            'state' => $request->state,
            'city' => $request->city,
            'description' => $request->description,
            'country_id' => $request->country,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect('/dashboard/manufacturers/')->with('flash', 'Successful aangemaakt!');
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
        $manufacturer = Manufacturer::find($id);

        return view('dashboard.manufacturers.edit', compact('manufacturer'));

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
        if($request->logo_upload) {
            $imageName = time() . '.' . $request->logo_upload->extension();
            $request->logo_upload->storeAs('public/images', $imageName);
        }

        $manufacturer = Manufacturer::find($id);

        $manufacturer->update([
            'name' => $request->name,
            'logo' => $request->logo_upload ? '/storage/images/' . $imageName : $manufacturer->logo,
            'address' => $request->street_address,
            'zip_code' => $request->postal_code,
            'state' => $request->state,
            'city' => $request->city,
            'description' => $request->description,
            'country_id' => $request->country,
            'updated_at' => Carbon::now(),
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
        Manufacturer::destroy($id);

        return redirect('/dashboard/manufacturers')->with('flash', "Succesvol verwijderd");
    }

    public function getAllManufacturers() {
        return response()->json(Manufacturer::all());
    }
}
