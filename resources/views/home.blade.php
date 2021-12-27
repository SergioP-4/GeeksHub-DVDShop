@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="form rent-form">
            <table class="table">
                <tbody>
                <tr v-for=" film in films ">
                    <td> @{{ film.name }}</td>
                    <td>
                        <button v-on:click="rentFilm(film.id)" type="button" class="btn btn-secondary">
                            Alquilar
                        </button>
                        <!--<button type="submit" class="btn btn-secondary" name="rent" @click="rentfilm">Alquilar</button>-->
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
