@extends('layouts.dashboard')

@section('content')
    <div class="px-20 pt-10 pb-10">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-bold text-indigo-900">Steps</p>
            </div>
            <div class="w-1/2 text-right">
                <a href="{{ route('createStep') }}" type="button" class="w-full inline-flex justify-center rounded-md border border-indigo-300 shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 hover:no-underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Nieuwe step
                </a>
            </div>
        </div>
    </div>
    <div class="px-20">
        <step-list :steps="{{ $steps }}"></step-list>
    </div>
@endsection
