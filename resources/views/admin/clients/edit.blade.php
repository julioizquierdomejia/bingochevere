@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('EDITAR CLIENTE') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/admin/clientes/{{ $user->id }}/actualizar" autocomplete="off">
                            @method('PUT')
                            @csrf
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Razon Social') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Razon Social del Cliente') }}" value="{{ $user->name }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ $user->email }}">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('nombre_comercial') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nombre_comercial">{{ __('Nombre comercial') }}</label>
                                    <input type="text" name="nombre_comercial" id="input-nombre_comercial" class="form-control form-control-alternative{{ $errors->has('nombre_comercial') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre comercial de la empresa') }}" value="{{ $user->nombre_comercial }}">

                                    @if ($errors->has('nombre_comercial'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nombre_comercial') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('ruc') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-ruc">{{ __('RUC') }}</label>
                                    <input type="text" name="ruc" id="input-ruc" class="form-control form-control-alternative{{ $errors->has('ruc') ? ' is-invalid' : '' }}" placeholder="{{ __('RUC') }}" value="{{ $user->ruc }}">

                                    @if ($errors->has('ruc'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ruc') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('contacto') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-contacto">{{ __('Persona de contacto') }}</label>
                                    <input type="text" name="contacto" id="input-contacto" class="form-control form-control-alternative{{ $errors->has('contacto') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre de la Persona de contacto') }}" value="{{ $user->contacto }}">

                                    @if ($errors->has('contacto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contacto') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('area') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-area">{{ __('Área') }}</label>
                                    <input type="text" name="area" id="input-area" class="form-control form-control-alternative{{ $errors->has('area') ? ' is-invalid' : '' }}" placeholder="{{ __('Area del contacto') }}" value="{{ $user->area }}">

                                    @if ($errors->has('area'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('area') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-telefono">{{ __('Teléfono de Contacto') }}</label>
                                    <input type="text" name="telefono" id="input-telefono" class="form-control form-control-alternative{{ $errors->has('telefono') ? ' is-invalid' : '' }}" placeholder="{{ __('Teléfono del contacto') }}" value="{{ $user->telefono }}">

                                    @if ($errors->has('telefono'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Registrar Cliente') }}</button>
                                </div>

                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush