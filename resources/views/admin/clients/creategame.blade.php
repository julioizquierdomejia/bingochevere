@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Crear un juego nuevo para') }} {{$user->name}}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.clients.storegame') }}" autocomplete="off" enctype="multipart/form-data">
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
                                    <label class="form-control-label" for="input-name">{{ __('Nombre de la Campaña') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre de la Campaña') }}" value="{{ old('name') }}"autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Descripción de la Campaña') }}</label>
                                    <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripción de la Campaña') }}" value="{{ old('description') }}">

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('cant') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-cant">{{ __('Canitdad de Cartones') }}</label>
                                    <input type="text" name="cant" id="input-cant" class="form-control form-control-alternative{{ $errors->has('cant') ? ' is-invalid' : '' }}" placeholder="{{ __('Cantidad de Cartones') }}" value="{{ old('cant') }}"autofocus>

                                    @if ($errors->has('cant'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cant') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('background_design') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-background_design">{{ __('Diseño del Carton') }}</label>
                                    <input type="file" name="background_design" id="input-background_design" class="form-control form-control-alternative{{ $errors->has('background_design') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripción de la Campaña') }}" value="{{ old('background_design') }}">

                                    @if ($errors->has('background_design'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('background_design') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{--
                                <div class="form-group{{ $errors->has('logo_central') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-logo_central">{{ __('Logo del carton') }}</label>
                                    <input type="file" name="logo_central" id="input-logo_central" class="form-control form-control-alternative{{ $errors->has('logo_central') ? ' is-invalid' : '' }}" placeholder="{{ __('Logo del carton') }}" value="{{ old('logo_central') }}">

                                    @if ($errors->has('logo_central'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('logo_central') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                --}}

                                <div class="form-group">
                                    <label for="color" class="form-control-label">Elija un color para su campaña</label>
                                    <input type="color" id="favcolor" name="color"><br><br>
                                </div>

                                <div class="form-group">
                                    <label for="color_text" class="form-control-label">Elija un color de Texto</label>
                                    <input type="color" id="favcolor-text" name="color_text"><br><br>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Status de la Campaña</label>
                                    <div class="custom-control custom-radio mb-3">
                                      <input type="radio" id="isActive" name="status" class="custom-control-input" value="1" checked>
                                      <label class="custom-control-label" for="isActive">Activo</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                      <input type="radio" id="isNotactive" name="status" class="custom-control-input" value="0">
                                      <label class="custom-control-label" for="isNotactive">Inactivo</label>
                                    </div>
                                </div>

                                <input type="hidden" name="statusCamapania" id="status_campania" value="1">
                                <input type="hidden" name="id" value="{{ $user->id }}">

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Registrar Campaña') }}</button>
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

    <script type="text/javascript">
        
        $('input[name=status]').change(function(){
          if($(this).val() == 1){
            $('#status_campania').val('1')
          }else{ // Si es Boelta
            $('#status_campania').val('0')
          }
        });

    </script>


@endpush