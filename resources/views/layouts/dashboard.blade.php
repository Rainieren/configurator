<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="text-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
    <body class="antialiased bg-white">
        <div class="w-20 bg-gray-100 h-screen fixed justify-between flex flex-col">
            <div class="w-full h-auto bg-indigo-500 flex items-center justify-center rounded mb-5 text-white word-break p-2">
                Logo
            </div>
            <ul class="h-auto space-y-6 mb-auto p-4">
                <li class="flex justify-center hover:bg-indigo-500 py-2.5 w-auto rounded-lg cursor-pointer text-gray-500 hover:text-gray-50 transition-all">
                    <a href=""></a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </li>
                <li class="flex justify-center hover:bg-indigo-500 py-2.5 rounded-lg cursor-pointer text-gray-500 hover:text-gray-50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </li>
                <li class="flex justify-center hover:bg-indigo-500 py-2.5 rounded-lg cursor-pointer text-gray-500 hover:text-gray-50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </li>
                <li class="flex justify-center hover:bg-indigo-500 py-2.5 rounded-lg cursor-pointer text-gray-500 hover:text-gray-50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </li>
                <li class="flex justify-center hover:bg-indigo-500 py-2.5 rounded-lg cursor-pointer text-gray-500 hover:text-gray-50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </li>
                <div class="border border-gray-200 w-full"></div>
                <li class="flex justify-center hover:bg-indigo-500 py-2.5 rounded-lg cursor-pointer text-gray-500 hover:text-gray-50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                    </svg>
                </li>
                <li class="flex justify-center hover:bg-indigo-500 py-2.5 rounded-lg cursor-pointer text-gray-500 hover:text-gray-50 transition-all relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <div class="absolute h-4 w-4 text-sm rounded-full p-2.5 bg-red-500 text-white flex items-center justify-center top-0 right-2 shadow-md">
                        1
                    </div>
                </li>
            </ul>

            <div class="h-auto flex items-center justify-center p-4">
                <img class="inline-block h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </div>
        </div>
        <div class="ml-20 w-64 bg-white h-screen fixed justify-between flex flex-col shadow-md">
            <div class="h-auto w-full p-8 rounded flex items-center mb-3 border-b-2 border-gray-100">
                <a href="{{ redirect()->back() }}" class="flex items-center hover:text-indigo-500 hover:no-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg> Ga terug
                </a>
            </div>
            <ul class="space-y-2 mb-auto  h-auto p-4">
                <li>
                    <a href="{{ route('home') }}" class="p-2.5 px-4 flex transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('home') ? 'bg-indigo-600 text-white' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('configurator') }}" class="p-2.5 px-4 flex transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('configurator') ? 'bg-indigo-600 text-white' : '' }}">
                        Configurators
                    </a>
                </li>
                <li>
                    <a href="{{ route('products') }}" class="p-2.5 px-4  flex transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('products') ? 'bg-indigo-600 text-white' : '' }}">
                        Products
                    </a>
                </li>
                <li>
                    <a href="{{ route('steps') }}" class="p-2.5 px-4  flex transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('steps') ? 'bg-indigo-600 text-white' : '' }}">
                        Steps
                    </a>
                </li>
                <li>
                    <a href="{{ route('manufacturers') }}"  class="p-2.5 px-4  flex transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('manufacturers') ? 'bg-indigo-600' : '' }}">
                        Manufacturers
                    </a>
                </li>

                <li>
                    <p class="text-xs p-2 text-gray-800  font-semibold uppercase tracking-widest">Overig</p>
                </li>

                <li>
                    <a href="" class="p-2.5 px-4  flex transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('settings') ? 'bg-indigo-600 text-white hover:text-gray-800' : '' }}">
                        Settings
                    </a>
                </li>
                <li>
                    <a href="" class="p-2.5 px-4  flex transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('privacy') ? 'bg-indigo-600 text-white hover:text-gray-800' : '' }}">
                        Privacy
                    </a>
                </li>
                <li>
                    <a href="/" class="p-2.5 px-4  flex transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium">
                        Go to configurator
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"  class="p-2.5 px-4  flex transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </li>
            </ul>
        </div>
        <div class="ml-80" id="dashboard">
            @yield('content')
            <flash message="{{ session('flash') }}"></flash>
        </div>
    </body>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</html>
