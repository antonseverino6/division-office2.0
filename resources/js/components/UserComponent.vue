<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">
                        Users

                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" @click="addNewUserModal"> 
                            Add New <i class="fas fa-user-plus fa-fw"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Represents</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.representative.name }}</td>
                                    <td> 
                                        <a href="#" @click="editUser(user)">
                                            <i class="far fa-edit" style="color: green"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteUser(user.id)">
                                            <i class="far fa-trash-alt" style="color: red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        This is a footer
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="editMode ? updateUser() : createUser()" action="" method="post">
                    <div class="form-group-sm">
                        <label for="name">Name</label>
                        <input type="text" v-model="form.name" class="form-control" name="name" 
                            :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Name">
                            <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" v-model="form.email" class="form-control" name="email" id="email"
                              :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Email">
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group-sm">
                        <label for="representative">Representing</label>
                        <select v-model="form.representative_id" class="form-control" name="representative_id" id="representative"
                              :class="{ 'is-invalid': form.errors.has('representative_id') }">
                            <option v-for="represent in representatives" :key="represent.id" :value="represent.id">{{represent.name}}</option>
                        </select>
                        <has-error :form="form" field="representative_id"></has-error>
                    </div>
                    <div class="form-group-sm">
                        <div>
                            <label for="">Role</label>
                        </div>
                         &nbsp;
                        <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" v-model="form.admin" class="form-check-input" name="admin" value="1">Admin
                        </label>
                        </div>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" v-model="form.admin" class="form-check-input" name="admin" value="0" checked>User
                        </label>
                        <has-error :form="form" field="admin"></has-error>
                        </div>
                    </div>
                    <div class="form-group-sm">
                        <label for="password">Password</label>
                        <input type="password" v-model="form.password" class="form-control" name="password" id="password"
                            :class="{ 'is-invalid': form.errors.has('password') }" placeholder="Password">
                        <has-error :form="form" field="password"></has-error>
                    </div>
                    <div class="form-group-sm">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" v-model="form.password_confirmation" class="form-control" name="password_confirmation" 
                            :class="{ 'is-invalid': form.errors.has('password_confirmation') }"    placeholder="Confirm Password">
                        <has-error :form="form" field="password_confirmation"></has-error>        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editMode" type="submit" class="btn btn-success">Create User</button>
                        <button v-show="editMode" type="submit" class="btn btn-success">Edit User</button>
                    </div>

                </form>
            </div>

            </div>
        </div>
        </div>



    </div>
</template>

<script>
    export default {
        data() {
            return {
                editMode: false,
                users : {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    admin: '0',
                    password: '',
                    password_confirmation: '',
                    representative_id: '',
                }),
                representatives: {},
            }
        },
        mounted() {
            console.log('mounted successfully')
        },
        methods: {
            loadUsers() {
                axios.get('api/users')
                    .then(({data}) => (this.users = data));
            },
            addNewUserModal() {
                this.editMode = false;
                this.form.clear();
                this.form.reset();
                $('#UserModal').modal('show');
            },
            createUser() {
                this.$Progress.start();
                this.form.post('api/users')
                    .then(() => {
                        Fire.$emit('reloadUsers');
                        $('#UserModal').modal('hide');

                        Toast.fire({
                        icon: 'success',
                        title: 'User created successfully'
                        })

                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            editUser(user) {
                this.form.clear();
                this.form.reset();
                this.editMode = true;
                $('#UserModal').modal('show');
                this.form.fill(user)
            },
            updateUser() {
                this.$Progress.start();
                this.form.patch('api/users/' + this.form.id)
                    .then(() => {
                        Fire.$emit('reloadUsers');

                        Toast.fire({
                        icon: 'success',
                        title: 'User updated successfully'
                        })
                        $('#UserModal').modal('hide')
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            deleteUser(id) {
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('api/users/'+ id)
                            .then(() => {
                                
                                Swal.fire(
                                'Deleted!',
                                'User been deleted.',
                                'success'
                                );

                                Fire.$emit('reloadUsers');
                            })
                            .catch(() => {
                                Swal.fire(
                                'Something Went Wrong',
                                '',
                                'warning'
                                )    
                            })
                    }
                })
            },
            loadRepresentatives() {
                axios.get('api/representatives')
                     .then(({data}) => (this.representatives = data))
            }
        },
        created() {
            this.loadUsers();
            this.loadRepresentatives();
            Fire.$on('reloadUsers', () => {
                this.loadUsers();
            });
        }
    }
</script>
