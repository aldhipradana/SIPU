@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content_header')
    <h1>Daftar Pinjaman</h1>
@stop


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Daftar Pinjaman
                        <a onclick="addForm()" class="btn btn-primary pull-right" style="margin-top: -8px;">Tambah Pinjaman</a>
                    </h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" id="nasabah-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Bunga(%)</th>
                                <th>Jumlah</th>
                                <th>Sisa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    
                    <a href="/exportpinjaman" class="btn btn-info pull-left" style="margin-top: -8px;">Export Pinjaman</a>
                </div>
            </div>
        </div>
    </div>
    
    @include('pinjaman.form')
</div>

@stop

@section('js')
    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
    {{-- dataTables --}}
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        var tables =    $('#nasabah-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "{{ route('api.pinjaman') }}",
                            columns:[
                                {data: 'idPinjaman', name: 'idPinjaman'},
                                {data: 'nama_nasabah', name: 'nama_nasabah'},
                                {data: 'bunga', name: 'bunga'},
                                {data: 'jmlPinjam', name: 'jmlPinjam'},
                                {data: 'sisaPinjam', name: 'sisaPinjam'},
                                {data: 'status', name: 'status'},
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
                url: "{{ route('getnasabah') }}",
                type: "GET",
                dataType: "JSON",
                success: function(response){
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Add Pinjaman');

                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                        console.log("data not null");
                    }

                    if(len > 0){
                        // Read data and create <option >
                        console.log("len > 0");

                        for(var i=0; i<len; i++){

                            var id = response['data'][i].idNasabah;
                            var name = response['data'][i].firstname;

                            var option = "<option value='"+id+"'>"+name+"</option>"; 

                            $("#idNasabah").append(option); 
                        }
                    }

                    $('#idNasabah').val(data.idNasabah);
                        
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
                url: "{{ url('pinjaman') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Pinjaman');

                    $('#idPinjaman').val(data.idPinjaman);
                    $('#idNasabah').val(data.idNasabah);
                    $('#bunga').val(data.bunga);
                    $('#jmlPinjam').val(data.jmlPinjam);
                    $('#status').val(data.status);
                        
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
                    url: "{{ url('pinjaman') }}" + '/' + id,
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
                    var id = $('#idPinjaman').val();
                    if (save_method == 'add') url = "{{ url('pinjaman') }}";
                    else url = "{{ url('pinjaman') . '/' }}" + id;
                    
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