@extends('layouts.app')

@section('content')
    <div class="bg-white w-full h-screen flex flex-column justify-center p-20">
        <div class="w-2/6 space-y-4">
            <div class="">
                <p class="text-3xl font-extrabold">Summary #{{ $summary->code }}</p>
                <p class="text-gray-500 text-lg">Placed on {{ $summary->created_at->toFormattedDateString() }}</p>
            </div>
            <div class="">
                <div class="flex justify-between">
                    <p class="text-lg font-extrabold">{{ $summary->products[0]->name }}</p>
                    <p class="text-lg font-extrabold">€ {{ $summary->products[0]->price }}</p>
                </div>
                <?php $sum = 0; ?>
                @foreach($summary->options as $option)
                    <?php $sum += $option->price ?>
                    <div class="flex justify-between">
                        <p class="ml-5 text-gray-500">{{ $option->name }}</p>
                        <p class="ml-5 text-gray-500">€ {{ $option->price }}</p>
                    </div>
                @endforeach
                <div class="flex justify-between my-5">
                    <p class="text-lg font-extrabold">Totaal</p>
                    <p class="text-lg font-extrabold">€ {{ $summary->products[0]->price + $sum }}</p>
                </div>
            </div>
            <div class="flex justify-between">
                <a href="/dashboard/configurators" type="button" class="w-full xl:w-auto inline-flex items-center justify-center rounded-md border border-gray-300 shadow-sm px-4 mt-2 xl:mt-0 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download
                </a>
            </div>
        </div>

    </div>
@endsection
