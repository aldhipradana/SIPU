@extends('layouts.app')

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

@endsection