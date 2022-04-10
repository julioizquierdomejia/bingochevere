@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    

    <div class="container-fluid mt--7">

            <div class="row mt-5">
                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Clientes </h3>
                                </div>
                                <div class="col text-right">
                                    <a href="{{route('admin.clients.create')}}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Crear Nuevo Cliente"><i class="fas fa-plus-circle"></i> Crear Cliente</a>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                
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
                        
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- Projects table -->
                                    <table class="table align-items-center table-flush" id="table_campanias">
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
                                                        <span class="mr-2">
                                                            {{$camp->cartones}} de {{$camp->cant}}
                                                            {{-- number_format($camp->cartones * 100 / $camp->cant, 2) --}}{{--%--}}
                                                        </span>
                                                        <div>
                                                            <div class="progress">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ number_format($camp->cartones * 100 / $camp->cant, 2) }}%; background-color: {{$camp->color}};"></div>
                                                            </div>
                                                        </div>
                                                        <span class="ml-2">
                                                            {{number_format($camp->cartones * 100 / $camp->cant, 2) }}%
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="row-register">
                                                    <a class="btn btn-sm btn-success text-white boton_copiar">
                                                            <i class="far fa-copy"></i></a>

                                                    <a href=" {{route('admin.clients.editgame', $camp->id )}} " class="btn btn-sm btn-warning" id="{{$camp->id}}" data-toggle="tooltip" data-placement="top" title="Editar">
                                                            <i class="far fa-edit"></i></a>

                                                    <a class="btn btn-sm btn-danger text-white eliminar-camp"  id="{{$camp->id}}" name='{{$camp->name}}'>
                                                            <i class="far fa-trash-alt"></i></a>

                                                    <input type="text" name="" id="" value="{{$camp->url_register}}" class="url_registro" style="opacity:0;">

                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>        

        @include('layouts.footers.auth')

    </div>
@endsection

@push('js')
    <script type="text/javascript" src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!--script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script-->

    <!--script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script-->

    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>


    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.2.1/html2canvas.min.js" integrity="sha512-RGZt6PJZ2y5mdkLGwExIfOMlzRdkMREWobAwzTX4yQV0zdZfxBaYLJ6nPuMd7ZPXVzBQL6XAJx0iDXHyhuTheQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready( function () {

            $('#table_clients').DataTable({
                responsive: true,
                autoWidth: false
            });

            
            $('#table_campanias').DataTable({
                responsive: true,
                autoWidth: false
            });
            

            //boton para copiar la URL de creacion de usuarios
            //$('.boton_copiar').click(function(){
            $(document).on('click', '.boton_copiar', function(){
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

            //Boton para eliminar campañs
            $(document).on('click', '.eliminar_camp', function(){

            })


            //ajax para consultar campañas
            $(document).on('click', '.eliminar-camp', function(){

                id = $(this).attr('id');
                camp = $(this).attr('name');

                $.ajax({
                    url: "{{ route('admin.clients.consultarcamp') }}",
                    method : 'POST',
                    data:{
                        _token:$('input[name="_token"]').val(),
                        id: id, //'{{$user_current->id}}',
                    }
                }).done(function(res){
                    //alert('Al eliminar esta campaña estamos elimmando a ' + res + ' Usuarios que han generado sus cartones')

                    Swal.fire({
                      title: camp,
                      text: 'Al eliminar esta campaña estamos elimmando a ' + res + ' Usuarios que han generado sus cartones',
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#39BD4F',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, Eliminar',
                      cancelButtonText: 'Cancelar',
                    }).then((result) => {
                      if (result.isConfirmed) {

                        //console.log('Eliminando registros');

                        //ajax Para eliminar campañas
                        $.ajax({
                            url: "{{ route('admin.clients.borrarcamp') }}",
                            type : 'DELETE',
                            data:{
                                _token:$('input[name="_token"]').val(),
                                id: id, //'{{$user_current->id}}',
                            }
                        }).done(function(res){
                            //console.log('Se elimino');
                            Swal.fire(
                              'Campaña Eliminada',
                              res,
                              'success'
                            )
                        })

                        
                      }
                    })


                })
            })
            

        })

    </script>
@endpush