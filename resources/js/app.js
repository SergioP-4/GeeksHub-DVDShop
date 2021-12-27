require('./bootstrap');
var app = new Vue({
    el: '#app',
    created() {
      this.listFilm();
    },
    data: {
        films: []
    },
    methods: {
        listFilm: function () {
            axios.post('/home/films').then( response => {
                this.films = response.data;
            }).catch(error => {
                console.log(error.response);
            });
        }
    }
});
