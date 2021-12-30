require('./bootstrap');
require('./toastr');
Vue.use(Toasted);
var app = new Vue({
    el: '#app',
    created() {
        this.listFilm();
        this.listReturnFilm();
        this.salesList();
        this.salesRentList();
    },
    data: {
        films: [],
        film_id: '',
        returnFilms: [],
        salesListUsers: [],
        salesRentListUser:[]
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
        salesList: function (){
            axios.post('sales-list').then(response => {
                this.salesListUsers = response.data;
            }).catch(error => {
                console.log(error.response);
            });
        },
        salesRentList: function (){
            axios.post('sales-rent-list').then(response => {
                this.salesRentListUser = response.data;
            }).catch(error => {
                console.log(error.response);
            });
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
