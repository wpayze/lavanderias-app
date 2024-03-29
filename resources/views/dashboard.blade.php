<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-9 bg-white ">
        <div class="p-5">
            <p>MES DEL REPORTE</p>
            <form>
                <div class="grid grid-cols-12">
                    <div class="col-span-12 md:col-span-6">
                        <select name="month" class="form-select block w-full">
                            @foreach ($months as $month)
                                <option value="{{$month->month}}" @if ($month->month == $currentMonth) selected @endif >{{$monthsText[$month->month]}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <button class="w-full inline p-2 bg-blue-500 text-white rounded-md focus:outline-none focus:ring-2 ring-blue-300 ring-offset-2" type="submit">Cargar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4 max-w-7xl mx-auto mt-9 ">

        <div class="col-span-12 sm:col-span-6 md:col-span-3 shadow-xl rounded-xl">
            <div class="flex flex-row bg-white shadow-sm rounded p-4">
            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <div class="text-sm text-gray-500">Clientes Totales</div>
                <div class="font-bold text-lg">{{$report["clients"]}}</div>
            </div>
            </div>
        </div>

        <div class="col-span-12 sm:col-span-6 md:col-span-3 shadow-xl rounded-xl">
            <div class="flex flex-row bg-white shadow-sm rounded p-4">
            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-green-100 text-green-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <div class="text-sm text-gray-500">Ordenes</div>
                <div class="font-bold text-lg">{{$report["orders"]}}</div>
            </div>
            </div>
        </div>

        <div class="col-span-12 sm:col-span-6 md:col-span-3 shadow-xl rounded-xl">
            <div class="flex flex-row bg-white shadow-sm rounded p-4">
            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-orange-100 text-orange-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <div class="text-sm text-gray-500">Nuevos Clientes</div>
                <div class="font-bold text-lg">{{$report["newClients"]}}</div>
            </div>
            </div>
        </div>

        <div class="col-span-12 sm:col-span-6 md:col-span-3 shadow-xl rounded-xl">
            <div class="flex flex-row bg-white shadow-sm rounded p-4">
            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-red-100 text-red-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="flex flex-col flex-grow ml-4">
                <div class="text-sm text-gray-500">Ingresos</div>
                <div class="font-bold text-lg">L. {{$report["revenue"]}}</div>
            </div>
            </div>
        </div>

    </div>

    <div class="max-w-7xl mx-auto mt-9 bg-white ">
        <canvas id="myChart"></canvas>
    </div>

    @once
        @push('scripts')
            <script>

                const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

                fetch('/revenueByMonth')
                .then(response => response.json())
                .then( (data) => {
                    console.log(data);
                    setRevenueByMonthChart(data);
                });

                let setRevenueByMonthChart = (data) => {
                    var ctx = document.getElementById('myChart').getContext('2d');

                    var months = data.map( x => monthNames[x.month - 1]);
                    var revenues = data.map( x => x.data);

                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Ingresos por Mes',
                                data: revenues,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }

            </script>
        @endpush
@endonce

</x-app-layout>
