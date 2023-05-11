<form id="logout-form" method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('logout-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const authToken = sessionStorage.getItem('authToken');
        if (!authToken) {
            console.log('User not authenticated');
            return;
        }

        axios.post('{{ route('logout') }}', {}, {
            headers: {
                'Authorization': 'Bearer ' + authToken
            }
        })
        .then(function(response) {
            sessionStorage.removeItem('authToken');
            window.location.href = "{{ route('login') }}";
        })
        .catch(function(error) {
            console.log(error.response.data);
        });
    });
</script>