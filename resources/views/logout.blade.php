<form id="logout-form">
    @csrf
    <button type="submit">Logout</button>
</form>

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
