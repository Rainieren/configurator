@extends('layouts.dashboard')

@section('content')
    <div class="px-20 pt-10 pb-10">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-2xl font-bold">Products</p>
            </div>
            <div class="w-1/2 text-right">
                <a href="{{ route('createProduct') }}" type="button" class="w-full inline-flex justify-center rounded-md border border-blue-300 shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 hover:no-underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Nieuw product
                </a>
            </div>
        </div>
    </div>
    <div class="px-20">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                    {{ $products->links() }}
                    <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg shadow-sm rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
{{--                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Thumbnail--}}
{{--                                </th>--}}
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Last updated
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created at
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($products as $product)
                                    <tr>
{{--                                        <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                            <img src="{{ $product->thumbnail }}" class="h-16 w-16 rounded bg-cover" alt="">--}}
{{--                                        </td>--}}
                                        <td class="px-6 py-3 whitespace-nowrap">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            <div class="p m-0 text-gray-600">{{ substr($product->description, 0, 32) }}</div>
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                           {{ $product->stock }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            @if($product->status == 1)
                                                <div class="bg-green-200 text-green-800 text-sm rounded-full font-medium text-center w-auto">Active</div>
                                            @else
                                                <div class="bg-red-200 text-red-800 text-sm rounded-full font-medium text-center">Inactive</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            € {{ $product->price }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            {{ $product->updated_at->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            {{ $product->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-3 whitespace-nowrap text-sm">
                                            <div class="flex space-x-4">
                                                <a href="" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                                <a href="" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('showProduct', ['id' => $product->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
