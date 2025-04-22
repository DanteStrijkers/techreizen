@extends('layouts.app')

@section('content')
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
@endsection