<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-js/1.0.0/markdown.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">

        @component('components.navbar')
        @endcomponent

        @component('components.sidebar')
        @endcomponent

        <br>

        <div class="p-4 sm:ml-64">
            <main>
                {{ $slot }}
            </main>
        </div>
        {{--
        <a href="#" class="fixed bottom-4 right-4 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition duration-200 ease-in-out">
            <!-- Icono del botón (puedes usar un icono de Font Awesome, Heroicons, etc.) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v16H4z" />
            </svg>
        </a> --}}
        <!-- Botón para abrir el chatbot -->
        <a href="#" id="chatbot-toggle"
            class="fixed bottom-4 right-4 bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition duration-200 ease-in-out">
            <img src="{{ asset('icons/chat.svg') }}" alt="Chat" class="w-6 h-6">
        </a>

        <!-- Contenedor del chatbot -->
        <style>
            #chatbot {
                width: 620px;
                /* Duplicar el tamaño original de 160px */
                height: 500px;
                /* Duplicar el tamaño original de 200px */
            }
        </style>

        <div id="chatbot"
            class="fixed bottom-20 right-4 bg-white shadow-lg rounded-lg hidden transition-all duration-300 ease-in-out">
            <div class="flex items-center justify-between p-4 border-b">
                <h2 class="text-lg font-semibold">Chatbot</h2>
                <button id="chatbot-close" class="text-gray-600 hover:text-gray-800">
                    &times; <!-- Ícono para cerrar (puedes usar un ícono de Font Awesome si lo prefieres) -->
                </button>
            </div>
            <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">

                <div id="chat-box" class="overflow-y-auto border p-4 rounded-lg bg-gray-50 mb-4"
                    style="height: 400px;">
                    <!-- Mensajes del chatbot -->
                    {{-- <h1>Hola</h1> --}}
                </div>

                <form id="chat-form" class="flex">
                    <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
                    <input type="text" id="user-text"
                        class="flex-1 border border-gray-300 rounded-l-lg p-2 focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Escribe un mensaje...">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 rounded-r-lg hover:bg-blue-600">Enviar</button>
                </form>
            </div>
        </div>




        <script>
            $(document).ready(function() {
                // Evento de envío del formulario
                $('#chat-form').on('submit', function(e) {
                    e.preventDefault();

                    let userInput = $('#user-text').val();
                    let userId = $('#user-id').val(); // Obtener el ID del usuario logueado

                    if (userInput.trim() === '') {
                        return;
                    }

                    // Agrega el texto del usuario al chat
                    $('#chat-box').append(`
            <div class="mb-2">
                <strong class="text-blue-500">Tú:</strong>
                <span>${userInput}</span>
            </div>
        `);

                    // Limpia el campo de entrada de texto
                    $('#user-text').val('');

                    // Enviar el texto al endpoint
                    $.ajax({
                        url: '/api/texto',
                        type: 'POST',
                        data: {
                            text: userInput,
                            id: userId, // Enviar el ID del usuario logueado
                        },
                        success: function(response) {
                            // Mostrar el mensaje generado por el servidor
                            $('#chat-box').append(`
                                <div class="mb-2">
                                    <strong class="text-green-500">AquaBot:</strong>
                                    <span>${response.generated_text}</span>
                                </div>
                            `);

                            // Hacer scroll hacia el último mensaje
                            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                        },
                        error: function() {
                            $('#chat-box').append(`
                    <div class="mb-2 text-red-500">Error: No se pudo obtener la respuesta.</div>
                `);
                        }
                    });
                });
            });
        </script>

        <!-- Script para manejar el comportamiento del chatbot -->
        <script>
            const toggleButton = document.getElementById('chatbot-toggle');
            const chatbot = document.getElementById('chatbot');
            const closeButton = document.getElementById('chatbot-close');

            toggleButton.addEventListener('click', (e) => {
                e.preventDefault();
                chatbot.classList.toggle('hidden');
            });

            closeButton.addEventListener('click', () => {
                chatbot.classList.add('hidden');
            });
        </script>



        <!-- Page Content -->

    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
