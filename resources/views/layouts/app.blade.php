<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    {{-- dataTables --}}
    <link href="{{ asset('assets/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    {{-- SweetAlert2 --}}
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>Nasabah <span class="caret"></span> <span class="sr_only"> </span> </a>
                                    <ul class="dropdown-menu">
                                            <li> <a href="{{ route('nasabah.index') }}">Daftar Nasabah</a> </li>
                                    </ul>
                                </li>
                            </ul>
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
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
</body>
</html>
