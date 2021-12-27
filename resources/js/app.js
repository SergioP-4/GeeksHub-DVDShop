require('./bootstrap');
Vue.use(Toasted)
var app = new Vue({
    el: '#app',
    created() {
        this.listFilm();
        this.listReturnFilm();
    },
    updated() {
        this.rentFilm();
        this.returnFilm();
    },
    data: {
        films: [],
        film_id: '',
        returnFilms: []
    },
    methods: {
        listFilm: function () {
            axios.post('/home/films').then( response => {
                this.films = response.data;
            }).catch(error => {
                console.log(error.response);
            });
        },
        listReturnFilm: function () {
            axios.post('/rented-films/list').then(response => {
                this.returnFilms = response.data;
            }).catch(error => {
                console.log(error.response);
            })
        },
        rentFilm: function (film) {
            axios.post('/home/films-rent', {
                film_id: film
            }).then( response => {
                if(response.data){
                    //notificación alquilada correctamente.
                }
            }).catch(error => {
                console.log(error.response);
            })
        },
        returnFilm: function (returnFilm){
            axios.post('/return-films',{
                film_return_id: returnFilm
            }).then(response => {
                if(response.data){
                    //notificación devuelta correctamente.
                } else {
                    //Se ha producido un error.
                }
                console.log(response.data);
            }).catch(error => {
                console.log(error.response);
            })
        }
    }
});
