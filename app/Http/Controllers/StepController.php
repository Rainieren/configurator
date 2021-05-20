<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Step;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $steps = Step::orderBy('order')->get();

        return view('dashboard.steps.steps', compact('steps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.steps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $steps = Step::all();

        if(count($steps) == 0) {
            $order = 0;
        } else {
            $order = $steps->max('order') + 1;
        }

//        dd($request->addToConfigurableProducts);
        $step = Step::create([
            'name' => $request->name,
            'interaction_type' => $request->interaction_type,
            'is_optional' => $request->is_optional ? 1 : null,
            'order' => $order,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        foreach(json_decode($request->selectedProducts[0]) as $selectedProduct) {
            Product::where('id', $selectedProduct->id)->update(['step_id' => $step->id]);
        }

        foreach(json_decode($request->addToConfigurableProducts[0]) as $configurableProduct) {
            $product = Product::find($configurableProduct);
            $product->steps()->attach($step->id);
        }

        return redirect('/dashboard/step/' . $step->id)->with('flash', 'Successful aangemaakt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $step = Step::where('id', $id)->with('interactionType', 'options')->firstOrFail();

        return view('dashboard.steps.index', compact('step'));
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
        Step::destroy($id);

        return redirect('/dashboard/steps')->with('flash', "Succesvol verwijderd");
    }

    // Vue methods

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRelatedStepsAndProducts($id) {
        return response()->json(Step::whereHas('options', function ($q) use ($id) {
            $q->where('product_id', $id);
        })->get());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSteps() {
        return response()->json(Step::orderBy('order')->get());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeOrder(Request $request)
    {
        $steps = Step::all();

        foreach($steps as $step) {
            $id = $step->id;
            foreach($request->steps as $stepNew) {
                if($stepNew['id'] == $id) {
                    $step->update(['order' => $stepNew['order']]);
                }
            }
        }

        return response()->json();
    }
}
