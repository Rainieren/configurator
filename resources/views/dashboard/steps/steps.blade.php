@extends('layouts.dashboard')

@section('content')
    <div class="px-10 py-5 md:px-20 md:py-10 transition-all">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-bold text-gray-900">Steps</p>
            </div>
            <div class="w-1/2 text-right">
                <a href="{{ route('createStep') }}" type="button" class="inline-flex justify-center rounded-md border border-indigo-300 shadow-sm p-2 lg:px-4 lg:py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 hover:no-underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    <span class="hidden lg:block">New step</span>
                    <span class="block lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="px-10 md:px-20 transition-all">
        <step-list :steps="{{ $steps }}"></step-list>
    </div>
@endsection
