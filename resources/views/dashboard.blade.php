<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

<x-app-layout>
    <br>
    <style>
        .container {
            position: relative;
            width: 192px;
            /* Reducido un 20% de 240px */
            height: 320px;
            /* Reducido un 20% de 400px */
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
    <br>
    <!-- Verificar si $ph es menor a 6.5 -->
    @if ($ph < 6.5)
        <!-- Modal -->
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="bg-white rounded-lg p-6 z-10">
                <h2 class="text-xl font-bold">Advertencia</h2>
                <p class="mt-4">El pH no es bueno. Su valor es {{ $ph }}.</p>
                <div class="mt-6 flex justify-end">
                    <button onclick="closeModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Cerrar</button>
                </div>
            </div>
        </div>
    @endif

    <script>
        // Función para cerrar el modal
        function closeModal() {
            document.querySelector('.fixed.inset-0').style.display = 'none';
        }
    </script>



    <div class="bg-white p-4 rounded-xl">
        <div class="flex flex-col md:flex-row">
            <div class="flex-none w-1/4 p-2 flex items-center justify-center">
                <!-- Ancho ajustado a una cuarta parte -->
                <div class="container flex flex-col items-center"> <!-- Flex para centrar contenido en columna -->
                    <canvas id="water" width="192" height="320"></canvas>
                    <canvas id="tank" width="192" height="320"></canvas>
                </div>
            </div>

            <div class="flex-1  p-2">
                <h3 class="text-3xl font-bold dark:text-white">{{ $brokerName }}</h3>
                <div style="height: 0.5em;"></div>
                <div style="display: flex; align-items: center;">

                    {{-- <h6 class="text-xl font-bold dark:text-white">Capacidad:</h6>&nbsp;&nbsp;

                    <span
                        class="bg-green-100 text-green-800 text-xl font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                        50%
                    </span> --}}
                </div>

                <div style="height: 0.5em;"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center p-2 mb-2 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                        role="alert">
                        <img src="{{ asset('icons/cap.svg') }}" alt="Capacity Icon"
                            class="w-1/2 mb-2 md:w-2/6 md:mb-0">&nbsp;
                        <div class="text-center md:text-left">
                            <span class="font-medium text-xl">Tanque de agua</span><br>
                            <span class="font-medium text-xl">Porcentaje:
                                <p id="porcentaje"
                                    class="bg-green-100 text-green-800 text-xl font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    {{ $porcentaje }}%
                                </p>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center p-2 mb-2 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                        role="alert">
                        <img src="{{ asset('icons/ph.svg') }}" alt="ph Icon"
                            class="w-1/2 mb-2 md:w-1/6 md:mb-0">&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="text-center md:text-left">
                            <span class="font-medium text-xl">Calidad del agua</span><br>
                            <span class="font-medium text-xl">pH: &nbsp;
                                <span>
                                    {{ $ph }}
                                </span>
                                <br>
                                <center>
                                    @if ($ph < 7)
                                        <span
                                            class="bg-red-100 text-red-800 text-xl font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                            Ácido
                                        </span>
                                    @elseif ($ph == 7)
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xl font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                            Neutro
                                        </span>
                                    @elseif ($ph > 7 && $ph <= 14)
                                        <span
                                            class="bg-green-100 text-green-800 text-xl font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                            Alcalino
                                        </span>
                                    @endif
                                </center>

                            </span>
                        </div>
                    </div>

                    <div class="flex items-center p-2 mb-2 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                        role="alert">
                        <img src="{{ asset('icons/promedio.svg') }}" alt="Capacity Icon"
                            class="w-1/2 mb-2 md:w-1/6 md:mb-0">&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="text-center md:text-left">
                            <span class="font-medium text-xl">Cosumo del día</span><br>
                            <p
                                class="bg-green-100 text-green-800 text-xl font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                {{ number_format($litrosGastados, 0) }} litros
                            </p>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center p-2 mb-2 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                        role="alert">
                        <img src="{{ asset('icons/alert.svg') }}" alt="Capacity Icon"
                            class="w-1/2 mb-2 md:w-1/6 md:mb-0">&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="text-center md:text-left">
                            <span class="font-medium text-xl">Ultima actualizacion</span><br>
                            <span
                                class="bg-gray-100 text-gray-800 text-l font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                                {{ $timeUpdate }}
                            </span>

                        </div>
                    </div>


                </div>





            </div>
            <div class="w-full md:w-1/3 p-2">
                <h6 class="text-xl font-bold dark:text-white">Consumo de agua mensual</h6>
                <br>
                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div style="position: relative; width: 100%; height: 200px;">
                        <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
                    </div>
                </div>
            </div>


            {{--
            <script>
                const labels = ['January', 'February', 'March', 'April'];

                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Litros por mes',
                        data: [10, 20, 30, 40],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false, // Si deseas un gráfico de líneas
                        tension: 0.1 // Usado solo si es un gráfico de líneas
                    }]
                };

                const config = {
                    type: 'line', // Cambia a 'line' si deseas un gráfico de líneas
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true // Asegúrate de que el eje Y comience en cero
                            }
                        }
                    }
                };

                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, config);
            </script> --}}

        </div>

    </div>


    <br>


    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-4 text-gray">
            <div class="bg-white p-4 rounded-xl">
                <div class="flex items-center">
                    <img src="{{ asset('icons/capacity.svg') }}" alt="Capacity Icon"
                        class="w-[50%] mb-2 md:w-[12%] md:mb-0">
                    <h6 class="text-xl font-bold dark:text-white ml-4">Consumo por persona al día</h6>
                </div>
                <div style="line-height: 0.5em;">&nbsp;</div>
                <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <p class="text-2xl text-gray-900 dark:text-white mr-2">Consumo al día:</p>
                    <span
                        class="ml-auto bg-green-100 text-green-800 text-l font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">
                        {{ number_format($litrosGastados, 0) }} Litros
                    </span>
                </div>

                <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Tienes un consumo responsalble!</span> Continua con tu consumo
                        responable.
                    </div>
                </div>
                {{-- tabla --}}
                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div style="position: relative; width: 100%; height: 200px;">
                        <canvas id="mySecondChart" style="width: 100%; height: 100%;"></canvas>
                    </div>
                </div>
                {{-- tablascript --}}



            </div>
        </div>

        <div class="p-4 text-gray">
            <div class="bg-white p-4 rounded-xl">
                <div class="flex items-center">
                    &nbsp;&nbsp;
                    <img src="{{ asset('icons/predict.png') }}" alt="Capacity Icon"
                        class="w-[50%] mb-2 md:w-[12%] md:mb-0">
                    <h6 class="text-xl font-bold dark:text-white ml-4">Predicción proximo mes</h6>
                </div>
                <div style="line-height: 0.5em;">&nbsp;</div>
                <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Alerta!</span>Tienes un consumo algo alto, considera reducirlo
                    </div>
                </div>
                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div style="position: relative; width: 100%; height: 200px;">
                        <canvas id="myThirdChart" style="width: 100%; height: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 text-gray">
            <div class="bg-white p-4 rounded-xl">
                <div class="flex items-center">
                    &nbsp;&nbsp;
                    <img src="{{ asset('icons/ph.png') }}" alt="Capacity Icon"
                        class="w-[50%] mb-2 md:w-[12%] md:mb-0">
                    <h6 class="text-xl font-bold dark:text-white ml-4">Historial de pH del agua</h6>
                </div>
                <div style="line-height: 0.5em;">&nbsp;</div>
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Buena calidad del agua!</span>Tienes un pH adecuado en el agua.
                    </div>
                </div>
                <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div style="position: relative; width: 100%; height: 200px;">
                        <canvas id="myFourthChart" style="width: 100%; height: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="p-4 text-gray">
            <div class="bg-white p-4 rounded-xl">
            </div>
        </div> --}}
    </div>






    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.1/dist/flowbite.bundle.min.js"></script>
    <script>
        const tankCanvas = document.getElementById('tank');
        const waterCanvas = document.getElementById('water');
        const tankCtx = tankCanvas.getContext('2d');
        const waterCtx = waterCanvas.getContext('2d');

        function drawTank() {
            const width = tankCanvas.width;
            const height = tankCanvas.height;
            const ctx = tankCtx;

            // Draw the tank
            ctx.fillStyle = '#FFFFFF';
            ctx.fillRect(0, 0, width, height);

            // Draw the tank outline with rounded corners
            ctx.strokeStyle = '#004d40';
            ctx.lineWidth = 5;
            ctx.lineJoin = 'round'; // Set line join to round
            ctx.strokeRect(5, 5, width - 10, height - 10);
        }

        function drawWater(level) {
            const width = waterCanvas.width;
            const height = waterCanvas.height;
            const ctx = waterCtx;

            // Clear the canvas
            ctx.clearRect(0, 0, width, height);

            // Draw water with a wavy effect
            const waterHeight = (height - 10) * level / 100;
            ctx.fillStyle = '#00bcd4';
            ctx.beginPath();
            ctx.moveTo(5, height - 5);
            for (let x = 5; x <= width - 5; x++) {
                const y = height - 5 - waterHeight + 10 * Math.sin((x + waveOffset) * 0.05);
                ctx.lineTo(x, y);
            }
            ctx.lineTo(width - 5, height - 5);
            ctx.closePath();
            ctx.fill();
        }

        // Animation parameters
        let waveOffset = 0;
        const animationSpeed = 0.7;

        function animateWater() {
            waveOffset += animationSpeed;
            drawWater(percentage);
            requestAnimationFrame(animateWater);
        }

        // Example percentage
        const percentage = {{ $porcentaje }}; // Puedes cambiar este valor para representar diferentes niveles

        // Draw tank and start animation
        drawTank();
        animateWater();
    </script>
