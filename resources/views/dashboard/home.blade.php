@extends('layouts.dashboard')

@section('content')
    <div class="px-20 pt-10 pb-10">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-bold text-indigo-900">Dashboard</p>
            </div>
        </div>
    </div>

    <div class="px-20">
        <statistics></statistics>
    </div>


@endsection
