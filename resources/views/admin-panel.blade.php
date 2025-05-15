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
                            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                                <h4 class="mb-0 me-3">{{ __('User Management') }}</h4>
                            
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($trips as $trip)
                                        <span class="badge bg-secondary text-white">
                                            {{ $trip->name }}: {{ $trip->participants_count }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            
                            
                            
                            <!-- 👇 Voeg hier de teller toe -->
                            
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
                            <h4>{{ __('Traveller Management') }}</h4>
                            <div class="row" style="height: 100vh; overflow-y: auto;">
                                <!-- Column for selecting fields -->
                                <div class="col-md-3" style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background-color: #f9f9f9;">
                                    <h5>{{ __('Select Fields') }}</h5>
                                    <form id="field-selection-form">
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="first_name" id="field-first_name" checked>
                                            <label class="form-check-label" for="field-first_name">First Name</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="last_name" id="field-last_name" checked>
                                            <label class="form-check-label" for="field-last_name">Last Name</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="email" id="field-email" checked>
                                            <label class="form-check-label" for="field-email">Email</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="trip" id="field-trip">
                                            <label class="form-check-label" for="field-trip">Trip</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="country" id="field-country">
                                            <label class="form-check-label" for="field-country">Country</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="address" id="field-address">
                                            <label class="form-check-label" for="field-address">Address</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="gender" id="field-gender">
                                            <label class="form-check-label" for="field-gender">Gender</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="phone" id="field-phone">
                                            <label class="form-check-label" for="field-phone">Phone</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="emergency_phone_1" id="field-emergency_phone_1">
                                            <label class="form-check-label" for="field-emergency_phone_1">Emergency Phone 1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="emergency_phone_2" id="field-emergency_phone_2">
                                            <label class="form-check-label" for="field-emergency_phone_2">Emergency Phone 2</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="nationality" id="field-nationality">
                                            <label class="form-check-label" for="field-nationality">Nationality</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="birthdate" id="field-birthdate">
                                            <label class="form-check-label" for="field-birthdate">Birthdate</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="birthplace" id="field-birthplace">
                                            <label class="form-check-label" for="field-birthplace">Birthplace</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="iban" id="field-iban">
                                            <label class="form-check-label" for="field-iban">IBAN</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="bic" id="field-bic">
                                            <label class="form-check-label" for="field-bic">BIC</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="medical_issue" id="field-medical_issue">
                                            <label class="form-check-label" for="field-medical_issue">Medical Issue</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="medical_info" id="field-medical_info">
                                            <label class="form-check-label" for="field-medical_info">Medical Info</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox" value="created_at" id="field-created_at">
                                            <label class="form-check-label" for="field-created_at">Created At</label>
                                        </div>
                                    </form>
                                </div>

                                <!-- Traveller Info Table -->
                                <div class="col-md-9">
                                    <div class="table-responsive">
                                        <table id="travellers-table" class="table table-striped datatable">
                                            <thead>
                                                <tr>
                                                    <th class="field-first_name">First Name</th>
                                                    <th class="field-last_name">Last Name</th>
                                                    <th class="field-email">Email</th>
                                                    <th class="field-trip" style="display: none;">Trip</th> <!-- Hidden by default -->
                                                    <th class="field-country" style="display: none;">Country</th>
                                                    <th class="field-address" style="display: none;">Address</th>
                                                    <th class="field-gender" style="display: none;">Gender</th>
                                                    <th class="field-phone" style="display: none;">Phone</th>
                                                    <th class="field-emergency_phone_1" style="display: none;">Emergency Phone 1</th>
                                                    <th class="field-emergency_phone_2" style="display: none;">Emergency Phone 2</th>
                                                    <th class="field-nationality" style="display: none;">Nationality</th>
                                                    <th class="field-birthdate" style="display: none;">Birthdate</th>
                                                    <th class="field-birthplace" style="display: none;">Birthplace</th>
                                                    <th class="field-iban" style="display: none;">IBAN</th>
                                                    <th class="field-bic" style="display: none;">BIC</th>
                                                    <th class="field-medical_issue" style="display: none;">Medical Issue</th>
                                                    <th class="field-medical_info" style="display: none;">Medical Info</th>
                                                    <th class="field-created_at" style="display: none;">Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($travellers as $traveller)
                                                    <tr>
                                                        <td class="field-first_name">{{ $traveller->first_name }}</td>
                                                        <td class="field-last_name">{{ $traveller->last_name }}</td>
                                                        <td class="field-email">{{ $traveller->email }}</td>
                                                        <td class="field-trip" style="display: none;">{{ $traveller->trip->name ?? 'N/A' }}</td> <!-- Hidden by default -->
                                                        <td class="field-country" style="display: none;">{{ $traveller->country }}</td>
                                                        <td class="field-address" style="display: none;">{{ $traveller->address }}</td>
                                                        <td class="field-gender" style="display: none;">{{ ucfirst($traveller->gender) }}</td>
                                                        <td class="field-phone" style="display: none;">{{ $traveller->phone }}</td>
                                                        <td class="field-emergency_phone_1" style="display: none;">{{ $traveller->emergency_phone_1 }}</td>
                                                        <td class="field-emergency_phone_2" style="display: none;">{{ $traveller->emergency_phone_2 }}</td>
                                                        <td class="field-nationality" style="display: none;">{{ $traveller->nationality }}</td>
                                                        <td class="field-birthdate" style="display: none;">{{ $traveller->birthdate }}</td>
                                                        <td class="field-birthplace" style="display: none;">{{ $traveller->birthplace }}</td>
                                                        <td class="field-iban" style="display: none;">{{ $traveller->iban }}</td>
                                                        <td class="field-bic" style="display: none;">{{ $traveller->bic }}</td>
                                                        <td class="field-medical_issue" style="display: none;">{{ $traveller->medical_issue }}</td>
                                                        <td class="field-medical_info" style="display: none;">{{ $traveller->medical_info }}</td>
                                                        <td class="field-created_at" style="display: none;">{{ $traveller->created_at }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="18">No travellers found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
                                                <td class="editable" data-field="status">{{ ucfirst($trip->status) }}</td>
                                                <td>{{ $trip->created_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('trips.destroy', $trip->id) }}" method="POST"
                                                        onsubmit="return confirm('Weet je zeker dat je deze reis wilt verwijderen?');"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No Trips found.</td>
                                            </tr>
                                        @endforelse

                                        <!-- Formulier om nieuwe trip toe te voegen -->
                                        <tr>
                                            <form action="{{ route('trips.store') }}" method="POST">
                                                @csrf
                                                <td><input type="text" name="name" class="form-control" placeholder="Trip name" required></td>
                                                <td><input type="text" name="description" class="form-control" placeholder="Description"></td>
                                                <td><input type="email" name="contact_email" class="form-control" placeholder="Contact email">
                                                </td>
                                                <td><input type="number" name="price" step="0.01" min="0.01" class="form-control" placeholder="Price"
                                                        required></td>
                                                <td>
                                                    <select name="status" class="form-select" required>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-plus"></i> Add
                                                    </button>
                                                </td>
                                            </form>
                                        </tr>
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

    $(document).ready(function () {
        $('#travellers-table').DataTable({
            dom: "<'row mb-3'<'col-md-6'f><'col-md-6 text-end d-flex justify-content-end align-items-center'<'me-2 export-label'>B>>" +
                 "<'row'<'col-12'tr>>" +
                 "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
            buttons: [
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success me-2',
                    filename: 'techreizen_travellers_excel' // <-- your desired Excel filename
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger',
                    filename: 'techreizen_travellers_pdf' // <-- your desired PDF filename
                }
            ]
        });

        $('.export-label').html('<span class="me-2 fw-bold">Export:</span>');
    });

    document.querySelectorAll('.field-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const fieldClass = `.field-${this.value}`;
            const tableColumns = document.querySelectorAll(fieldClass);

            if (this.checked) {
                tableColumns.forEach(column => column.style.display = '');
            } else {
                tableColumns.forEach(column => column.style.display = 'none');
            }
        });
    });
        </script>
    </body>
    </html>
@endsection
