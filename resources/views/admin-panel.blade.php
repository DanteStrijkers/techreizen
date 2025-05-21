@extends('layouts.app')

@section('content')
    <div class="container col-10 m-auto mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Admin Panel</h5>
            </div>

            <div class="card-body">
                <!-- Tab Navigation -->
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
                                @foreach ($trips as $trip)
                                    <span class="badge bg-primary text-white trip-filter" data-trip-id="{{ $trip->id }}"
                                        style="cursor: pointer;">
                                        {{ $trip->name }}: {{ $trip->participants_count }}
                                    </span>
                                @endforeach

                                <span class="badge bg-secondary text-white trip-filter" data-trip-id=""
                                    style="cursor: pointer;">
                                    Show All
                                </span>


                            </div>
                        </div>
                        <div class="row" style="height: 100vh; overflow-y: auto;">
                            <!-- Column for selecting fields -->
                            <div class="col-md-3"
                                style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background-color: #f9f9f9;">
                                <h5>{{ __('Select Fields') }}</h5>
                                <form id="field-selection-form">
                                    @php
                                        $allFields = [
                                            'first_name' => 'First Name',
                                            'last_name' => 'Last Name',
                                            'email' => 'Email',
                                            'trip' => 'Trip',
                                            'country' => 'Country',
                                            'address' => 'Address',
                                            'gender' => 'Gender',
                                            'phone' => 'Phone',
                                            'emergency_phone_1' => 'Emergency Phone 1',
                                            'emergency_phone_2' => 'Emergency Phone 2',
                                            'nationality' => 'Nationality',
                                            'birthdate' => 'Birthdate',
                                            'birthplace' => 'Birthplace',
                                            'iban' => 'IBAN',
                                            'bic' => 'BIC',
                                            'medical_issue' => 'Medical Issue',
                                            'medical_info' => 'Medical Info',
                                            'created_at' => 'Created At',
                                        ];
                                    @endphp

                                    @foreach ($allFields as $key => $label)
                                        <div class="form-check">
                                            <input class="form-check-input field-checkbox" type="checkbox"
                                                value="{{ $key }}" id="field-{{ $key }}"
                                                @if (in_array($key, ['first_name', 'last_name', 'email', 'trip'])) checked @endif>
                                            <label class="form-check-label"
                                                for="field-{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </form>
                            </div>

                            <!-- Traveller Info Table -->
                            <div class="col-md-9">
                                <div class="table-responsive">
                                    <table id="travellers-table" class="table table-striped datatable">
                                        <thead>
                                            <tr id="travellers-thead">
                                                {{-- Will be built dynamically via JS --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Populated by DataTables via AJAX --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Other tabs... -->
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
                                            <td class="editable" data-field="price">{{ number_format($trip->price, 2) }}
                                            </td>
                                            <td class="editable" data-field="status">{{ ucfirst($trip->status) }}</td>
                                            <td>{{ $trip->created_at->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('trips.edit', $trip->id) }}"
                                                    class="btn btn-sm btn-primary">
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
                                            <td><input type="text" name="name" class="form-control"
                                                    placeholder="Trip name" required></td>
                                            <td><input type="text" name="description" class="form-control"
                                                    placeholder="Description"></td>
                                            <td><input type="email" name="contact_email" class="form-control"
                                                    placeholder="Contact email">
                                            </td>
                                            <td><input type="number" name="price" step="0.01" min="0.01"
                                                    class="form-control" placeholder="Price" required></td>
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
                                            @foreach ($trips as $trip)
                                                <option value="{{ $trip->id }}">{{ $trip->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="message-content">{{ __('Your Message') }}</label>
                                        <textarea class="form-control" id="message-content" name="message" rows="5"
                                            placeholder="{{ __('Type your message here...') }}" required></textarea>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            function getSelectedFields() {
                const fields = [];
                $('.field-checkbox:checked').each(function() {
                    fields.push($(this).val());
                });
                return fields;
            }

            function renderTableHeader(selectedFields) {
                const $thead = $('#travellers-thead');
                $thead.empty();
                selectedFields.forEach(col => {
                    let label = col.replace(/_/g, ' ');
                    label = label.split(' ')
                        .map(w => w.charAt(0).toUpperCase() + w.slice(1))
                        .join(' ');
                    $thead.append(`<th data-col="${col}">${label}</th>`);   
                });
                $thead.append('<th>Actions</th>');
            }

            let travellersTable = null;
            let currentTripId = ''; // holds selected trip

            function initTravellersTable() {
                const fields = getSelectedFields();

                if ($.fn.DataTable.isDataTable('#travellers-table')) {
                    travellersTable.clear().destroy();
                    $('#travellers-table tbody').empty();
                }

                renderTableHeader(fields);

                const columnsConfig = fields.map(col => ({
                    data: col,
                    orderable: true
                }));

                columnsConfig.push({
                data: 'id',
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    const editUrl = `/travellers/${data}/edit`;
                    const deleteUrl = `/travellers/${data}`;
                    return `<a href="${editUrl}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="${deleteUrl}" method="POST" style="display:inline;" onsubmit="return confirm('Weet je zeker dat je deze reiziger wilt verwijderen?')">
                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>`;
                    
                }
            });

                travellersTable = $('#travellers-table').DataTable({
                    ordering: true,
                    processing: true,
                    serverSide: false, // <-- set to false (Yajra)
                    ajax: {
                        url: "{{ route('admin-panel.travellers-data') }}",
                        type: 'POST',
                        data: function(d) {
                            d._token = "{{ csrf_token() }}";
                            d.fields = getSelectedFields();
                            d.trip_id = currentTripId; // Add this line

                        }
                    },
                    columns: columnsConfig,
                    dom: "<'row mb-3'<'col-md-6'f><'col-md-6 text-end'<'export-label'>B>>" +
                        "<'row'<'col-12'tr>>" +
                        "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
                    buttons: [{
                            extend: 'excelHtml5',
                            className: 'btn btn-success me-2',
                            filename: 'techreizen_travellers_excel',
                            exportOptions: {
                                columns: ':not(:last-child)', // sluit laatste kolom (actieknoppen) uit
                            },
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-danger',
                            filename: 'techreizen_travellers_pdf',
                            exportOptions: {
                                columns: ':not(:last-child)', // sluit laatste kolom (actieknoppen) uit
                            },
                        }
                    ],
                    order: [
                        [0, 'asc']
                    ],
                    rowId: 'id'
                });

                $('.export-label').html('<span class="me-2 fw-bold">Export:</span>');
            }

            initTravellersTable();

            $('.field-checkbox').on('change', function() {
                initTravellersTable();
            });
            // Handle trip badge click
            $('.trip-filter').on('click', function() {
                currentTripId = $(this).data('trip-id') || '';
                initTravellersTable();
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hash = window.location.hash;
            if (hash) {
                const tabTrigger = document.querySelector(`a[data-bs-toggle="tab"][href="${hash}"]`);
                if (tabTrigger) {
                    const tab = new bootstrap.Tab(tabTrigger);
                    tab.show();
                }
            }
        });
    </script>
@endsection
