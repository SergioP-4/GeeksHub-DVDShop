@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-4 col-xl-4">
                                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">Usuarios</h5>
                                            @php
                                                use App\Models\User;
                                                $cant_users = User::count();
                                            @endphp
                                            <p class="card-text">Número de usuarios: {{$cant_users}}
                                                <br/>
                                                 <a href="/users" style="color: white;">Ver más</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card text-white bg-danger mb-3" style="max-width: 18rem">
                                        <div class="card-body">
                                            <h5 class="card-title">Peliculas</h5>
                                            @php
                                                use App\Models\Film;
                                                $cant_films = Film::count();
                                            @endphp
                                            <p class="card-text">Número de peliculas: {{$cant_films}}
                                                <br/>
                                                <a href="/films" style="color: white;">Ver más</a>
                                            </p>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
