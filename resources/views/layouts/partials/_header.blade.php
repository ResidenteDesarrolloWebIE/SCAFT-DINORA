<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SCATF') }}</title>
    <link href="{{asset('images/icon.ico') }}" rel="shortcut icon" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/auth/_navigationBar.css') }}" />
    <link rel="stylesheet" href="{{asset('css/general.css') }}" />
    <link rel="stylesheet" href="{{asset('css/home.css') }}" />

    <link rel="stylesheet" href="{{asset('css/admin/projectList.css') }}" />
    <link rel="stylesheet" href="{{asset('css/admin/modals/loadImages.css') }}" />
    <link rel="stylesheet" href="{{asset('css/client/clientGeneral.css') }}" />
    <link rel="stylesheet" href="{{asset('css/client/modals/technicalAdvance.css') }}" />
    <link rel="stylesheet" href="{{asset('plugins/dropzone-2012/dropzone.css') }}">

    <link rel="stylesheet" href="{{asset('plugins/bootstrap-4.4.1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/dataTables-1.10.20/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-5.12.1/css/solid.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fotoroma-4.6.4/fotorama.css') }}">
</head>