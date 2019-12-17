@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content_header')
    <h1>Daftar Angsuran</h1>
@stop


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Daftar Angsuran
                        <a onclick="addForm()" class="btn btn-primary pull-right" style="margin-top: -8px;">Tambah Angsuran</a>
                    </h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" id="nasabah-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Pinjaman</th>
                                <th>Jumlah Pinjaman</th>
                                <th>Jumlah Angsuran</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    
                    <a href="/exportangsuran" class="btn btn-info pull-left" style="margin-top: -8px;">Export Angsuran</a>
                </div>
            </div>
        </div>
    </div>
    
    @include('angsuran.form')
</div>

@stop

@section('js')
    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
    {{-- dataTables --}}
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        var flag = 0;

        var tables =    $('#nasabah-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "{{ route('api.angsuran') }}",
                            columns:[
                                {data: 'idAngsuran', name: 'idAngsuran'},
                                {data: 'idPinjaman', name: 'idPinjaman'},
                                {data: 'jml_pinjaman', name: 'jml_pinjaman'},
                                {data: 'jmlAngsuran', name: 'jmlAngsuran'},
                                {data: 'keterangan', name: 'keterangan'},
                                {data: 'action', name: 'action', orderable: false, searcable: false},
                            ]
                        })

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            // $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            // $('.modal-title').text('Add Pinjaman');
            $.ajax({
                url: "{{ route('getpinjaman') }}",
                type: "GET",
                dataType: "JSON",
                success: function(response){
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Add Angsuran');

                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                        console.log("data not null");
                    }

                    if(len > 0){
                        // Read data and create <option >
                        console.log("len > 0");

                        for(var i=0; i<len; i++){

                            var id = response['data'][i].idPinjaman;
                            var name = response['data'][i].idPinjaman;

                            var option = "<option value='"+id+"'>"+name+"</option>"; 

                            $("#idPinjaman").append(option); 
                        }
                    }
                        
                },
                error: function(){
                    alert("No data found");
                }
            });
        }

        function editForm(id){
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('angsuran') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Angsuran');

                    $('#idAngsuran').val(data.idAngsuran);
                    $('#jmlAngsuran').val(data.jmlAngsuran);
                    $('#keterangan').val(data.keterangan);

                    $.ajax({
                        url: "{{ route('getpinjaman') }}",
                        type: "GET",
                        dataType: "JSON",
                        success: function(response){

                            var len = 0;
                            if(response['data'] != null){
                                len = response['data'].length;
                                console.log("data not null");
                            }

                            for(var i=0; i<len; i++){
                                // Read data and create <option >
                                console.log("len > 0");

                                for(var i=0; i<len; i++){

                                    var id = response['data'][i].idPinjaman;
                                    var name = response['data'][i].idPinjaman;

                                    var option = "<option value='"+id+"'>"+name+"</option>"; 
                                    flag = 1;
                                    $("#idPinjaman").append(option); 
                                }
                            }
                            $('#idPinjaman').val(data.idPinjaman);
                            
                        },
                        error: function(){
                            alert("No data found");
                        }
                    });
                    
                },
                error: function(){
                    alert("No data found");
                }
            });
        }

        function deleteData(id){
            
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            swal({
                title: 'Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan data ini lagi!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then( function(){
                $.ajax({
                    url: "{{ url('angsuran') }}" + '/' + id,
                    type: "POST",
                    data:   {'_method' : 'DELETE', '_token'  : csrf_token},
                    success : function(data){
                        tables.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: "Data telah dihapus!",
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error: function(){
                        swal({
                            title: 'Oooppss!!',
                            text: "Oooppss!",
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });

        }

        $(function(){
            $('#modal-form form').validator().on('submit', function(e){
                if(!e.isDefaultPrevented()){
                    var id = $('#idAngsuran').val();
                    if (save_method == 'add') url = "{{ url('angsuran') }}";
                    else url = "{{ url('angsuran') . '/' }}" + id;
                    
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form form').serialize(),
                        success: function($data){
                            $('#modal-form').modal('hide');
                            tables.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: "Berhasil memproses data!",
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error: function(){
                            swal({
                                title: 'Oooppss!!',
                                text: "Oooppss!",
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });

                    return false;
                }
            })
        });

    </script>
@stop