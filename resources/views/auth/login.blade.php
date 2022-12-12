@extends('layouts.auth')
@push('content')
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="card w-50">
            <p class="card-header">{{ trans('auth.login.title') }}</p>
            <div class="card-body">
                <form method="POST">
                    @csrf
                    <x-forms.inputs.email name="email" label="{{ trans('auth.fields.email.label') }}" value="{{ old('email') }}" required/>
                    <x-forms.inputs.password name="password" label="{{ trans('auth.fields.password.label') }}" required/>
                    <button type="submit" class="btn btn-success">{{ trans('Login') }}</button>
                </form>
            </div>
        </div>
    </div>
@endpush
