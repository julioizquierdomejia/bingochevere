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
                                <h3 class="mb-0">Listado de Cartones</h3>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table id="table_clients" class="table align-items-center table-flush" style="width:100%">

                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col"><i class="far fa-eye"></i></th>
                                            <th scope="col">Codigo</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Campaña</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartones as $carton)
                                            <tr>
                                                <td>
                                                    <a href="" class="btn btn-primary btn-sm verCarton" id="{{$carton->id}}"><i class="far fa-eye"></i></a>
                                                </td>
                                                <td scope="row">
                                                    {{$carton->codigo}}
                                                </td>
                                                <td>
                                                    {{$carton->id}} - {{$carton->name}}
                                                </td>
                                                <td>
                                                    {{$carton->nombre_camapnia}}
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
                                <h3 class="mb-0">Visor de Carton <span><input type="text" name="" value="" class="clipboard" style="border:0; color: gray; margin-left: 10px; opacity: 0;"></span></h3>
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
                        <div class="carton" id="capture" style="height: 790px; width: 560px;">
                            <div id="take">

                                <img src="" id="imagenFondo" style="width:560px; height:auto; position: absolute;">

                                <table class="tabla table table-borderless" id="tablaNumeros" style="position:absolute; top: 334px; width: 200px; left: 40px; font-weight: bold;">
                                    <tr class="fila1"></tr>
                                    <tr class="fila2"></tr>
                                    <tr class="fila3"></tr>
                                    <tr class="fila4"></tr>
                                    <tr class="fila5"></tr>
                                </table>
                                <div id="codigo" style="width:209px; height:auto; position: absolute; font-weight: bold; left: 176px; top:198px; font-size: 22px; text-align: center;"></div>
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

    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.2.1/html2canvas.min.js" integrity="sha512-RGZt6PJZ2y5mdkLGwExIfOMlzRdkMREWobAwzTX4yQV0zdZfxBaYLJ6nPuMd7ZPXVzBQL6XAJx0iDXHyhuTheQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        
        

        $(document).ready(function(){

            
            $('#table_clients').DataTable({
                //responsive: true,
                autoWidth: false
            });
            

            
            //al hacer click boton vercarton
            //$('.verCarton').click(function(e){
            $(document).on('click', '.verCarton', function(e) {

                e.preventDefault();

                $('#imagenFondo').attr('src', '');
                $('#codigo').html('');

                id = $(this).attr('id');

                //limpiamos el carton
                $('.fila1').html('');
                $('.fila2').html('');
                $('.fila3').html('');
                $('.fila4').html('');
                $('.fila5').html('');
                
                $.ajax({
                    url: "{{ route('admin.clients.vercarton') }}",
                    method: 'POST',
                    data:{
                        _token:$('input[name="_token"]').val(),
                        id: id, //'{{$user_current->id}}',
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

                    $('#imagenFondo').attr('src', '../assets/img/background_bingo/'+res[0][6]);
                

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
        })

    </script>
@endpush