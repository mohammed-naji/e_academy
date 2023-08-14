@extends('admins.master')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
<canvas id="paymentChart"></canvas>
@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var paymentData = @json($paymentData);

    var years = [...new Set(paymentData.map(item => item.year))];

    var ctx = document.getElementById('paymentChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Array.from({ length: 12 }, (_, i) => i + 1),
            datasets: paymentData.reduce((datasets, item) => {
                var dataset = datasets.find(ds => ds.label === item.year);
                if (!dataset) {
                    dataset = {
                        label: item.year,
                        data: new Array(12).fill(0),
                        borderColor: randomColor(),
                        borderWidth: 2,
                        fill: false
                    };
                    datasets.push(dataset);
                }
                dataset.data[item.month - 1] = item.total_amount;
                return datasets;
            }, [])
        },
        options: {
            scales: {
                x: {
                    type: 'linear',
                    beginAtZero: true,
                    max: 12,
                    stepSize: 1,
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Amount'
                    }
                }
            }
        }
    });

    function randomColor() {
        return '#' + Math.floor(Math.random()*16777215).toString(16);
    }
</script>
@stop
