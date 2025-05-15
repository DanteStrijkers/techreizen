@extends('layouts.app')

@section('content')
    <div class="container col-10 m-auto mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Trip</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('trips.update', $trip->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Trip Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $trip->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description">{{ $trip->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="contact_email" class="form-label">Email (Contactpersoon)</label>
                        <select class="form-select" name="contact_email">
                            <option value="">-- Kies een contactpersoon --</option>
                            @foreach ($admins as $admin)
                                <option value="{{ $admin->email }}" {{ $trip->contact_email === $admin->email ? 'selected' : '' }}>
                                    {{ $admin->first_name }} {{ $admin->last_name }} ({{ $admin->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" value="{{ $trip->price }}" step="0.01" min="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ $trip->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $trip->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
