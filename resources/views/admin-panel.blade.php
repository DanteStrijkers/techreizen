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

        <!-- DataTables Buttons CSS -->
        <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />
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
                        <li class="nav-item">
                            <a class="nav-link" href="#messages" data-bs-toggle="tab">{{ __('Messages') }}</a>
                        </li>


                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Users Tab -->
                        <div class="tab-pane active" id="users">
                            <h4>{{ __('User Management') }}</h4>
                            <div class="table-responsive">
                                <table id="users-table" class="table table-striped datatable">
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
                                        @forelse($trips as $trip)
                                            <tr data-trip-id="{{ $trip->id }}">
                                                <td class="editable" data-field="name">{{ $trip->name }}</td>
                                                <td class="editable" data-field="description">{{ $trip->description }}</td>
                                                <td class="editable" data-field="price">{{ number_format($trip->price, 2) }}</td>
                                                <td class="editable" data-field="status">
                                                    <select class="form-select status-select">
                                                        <option value="active" {{ $trip->status == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ $trip->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </td>
                                                <td>{{ $trip->created_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>


                                                    <button class="btn btn-sm btn-success save-btn" style="display: none;">
                                                        <i class="fas fa-save"></i> Save
                                                    </button>
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No Trips found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         <!-- Messages tab -->
                         <div class="tab-pane" id="messages">
                            <h4>{{ __('messages') }}</h4>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <form id="send-message-form">
                                        @csrf

                                        <div class="form-group">
                                            <label for="trip-select">{{ __('Select Trip') }}</label>
                                            <select class="form-control" id="trip-select" name="trip_id" required>
                                                <option value="">{{ __('Choose a trip') }}</option>
                                                @foreach($trips as $trip)
                                                    <option value="{{ $trip->id }}">{{ $trip->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="message-content">{{ __('Your Message') }}</label>
                                            <textarea class="form-control" id="message-content" name="message" 
                                                rows="5" placeholder="{{ __('Type your message here...') }}" required></textarea>
                                        </div>

                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-paper-plane"></i> {{ __('Send Message') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
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
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <!-- Buttons dependencies -->
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>


        <script type="text/javascript">
            $(document).ready(function () {
        $('#users-table').DataTable({
            dom: "<'row mb-3'<'col-md-6'f><'col-md-6 text-end d-flex justify-content-end align-items-center'<'me-2 export-label'>B>>" +
                 "<'row'<'col-12'tr>>" +
                 "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
            buttons: [
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success me-2',
                    filename: 'techreizen_users_excel' // <-- your desired Excel filename
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger',
                    filename: 'techreizen_users_pdf' // <-- your desired PDF filename
                }
            ]
        });

        $('.export-label').html('<span class="me-2 fw-bold">Export:</span>');
    });
        </script>
    </body>
    </html>
@endsection
