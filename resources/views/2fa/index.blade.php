@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">2FA {{__('Verification')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('2fa.store') }}">
                            @csrf

                            <p class="text-center">
                                {{__('We sent code to your phone')}}
                                : {{ substr(auth()->user()->phone, 0, 5) . '******' . substr(auth()->user()->phone,  -2) }}
                            </p>

                            @if ($message = Session::get('success'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($message = Session::get('error'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row mb-2 align-content-center justify-content-center">
                                <div class="col-4">
                                    <input id="code" type="number"
                                           class="form-control @error('code') is-invalid @enderror"
                                           name="code"
                                           value="{{ old('code') }}" required autocomplete="off" autofocus
                                           placeholder="{{__('Write code 2FA')}}">
                                    @error('code')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-12 offset-md-4">
                                    <a class="btn btn-link" href="{{ route('2fa.resend') }}">{{__('Resend Code?')}}</a>
                                </div>
                            </div>

                            <div
                                class="btn-group container row justify-content-center align-content-center align-items-center mt-5"
                                role="group">
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
