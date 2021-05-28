@extends('layouts.dashboard')

@section('content')
    <div class="px-20 pt-10 pb-10">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-bold text-gray-900">Create a new product</p>
            </div>
        </div>
    </div>
    <product-create-form></product-create-form>
@endsection
