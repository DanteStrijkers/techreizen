@extends('layouts.app')

@section('content')
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

            <div class="tab-content">
                <!-- Users Tab -->
                <div class="tab-pane active" id="users">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                        <h4 class="mb-0 me-3">{{ __('User Management') }}</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($trips as $trip)
                                <span class="badge bg-primary text-white">
                                    {{ $trip->name }}: {{ $trip->participants_count }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="row" style="height: 100vh; overflow-y: auto;">
                        <!-- Column for selecting fields -->
                        <div class="col-md-3 border p-3 rounded bg-light">
                            <h5>{{ __('Select Fields') }}</h5>
                            <form id="field-selection-form">
                                @foreach([
                                    'first_name', 'last_name', 'email', 'trip', 'country', 'address', 'gender', 'phone',
                                    'emergency_phone_1', 'emergency_phone_2', 'nationality', 'birthdate', 'birthplace',
                                    'iban', 'bic', 'medical_issue', 'medical_info', 'created_at'
                                ] as $field)
                                    <div class="form-check">
                                        <input class="form-check-input field-checkbox" type="checkbox"
                                               value="{{ $field }}" id="field-{{ $field }}"
                                               @checked(in_array($field, ['first_name', 'last_name', 'email', 'trip']))>
                                        <label class="form-check-label" for="field-{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                    </div>
                                @endforeach
                            </form>
                        </div>

                        <!-- Traveller Info Table -->
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table id="travellers-table" class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            @foreach([
                                                'first_name', 'last_name', 'email', 'trip', 'country', 'address', 'gender', 'phone',
                                                'emergency_phone_1', 'emergency_phone_2', 'nationality', 'birthdate', 'birthplace',
                                                'iban', 'bic', 'medical_issue', 'medical_info', 'created_at'
                                            ] as $field)
                                                <th class="field-{{ $field }}" style="@if(!in_array($field, ['first_name','last_name','email','trip'])) display: none; @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $field)) }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($travellers as $traveller)
                                            <tr>
                                                @foreach([
                                                    'first_name', 'last_name', 'email', 'trip', 'country', 'address', 'gender', 'phone',
                                                    'emergency_phone_1', 'emergency_phone_2', 'nationality', 'birthdate', 'birthplace',
                                                    'iban', 'bic', 'medical_issue', 'medical_info', 'created_at'
                                                ] as $field)
                                                    <td class="field-{{ $field }}" style="@if(!in_array($field, ['first_name','last_name','email','trip'])) display: none; @endif">
                                                        @if($field == 'trip')
                                                            {{ $traveller->trip->name ?? 'N/A' }}
                                                        @elseif($field == 'gender')
                                                            {{ ucfirst($traveller->$field) }}
                                                        @elseif($field == 'created_at')
                                                            {{ $traveller->created_at->format('d-m-Y H:i') }}
                                                        @else
                                                            {{ $traveller->$field }}
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr><td colspan="18">No travellers found.</td></tr>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trips as $trip)
                                    <tr>
                                        <td>{{ $trip->name }}</td>
                                        <td>{{ $trip->description }}</td>
                                        <td>{{ number_format($trip->price, 2) }}</td>
                                        <td>{{ ucfirst($trip->status) }}</td>
                                        <td>{{ $trip->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je deze reis wilt verwijderen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6">No Trips found.</td></tr>
                                @endforelse

                                <!-- Add Trip Form -->
                                <tr>
                                    <form action="{{ route('trips.store') }}" method="POST">
                                        @csrf
                                        <td><input type="text" name="name" class="form-control" required></td>
                                        <td><input type="text" name="description" class="form-control"></td>
                                        <td><input type="number" step="0.01" name="price" class="form-control" required></td>
                                        <td>
                                            <select name="status" class="form-select" required>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </td>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-success">Add</button>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Messages Tab -->
                <div class="tab-pane" id="messages">
                    <h4>{{ __('Messages') }}</h4>
                    <form id="send-message-form">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="trip-select">Select Trip</label>
                            <select id="trip-select" name="trip_id" class="form-control" required>
                                <option value="">Choose a trip</option>
                                @foreach($trips as $trip)
                                    <option value="{{ $trip->id }}">{{ $trip->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="message-content">Your Message</label>
                            <textarea id="message-content" name="message" rows="5" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>

            @if ($errors->any())
                <x-alert type="danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert>
            @endif
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    $(document).ready(function () {
        const table = $('#travellers-table').DataTable({
            dom: "<'row mb-3'<'col-md-6'f><'col-md-6 text-end d-flex justify-content-end align-items-center'<'me-2 export-label'>B>>" +
                "<'row'<'col-12'tr>>" +
                "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
            buttons: [
                { extend: 'excelHtml5', className: 'btn btn-success me-2', filename: 'techreizen_users_excel' },
                { extend: 'pdfHtml5', className: 'btn btn-danger', filename: 'techreizen_users_pdf' }
            ]
        });
        $('.export-label').html('<span class="me-2 fw-bold">Export:</span>');

        $('.field-checkbox').on('change', function () {
            const field = $(this).val();
            const shouldShow = $(this).is(':checked');
            $(`.field-${field}`).toggle(shouldShow);
        });
    });
</script>
@endsection
