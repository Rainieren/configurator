@extends('layouts.dashboard')

@section('content')
    <div class="border-b px-5 py-3 bg-white">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-xl">{{ $product->name }}</p>
            </div>
        </div>
    </div>
    <div class="p-5">
        <div class="flex space-x-6">
            <div class="h-100 shadow-sm w-2/6 bg-white p-4">
                <p class="text-xl font-bold">{{ $product->name }}</p>
{{--                <p>Dit product hoort zelf bij deze stap: {{ $product->step->name }}</p>--}}
{{--                <p>Ik hoor bij: {{ $product->step['name'] }}</p>--}}
{{--                <p>Maar ikzelf heb deze stappen:</p>--}}

            </div>
{{--            <div class="w-2/6 space-y-6">--}}
{{--                <p class="text-xl mb-3">This product is configurable with:</p>--}}
{{--                <div class="shadow">--}}
{{--                    <div class="relative bg-white h-100 w-100 rounded-md transition p-4">--}}
{{--                        <p class="text-xl mb-3">Step name</p>--}}
{{--                        <div class="space-y-6">--}}
{{--                            <div class="">--}}
{{--                                <a href="">--}}
{{--                                    <div class="border-2 border-dashed border-gray-400 hover:border-indigo-500 hover:text-indigo-500 w-100 p-2 cursor-pointer  flex-column rounded-md flex justify-center items-center transition">--}}
{{--                                        <p>Add product</p>--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="">--}}
{{--                    <a href="">--}}
{{--                        <div class="border-2 border-dashed border-gray-400 hover:border-indigo-500 hover:text-indigo-500 h-56 w-100  flex-column rounded-md flex justify-center items-center transition">--}}
{{--                            <p>Add a step</p>--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--            </div>--}}

        </div>
    </div>
@endsection
