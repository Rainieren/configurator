@extends('layouts.dashboard')

@section('content')
    <div class="px-10 py-5 md:px-20 md:py-10 transition-all">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-bold text-gray-900">Summaries</p>
            </div>
            <div class="w-1/2 text-right">

            </div>
        </div>
    </div>
    <div class="px-10 md:px-20 transition-all">

        @if(count($summaries) == 0)
            <div class="w-100 text-center flex items-center justify-center flex-column">
                <p class="font-medium text-lg">{{ __('You dont have any products yet. Create a product using the button in the top right corner.') }}</p>
                <img src="{{ asset('images/empty_1.svg') }}" class="w-25 my-24" alt="">
            </div>
        @else
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                    <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                        {{ $summaries->links() }}
                        <div class="border-b border-gray-200 sm:rounded-lg shadow-md rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 ">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product configured
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount of options
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Code
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created at
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Updated at
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($summaries as $summary)
                                    <tr>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            {{ $summary->products[0]['name'] }}

                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            {{ $summary->options->count() }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            {{ $summary->code }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            € {{ $summary->total }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm hidden">
                                            <div class="flex">
                                                <div class="bg-yellow-200 text-yellow-800 text-sm rounded-lg p-1 px-3 font-medium text-center w-auto">Open</div>
                                            </div>
                                            <div class="flex">
                                                <div class="bg-orange-200 text-orange-800 text-sm rounded-lg p-1 px-3 font-medium text-center w-auto">Pending</div>
                                            </div>
                                             <div class="flex">
                                                 <div class="bg-green-200 text-green-800 text-sm rounded-lg p-1 px-3 font-medium text-center w-auto">Paid</div>
                                             </div>
                                            <div class="flex">
                                                <div class="bg-red-200 text-red-800 text-sm rounded-lg p-1 px-3 font-medium text-center w-auto">Failed</div>
                                            </div>
                                            <div class="flex">
                                                <div class="bg-gray-200 text-gray-800 text-sm rounded-lg p-1 px-3 font-medium text-center w-auto">Cancelled</div>
                                            </div>
                                            <div class="flex">
                                                <div class="bg-gray-200 text-gray-800 text-sm rounded-lg p-1 px-3 font-medium text-center w-auto">Expired</div>
                                            </div>

                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            {{ $summary->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            {{ $summary->updated_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $summaries->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
