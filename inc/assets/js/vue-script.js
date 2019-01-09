// {/* <script> */}
// const Home = { template: '<div> Home page </div>' };
// let routes = [
//     { path: '/home.php', component: Home }
//   ]

// const router = new VueRouter({
//     mode: 'history',
//     routes // short for `routes: routes`
// })

var app = new Vue({
  el: '#app',
//   router,
  data: {
    user:{
        id:'',
        name:'',
        email:'',
        mobile:'',
        password:''
    },
    login: 'Login',
    loading: false,
    seen: false,
    users: [],
    editmode: false
  },
  methods: {
    updateUser(id) {
        console.log(id)
        app.loading = true;
        axios.patch('api/user-create.php?action=update&id='+id, {
            name: this.user.name,
            email: this.user.email,
            mobile: this.user.mobile,
            password: this.user.password
        })
        .then(function (response) {
            app.loading = false;
            app.editmode = false;
            if (response.data.error) {
                console.log(response.data.error);
                Swal({
                type: 'error',
                title: 'Oops...',
                text: response.data.error
                })
            } else {
                $('#openModal').modal('hide');
                console.log(response.data.success);
                app.getAllUsers();

                const toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000
                });

                toast({
                type: 'success',
                title: response.data.success
                })
            }
        });
    },
    editModal(user) {
        app.editmode = true;
        this.user.id = user.id;
        this.user.name = user.name;
        this.user.email = user.email;
        this.user.mobile = user.mobile;
        this.user.password = user.password;
        $('#openModal').modal('show');
    },
    getAllUsers(){
        axios.get('api/user-create.php?action=read')
        .then(response => {
            if (response.data.error) {
                console.log(response.data.error);
            } else {
                console.log(response.data)
                app.users = response.data;
            }
        })
    },
    loginUser(){
        app.loading = true;
        axios.post('api/user-create.php?action=create', {
            name: this.user.name,
            email: this.user.email,
            mobile: this.user.mobile,
            password: this.user.password
        })
        .then(function (response) {
            app.loading = false;
            if (response.data.error) {
                console.log(response.data.error);
                Swal({
                type: 'error',
                title: 'Oops...',
                text: response.data.error
                })
            } else {
                app.seen = false;
                console.log(response.data.success);
                app.getAllUsers();
                swal(
                'Deleted!',
                response.data.success,
                'success'
                )
            }
        });
    },
    deleteUser(id){
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                //send Request to  the server
                if(result.value) {
                    axios.delete('api/user-create.php?action=delete&id='+id)
                    .then(response => {
                        if (response.data.error) {
                            console.log(response.data.error);
                        } else {
                            console.log(response.data.success)
                            this.getAllUsers();
                            swal(
                            'Deleted!',
                            response.data.success,
                            'success'
                            )
                        }
                    })
                }
        })
    },
    add() {
        if (app.editmode == true) {
            this.user.id = '',
            this.user.name = '',
            this.user.email = '',
            this.user.mobile = '',
            this.user.password = ''
        }
    }
  },
  mounted() {
      this.getAllUsers();
  }
})
{/* </script> */}
