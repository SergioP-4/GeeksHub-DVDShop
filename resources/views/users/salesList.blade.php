@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Listado ventas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <th scope="col">Nombre Usuario</th>
                                <th scope="col">Pelicula</th>
                                <th scope="col">Fecha Alquiler</th>
                                </thead>
                                <tbody>
                                <tr v-for="sales in salesListUsers">
                                    <td>@{{ sales.name }}</td>
                                    <td>@{{ sales.film }}</td>
                                    <td>@{{ sales.created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
