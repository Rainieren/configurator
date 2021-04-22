@extends('layouts.dashboard')

@section('content')
    <div class="border-b px-5 py-3 bg-white">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-xl">Dashboard</p>
            </div>
            <div class="w-1/2 text-right">
                <button class="bg-indigo-600 py-2 px-4 text-white shadow-sm rounded">Nieuw product</button>
            </div>
        </div>
    </div>
    <div class="p-5">
        <p class="text-xl">Overview</p>
        <div class="grid grid-cols-3 gap-5 my-4">
            <div class="bg-white shadow-sm rounded">
                <div class="p-3">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-1 flex flex-column items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="col-span-3 flex flex-column justify-center">
                            <p class="m-0 font-bold text-gray-500">Total configured products</p>
                            <p class="m-0 text-xl font-bold">-</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-200 p-3">
                    <a href="" class="font-bold text-indigo-500">Show all</a>
                </div>
            </div>
            <div class="bg-white shadow-sm rounded">
                <div class="p-3 h-100 flex flex-column justify-center">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-1 flex flex-column items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="col-span-3 flex flex-column justify-center">
                            <p class="m-0 font-bold text-gray-500">Total revenue generated</p>
                            <p class="m-0 text-xl font-bold">€ - </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-sm rounded">
                <div class="p-3 h-100 flex flex-column justify-center">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-1 flex flex-column items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                        <div class="col-span-3 flex flex-column justify-center">
                            <p class="m-0 font-bold text-gray-500">Average configured product</p>
                            <p class="m-0 text-xl font-bold">€ - </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-10">
            <div class="">
                <p class="text-xl">Recent configurations</p>
                <div class="flex flex-col my-4">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                            <div class="shadow-sm overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-white">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Product
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Configuration
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @for($i = 0; $i < 3; $i++)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            Lamppost
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Lamp</div>
                                                <div class="text-sm ml-3 text-gray-600">- Yellow circular cover</div>
                                                <div class="text-sm ml-3 text-gray-600">- Brown 10 feet tall stand</div>
                                                <div class="text-sm ml-3 text-gray-600">- Built-in USB port</div>
                                                <div class="text-sm ml-3 text-gray-600">- LED Lights</div>
                                                <div class="text-sm ml-3 text-gray-600">- Built-in Google Assistent and Amazon Alexa</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                € 58,98
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <p class="text-xl">Most popular products</p>
                <div class="flex flex-col my-4">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                            <div class="shadow-sm overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-white">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Product
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Base price
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Amount
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @for($i = 0; $i < 3; $i++)
                                        <tr>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            Monitor
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                € 58,98
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">573</div>
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
