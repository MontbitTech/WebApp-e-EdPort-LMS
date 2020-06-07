@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    @if (session('error'))
                      <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                      </div>
                    @endif
                    <form method="POST" action="{{ route('teacher.login') }}">
                        @csrf

                        
                        <div class="form-group row">
                            <label for="login_pin" class="col-md-4 col-form-label text-md-right">{{ __('Login Pin') }}</label>

                            <div class="col-md-6">
                                <input id="login_pin" type="password" class="form-control @error('login_pin') is-invalid @enderror" name="login_pin" required autocomplete="current-password">

                                @error('login_pin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
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
