<!DOCTYPE html>
<html>
<?php include 'inc/layouts/header.php'; ?>
<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">Sign out</a>
    </li>
    </ul>
</nav> 
<div class="container" id="app">
    <div class="row mt-1">
    <?php include 'inc/layouts/sidebar.php'; ?>
    <main role="main" class="col-md-12 ml-sm-auto col-lg-11 pt-3 px-4">
        <button class="btn btn-secondary float-right mb-3" v-on:click="seen = !seen" @click="add">New User <i class="fas fa-user-plus"></i></button>
        
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card" v-if="seen">
                <h5 class="card-header">{{login}}</h5>
                <div class="card-body">
                    <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" v-model="user.name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" v-model="user.email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <input type="number" v-model="user.mobile" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" v-model="user.password" class="form-control" id="password" placeholder="Password">
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

        <!-- Modal -->
        <div class="modal fade" id="openModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" v-model="user.name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" v-model="user.email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <input type="number" v-model="user.mobile" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" v-model="user.password" class="form-control" id="password" placeholder="Password">
                    </div>

                    </button>
                    
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button :disabled="loading" type="submit" @click.prevent="updateUser(user.id)" class="btn btn-info">
                    <i class="fas fa-spin fa-spinner" v-if="loading"></i>
                    {{ loading ? '' : 'Update' }}
                    </button>
                </div>
                </form>
                </div>
            </div>
        </div>

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
                <tr v-for="(user,index) in users.users" :key="user.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.mobile }}</td>
                    <td>
                        <a href=""  @click.prevent="editModal(user)" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        <a href="" @click.prevent="deleteUser(user.id)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
    </main>
    </div>
</div>

<?php include 'inc/layouts/footer.php'?>
</body>
</html>