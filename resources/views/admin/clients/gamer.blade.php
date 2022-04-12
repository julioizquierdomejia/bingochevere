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
                                {{--<a href="clientes/{{$user_current->id}}/crearcarton" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Crear Carton de Bingo"><i class="fas fa-plus-circle"></i> Generar Carton de bingo</a>--}}

                                <div>
                                    <form>
                                        @csrf
                                        @if($carton == null)
                                            <a href="#" class="btn btn-primary text-white" data-toggle="tooltip" data-placement="top" title="Crear Carton de Bingo" id="generar_bingo" disabled><i class="fas fa-plus-circle"></i> Generar Carton de bingo</a>
                                        @else
                                            <a href="#" class="btn btn-success text-white" data-toggle="tooltip" data-placement="top" title="Crear Carton de Bingo" id="generar_bingo" disabled><i class="far fa-eye"></i>Ver Mi Carton de Bingo</a>
                                        @endif
                                        
                                        <a href="" download='{{$user_current->name}}.png' class="btn btn-success text-white" id="download"><i class="fas fa-plus-circle"></i> Descargar Carton</a>

                                    </form>
                                </div>


                                <div class="table-responsive mt-5" id="carton_completo">

                                    <!-- Projects table -->
                                    <!-- Preguntamos que tipo de carton mostrar segun la campaña -->
                                    @if($campania->type == 1 )
                                        <div class="carton bg-gray" id="capture" style="height: 790px; width: 560px;">
                                            <div id="take">
                                                <img src="../assets/img/background_bingo/{{$campania->background_design}}" id="imagenFondo" style="width:560px; height:auto; position: absolute;">
                                                
                                                    
                                                    {{-- 
                                                    
                                                    <table border="" width="300px">
                                                     --}}
                                                    <table class="tabla table table-borderless" id="tablaNumeros" style="position:absolute; top: 355px; width: 200px; left: 50px; font-weight: bold;">
                                                    
                                                        <tr class="fila1"></tr>
                                                        <tr class="fila2"></tr>
                                                        <tr class="fila3"></tr>
                                                        <tr class="fila4"></tr>
                                                        <tr class="fila5"></tr>
                                                    </table>
                                                
                                                <div id="codigo" style="width:209px; height:auto; position: absolute; font-weight: bold; left: 189px; top:221px; font-size: 22px; text-align: center;"></div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="carton bg-gray" id="capture" style="height: 790px; width: 1000px;">
                                            <div id="take">
                                                <img src="../assets/img/background_bingo/{{$campania->background_design}}" id="imagenFondo" style="width:1000px; height:auto; position: absolute;">
                                                
                                                    <table border="0" width="930px" style="border-collapse: collapse; position:absolute; top: 388px; left: 50px; font-weight: bold; text-align: center;">
                                                        <tr class="fila1"></tr>
                                                        <tr class="fila2"></tr>
                                                        <tr class="fila3"></tr>
                                                        <tr class="fila4"></tr>
                                                        <tr class="fila5"></tr>
                                                    </table>

                                                    {{-- 
                                                    <table class="tabla table" id="tablaMusica" width='100%' border style="border-collapse: collapse; position:absolute; top: 388px; left: 50px; font-weight: bold; text-align: center;">
                                                    
                                                        <tr class="fila1"></tr>
                                                        <tr class="fila2"></tr>
                                                        <tr class="fila3"></tr>
                                                        <tr class="fila4"></tr>
                                                        <tr class="fila5"></tr>
                                                    </table>
                                                     --}}
                                                
                                                <div id="codigo" style="width:209px; height:auto; position: absolute; font-weight: bold; left: 420px; top:213px; font-size: 22px; text-align: center;"></div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            
        </div>

        <div id="ver">
            <div class="col" id="aqui">
                

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
                    console.log("******************************");
                    console.log(res);
                    console.log("******************************");

                    if({{ $campania->type }} == 1){
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
                    }else{//es de musica
                        for (var i = 0; i < 5; i++) {
                            if (i == 2) {

                                $('.fila1').append('<td width="190px" style="padding:24px 16px 23px 16px">'+ res[0][i] +'</td>');
                                $('.fila2').append('<td width="190px" style="padding:24px 16px 23px 16px">'+ res[1][i] +'</td>');
                                $('.fila3').append('<td width="190px" style="padding:24px 16px 23px 16px; opacity:0;">'+ res[2][i] +'</td>');
                                $('.fila4').append('<td width="190px" style="padding:24px 16px 23px 16px">'+ res[3][i] +'</td>');
                                $('.fila5').append('<td width="190px" style="padding:24px 16px 23px 16px">'+ res[4][i] +'</td>');
                            }else{
                                $('.fila1').append('<td width="190px" style="padding:24px 16px 23px 16px">'+ res[0][i] +'</td>');
                                $('.fila2').append('<td width="190px" style="padding:24px 16px 23px 16px">'+ res[1][i] +'</td>');
                                $('.fila3').append('<td width="190px" style="padding:24px 16px 23px 16px">'+ res[2][i] +'</td>');
                                $('.fila4').append('<td width="190px" style="padding:24px 16px 23px 16px">'+ res[3][i] +'</td>');
                                $('.fila5').append('<td width="190px" style="padding:24px 16px 23px 16px">'+ res[4][i] +'</td>');
                            }
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