<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Index Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body>

<div class="container" id="app">
    <button class="btn btn-primary" v-on:click="seen = !seen">Open</button>
    <div class="row mt-4">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card" v-if="seen">
                <h5 class="card-header">{{login}}</h5>
                <div class="card-body">
                    <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" v-model="form.name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" v-model="form.email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <input type="number" v-model="form.mobile" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" v-model="form.password" class="form-control" id="password" placeholder="Password">
                    </div>

                    <button :disabled="loading" type="submit" @click.prevent="loginUser" class="btn btn-primary">
                    <i class="fas fa-spin fa-spinner" v-if="loading"></i>
			      	{{ loading ? '' : 'Create' }}
                    </button>
                    
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-md-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.mobile }}</td>
                <td>
                    <a href="" @click.prevent="user.id" class="btn btn-info"><i class="fas fa-edit"></i></a>
                    <a href="" @click.prevent="" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="inc/assets/js/axios.min.js"></script>
<script>
var app = new Vue({
  el: '#app',
  data: {
    form:{
        name:'',
        email:'',
        mobile:'',
        password:''
    },
    login: 'Login',
    loading: false,
    seen: false,
    users: []
  },
  methods: {
    loginUser(){
        app.loading = true;
        axios.post('api/user-create.php?action=create', {
            name: this.form.name,
            email: this.form.email,
            mobile: this.form.mobile,
            password: this.form.password
        })
        .then(function (response) {
            app.loading = false;
            if (response.data.error) {
                console.log(response.data.error);
            } else {
                console.log(response.data.success);
            }
        });
    }
  },
  mounted() {
      axios.get('api/user-create.php?action=read')
      .then(response => {
        if (response.data.error) {
            console.log(response.data.error);
        } else {
            console.log(response)
            app.users = response;
        }
      })
  }
})
</script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</body>
</html>