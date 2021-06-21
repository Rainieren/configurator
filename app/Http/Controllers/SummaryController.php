<?php

namespace App\Http\Controllers;

use App\Download;
use App\Models\Product;
use App\Models\Summary;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $summaries = Summary::orderBy('created_at', 'desc')->paginate(20);

        return view('dashboard.summaries.index', compact('summaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $parent = Product::find($request['parent']['id']);

        $sum = $parent->price;

        $summary = Summary::create([
            'code' => strtoupper(bin2hex(openssl_random_pseudo_bytes(4))),
            'total' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $summary->products()->attach($parent->id);

        foreach ($request['options'] as $option) {
            foreach($option[0]['options'] as $product) {
                $product = Product::find($product['id']);
                $product->opties()->attach($summary->id);
                $sum += $product['price'];
            }
        }

        Summary::where('id', $summary->id)->update(['total' => $sum]);

        return response()->json();
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
        //
    }

    public function getAllSummaries()
    {
        return response()->json(Summary::with('products')->get());
    }

    public function generatePDF(Request $request)
    {
//        dd($request);
        $pdf = PDF::loadView('pdfs.summary', ['active' => $request->activeProduct, 'options' => $request->chosenOptions]);
//        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
//        $download = Summary::create([
//            'user_id' => Auth::user()->id,
//            'filename' => 'summary.pdf'
//        ]);

        return $pdf->download('summary.pdf');
    }

    public function getMostPopulairProduct() {

    }
}
