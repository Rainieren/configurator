@extends('layouts.app')

@section('content')
    <div class="flex">
        <div class="configurator bg-red-500 w-8/12 h-screen p-20">
            <div class="container mx-auto bg-green-500 h-50 w-full p-5">
                <section class="step">
                    <p class="step-title text-2xl">Step 1</p>
                    <div class="flex space-x-4">
                        @for($i = 0; $i < 3; $i++)
                            <div class="bg-gray-100 w-1/3 h-40 my-5 rounded cursor-pointer hover:shadow-lg transition-shadow">
                                <div class="border-b border-gray-300 p-5 flex">
                                    <div class="w-1/2 font-bold">
                                        Product naam
                                    </div>
                                    <div class="w-1/2 text-right text-sm">
                                        + € 5,00
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                </section>
            </div>
        </div>
        <div class="preview bg-gray-100 w-4/12 h-20 border-l border-gray-300 h-screen fixed top-0 right-0 shadow-lg">
            <div class="border-b border-gray-300 h-1/4 flex justify-center items-center">
                Product preview
            </div>
            <div class="p-16">
                <div class="border-b border-gray-300 py-6 flex">
                    <div class="w-1/2">
                        <p class="text-gray-500">Subtotal</p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-gray-500">€ 500.00</p>
                    </div>
                </div>
                <div class="border-b border-gray-300 py-6 flex">
                    <div class="w-1/2">
                        <p class="text-gray-500">Shipping</p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-gray-500">FREE</p>
                    </div>
                </div>
                <div class="py-6 flex">
                    <div class="w-1/2">
                        <p class="text-black text-2xl font-bold">Total</p>
                    </div>
                    <div class="w-1/2 text-right">
                        <p class="text-black text-2xl font-bold">€ 500.00</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

@endsection