</x-app-layout>



<script>
    const labels = {!! json_encode($labels1) !!}; // Tus labels de Laravel
    const consumptionData = {!! json_encode($consumptionData) !!}; // Tus datos de Laravel

    // Configurar los datos para el gráfico
    const chartData = {
        labels: labels, // Los labels de los meses
        datasets: [{
            label: 'Litros por mes',
            data: consumptionData, // Los datos de consumo
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            fill: false,
            tension: 0.1
        }]
    };

    // Configuración del gráfico
    const config = {
        type: 'line', // Puedes cambiar a 'bar' o el tipo que prefieras
        data: chartData, // Usa `chartData` en lugar de `data`
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Renderizar el gráfico en el contexto del canvas
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, config);

    // Datos del nuevo gráfico
    const secondData = {
        labels: ['Consumo por persona', 'Consumo promedio'], // Etiquetas para las barras
        datasets: [{
            label: 'Consumo de agua',
            data: [30, 25, 0], // Valores para cada barra
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)', // Color para la barra de consumo por persona
                'rgba(54, 162, 235, 0.2)' // Color para la barra de consumo promedio
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)', // Color de borde para la barra de consumo por persona
                'rgba(54, 162, 235, 1)' // Color de borde para la barra de consumo promedio
            ],
            borderWidth: 1
        }]
    };

    const secondConfig = {
        type: 'bar',
        data: secondData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const secondCtx = document.getElementById('mySecondChart').getContext('2d');
    const mySecondChart = new Chart(secondCtx, secondConfig);




    // Datos del tercer gráfico (tres barras)
    const thirdData = {
        labels: ['Agosto', 'Septiembre', 'Proyección Octubre'], // Etiquetas para las barras
        datasets: [{
            label: 'Consumo proyectado',
            data: [30, 20, 35], // Valores para los dos últimos meses y el próximo mes
            backgroundColor: [
                'rgba(75, 192, 192, 0.2)', // Color para el mes anterior
                'rgba(75, 192, 192, 0.2)', // Color para el mes anterior
                'rgba(153, 102, 255, 0.2)' // Color para la proyección del próximo mes
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)', // Color de borde para el mes anterior
                'rgba(75, 192, 192, 1)', // Color de borde para el mes anterior
                'rgba(153, 102, 255, 1)' // Color de borde para la proyección del próximo mes
            ],
            borderWidth: 1
        }]
    };

    const thirdConfig = {
        type: 'bar',
        data: thirdData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const thirdCtx = document.getElementById('myThirdChart').getContext('2d');
    const myThirdChart = new Chart(thirdCtx, thirdConfig);


    // Datos de la cuarta gráfica (cinco barras)
    const fourthData = {
        labels: ['Junio', 'Julio', 'Agosto', 'Septiembre', 'Proyección Octubre'], // Etiquetas para las barras
        datasets: [{
            label: 'Consumo mensual proyectado',
            data: [25, 28, 30, 20, 35], // Valores para los meses
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)', // Color para Junio
                'rgba(54, 162, 235, 0.2)', // Color para Julio
                'rgba(75, 192, 192, 0.2)', // Color para Agosto
                'rgba(153, 102, 255, 0.2)', // Color para Septiembre
                'rgba(255, 159, 64, 0.2)' // Color para la proyección de Octubre
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)', // Borde para Junio
                'rgba(54, 162, 235, 1)', // Borde para Julio
                'rgba(75, 192, 192, 1)', // Borde para Agosto
                'rgba(153, 102, 255, 1)', // Borde para Septiembre
                'rgba(255, 159, 64, 1)' // Borde para la proyección de Octubre
            ],
            borderWidth: 1
        }]
    };

    const fourthConfig = {
        type: 'bar',
        data: fourthData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const fourthCtx = document.getElementById('myFourthChart').getContext('2d');
    const myFourthChart = new Chart(fourthCtx, fourthConfig);
</script>
