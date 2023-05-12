@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Task List</h1>
        <table id="task-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Assigned name</th>
                    <th>Admin name</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center" id="pagination-links">
            </ul>
        </nav>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            const authToken = sessionStorage.getItem('authToken');

            function loadPage(url) {
                url += (url.includes('?') ? '&' : '?') + 'per_page=10';
                axios.get(url, {
                        headers: {
                            'Authorization': 'Bearer ' + authToken
                        }
                    })
                    .then(function(response) {
                        console.log(response.data);

                        // Clear the table body
                        $('#task-table tbody').empty();

                        // Loop through the data and add each task to the table
                        $.each(response.data.data, function(index, task) {
                            var row = $('<tr>');
                            row.append($('<td>').text(task.title));
                            row.append($('<td>').text(task.description));
                            row.append($('<td>').text(task.assigned_to.name));
                            row.append($('<td>').text(task.assigned_by.name));
                            $('#task-table tbody').append(row);
                        });

                        // Clear the pagination links
                        $('#pagination-links').empty();

                        // Add the previous page link to the container
                        if (response.data.prev_page_url) {
                            $('#pagination-links').append(
                                '<li class="page-item"><a class="page-link" href="#" data-page="' + response
                                .data.prev_page_url + '">Previous</a></li>');
                        }

                        // Add the page links to the container
                        for (var i = 1; i <= response.data.last_page; i++) {
                            var activeClass = (response.data.current_page === i) ? ' active' : '';
                            $('#pagination-links').append('<li class="page-item' + activeClass +
                                '"><a class="page-link" href="#" data-page="' + response.data.path +
                                '?page=' + i + '">' + i + '</a></li>');
                        }

                        // Add the next page link to the container
                        if (response.data.next_page_url) {
                            $('#pagination-links').append(
                                '<li class="page-item"><a class="page-link" href="#" data-page="' + response
                                .data.next_page_url + '">Next</a></li>');
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }

            // Load the first page of tasks
            loadPage('/api/tasks');

            // Load the next page when a pagination link is clicked
            $('#pagination-links').on('click', 'a[data-page]', function(e) {
                e.preventDefault();
                var nextPageUrl = $(this).data('page');
                loadPage(nextPageUrl);
            });
        });
    </script>
@endsection
