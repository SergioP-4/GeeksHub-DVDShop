@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Listado Devoluciones</h3>
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
                                <th scope="col">Fecha Devolución</th>
                                </thead>
                                <tbody>
                                <tr v-for="salesRent in salesRentListUser">
                                    <td>@{{ salesRent.name }}</td>
                                    <td>@{{ salesRent.film }}</td>
                                    <td>@{{ salesRent.created_at }}</td>
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
