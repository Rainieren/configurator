@extends('layouts.dashboard')

@section('content')
    <div class="p-10 md:px-20 md:py-10 transition-all">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-bold text-gray-900">Dashboard</p>
            </div>
        </div>
    </div>

    <div class="px-10 md:px-20 transition-all">
        <statistics></statistics>
    </div>


@endsection
