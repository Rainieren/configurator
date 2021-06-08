@extends('layouts.dashboard')

@section('content')
    <div class="px-10 py-5 md:px-20 md:py-10 transition-all">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-bold text-gray-900">Configurators</p>
            </div>
            <div class="w-1/2 text-right">
                <a href="{{ route('createConfigurator') }}" type="button" class="inline-flex justify-center rounded-md border border-indigo-300 shadow-sm p-2 lg:px-4 lg:py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 hover:no-underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    <span class="hidden lg:block">Nieuwe configurator</span>
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
        {{ $sum = 0 }}
        @foreach($summaries as $summary)
            {{ $summary->id }}
            <ul>
                @foreach($summary->products as $product)
                    <li>{{ $product->name }}</li>
                    {{ $sum += $product->price }}
                @endforeach
            </ul>
        @endforeach
        {{ $sum }}
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 ">
                <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg shadow-md rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead class="bg-white">
                            <tr>
                                {{--                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
                                {{--                                    Thumbnail--}}
                                {{--                                </th>--}}
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Theme color
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Language
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
                            @foreach($configurators as $configurator)
                                <tr>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm">
                                        {{ $configurator->name }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm">
                                        <div class="h-5 w-5 block rounded-md" style="background-color: {{ $configurator->theme_color }}"></div>
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm">
                                        {{ $configurator->language_id }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm">
                                        {{ $configurator->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm">
                                        {{ $configurator->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm">
                                        <div class="flex space-x-4">
                                            <a href="{{ route('editConfigurator', ['id' => $configurator->id]) }}" class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <form action="/dashboard/configurator/{{$configurator->id}}/delete" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <a href="{{ route('showProduct', ['id' => $configurator->id]) }}">
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

                </div>
            </div>
        </div>
    </div>
@endsection
