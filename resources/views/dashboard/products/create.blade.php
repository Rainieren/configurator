@extends('layouts.dashboard')

@section('content')
    <div class="px-10 pt-5 pb-5 md:px-20 md:pt-10 md:pb-10">
        <div class="flex">
            <div class="w-100 lg:w-1/2 flex items-center">
                <p class="text-base md:text-lg lg:text-2xl xl:text-3xl font-extrabold text-gray-900">Create a new product</p>
            </div>
        </div>
    </div>
    <product-create-form></product-create-form>
@endsection
