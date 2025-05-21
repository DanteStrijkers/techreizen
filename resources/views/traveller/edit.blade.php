@extends('layouts.app')

@section('content')
<div class="container col-10 m-auto mt-5">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Traveller</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('travellers.update', $traveller->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $traveller->first_name }}" required>
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ $traveller->last_name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $traveller->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="trip_id" class="form-label">Trip</label>
                    <select name="trip_id" class="form-select">
                        <option value="">-- Select Trip --</option>
                        @foreach($trips as $trip)
                            <option value="{{ $trip->id }}" {{ $traveller->trip_id == $trip->id ? 'selected' : '' }}>
                                {{ $trip->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" name="country" value="{{ $traveller->country }}">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $traveller->address }}">
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="male" {{ $traveller->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $traveller->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $traveller->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $traveller->phone }}">
                </div>

                <div class="mb-3">
                    <label for="emergency_phone_1" class="form-label">Emergency Phone 1</label>
                    <input type="text" class="form-control" name="emergency_phone_1" value="{{ $traveller->emergency_phone_1 }}">
                </div>

                <div class="mb-3">
                    <label for="emergency_phone_2" class="form-label">Emergency Phone 2</label>
                    <input type="text" class="form-control" name="emergency_phone_2" value="{{ $traveller->emergency_phone_2 }}">
                </div>

                <div class="mb-3">
                    <label for="nationality" class="form-label">Nationality</label>
                    <input type="text" class="form-control" name="nationality" value="{{ $traveller->nationality }}">
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" class="form-control" name="birthdate" value="{{ $traveller->birthdate }}">
                </div>

                <div class="mb-3">
                    <label for="birthplace" class="form-label">Birthplace</label>
                    <input type="text" class="form-control" name="birthplace" value="{{ $traveller->birthplace }}">
                </div>

                <div class="mb-3">
                    <label for="iban" class="form-label">IBAN</label>
                    <input type="text" class="form-control" name="iban" value="{{ $traveller->iban }}">
                </div>

                <div class="mb-3">
                    <label for="bic" class="form-label">BIC</label>
                    <input type="text" class="form-control" name="bic" value="{{ $traveller->bic }}">
                </div>

                <div class="mb-3">
                    <label for="medical_issue" class="form-label">Medical Issue</label>
                    <input type="text" class="form-control" name="medical_issue" value="{{ $traveller->medical_issue }}">
                </div>

                <div class="mb-3">
                    <label for="medical_info" class="form-label">Medical Info</label>
                    <textarea class="form-control" name="medical_info">{{ $traveller->medical_info }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
