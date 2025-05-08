@extends('layouts.app')

@section('content')
<!doctype html>
<html lang="en">
<head>
    <title>Laravel Admin Panel</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container col-10 m-auto mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Admin Panel</h5>
            </div>

            <div class="card-body">
                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="#users" data-bs-toggle="tab">{{ __('Users') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#trips" data-bs-toggle="tab">{{ __('Trips') }}</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Users Tab -->
                    <div class="tab-pane active" id="users">
                        <h4>{{ __('User Management') }}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Trip</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->trip ? $user->trip->name : '—' }}</td>
                                            <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No users found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Trips Tab -->
                    <div class="tab-pane" id="trips">
                        <h4>{{ __('Trip Management') }}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped" id="trips-table">
                                <thead>
                                    <tr>
                                        <th>Trip Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trips as $trip)
                                        <tr>
                                            <td>{{ $trip->name }}</td>
                                            <td>{{ Str::limit($trip->description, 50) }}</td>
                                            <td>€{{ number_format($trip->price, 2) }}</td>
                                            <td>{{ $trip->status }}</td>
                                            <td>{{ $trip->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.datatable').DataTable();
            $('#trips-table').DataTable();
        });
    </script>
</body>
</html>
@endsection
