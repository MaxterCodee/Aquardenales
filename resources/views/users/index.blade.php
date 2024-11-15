<x-app-layout>
    <div class=" mt-10">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Usuarios</h1>
            <button data-modal-target="crear-usuario" data-modal-toggle="crear-usuario" type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Añadir usuario
            </button>


            <!-- Modal toggle -->
            {{-- <button
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Toggle modal
            </button> --}}

            <!-- Main modal -->
            <div id="crear-usuario" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Crear nuevo usuario
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="crear-usuario">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                                <input type="text" id="name" name="name"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo
                                    Electrónico:</label>
                                <input type="email" id="email" name="email"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                @error('email')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password"
                                    class="block text-gray-700 text-sm font-bold mb-2">Contraseña:</label>
                                <input type="password" id="password" name="password"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                @error('password')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation"
                                    class="block text-gray-700 text-sm font-bold mb-2">Confirmar Contraseña:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="role_name" class="block text-gray-700 text-sm font-bold mb-2">Rol:</label>
                                <select id="role_name" name="role_name"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="">Seleccione un rol</option>
                                    <!-- Suponiendo que tienes una variable roles que contiene los roles disponibles -->
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-between">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Crear Usuario
                                </button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>

        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 border-b border-gray-200 text-left">ID</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Nombre</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Email</th>
                        <th class="py-3 px-4 border-b border-gray-200 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-100">
                        <td class="py-3 px-4 border-b border-gray-200">1</td>
                        <td class="py-3 px-4 border-b border-gray-200">Juan Pérez</td>
                        <td class="py-3 px-4 border-b border-gray-200">juan@example.com</td>
                        <td class="py-3 px-4 border-b border-gray-200">
                            <button class="text-blue-600 hover:underline">Editar</button>
                            <button class="text-red-600 hover:underline">Eliminar</button>
                        </td>
                    </tr>
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
