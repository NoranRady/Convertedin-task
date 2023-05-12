@extends('layouts.app')

@section('content')
    <h1>Create Task</h1>

    <form id="create-task-form">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="assigned_to">Assigned User</label>
            <select class="form-control" id="assigned_to" name="assigned_to" required>
            </select>
        </div>

        <div class="form-group">
            <label for="assigned_to">Admin Name</label>
            <select class="form-control" id="assigned_by" name="assigned_by" required>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        // Read the token from session storage
        const authToken = sessionStorage.getItem('authToken');

        // Fetch users from the API 
        axios.get('/api/users?is_admin=0', {
                headers: {
                    'Authorization': 'Bearer ' + authToken
                }
            })
            .then(function(response) {
                const users = response.data;
                const assignedToSelect = document.getElementById('assigned_to');
                users.forEach(function(user) {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.text = user.name;
                    assignedToSelect.add(option);
                });
            })
            .catch(function(error) {
                console.log(error.response.data);
            });

        // Fetch adminUsers from the API
        axios.get('/api/users?is_admin=1', {
                headers: {
                    'Authorization': 'Bearer ' + authToken
                }
            })
            .then(function(response) {
                const adminUsers = response.data;
                const assignedBySelect = document.getElementById('assigned_by');
                adminUsers.forEach(function(adminUser) {
                    const option = document.createElement('option');
                    option.value = adminUser.id;
                    option.text = adminUser.name;
                    assignedBySelect.add(option);
                });
            })
            .catch(function(error) {
                console.log(error.response.data);
            });

        document.getElementById('create-task-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = event.target;
            const title = form.elements.title.value;
            const description = form.elements.description.value;
            const assigned_to = form.elements.assigned_to.value;
            const assigned_by = form.elements.assigned_by.value;

            axios.post('/api/tasks', {
                    title: title,
                    description: description,
                    assigned_to: assigned_to,
                    assigned_by: assigned_by,
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + authToken,
                        'test': 'Bearer ' + authToken,
                    }
                })
                .then(function(response) {
                    console.log(response.data);
                    window.location.href = "{{ route('tasks.index') }}";
                })
                .catch(function(error) {
                    console.log(error.response.data);
                });
        });
    </script>
@endsection
