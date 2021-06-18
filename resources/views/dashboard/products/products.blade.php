@extends('layouts.dashboard')

@section('content')
    <div class="px-10 py-5 md:px-20 md:py-10 transition-all">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-bold text-gray-900">Products</p>
            </div>
            <div class="w-1/2 text-right">
                <a href="{{ route('createProduct') }}" type="button" class="inline-flex justify-center rounded-md border border-indigo-300 shadow-sm p-2 lg:px-4 lg:py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 hover:no-underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    <span class="hidden lg:block">New product</span>
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

        @if(count($products) == 0)
            <div class="w-100 text-center flex items-center justify-center flex-column">
                <p class="font-medium text-lg">{{ __('You dont have any products yet. Create a product using the button in the top right corner.') }}</p>
                <img src="{{ asset('images/empty_1.svg') }}" class="w-25 my-24" alt="">
            </div>
        @else
            <div class="flex space-x-4 align-items-center">
                <input type="text" class="appearance-none block border border-gray-200 p-2 pr-6 rounded-md w-64 shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="Search..." autofocus>
                <select id="country" name="country" autocomplete="country" class="appearance-none block border border-gray-200 p-2 pr-6 rounded-md w-64 shadow-sm focus:border-indigo-500 focus:outline-none">
                    <option>ID</option>
                    <option>Name</option>
                    <option>Description</option>
                    <option>Created_at</option>
                    <option>Updated_at</option>
                </select>
                <a href="" class="border border-gray-200 rounded-md hover:shadow-md transition p-2 hover:text-indigo-500 flex items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                    </svg>
                </a>
                <a href="" class="border border-gray-200 rounded-md hover:shadow-md transition p-2 hover:text-indigo-500 flex items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                    </svg>
                </a>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                    <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                        {{ $products->links() }}
                        <div class="border-b border-gray-200 sm:rounded-lg shadow-md rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 ">
                                <thead class="bg-white">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Thumbnail
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        In stock
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Visibility
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created by
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
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                <img src="{{ $product->thumbnail }}" class="h-12 w-12 rounded bg-cover" alt="">
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                {{ $product->name }}
                                            </td>

                                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                @if($product->stock == 1)
                                                    <span class="text-green-500 font-medium font-sm flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                        </svg>
                                                        In stock
                                                    </span>
                                                @else
                                                    <span class="text-red-500 font-medium font-sm flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                        </svg>
                                                        Out of stock
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                {{ $product->configurable ? "Configurable product" : "Option" }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                @if($product->status == 1)
                                                    <div class="bg-green-200 text-green-800 text-sm rounded-full font-medium text-center w-auto">Active</div>
                                                @else
                                                    <div class="bg-red-200 text-red-800 text-sm rounded-full font-medium text-center">Inactive</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                @if($product->visibility == 1)
                                                    <div class="bg-green-200 text-green-800 text-sm rounded-full font-medium text-center w-auto">Visible</div>
                                                @else
                                                    <div class="bg-red-200 text-red-800 text-sm rounded-full font-medium text-center">Invisible</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                @if($product->price)
                                                    € {{ $product->price }}
                                                @else
                                                    + {{ $product->percentage_increase }} %
                                                @endif
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                {{ $product->user->name }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                {{ $product->updated_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                {{ $product->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                <div class="flex space-x-4">
                                                    <a href="{{ route('editProduct', ['id' => $product->id]) }}" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </a>
                                                    <form action="/dashboard/product/{{$product->id}}/delete" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
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
        @endif
    </div>
@endsection
