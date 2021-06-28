@extends('layouts.dashboard')

@section('content')
    <div class="px-10 py-5 md:px-20 md:py-10 transition-all">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-base md:text-lg lg:text-2xl xl:text-3xl font-extrabold text-gray-900">Create a new step</p>
            </div>
        </div>
    </div>
    <step-create-form></step-create-form>
@endsection
