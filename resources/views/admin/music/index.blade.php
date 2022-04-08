@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    

    <div class="container-fluid mt--7">

        @if($user_current->role_id == 1)
            <div class="row mt-5">
                <div class="col-xl-12">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Listado de Canciones <span><input type="text" name="" value="" class="clipboard" style="border:0; color: gray; margin-left: 10px; opacity: 0;"></span> Hay un total de {{ $musics->count() }} Canciones registradas</h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    
                                    <!-- Projects table -->
                                    <table class="table align-items-center table-flush" id="lista">

                                        <thead class="thead-light">
                                            <tr>
                                            	<th></th>
                                                <th scope="col">Numero de Orden</th>
                                                <th scope="col">Nombre de la canción</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($musics as $music)
                                        	<tr>
                                        		<td><i class="fas fa-ellipsis-v"></i></td>
                                        		<td>{{ $music->order }}</td>
                                        		<td>{{ $music->name }}</td>
                                        		<td>
                                        			
                                        			<form action="" method="POST">
	                                    				@csrf
	                                    				<a href="{{ route('music.edit', $music) }}" class="btn btn-sm btn-info"><i class="far fa-edit"></i></a>
	                                        			{{-- 
                                                        <a href="" class="btn btn-sm btn-warning delete" data-name='{{ $music->name }}' data-id='{{ $music->id }}'><i class="fas fa-trash-alt"></i></a>
                                                         --}}
	                                        		</form>
                                        			
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
        @endif
        

        

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

    <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
	<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    

    <script type="text/javascript">
        $(document).ready( function () {

        	/* ************************* */
        	const lista = document.getElementById('lista');
            Sortable.create(lista, {});
                
        	/* ************************* */

            $('#table_clients').DataTable({
                responsive: true,
                autoWidth: false
            });

            
            $('#table_campanias').DataTable({
                responsive: true,
                autoWidth: false
            });

            //eliminar registro de canciones 
            $(document).on('click', '.delete', function(e){

            	name=$(this).data("name")
            	id=$(this).data("id")

            	e.preventDefault();

            	Swal.fire({
				  title: 'Estas seguro de Elimnar?',
				  text: name,
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Si, eliminar!',
				  cancelButtonText: 'Cancelar'
				}).then((result) => {
				  if (result.isConfirmed) {
				    $.ajax({
	                        url: "/admin/music/"+ id,
	                        method: 'DELETE',
	                        data:{
	                            _token:$('input[name="_token"]').val(),
	                            id: id,
	                        }
                    }).done(function(res){ 

                        Swal.fire(
                          'Eliminado!',
                          res,
                          'success'
                        )
                    })
				  }
				})
            })
            

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

            //$('.carton').hide();
            $('#download').hide();
            $('#carton_completo').hide();
            

            $('#generar_bingo').click(function(e){
                e.preventDefault();

                $('#generar_bingo').attr('disabled', true);

                $.ajax({
                    url: "{{ route('admin.clients.createbingo') }}",
                    method: 'POST',
                    data:{
                        _token:$('input[name="_token"]').val(),
                        id: '{{$user_current->user_id}}',
                    }
                }).done(function(res){
                    //alert(res)
                    //console.log(res[0]);

                    for (var i = 0; i < 5; i++) {

                        if (i == 2) {
                            $('.fila1').append('<td style="font-size: 43px; color: black; text-align: center;">'+ res[0][i] +'</td>');
                            $('.fila2').append('<td style="font-size: 43px; color: black; text-align: center;">'+ res[1][i] +'</td>');
                            $('.fila3').append('<td style="font-size: 43px; color: black; text-align: center; opacity:0;">'+ res[2][i] +'</td>');
                            $('.fila4').append('<td style="font-size: 43px; color: black; text-align: center;">'+ res[3][i] +'</td>');
                            $('.fila5').append('<td style="font-size: 43px; color: black; text-align: center;">'+ res[4][i] +'</td>');   
                        }else{
                            $('.fila1').append('<td style="font-size: 43px; color: black; text-align: center;">'+ res[0][i] +'</td>');
                            $('.fila2').append('<td style="font-size: 43px; color: black; text-align: center;">'+ res[1][i] +'</td>');
                            $('.fila3').append('<td style="font-size: 43px; color: black; text-align: center;">'+ res[2][i] +'</td>');
                            $('.fila4').append('<td style="font-size: 43px; color: black; text-align: center;">'+ res[3][i] +'</td>');
                            $('.fila5').append('<td style="font-size: 43px; color: black; text-align: center;">'+ res[4][i] +'</td>');
                        }



                    }

                    $('#codigo').html(res[0][5]);


                    $('#download').show();
                    $('#generar_bingo').hide();
                    $('#carton_completo').show('slow');
                    $('.carton').show('slow');

                    html2canvas(document.getElementById('capture')).then(function(canvas){
                        //$('#foto').append(canvas);

                        //var a = document.getElementById('capture').createElement('a');
                        //a.href = canvas.toDataURL("image/png");

                        //console.log(canvas.toDataURL("image/png"));
                        link = canvas.toDataURL("image/png");
                        $('#download').attr('href', link);

                    })
                    

                })

            })

            $('#tomar_foto').click(function(){

                
                html2canvas(document.getElementById('capture')).then(function(canvas){
                    //$('#foto').append(canvas);

                    //var a = document.getElementById('capture').createElement('a');
                    //a.href = canvas.toDataURL("image/png");

                    console.log(canvas.toDataURL("image/png"));
                    link = canvas.toDataURL("image/png");
                    $('#download').attr('href', 'google.com.pe');
                })
                
                /*
                html2canvas($('#capture')),
                {
                    onrendered: function(canvas){
                        var a = document.createElement('a');

                        a.href = canvas.toDataURL("image/png");
                        a.download = 'carton.png';
                        a.click();
                    }
                }
                */


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