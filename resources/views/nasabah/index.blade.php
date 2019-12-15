@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Nasabah List</h1>
@stop


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Daftar Nasabah
                        <a onclick="addForm()" class="btn btn-primary pull-right" style="margin-top: -8px;">Tambah Nasabah</a>
                    </h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" id="nasabah-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @include('nasabah.form')
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
                            ajax: "{{ route('api.nasabah') }}",
                            columns:[
                                {data: 'idNasabah', name: 'idNasabah'},
                                {data: 'firstname', name: 'firstname'},
                                {data: 'email', name: 'email'},
                                {data: 'action', name: 'action', orderable: false, searcable: false},
                            ]
                        })

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Nasabah');
        }

        function editForm(id){
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('nasabah') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Nasabah');

                    $('#idNasabah').val(data.idNasabah);
                    $('#firstname').val(data.firstname);
                    $('#lastname').val(data.lastname);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#alamat').val(data.alamat);
                        
                },
                error: function(){
                    alert("No data found");
                }
            });
        }

        $(function(){
            $('#modal-form form').validator().on('submit', function(e){
                if(!e.isDefaultPrevented()){
                    var id = $('#idNasabah').val();
                    if (save_method == 'add') url = "{{ url('nasabah') }}";
                    else url = "{{ url('nasabah') . '/' }}" + id;
                    
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form form').serialize(),
                        success: function($data){
                            $('#modal-form').modal('hide');
                            tables.ajax.reload();
                        },
                        error: function(){
                            alert('Ooops! Error occured!');
                        }
                    });

                    return false;
                }
            })
        });

    </script>
@stop