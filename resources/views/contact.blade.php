@extends('layouts.app')

@section('content')
    <div class="row justify-content-center p-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contact') }}</div>

                <div class="card-body">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <!-- cancel button -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" name="name" class="form-control" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <!-- email field -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" name="email" class="form-control" required autocomplete="email">
                            </div>
                        </div>

                        <!-- trips dropdown -->
                        <div class="row mb-3">
                            <label for="trip" class="col-md-4 col-form-label text-md-end">{{ __('Trip') }}</label>
                            <div class="col-md-6">
                                <select id="trip" name="trip" class="form-control" required>
                                    <option value="" disabled selected>{{ __('Select a trip') }}</option>
                                    @foreach($trips as $trip)
                                        <option value="{{ $trip->id }}">{{ $trip->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- message text area -->
                        <div class="row mb-3">
                            <label for="message" class="col-md-4 col-form-label text-md-end">{{ __('Message') }}</label>

                            <div class="col-md-6">
                                <textarea id="message" name="message" class="form-control" required></textarea>
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

                                <!-- success message -->
                                @if(session('success'))
                                    <span class="text-success fw-bold ms-3">{{ session('success') }}</span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
