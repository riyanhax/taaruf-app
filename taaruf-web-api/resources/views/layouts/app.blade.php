<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{!! title(isset($title) ? $title : false) !!}</title>

    <link rel="stylesheet" href="{{modules('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{modules('ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{modules('summernote/summernote-lite.css')}}">
    <link rel="stylesheet" href="{{modules('toastr/build/toastr.min.css')}}">
    <link rel="stylesheet" href="{{modules('jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{modules('datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{modules('datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{modules('datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{modules('bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{modules('bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{modules('select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{modules('jquery-selectric/selectric.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/midia/midia.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/midia/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/skins/darksidebar.css')}}">

    @yield('css')
</head>

<body>
    <div id="app">
        @if(auth()->check() && @$auth !== false)
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
                        </ul>
                    </form>
                    <ul class="navbar-nav">
                        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle">Hi, {{user()->name}}</a>
                            <div class="dropdown-menu dropdown-menu-right dropdown">
                                <a href="{{route('backend.users.edit', user()->id)}}" class="dropdown-item has-icon">
                                    <i class="ion ion-android-person"></i> Profil
                                </a>
                                <a href="#" class="dropdown-item has-icon" onclick="$('#logout-form').submit();">
                                    <i class="ion ion-log-out"></i> Keluar
                                </a>
                                <form id="logout-form" action="{{route('logout')}}" method="post">{!! csrf_field() !!}</form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="main-sidebar">
                @include('layouts.sidebar')
            </div>
            <div class="main-content">
    @endif
                @yield('content')
    @if(auth()->check() && @$auth !== false)
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design by <a href="https://sigmaid.net">SigmaID</a>
                </div>
                <div class="footer-right"></div>
            </footer>
        </div>
    </div>
    @endif

    <script src="//maps.google.com/maps/api/js?key=AIzaSyB55Np3_WsZwUQ9NS7DP-HnneleZLYZDNw&sensor=true"></script>
    <script src="{{modules('jquery.min.js')}}"></script>
    <script src="{{modules('popper.js')}}"></script>
    <script src="{{modules('tooltip.js')}}"></script>
    <script src="{{modules('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{modules('chart.min.js')}}"></script>
    <script src="{{modules('moment.min.js')}}"></script>
    <script src="{{modules('summernote/summernote-lite.js')}}"></script>
    <script src="{{modules('nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{modules('sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{modules('toastr/build/toastr.min.js')}}"></script>
    <script src="{{modules('jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{modules('datatables/datatables.min.js')}}"></script>
    <script src="{{modules('datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{modules('datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{modules('select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{modules('jquery-selectric/jquery.selectric.min.js')}}"></script>
    <script src="{{modules('cleave-js/dist/cleave.min.js')}}"></script>
    <script src="{{modules('cleave-js/dist/addons/cleave-phone.us.js')}}"></script>
    <script src="{{modules('upload-preview/assets/js/jquery.uploadPreview.min.js')}}"></script>
    <script src="{{modules('typeahead.min.js')}}"></script>
    <script src="{{modules('gmaps.js')}}"></script>
    <script src="{{asset('vendor/midia/dropzone.js')}}"></script>
    <script src="{{asset('vendor/midia/midia.js')}}"></script>
    <script src="{{asset('js/sa-functions.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>

    <script>
        $('.midia').midia({
            base_url: '{{url("")}}'
        });
    </script>

    <script>
    $(document).ready(function(){

        // Define function to open filemanager window
        var midia = function(options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/midia';
            window.open(route_prefix + '?type=' + options.type || 'file', 'Midia', 'width=900,height=600');
            window.SetUrl = cb;
        };
        
        // Define midia summernote button
        var MButton = function(context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: 'Insert image with filemanager',
                click: function() {
            
                    midia({type: 'image', prefix: '/midia/open/summernote'}, function(url, path) {
                        context.invoke('insertImage', url);
                    });

                }
            });
            return button.render();
        };
        
        // Initialize summernote with midia button in the popover button group
        // Please note that you can add this button to any other button group you'd like
        $('.summernote-simple').summernote({
            minHeight: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                // ['para', ['paragraph']],
                // ['para', ['left', 'center', 'right', 'justify']],
                ['insert', ['link']],
                ['popovers', ['midia']],
            ],
            buttons: {
                midia: MButton
            }
        })
       
    });
    </script>

    @yield('scripts')
    @yield('footer')
</body>
</html>