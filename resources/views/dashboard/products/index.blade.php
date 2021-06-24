@extends('layouts.dashboard')

@section('content')
    <div class="px-20 pt-10 pb-10">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-extrabold text-gray-900">{{ $product->name }}</p>
            </div>
        </div>
    </div>
    <div class="px-20">
        <div class="flex space-x-6">
            <div class="h-100 shadow w-4/6 bg-white p-5 border border-gray-200 rounded-lg">
                <div class="flex">
                    <div class="w-1/2 flex items-center justify-center">
                        <img src="{{ $product->thumbnail }}" alt="">
                    </div>
                    <div class="w-1/2 flex flex-column space-y-4">
                        <div class="w-100">
                            <p class="font-medium text-lg">{{ $product->name }}</p>
                            <p class=" text-gray-500 text-lg">€ {{ $product->price }}</p>
                        </div>
                       <div class="w-100 break-words">
                           <p class="font-medium">Description</p>
                           <p class="text-gray-500">{{ $product->description }}</p>
                       </div>

                        <div class="">
                            <p class="font-medium">Attributes:</p>
                            <ul class="list-unstyled text-gray-500 w-50">
                                <li class="flex w-100 justify-between"><span>Stock:</span> <span>{{ $product->stock ? 'In stock' : 'Out of stock' }}</span></li>
                                <li class="flex w-100 justify-between"><span>Visible:</span> <span>{{ $product->visibility ? 'True' : 'False' }}</span></li>
                                <li class="flex w-100 justify-between"><span>Enabled:</span> <span>{{ $product->status ? 'True' : 'False' }}</span></li>
                                <li class="flex w-100 justify-between"><span>SKU:</span> <span>{{ $product->sku }}</span></li>
                                <li class="flex w-100 justify-between"><span>Width:</span> <span>{{ $product->width }}</span></li>
                                <li class="flex w-100 justify-between"><span>Height:</span> <span>{{ $product->height }}</span></li>
                                <li class="flex w-100 justify-between"><span>Length:</span> <span>{{ $product->length }}</span></li>
                                <li class="flex w-100 justify-between"><span>Weight:</span> <span>{{ $product->weight }}</span></li>
                                <li class="flex w-100 justify-between"><span>Created by:</span> <span>{{ $product->user->name }}</span></li>
                                <li class="flex w-100 justify-between"><span>Interaction type:</span> <span>@if ($product->interaction_type) {{ $product->interaction_type->name }} @else {{ __('No interaction type') }} @endif</span></li>
                                <li class="flex w-100 justify-between"><span>Manufacturer:</span> <span>@if ($product->manufacturer) {{ $product->manufacturer->name }} @else {{ __('No manufacturer') }} @endif</span></li>
                                <li class="flex w-100 justify-between"><span>Step:</span> <span>@if ($product->step) {{ $product->step->name }} @else {{ __('No step') }} @endif</span></li>
                                <li class="flex w-100 justify-between"><span>Configurable:</span> <span>{{ $product->configurable ? 'True' : 'False' }}</span></li>
                                <li class="flex w-100 justify-between"><span>Configurator:</span> <span>@if ($product->configurator_id) {{ $product->configurator->name }} @else {{ __('No configurator') }} @endif</span></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
