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
        <div class="w-20 xl:block xl:w-80 bg-white h-screen fixed justify-between flex flex-col shadow-md transition-all">
            <div class="h-auto w-full p-8 rounded flex items-center mb-3 border-b-2 border-gray-100">
                <a href="{{ url()->previous() }}" class="flex items-center hover:text-indigo-500 hover:no-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    <span class="hidden lg-block">Go back</span>
                </a>
            </div>
            <ul class="space-y-2 mb-auto  h-auto p-4">
                <li>
                    <a href="{{ route('home') }}" class="p-2.5 xl:px-4 px-2 flex justify-center xl:justify-start transition items-center hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('home') ? 'bg-indigo-600 text-white' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xl:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                        <span class="hidden xl:block">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('configurators') }}" class="p-2.5 xl:px-4 px-2 flex justify-center xl:justify-start transition items-center hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('configurators') ? 'bg-indigo-600 text-white' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xl:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        <span class="hidden xl:block">Configurators</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products') }}" class="p-2.5 xl:px-4 px-2 flex justify-center xl:justify-start transition items-center hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('products') ? 'bg-indigo-600 text-white' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xl:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        <span class="hidden xl:block">Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('steps') }}" class="p-2.5 xl:px-4 px-2 flex justify-center xl:justify-start transition items-center hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('steps') ? 'bg-indigo-600 text-white' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xl:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span class="hidden xl:block">Steps</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('manufacturers') }}"  class="p-2.5 xl:px-4 px-2 justify-center xl:justify-start flex transition items-center hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('manufacturers') ? 'bg-indigo-600 text-white' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xl:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="hidden xl:block">Manufacturers</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('summaries') }}"  class="p-2.5 xl:px-4 px-2 justify-center xl:justify-start flex transition items-center hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('summaries') ? 'bg-indigo-600 text-white' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xl:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="hidden xl:block">Summaries</span>
                    </a>
                </li>

                <li>
                    <p class="text-xs p-2 text-gray-800  font-semibold uppercase tracking-widest">Other</p>
                </li>

                <li>
                    <a href="{{ route('settings') }}" class="p-2.5 xl:px-4 px-2 flex justify-center xl:justify-start transition items-center hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium {{ Route::currentRouteNamed('settings') ? 'bg-indigo-600 text-white' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xl:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="hidden xl:block">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="/" class="p-2.5 xl:px-4 px-2 flex justify-center xl:justify-start transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xl:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        <span class="hidden xl:block">Configurator</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"  class="p-2.5 xl:px-4 px-2 flex justify-center xl:justify-start transition items-center text-gray-800 hover:text-gray-50 hover:no-underline rounded-md hover:bg-indigo-500 hover:font-medium" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 xl:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="hidden xl:block">Logout</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </li>
            </ul>
        </div>
        <div class="xl:ml-80 ml-20 transition-all" id="dashboard">
            @yield('content')
            <flash message="{{ session('flash') }}"></flash>
        </div>
    </body>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</html>
