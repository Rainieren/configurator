@extends('layouts.dashboard')

@section('content')
    <div class="px-20 pt-10 pb-10">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-2xl font-bold">Dashboard</p>
            </div>
        </div>
    </div>

    <div class="px-20">
        <statistics></statistics>
        <div class="grid grid-cols-2 gap-10">
            <div class="">
                <p class="text-xl">Recent configurations</p>
                <div class="flex flex-col my-4">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                            <div class="shadow-sm overflow-hidden border-b border-gray-200 rounded-md">
                                <table class="min-w-full divide-y rounded-md divide-gray-200 border border-gray-100">
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
                            <div class="shadow-sm overflow-hidden border-b border-gray-200 rounded-md">
                                <table class="min-w-full divide-y divide-gray-200 rounded-md border border-gray-100">
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
