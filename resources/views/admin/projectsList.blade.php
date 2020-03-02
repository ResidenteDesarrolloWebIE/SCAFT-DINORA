@extends('layouts.app')
@section('content')

@section('content')
<section class="section-projects-admin py-2 text-xs-center">
    @include('layouts.partials._navigationBar')
    <div class="container container-projects-admin">
        <div class="row table-responsive text-center projects-table">
            <h1 class="text-center">Lista de Proyectos</h1>
            <table class="table text-center" id="tableProjects">
                <thead class="thead-dark">
                    <tr>
                        <th> Id</th>
                        <th> Folio</th>
                        <th> Nombre</th>
                        <th> Status</th>
                        <th>
                            Tipo
                        </th>
                        <th>
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->folio}}</td>
                        <td>{{$project->name}}</td>
                        <td>{{$project->status}}</td>
                        <td>
                            @if(!is_null($project->product_quotation_id))
                            Suministro
                            @elseif(!is_null($project->service_quotation_id))
                            Servicio
                            @else
                            No definido
                            @endif
                        </td>
                        <td>
                            <a data-toggle="modal" data-target="#loadImages" onclick='imagesProject( {{$project->id}}, "{{$project->name}}", "{{$project->folio}}" )'>
                                <!--  onclick="getDocuments('{{$project->folio}}')" -->
                                <button type="button" class="btn btn-success" data-toggle="tooltip" title="Agregar imagenes" data-placement="bottom"><i class="fas fa-images"></i></button> <!-- data-toggle="tooltip" title="Agregar imagenes" -->
                            </a>
                        </td>
                    </tr>
                    @empty
                    <p>No hay datos</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('admin/modals/loadImages')
</section>
@endsection