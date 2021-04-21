@extends('layouts.app')

@section('content')
    <div class="loading-screen absolute w-screen h-screen flex justify-center items-center bg-white z-20 flex-col overflow-hidden hidden">

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
                        <p><span class="text-blue-600 font-bold"></span>Manufacturer: <?= $manufacturer->name ?></p>
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
                        <p><span class="text-blue-600 font-bold">Product name:</span> <?= $product->name ?> ID: <?= $product->id ?></p>
                        <p class="ml-5"><span class="text-green-600 font-bold">Manufacturer:</span> <?= $product->manufacturer['name'] ?></p>
                        <p class="ml-5 text-yellow-600 font-bold">Sub products:</p>
                        @foreach($product->products as $subProduct)
                            <p class="ml-10"><span class="text-purple-600 font-bold">Product name: </span><?= $subProduct['name'] ?> ID: <?= $subProduct['id'] ?></p>
                            <p class="ml-16"><span class="text-pink-600 font-bold">Manufacturer name:</span> <?= $subProduct->manufacturer['name'] ?></p>
                            @foreach($subProduct->products as $subSubProduct)
                                <p class="ml-24"><span class="text-red-600 font-bold">Product name: </span><?= $subSubProduct['name'] ?> ID: <?= $subSubProduct['id'] ?></p>
                                <p class="ml-28"><span class="text-yellow-300 font-bold">Manufacturer name:</span> <?= $subSubProduct->manufacturer['name'] ?></p>
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
            </div>

                    </div>
                </section>
                <section class="finished space-y-5">
                    <button class="bg-purple-500 p-5 rounded-lg w-full hover:shadow-lg text-white transition">Ik ben klaar</button>
                    <button class="bg-purple-500 opacity-80 pointer-events-none p-5 rounded-lg w-full hover:shadow-lg text-white transition">Ik ben klaar disabled</button>
                </section>
            </div>
        </div>
        <div class="preview bg-gray-100 xl:w-4/12 w-full border-l border-gray-300 h-screen fixed top-0 right-0 shadow-md">
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

