@extends('layouts.app')
<!doctype html>
<html lang="en">
    <head>
        <title>Laravel</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>

        <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet"/>
    </head>

    <body>
        <div class="container col-8 m-auto mt-5" style="margin-top: 200px !important;">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Lijst gebruikers</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                    
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            
                            <tbody>

                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                    
                                @empty
                                    <tr>
                                        <td colspan="3"> No data found! </td>
                                    </tr>
                                    
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                

            </div>
        </div>

        {{-- jQuery CDN --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

        {{-- Database JS --}}
        <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.datatable').DataTable();
            })
        </script>
    </body>
</html>

        

        
{{-- </body>
</html> --}}

{{-- @section('content')
    <div class="row justify-content-center p-2">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('admin panel') }}</div>

                <div class="card-body">
                    <!-- Admin navigation tabs -->
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="#users" data-bs-toggle="tab">{{ __('users') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#trips" data-bs-toggle="tab">{{ __('trips') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#messages" data-bs-toggle="tab">{{ __('messages') }}</a>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content">
                        <!-- Users tab -->
                        <div class="tab-pane active" id="users">
                            <h4>{{ __('user management') }}</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('name') }}</th>
                                            <th>{{ __('email') }}</th>
                                            <th>{{ __('role') }}</th>
                                            <th>{{ __('actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ ucfirst($user->role) }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">{{ __('edit') }}</button>
                                                    <button class="btn btn-sm btn-danger">{{ __('delete') }}</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Trips tab -->
                        <div class="tab-pane" id="trips">
                            <h4>{{ __('trip management') }}</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('trip name') }}</th>
                                            <th>{{ __('description') }}</th>
                                            <th>{{ __('price') }}</th>
                                            <th>{{ __('actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($trips as $trip)
                                            <tr>
                                                <td>{{ $trip->name }}</td>
                                                <td>{{ Str::limit($trip->description, 50) }}</td>
                                                <td>€{{ number_format($trip->price, 2) }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">{{ __('edit') }}</button>
                                                    <button class="btn btn-sm btn-danger">{{ __('delete') }}</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Messages tab -->
                        <div class="tab-pane" id="messages">
                            <h4>{{ __('messages') }}</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('sender') }}</th>
                                            <th>{{ __('email') }}</th>
                                            <th>{{ __('trip') }}</th>
                                            <th>{{ __('message') }}</th>
                                            <th>{{ __('date') }}</th>
                                            <th>{{ __('actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Error display (similar to contact form) -->
                    @if ($errors->any())
                        <div class="row mb-3 mt-4">
                            <div class="col-md-8 offset-md-2">
                                <x-alert type="danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </x-alert>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection --}}