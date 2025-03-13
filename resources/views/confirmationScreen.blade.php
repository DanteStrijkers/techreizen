 @extends('layouts.app')

@section('content')
    <div class="row justify-content-center p-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">{{ __('Succesvol Verzonden') }}</div>

                <div class="card-body text-center">
                    <h5>{{ __('Hey') }} {{request('name')}}, {{ __('je bericht is succesvol verzonden!') }}</h5>
                    <p>{{ __('We nemen zo snel mogelijk contact met je op.') }}</p>
                </div>

                <div class="text-center">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            {{ __('Terug naar home') }}
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
