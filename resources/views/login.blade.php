@extends('layouts.dashboard')

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form id="login-form" class="p-4 border rounded">
            <h1 class="mb-4">Login</h1>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
            <div id="login-error" class="mt-3 text-danger" style="display: none;">
                Invalid email or password. Please try again.
            </div>
        </form>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = event.target;
            const email = form.elements.email.value;
            const password = form.elements.password.value;

            axios.post('/api/authenticate', {
                    email: email,
                    password: password
                })
                .then(function(response) {
                    const token = response.data.token;
                    sessionStorage.setItem('access_token', token);
                    window.location.href =  "{{ route('tasks.index') }}";
                })
                .catch(function(error) {
                    console.log(error.response.data);
                    document.getElementById('login-error').style.display = 'block';
                });
        });
    </script>
@endsection