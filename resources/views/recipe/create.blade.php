@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('recipe.store') }}">
        <div class="row justify-content-center">

                <div class="col-md-10">
                    @csrf
                    <div class="card">
                        <div class="card-header">{{ __('Create_Recipe') }}</div>

                        <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="mt-2 col-md-12">
                    <ingredient-component></ingredient-component>

                </div>
        </div>
        </form>
    </div>
@endsection
