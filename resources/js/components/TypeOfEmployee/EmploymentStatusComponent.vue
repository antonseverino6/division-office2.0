<template>
    <div>
        <form class="mb-3" @submit.prevent="addEmploymentStatus()" action="" method="post">
            <div class="form-group">
                <label for="level-of-civil">Employment Status</label>
                <input v-model="form.name" type="text" id="level-of-civil" 
                    :class="{ 'is-invalid': form.errors.has('name') }" class="form-control">
                    <has-error :form="form" field="name"></has-error>
            </div>
            <div class="d-flex flex-row-reverse">
            <button class="btn btn-success" type="submit">Add Employment Status</button>
            </div>
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="empStatus in empStatuses" :key="empStatus.id" >
                    <td>{{empStatus.name}}</td>
                    <td>
                        <a href="#" @click="editEmploymentStatus(empStatus)">
                            <i class="far fa-edit" style="color: green"></i>
                        </a>
                        /
                        <a href="#" @click="deleteEmploymentStatus(empStatus.id)">
                            <i class="far fa-trash-alt" style="color: red"></i>
                        </a> 
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Employee Type Modal -->
        <div class="modal fade" id="editEmpStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Employment Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="updateEmploymentStatus()" action="" method="post">
                    <div class="form-group">
                        <label for="name">Employment Status</label>
                        <input type="text" v-model="editForm.name" class="form-control" name="name" 
                            :class="{ 'is-invalid': editForm.errors.has('name') }">
                            <has-error :form="editForm" field="name"></has-error>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Employment Status</button>
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
                empStatuses: {},
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
            loadEmploymentStatus() {
                axios.get('api/employment-status')
                     .then(({data}) => {
                         (this.empStatuses = data)
                     })
                     .catch(() => {
                         alert('something went wrong')
                     })
            },
            addEmploymentStatus() {
                this.form.post('api/employment-status')
                    .then(() => {
                        this.form.reset();
                        this.form.clear();
                        Toast.fire({
                        icon: 'success',
                        title: 'Level of Civil added successfully'
                        }) 
                        Fire.$emit('reloadEmploymentStatus');
                    })
            },
            editEmploymentStatus(empStatus) {
                this.editForm.clear();
                this.editForm.reset();
                $('#editEmpStatusModal').modal('show');
                this.editForm.fill(empStatus);
            },
            updateEmploymentStatus() {
                this.editForm.patch('api/employment-status/' + this.editForm.id)
                    .then(() => {
                        Toast.fire({
                        icon: 'success',
                        title: 'Employment status updated successfully'
                        }) 

                        $('#editEmpStatusModal').modal('hide');
                        Fire.$emit('reloadEmploymentStatus');
                    })
            },
            deleteEmploymentStatus(id) {
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
                        this.editForm.delete('api/employment-status/' + id) 
                            .then(() => {
                                Swal.fire(
                                'Deleted!',
                                'Certain employment status has been deleted.',
                                'success'
                                );

                                Fire.$emit('reloadEmploymentStatus');
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
            this.loadEmploymentStatus();
            Fire.$on('reloadEmploymentStatus', () => {
                this.loadEmploymentStatus();
            })
        }
    }
</script>
