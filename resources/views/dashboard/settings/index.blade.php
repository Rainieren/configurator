@extends('layouts.dashboard')

@section('content')
    <div class="px-10 py-5 md:px-20 md:py-10 transition-all">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-base md:text-lg lg:text-2xl xl:text-3xl font-extrabold text-gray-900">{{ __('Settings') }}</p>
            </div>
        </div>
    </div>
    <div class="px-10 md:px-20 transition-all">
        <div class="grid grid-cols-1 divide-y divide-gray-300">
            <div class="py-4 mb-5 w-1/2">
                <p class="text-xl font-medium">System</p>
                <p class="text-sm text-gray-500">Manage how information is displayed on the system</p>
            </div>
            <div class="flex justify-between py-6">
                <div class="text-gray-500 w-4/12 font-medium">
                    <p class="">Language</p>
                </div>
                <div class="w-6/12">
                    <p>Nederlands</p>
                </div>
                <div class="flex w-2/12 justify-end">
                    <a class="text-indigo-600 font-medium" href="">Update</a>
                </div>
            </div>
            <div class="flex justify-between py-6">
                <div class="text-gray-500 w-4/12 font-medium">
                    <p class="">Currency</p>
                </div>
                <div class="w-6/12">
                    <p>Euro</p>
                </div>
                <div class="flex w-2/12 justify-end">
                    <a class="text-indigo-600 font-medium" href="">Update</a>
                </div>
            </div>
            <div class="flex justify-between py-6">
                <div class="text-gray-500 w-4/12 font-medium">
                    <p class="">Measurements</p>
                </div>
                <div class="w-6/12">
                    <p>Metric</p>
                </div>
                <div class="flex w-2/12 justify-end">
                    <a class="text-indigo-600 font-medium" href="">Update</a>
                </div>
            </div>
        </div>
    </div>
@endsection
