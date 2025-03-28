@extends('layouts.app')

@section('content')
    <div class="row justify-content-center p-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">{{ __('contact.confirmation.title') }}</div>

                <div class="card-body text-center">
                    <h5>{{ __('contact.confirmation.header', ['first_name' => $first_name]) }}</h5>
                    <p>{{ __('contact.confirmation.message') }}</p>
                </div>
                <div class="row mb-3">
                    <div class="text-center">
                            <a href="{{ route('home') }}" class="btn btn-primary">
                                {{ __('contact.confirmation.button') }}
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
