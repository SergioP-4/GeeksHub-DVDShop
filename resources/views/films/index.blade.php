@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Peliculas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-film')
                                <a class="btn btn-warning" href="{{ route('films.create')  }}">Nuevo</a>
                            @endcan
                            <table class="table table-striped mt-2">
                                <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($films as $film)
                                    <tr>
                                        <td>{{$film->name}}</td>
                                        <td>
                                            @can('editar-film')
                                                <a class="btn btn-warning" href="{{ route('films.edit',$film->id) }}">Editar</a>
                                            @endcan
                                            @can('borrar-film')
                                                {!! Form::open(['method' => 'DELETE','route' => ['films.destroy',$film->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Borrar',['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
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
    </section>
@endsection
