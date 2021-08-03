@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    

    <div class="container-fluid mt--7">

        @if($user_current->role_id == 1)
            <div class="row mt-5">
                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Clientes</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="{{route('admin.clients.create')}}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Crear Nuevo Cliente"><i class="fas fa-plus-circle"></i> Crear Cliente</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush" id="table_clients">

                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Contacto</th>
                                        <th scope="col">contactos</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="row">
                                                {{$user->name}}
                                            </th>
                                            <td>
                                                @if($user->contacto == null)
                                                    <span class="text-light">No hay contacto registrado</span>
                                                @else
                                                    <span class="text-primary">{{$user->contacto}}</span>
                                                @endif
                                            </td>
                                            <!--td>
                                                0
                                            </td-->
                                            <td>
                                                <b>{{$user->telefono}}</b> / {{$user->email}}
                                            </td>
                                            <td>
                                                <a href=" {{route('admin.clients.edit', $user->id )}} " class="btn btn-sm btn-warning" id="{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <i class="far fa-edit"></i></a>

                                                <a href=" {{route('admin.clients.creategame', $user->id )}} " class="btn btn-sm btn-success" id="{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Crear Juego">
                                                    <i class="fas fa-puzzle-piece"></i></a>

                                                {{--
                                                <a href=" {{route('admin.clients.show', $user->id )}} " class="btn btn-sm btn-warning" id="{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Ver Juegos">
                                                    <i class="fas fa-chess"></i></a>
                                                --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Campañas Activas <span><input type="text" name="" value="" class="clipboard" style="border:0; color: gray; margin-left: 10px; opacity: 0;"></span></h3>
                                </div>
                                {{--
                                <div class="col text-right">
                                    <a href="#!" class="btn btn-sm btn-primary">Ver todo</a>
                                </div>
                                --}}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush" id="table_clients">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Campaña</th>
                                        <th scope="col">Jugadores listos</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($campanias as $camp)
                                    <tr>
                                        <th scope="row">
                                            {{$camp->nombre_cliente}}
                                        </th>
                                        <td>
                                            {{$camp->name}}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">60%</span>
                                                <div>
                                                    <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%; background-color: {{$camp->color}};"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="row-register">
                                            <a class="btn btn-sm btn-success text-white boton_copiar">
                                                    <i class="far fa-copy"></i>

                                            <a href=" {{route('admin.clients.editgame', $camp->id )}} " class="btn btn-sm btn-warning" id="{{$camp->id}}" data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <i class="far fa-edit"></i></a>

                                            <input type="text" name="" id="" value="{{$camp->url_register}}" class="url_registro" style="opacity:0;">
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{--
                                    <tr>
                                        <th scope="row">
                                            Facebook
                                        </th>
                                        <td>
                                            5,480
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">70%</span>
                                                <div>
                                                    <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            Google
                                        </th>
                                        <td>
                                            4,807
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">80%</span>
                                                <div>
                                                    <div class="progress">
                                                    <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            Instagram
                                        </th>
                                        <td>
                                            3,678
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">75%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            twitter
                                        </th>
                                        <td>
                                            2,645
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">30%</span>
                                                <div>
                                                    <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        

        @if($user_current->role_id == 2)
            <div class="row mt-5">
                <div class="col-xl-7 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Colaboradores</h3>
                                </div>
                                <!--div class="col text-right">
                                    <a href="{{route('admin.clients.create')}}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Crear Nuevo Cliente"><i class="fas fa-plus-circle"></i> Generar Carton de bingo</a>
                                </div-->
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush" id="table_clients">

                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Colaborador</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Carton</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trabajadores as $trabajador)
                                        <tr>
                                            <th scope="row">
                                                {{$trabajador->name}}
                                            </th>
                                            <td>
                                                {{$trabajador->email}}
                                            </td>
                                            <!--td>
                                                0
                                            </td-->
                                            <td>
                                                20 / 35
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        @endif


        @if($user_current->role_id == 3)
            <div class="row mt-5">
                <div class="col-xl-7 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <a href="clientes/{{$user_current->id}}/crearcarton" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Crear Carton de Bingo"><i class="fas fa-plus-circle"></i> Generar Carton de bingo</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-xl-5">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Mi carton de Bingo</h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!--script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script-->
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
        $(document).ready( function () {
            //$('#table_clients').DataTable();

            //const button = document.querySelector('#boton_copiar');
            //const input = document.querySelector('#url_registro');


            //aqui tengo que aprovechar la iteracción

            //$('.boton_copiar').addEventListener('click', function(){
                //alert('hola');
                //$(this).find('input').focus();
                //$('.url_registro').focus();
                //document.execCommand('selectAll')
                //document.execCommand('copy')

            //})

            $('.boton_copiar').click(function(){
                valor = $(this).parent().find('input').val();
                $('.clipboard').val(valor);
                $('.clipboard').focus();
                document.execCommand('selectAll');
                document.execCommand('copy');
                
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Felicidades',
                  text: 'Se copio la URL para el registro!',
                  showConfirmButton: false,
                  timer: 1500
                })

            })


        } );
    </script>
@endpush