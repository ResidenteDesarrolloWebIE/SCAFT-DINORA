<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SCATF') }}</title>
    <link href="{{asset('images/icon.ico') }}" rel="shortcut icon"/> 
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    
    <link rel="stylesheet" href="css/auth/_navigationBar.css"/>
    <link rel="stylesheet" href="css/general.css"/>
    <link rel="stylesheet" href="css/home.css"/>

    <link rel="stylesheet" href="css/admin/projectList.css"/>
    <link rel="stylesheet" href="css/admin/modals/loadImages.css"/>
    <link rel="stylesheet" href="css/client/modals/moreInformation.css"/>
    <link rel="stylesheet" href="css/client/clientGeneral.css"/>
    <link rel="stylesheet" href="css/client/modals/technicalAdvance.css"/>
    <link rel="stylesheet" href="packages/dropzone/dropzone.css">

    <link rel="stylesheet" href="{{asset('packages/bootstrap-4.4.1/css/bootstrap.min.css') }}">  
    <link rel="stylesheet" href="{{asset('packages/datatables-1.10.7/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">    
    <link rel="stylesheet" href="{{asset('packages/fotoroma-4.6.4/fotorama.css') }}">

</head>