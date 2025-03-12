@extends('layouts.app')

@section('content')
    <div class="row justify-content-center p-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contact') }}</div>

                <div class="card-body">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" name="name" class="form-control" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" name="email" class="form-control" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="message" class="col-md-4 col-form-label text-md-end">{{ __('Message') }}</label>

                            <div class="col-md-6">
                                <textarea id="message" name="message" class="form-control" required></textarea>
                            </div>
                        </div>


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
