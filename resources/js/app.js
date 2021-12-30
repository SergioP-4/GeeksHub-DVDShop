require('./bootstrap');
require('./toastr');
Vue.use(Toasted);
var app = new Vue({
    el: '#app',
    created() {
        this.listFilm();
        this.listReturnFilm();
    },
    data: {
        films: [],
        film_id: '',
        returnFilms: []
    },
    methods: {
        listFilm: function () {
            axios.post('/available').then( response => {
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
                    this.listFilm();
                    this.$toasted.show("Alquilada correctamente", {
                        duration: 1000,
                        position: "top-right",
                    });
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
                    this.listReturnFilm();
                    this.$toasted.show("Devuelta correctamente", {
                        duration: 1000,
                        position: "top-right",
                    });
                }
            }).catch(error => {
                console.log(error.response);
            })
        }
    }
});
