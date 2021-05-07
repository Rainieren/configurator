<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
    <body class="antialiased bg-white">
        <div class="w-80 bg-gray-100 h-screen border-r border-gray-200 fixed justify-between flex flex-col">
            <div class="h-auto w-full p-2 rounded flex items-center justify-center mb-3">
                Logo
            </div>

            <ul class="space-y-2 mb-auto  h-auto p-3">
                <li>
                    <a href="{{ route('home') }}" class="hover:bg-gray-200 p-2 text-gray-600 rounded transition flex items-center hover:no-underline hover:font-bold hover:text-gray-800 {{ Route::currentRouteNamed('home') ? 'bg-gray-200 font-medium text-gray-800 hover:text-gray-800' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('configurator') }}" class="hover:bg-gray-200 p-2 text-gray-600 rounded transition flex items-center hover:no-underline hover:font-bold hover:text-gray-800 {{ Route::currentRouteNamed('configurator') ? 'bg-gray-200 font-medium text-gray-800 hover:text-gray-800' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        Configurator
                    </a>
                </li>
                <li>
                    <a href="{{ route('products') }}" class="hover:bg-gray-200 p-2 text-gray-600 rounded transition flex items-center hover:no-underline hover:text-gray-800 {{ Route::currentRouteNamed('products') ? 'bg-gray-200 font-medium text-gray-800 hover:text-gray-800' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        Products
                    </a>
                </li>
                <li>
                    <a href="{{ route('steps') }}" class="hover:bg-gray-200 p-2 text-gray-600 rounded transition flex items-center hover:no-underline hover:text-gray-800 {{ Route::currentRouteNamed('steps') ? 'bg-gray-200 font-medium text-gray-800 hover:text-gray-800' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Steps
                    </a>
                </li>
                <li>
                    <a href=""  class="hover:bg-gray-200 p-2 text-gray-600 rounded transition flex items-center hover:no-underline hover:text-gray-800 {{ Route::currentRouteNamed('manufacturers') ? 'bg-gray-200 font-medium text-gray-800 hover:text-gray-800' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Manufacturers
                    </a>
                </li>

                <li>
                    <p class="text-xs p-2 text-gray-500 font-semibold uppercase tracking-widest">Overig</p>
                </li>

                <li>
                    <a href="" class="hover:bg-gray-200 p-2 text-gray-600 rounded transition flex items-center hover:no-underline hover:text-gray-800 {{ Route::currentRouteNamed('settings') ? 'bg-gray-200 font-medium text-gray-800 hover:text-gray-800' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 transition hover:rotate-90 animate" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Settings
                    </a>
                </li>
                <li>
                    <a href="" class="hover:bg-gray-200 p-2 text-gray-600 rounded transition flex items-center hover:no-underline hover:text-gray-800 {{ Route::currentRouteNamed('privacy') ? 'bg-gray-200 font-medium text-gray-800 hover:text-gray-800' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                        Privacy
                    </a>
                </li>
                <li>
                    <a href="/" class="hover:bg-gray-200 p-2 text-gray-600 rounded transition flex items-center hover:no-underline hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Go to configurator
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"  class="hover:bg-gray-200 p-2 text-gray-600 rounded transition flex items-center hover:no-underline hover:text-gray-800" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </li>
            </ul>
            <div class="h-auto border-t border-gray-200 p-3">
                <div class="grid grid-cols-4 gap-4 ">
                    <div class="col-span-1 flex flex-column items-center">
                        <img class="inline-block h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    </div>
                    <div class="col-span-3 flex flex-column justify-center">
                        <p class="m-0 font-medium"><?= $user = Auth::user()->name; ?></p>
                        <a class="m-0 text-gray-500">View profile</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ml-80" id="dashboard">
            @yield('content')
            <flash message="{{ session('flash') }}"></flash>
        </div>
    </body>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</html>
