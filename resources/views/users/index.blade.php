@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('users.create')  }}">Nuevo</a>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" style="display: none;">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td style="display: none;"> {{ $user->id }}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $rolName)
                                                {{$rolName}}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('users.edit', $user->id) }}">Editar</a>

                                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy',$user->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Borrar',['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
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

