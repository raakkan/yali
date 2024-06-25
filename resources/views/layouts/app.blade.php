<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

    {{ Vite::useHotFile(storage_path('vite.hot'))->useBuildDirectory('build')->withEntryPoints(['resources/css/admin.css', 'resources/js/admin.js']) }}
</head>

<body class="font-sans antialiased">
    <x-yali::global-loader />

    <nav class="navbar">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                    </button>
                    <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Flowbite</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="relative flex items-center ms-3" x-data="{ userDropdown: false }">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                @click="userDropdown = !userDropdown">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="user photo">
                            </button>
                        </div>
                        <div class="absolute top-6 right-0 z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:bg-gray-700 dark:divide-gray-600"
                            x-show="userDropdown" @click.outside="userDropdown = false">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    Neil Sims
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    neil.sims@flowbite.com
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside class="sidebar" id="logo-sidebar" aria-label="Sidebar">

        {{ app(Raakkan\Yali\Core\Support\Navigation\NavigationManager::class)->getNavigation()->render() }}

    </aside>

    <div class="p-2 md:p-4 sm:ml-64 bg-gray-100 dark:bg-gray-500">

        <div class="mt-16 md:mt-14">
            {{-- TODO: Breadcrumbs not finished yet --}}
            {{-- {{ Raakkan\Yali\Core\Support\Breadcrumb\Breadcrumb::make(request())->render() }} --}}

            {{ $slot }}
        </div>
    </div>

    @if (session('notification'))
        <div x-data="{ show: true }" class="fixed top-4 right-4 z-50 flex flex-col space-y-4 max-w-md w-full">
            @foreach (session('notification') as $notification)
                <div class="relative max-w-full p-3 rounded-lg shadow-lg overflow-hidden bg-gradient-to-r from-[#0f9c0f] to-[#6ad45c] text-white"
                    x-show="show">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white rounded-full p-0.5">
                                <svg class="w-8 h-8 text-[#6ad45c]" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 0C5.62 0 0 5.62 0 12s5.62 12 12 12 12-5.62 12-12S18.38 0 12 0zm5.3 9L11 15.3l-4.3-4.3 1.41-1.42L11 12.47l5.3-5.3 1.41 1.41z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold">{{ $notification['title'] }}</p>
                                <p class="text-sm">{{ $notification['content'] }}</p>
                            </div>
                        </div>
                        <button type="button" @click="show = false" class="text-white hover:text-gray-100">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18.364 5.636a1 1 0 010 1.414L13.414 12l5.95 5.95a1 1 0 01-1.414 1.414L12 13.414l-5.95 5.95a1 1 0 01-1.414-1.414L10.586 12 4.636 6.05a1 1 0 111.414-1.414L12 10.586l5.95-5.95a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

    @endif

    <x-yali::toast />
</body>

</html>
