<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tasks.index') }}">List Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tasks.create') }}">Create Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tasks.statistics') }}">Statistics</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form id="logout-form">
                        <button type="submit" class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>      
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('logout-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const authToken = sessionStorage.getItem('access_token');
            if (!authToken) {
                console.log('User not authenticated');
                return;
            }
            axios.post('/api/logout', {}, {
                    headers: {
                        'Authorization': 'Bearer ' + authToken
                    }
                })
                .then(function(response) {
                    sessionStorage.removeItem('access_token');
                    window.location.href = "{{ route('login') }}";
                })
                .catch(function(error) {
                    console.log(error.response.data);
                });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>