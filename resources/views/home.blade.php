@extends('layouts.app')

@section('content')
    <div class="loading-screen absolute w-screen h-screen flex justify-center items-center bg-white z-10 flex-col overflow-hidden hidden">

        <svg class="animate-spin -ml-1 mr-3 h-10 w-10 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>

        <p class="my-5">Even geduld aub...</p>
    </div>
    <div class="flex flex-col xl:flex-row ">

        <div class="configurator bg-white xl:w-8/12 w-full min-h-screen p-20 space-y-15">
            <h1 class="text-5xl font-serif mb-20">Product configureren</h1>
            <div class="flex">
                <div class="w-1/3">
                    <p class="text-2xl font-bold my-5">Manufacturers: </p>
                    @foreach($manufacturers as $manufacturer)
                        <p>Manufacturer: <?= $manufacturer->name ?></p>
                        <p class="ml-5">Address: <?= $manufacturer->address ?> </p>
                        <p class="ml-5">Zip code: <?= $manufacturer->zip_code ?> </p>
                        <p class="ml-5">City: <?= $manufacturer->city ?> </p>
                        <p class="ml-5">Country: <?= $manufacturer->country['name'] ?> </p>
                        <p class="ml-5">Products: </p>
                        @foreach($manufacturer->products as $m_product)
                            <p class="ml-10">Product name: <?= $m_product->name ?> </p>
                        @endforeach
                    @endforeach
                </div>
                <div class="w-1/3">
                    <p class="text-2xl font-bold my-5">Products: </p>
                    @foreach($products as $product)
                        <p>Product name: <?= $product->name ?></p>
                        <p class="ml-5">Manufacturer: <?= $product->manufacturer['name'] ?></p>

                    @endforeach
                </div>
            </div>


            <hr class="my-5">



{{--            <div class="container mx-auto bg-white h-50 w-full">--}}
{{--                @for($i = 0; $i < 2; $i++)--}}
{{--                <section class="step">--}}
{{--                    <p class="step-title text-3xl font-serif my-8">Stap <?= $i + 1 ?></p>--}}
{{--                    <div class="flex space-x-4">--}}
{{--                        @for($x = 0; $x < 3; $x++)--}}
{{--                            <div class="bg-white border-2 <?= $x == 2 ? 'border-indigo-600' : 'border-gray-200' ?> hover:border-indigo-500 hover w-1/4 my-5 rounded-lg cursor-pointer hover:shadow-lg transition-all">--}}
{{--                                <div class="border-b border-gray-300 p-5 flex">--}}
{{--                                    <div class="w-1/2 font-bold flex items-center">--}}
{{--                                        Product <?= $x + 1 ?>--}}
{{--                                        <svg class="text-gray-500 h-6 w-6 mx-3" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 32 32" stroke="currentColor">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                    <div class="w-1/2 text-right text-sm">--}}
{{--                                        + € 5,00--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="w-full flex justify-center items-center h-40">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />--}}
{{--                                    </svg>--}}
{{--                                </div>--}}
{{--                                <div class="px-10 py-5">--}}
{{--                                    <p class="text-xs text-gray-400 font-bold">Kleine omschrijving van het product of dienst. Mag niet langer zijn dan 64 tekens...</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endfor--}}
{{--                            <div class="bg-gray-50 border-2 border-gray-200 hover w-1/4 my-5 rounded-lg cursor-not-allowed transition-all">--}}
{{--                                <div class="border-b border-gray-300 p-5 flex">--}}
{{--                                    <div class="w-1/2 font-bold">--}}
{{--                                        Disabled product--}}
{{--                                    </div>--}}
{{--                                    <div class="w-1/2 text-right text-sm">--}}
{{--                                        + € 5,00--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="w-full flex justify-center items-center h-40">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />--}}
{{--                                    </svg>--}}
{{--                                </div>--}}
{{--                                <div class="px-10 py-5">--}}
{{--                                    <p class="text-xs text-gray-400 font-bold">Kleine omschrijving van het product of dienst.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                    </div>--}}

{{--                </section>--}}
{{--                @endfor--}}
{{--                <section class="step">--}}
{{--                    <p class="step-title text-3xl font-serif my-8">Stap</p>--}}
{{--                    <div class="flex space-x-4">--}}

{{--                    </div>--}}
{{--                </section>--}}
{{--                <section class="finished space-y-5">--}}
{{--                    <button class="bg-purple-500 p-5 rounded-lg w-full hover:shadow-lg text-white transition">Ik ben klaar</button>--}}
{{--                    <button class="bg-purple-500 opacity-80 pointer-events-none p-5 rounded-lg w-full hover:shadow-lg text-white transition">Ik ben klaar disabled</button>--}}
{{--                </section>--}}
{{--            </div>--}}
        </div>
        <div class="preview bg-gray-100 xl:w-4/12 w-full border-l border-gray-300 h-screen fixed top-0 right-0 shadow-lg">
            <div class="h-4/5">
                <div class="border-b border-gray-300 h-1/4 flex justify-center items-center">
                    Product preview
                </div>
                <div class="p-16">
                    <div class="border-b border-gray-300 py-6 flex">
                        <div class="w-1/2">
                            <p class="text-gray-500">Subtotaal</p>
                        </div>
                        <div class="w-1/2 text-right">
                            <p class="text-gray-500">€ 500.00</p>
                        </div>
                    </div>
                    <div class="border-b border-gray-300 py-6 flex">
                        <div class="w-1/2">
                            <p class="text-gray-500">Verzending</p>
                        </div>
                        <div class="w-1/2 text-right">
                            <p class="text-gray-500">GRATIS</p>
                        </div>
                    </div>
                    <div class="py-6 flex">
                        <div class="w-1/2">
                            <p class="text-black text-2xl font-serif">Totaal</p>
                        </div>
                        <div class="w-1/2 text-right">
                            <p class="text-black text-2xl font-serif">€ 500.00</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-300 p-16 space-y-2 h-1/5 ">
                <p class="font-bold">Need help?</p>
                <p class="text-gray-500"> We zijn er altijd</p>

                STEP TYPE: cards, tabs, list,
                Product: is optioneel. Als optioneel, optie need dankje
            </div>
        </div>
    </div>

@endsection

