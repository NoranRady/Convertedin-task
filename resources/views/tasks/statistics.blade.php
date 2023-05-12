@extends('layouts.app')

@section('content')
    <h1>Statistics</h1>

    <canvas id="myChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        
        const authToken = sessionStorage.getItem('access_token');
        if(!authToken){
                window.location.href =  "{{ route('login') }}";
            }
        axios.get('/api/statistics/top-users-with-task-counts/10', {
                headers: {
                    'Authorization': 'Bearer ' + authToken
                }
            })
            .then(function (response) {
                var users = response.data;
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: users.map(function(user) { return user.user_name; }),
                        datasets: [{
                            label: 'Task Count',
                            data: users.map(function(user) { return user.task_count; }),
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
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
            })
            .catch(function (error) {
                console.log(error);
            });
    </script>
@endsection