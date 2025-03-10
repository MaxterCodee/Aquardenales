<div>
    <style>
        .container {
            position: relative;
            width: 300px;
            height: 500px;
        }
        canvas {
            position: absolute;
            top: 0;
            left: 0;
        }
        #water {
            z-index: 1;
        }
        #tank {
            z-index: 0;
        }
    </style>
    <aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 rounded-lg
                        {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group' }}">
                    <svg class="w-5 h-5
                        {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500' }}
                        transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('users.index') }}"
                    class="flex items-center p-2 rounded-lg
                        {{ request()->routeIs('users.index') ? 'bg-blue-600 text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group' }}">
                    <svg class="flex-shrink-0 w-5 h-5
                        {{ request()->routeIs('users.index') ? 'text-white' : 'text-gray-500' }}
                        transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path d="M10 10a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0 2c-5.333 0-8 2.667-8 6v1h16v-1c0-3.333-2.667-6-8-6z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Usuarios</span>
                    {{-- <span
                        class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span> --}}
                </a>
            </li>





        </ul>
    </div>
</aside>
</div>
