<form id="login-form">
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required autofocus>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>

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
            sessionStorage.setItem('authToken', token);
            window.location.href =  "{{ route('tasks.index') }}";
            })
        .catch(function(error) {
            console.log(error.response.data);
        });
    });
</script>