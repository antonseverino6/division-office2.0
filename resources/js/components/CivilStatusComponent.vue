<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 mt-3">
                <div class="card">
                    <div class="card-header">Civil Status</div>

                    <div class="card-body">
                        <form class="mb-3" @submit.prevent="addCivilStatus()" action="" method="post">
                            <div class="form-group">
                                <label for="name">Civil Status</label>
                                <input v-model="form.name" type="text" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>  
                            <div class="d-flex flex-row-reverse">
                            <button class="btn btn-success" type="submit">Add Civil Status</button>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Civil Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="civilStatus in civilStatuses" :key="civilStatus.id">
                                    <td>{{ civilStatus.name }}</td>
                                    <td>
                                        <a href="#" @click="editCivilStatus(civilStatus)">
                                            <i class="far fa-edit" style="color: green"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteCivilStatus(civilStatus.id)">
                                            <i class="far fa-trash-alt" style="color: red"></i>
                                        </a>         
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="editCivilStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Civil Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="updateCivilStatus()" action="" method="post">
                    <div class="form-group">
                        <label for="name">Civil Status</label>
                        <input type="text" v-model="editForm.name" class="form-control" name="name" 
                            :class="{ 'is-invalid': editForm.errors.has('name') }" placeholder="Name">
                            <has-error :form="editForm" field="name"></has-error>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Civil Status</button>
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
                civilStatuses : {},
                form: new Form({
                    name: '',
                }),
                editForm: new Form({
                    id: '',
                    name: '',                   
                }),
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            loadCivilStatus() {
                axios.get('api/civil-status')
                    .then(({data}) => {
                        (this.civilStatuses = data)
                    })
            },
            addCivilStatus() {
                this.form.post('api/civil-status')
                    .then(() => {
                        Toast.fire({
                        icon: 'success',
                        title: 'Civil Status added successfully'
                        })

                        Fire.$emit('reloadCivilStatus');

                        this.form.reset();
                        this.form.clear();
                    })
            },
            editCivilStatus(civilStatus) {
                this.editForm.clear();
                this.editForm.reset();
                $('#editCivilStatusModal').modal('show');
                this.editForm.fill(civilStatus);
            },
            updateCivilStatus() {
                this.$Progress.start();
                this.editForm.patch('api/civil-status/' + this.editForm.id)
                    .then(() => {
                        $('#editCivilStatusModal').modal('hide');

                        Toast.fire({
                        icon: 'success',
                        title: 'Civil Status updated successfully'
                        });

                        this.$Progress.finish();
                        Fire.$emit('reloadCivilStatus');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            deleteCivilStatus(id) {
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
                        this.form.delete('api/civil-status/' + id)
                            .then(() => {
                                Swal.fire(
                                'Deleted!',
                                'Certain civil status has been deleted.',
                                'success'
                                );

                                Fire.$emit('reloadCivilStatus');
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

            }
        },
        created() {
            this.loadCivilStatus();
            Fire.$on('reloadCivilStatus', () => {
                this.loadCivilStatus();
            })
        }
    }
</script>
