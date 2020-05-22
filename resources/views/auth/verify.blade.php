@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('messages.email_verify') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ trans('messages.email_sent') }}
                        </div>
                    @endif

                    {{ trans('messages.email_check') }}
                    {{ trans('messages.email_failed') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ trans('messages.email_request') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
