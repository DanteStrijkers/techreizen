@extends('layouts.app')

@section('content')
    <div class="col-md-8 p-2">
        <div class="card">
            <div class="card-header">{{ __('Contact') }}</div>

            <div class="card-body">
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf

                    <!-- first name field -->
                    <div class="row mb-3">
                        <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>
                        <div class="col-md-6">
                            <input id="first_name" type="text" name="first_name" class="form-control" maxlength="50" value="{{ old('first_name') }}" required autocomplete="given-name" autofocus>
                        </div>
                    </div>

                    <!-- last name field -->
                    <div class="row mb-3">
                        <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>
                        <div class="col-md-6">
                            <input id="last_name" type="text" name="last_name" class="form-control" maxlength="50" value="{{ old('last_name') }}" required autocomplete="family-name">
                        </div>
                    </div>

                    <!-- email field -->
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" name="email" class="form-control" maxlength="100" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>

                    <!-- trips dropdown -->
                    <div class="row mb-3">
                        <label for="trip" class="col-md-4 col-form-label text-md-end">{{ __('Trip') }}</label>
                        <div class="col-md-6">
                            <select id="trip" name="trip" class="form-control" required>
                                <option value="" disabled selected>{{ __('Select a trip') }}</option>
                                @foreach($trips as $trip)
                                    <option value="{{ $trip->id }}" {{ old('trip') == $trip->id ? 'selected' : '' }}>
                                        {{ $trip->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- message text area -->
                    <div class="row mb-3">
                        <label for="message" class="col-md-4 col-form-label text-md-end">{{ __('Message') }}</label>

                        <div class="col-md-6">
                            <textarea id="message" name="message" class="form-control" maxlength="1000" required>{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <!-- captcha -->
                    <div class="row mb-3 col-md-8 offset-md-4">
                        <x-turnstile />
                    </div>

                    <!-- error list -->
                    @if ($errors->any())
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
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

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4 d-flex align-items-center gap-2">
                            <!-- send button -->
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send') }}
                            </button>

                            <!-- cancel button -->
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('home') }}'">
                                {{ __('Cancel') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
