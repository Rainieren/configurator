@extends('layouts.dashboard')

@section('content')
    <div class="px-20 pt-10 pb-10">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-bold text-gray-900">{{ $product->name }}</p>
            </div>
        </div>
    </div>
    <div class="px-20">
        <div class="flex space-x-6">
            <div class="h-100 shadow-sm w-2/6 bg-white p-4">
                <p class="text-xl font-bold">{{ $product->name }}</p>
            </div>
        </div>
    </div>
@endsection
