@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <tbody>
                <tr v-for="film_return in returnFilms">
                    <td>@{{ film_return.name }}</td>
                    <td>
                        <button type="button" class="btn btn-secondary" v-on:click="returnFilm(film_return.id)">
                            Devolución
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
