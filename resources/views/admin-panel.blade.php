@extends('layouts.app')

@section('content')
    <div class="container col-10 m-auto mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ __('admin-panel.title') }}
                </h5>
            </div>

            <div class="card-body">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="#users" data-bs-toggle="tab">
                            {{ __('admin-panel.tabs.users') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#trips" data-bs-toggle="tab">
                            {{ __('admin-panel.tabs.trips') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#messages" data-bs-toggle="tab">
                            {{ __('admin-panel.tabs.messages') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Users Tab -->
                    <div class="tab-pane active" id="users">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                            <h4 class="mb-0 me-3">
                                {{ __('admin-panel.users.title') }}
                            </h4>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($trips as $trip)
                                    <span class="badge bg-secondary text-white trip-filter"
                                        data-trip-id="{{ $trip->id }}" style="cursor: pointer;">
                                        {{ $trip->name }}: {{ $trip->participants_count }}
                                    </span>
                                @endforeach

                                <span class="badge bg-secondary text-white trip-filter" data-trip-id=""
                                    style="cursor: pointer;">
                                    {{ __('admin-panel.users.show_all') }}
                                </span>


                            </div>
                        </div>
                        <div class="row" style="">
                            <!-- Column for selecting fields -->
                            <div class="col-md-3"
                                style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; background-color: #f9f9f9;">
                                <h5>
                                    {{ __('admin-panel.users.select_fields') }}
                                </h5>
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
                                            <label
                                                class="form-check-label"
                                                for="field-{{ $key }}"
                                            >
                                                {{ $label }}
                                            </label>
                                        </div>
                                    @endforeach
                                </form>
                            </div>

                            <!-- Traveller Info Table -->
                            <div class="col-md-9">
                                <div class="table-responsive" style="overflow-x: auto;">
                                    <div id="search-container" class="mb-3 d-flex justify-content-between align-items-center"></div>

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
                        <h4>
                            {{ __('admin-panel.trips.title') }}
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-striped" id="trips-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('admin-panel.trips.name') }}</th>
                                        <th>{{ __('admin-panel.trips.description') }}</th>
                                        <th>{{ __('admin-panel.trips.price') }}</th>
                                        <th>{{ __('admin-panel.trips.status') }}</th>
                                        <th>{{ __('admin-panel.trips.created_at') }}</th>
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
                                            <td style="white-space: nowrap">{{ $trip->created_at->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <div class="d‐flex gap" role="group" style="white-space: nowrap;">
                                                    <a
                                                        href="{{ route('trips.edit', $trip->id) }}"
                                                        class="btn btn-sm btn-primary"
                                                    >
                                                        <i class="fas fa-edit"></i> {{ __('admin-panel.trips.edit') }}
                                                    </a>
                                                    <form
                                                        action="{{ route('trips.destroy', $trip->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ __('admin-panel.trips.confirm_delete') }}');"
                                                        style="display:inline;"
                                                    >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i> {{ __('admin-panel.trips.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">{{ __('admin-panel.trips.no_trips') }}</td>
                                        </tr>
                                    @endforelse

                                    <!-- Formulier om nieuwe trip toe te voegen -->
                                    <tr>
                                        <form action="{{ route('trips.store') }}" method="POST">
                                            @csrf

                                            <td>
                                                <input
                                                    type="text"
                                                    name="name"
                                                    class="form-control"
                                                    placeholder="{{ __('admin-panel.trips.form.name') }}"
                                                    required
                                                >
                                            </td>
                                            <td>
                                                <input
                                                    type="text"
                                                    name="description"
                                                    class="form-control"
                                                    placeholder="{{ __('admin-panel.trips.form.description') }}"
                                                >
                                            </td>
                                            <td>
                                                <input
                                                    type="email"
                                                    name="contact_email"
                                                    class="form-control"
                                                    placeholder="{{ __('admin-panel.trips.form.email') }}"
                                                >
                                            </td>
                                            <td>
                                                <input
                                                    type="number"
                                                    name="price"
                                                    step="0.01"
                                                    min="0.01"
                                                    class="form-control"
                                                    placeholder="{{ __('admin-panel.trips.form.price') }}"
                                                    required
                                                >
                                            </td>
                                            <td>
                                                <select name="status" class="form-select" required>
                                                    <option value="active">{{ __('admin-panel.trips.form.status.active') }}</option>
                                                    <option value="inactive">{{ __('admin-panel.trips.form.status.inactive') }}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fas fa-plus"></i> {{ __('admin-panel.trips.add') }}
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="messages">
                        <h4>
                            {{ __('admin-panel.messages.title') }}
                        </h4>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form id="send-message-form">
                                    @csrf

                                    <div class="form-group">
                                        <label for="trip-select">{{ __('admin-panel.messages.select_trip') }}</label>
                                        <select class="form-control" id="trip-select" name="trip_id" required>
                                            <option value="">{{ __('admin-panel.messages.choose_trip') }}</option>
                                            @foreach ($trips as $trip)
                                                <option value="{{ $trip->id }}">{{ $trip->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="message-content">{{ __('admin-panel.messages.your_message') }}</label>
                                        <textarea
                                            class="form-control"
                                            id="message-content"
                                            name="message"
                                            rows="5"
                                            placeholder="{{ __('admin-panel.messages.placeholder') }}"
                                            required
                                        ></textarea>
                                    </div>

                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane"></i> {{ __('admin-panel.messages.send') }}
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

    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.1/b-3.2.3/b-html5-3.2.3/datatables.min.css" rel="stylesheet" integrity="sha384-SsXr+Rik+YaI1kUcNsy0iR7Ej5ICaTpzwHgu2HZSv3qTAsw6IPjscQ0n7oUWJXP7" crossorigin="anonymous">
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.1/b-3.2.3/b-html5-3.2.3/datatables.min.js" integrity="sha384-2B4rPWsDxUUtaQ5nkU68698uuW3tI74KMaTzHwu9moFQy3VuUzR5OX0K0DxD3zeB" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script type="text/javascript">
    const translations = {
        confirmDelete: "{{ __('admin-panel.users.confirm_delete') }}",
        edit: "{{ __('admin-panel.users.edit') }}",
        delete: "{{ __('admin-panel.users.delete') }}",
        export: "{{ __('admin-panel.users.export') }}",
        actions: "{{ __('admin-panel.users.actions') }}",
        searchLabel:   "{{ __('admin-panel.users.search_label') }}",
        searchPlaceholder: "{{ __('admin-panel.users.search_placeholder') }}",
    };

    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        const newHash = e.target.getAttribute('href')
        if (history.pushState) {
            history.pushState(null, null, newHash);
        } else {
            location.hash = newHash;
        }
    });

    $(document).ready(function () {
        let travellersTable = null;
        let currentTripId = ''; // default to Show All

        function getSelectedFields() {
            const fields = [];
            $('.field-checkbox:checked').each(function () {
                fields.push($(this).val());
            });
            return fields;
        }

        function renderTableHeader(selectedFields) {
            const $thead = $('#travellers-thead');
            $thead.empty();
            selectedFields.forEach(col => {
                let label = col.replace(/_/g, ' ');
                label = label.split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');
                $thead.append(`<th data-col="${col}">${label}</th>`);
            });
            $thead.append('<th>' + translations.actions + '</th>');
        }

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
                render: function (data, type, row) {
                    const editUrl = `/travellers/${data}/edit`;
                    const deleteUrl = `/travellers/${data}`;
                    return `
                        <div class="d‐flex gap" role="group" style="white-space: nowrap;">
                            <a href="${editUrl}" class="btn btn-sm btn-primary">${translations.edit}</a>
                            <form action="${deleteUrl}" method="POST" style="display:inline; margin:0;" onsubmit="return confirm(translations.confirmDelete)">
                                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger">${translations.delete}</button>
                            </form>
                        </div>`;
                }
            });

            travellersTable = $('#travellers-table').DataTable({
                ordering: true,
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{ route('admin-panel.travellers-data') }}",
                    type: 'POST',
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.fields = getSelectedFields();
                        d.trip_id = currentTripId;
                    }
                },
                columns: columnsConfig,
                scrollX: true,
                dom: "<'row mb-3'<'col-md-6'f><'col-md-6 text-end'<'export-label'>B>>" +
                     "<'row'<'col-12'tr>>" +
                     "<'row mt-2'<'col-md-5'i><'col-md-7'p>>",
                buttons: [
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-success me-2',
                        filename: 'techreizen_travellers_excel',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-danger',
                        filename: 'techreizen_travellers_pdf',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                    }
                ],
                order: [[0, 'asc']],
                rowId: 'id',
                initComplete: function () {
                    const $wrapper   = $('#travellers-table_wrapper');
                    const $filterDiv = $wrapper.find('.dt-search');
                    const $buttonsDiv = $wrapper.find('.dt-buttons');

                    $('#search-container').empty();

                    $filterDiv.find('label').contents()[0].nodeValue = translations.searchLabel + ':'
                    $filterDiv.find('input').attr('placeholder', translations.searchPlaceholder).addClass('ms-2');

                    $filterDiv.addClass('d-flex align-items-center');

                    $filterDiv.detach();
                    $buttonsDiv.detach();

                    const $exportWrapper = $('<div class="d-flex align-items-center"></div>')
                        .append('<span class="me-2 fw-bold">' + translations.export + ' :</span>')
                        .append($buttonsDiv);

                    $('#search-container')
                        .append($filterDiv)
                        .append($exportWrapper);
                }
            });
        }

        function updateBadgeColors() {
            $('.trip-filter').each(function () {
                const thisTripId = $(this).data('trip-id');
                if (thisTripId === currentTripId) {
                    $(this).removeClass('bg-danger bg-secondary').addClass('bg-success');
                } else {
                    $(this).removeClass('bg-success bg-secondary').addClass('bg-danger');
                }
            });
        }

        // Initialize on load
        updateBadgeColors();
        initTravellersTable();

        // React to checkbox field changes
        $('.field-checkbox').on('change', function () {
            initTravellersTable();
        });

        // Unified badge click handler (including "Show All")
        $('.trip-filter').on('click', function () {
            currentTripId = $(this).data('trip-id') || ''; // '' means Show All
            updateBadgeColors();
            initTravellersTable();
        });

        // Optional: maintain tab state
        const hash = window.location.hash;
        if (hash) {
            const tabTrigger = document.querySelector(`a[data-bs-toggle="tab"][href="${hash}"]`);
            if (tabTrigger) {
                new bootstrap.Tab(tabTrigger).show();
            }
        }
    });
</script>


@endsection
