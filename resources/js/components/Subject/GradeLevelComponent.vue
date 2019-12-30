<template>
    <div>
        <form class="mb-3" @submit.prevent="addGradeLevel()" action="" method="post">
            <div class="form-group">
                <label for="name">Grade Level</label>
                <input type="text" v-model="addGradeLevelForm.name" class="form-control" 
                    :class="{ 'is-invalid': addGradeLevelForm.errors.has('name') }" id="name" placeholder="Grade Level Name">
                <has-error :form="addGradeLevelForm" field="name"></has-error>
            </div>

            <div class="d-flex flex-row-reverse">
                <button type="submit" class="btn btn-success float-right">Add Grade Level</button>
            </div>    
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Grade Level</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="gradeLevel in gradeLevels" :key="gradeLevel.id">
                    <td>{{ gradeLevel.name }}</td>
                    <td>
                        <a href="#" @click="editGradeLevel(gradeLevel)">
                            <i class="far fa-edit" style="color: green"></i>
                        </a>
                        /
                        <a href="#" @click="deleteGradeLevel(gradeLevel.id)">
                            <i class="far fa-trash-alt" style="color: red"></i>
                        </a>   
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Areas Modal -->
        <div class="modal fade" id="editGradeLevelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Grade Level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="updateGradeLevel()" action="" method="post">
                    <div class="form-group">
                        <label for="name">Area Name</label>
                        <input type="text" v-model="editGradeLevelForm.name" class="form-control" name="name" 
                            :class="{ 'is-invalid': editGradeLevelForm.errors.has('name') }" placeholder="Name">
                            <has-error :form="editGradeLevelForm" field="name"></has-error>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Grade Level</button>
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
                gradeLevels: {},
                addGradeLevelForm: new Form({
                    name: '',
                }),
                editGradeLevelForm: new Form({
                    id: '',
                    name: '',
                }),  
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            loadGradeLevels() { //START GRADE LEVEL
                axios.get('api/grade-levels')
                     .then(({data}) => (this.gradeLevels = data))
            },
            addGradeLevel() {
                this.$Progress.start();
                this.addGradeLevelForm.post('api/grade-levels')
                    .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Grade Level added successfully'
                        })

                        this.$Progress.finish();
                        Fire.$emit('reloadGradeLevels');
                        this.addGradeLevelForm.clear();
                        this.addGradeLevelForm.reset();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            editGradeLevel(gradeLevel) {
                this.editGradeLevelForm.clear();
                this.editGradeLevelForm.reset();
                $('#editGradeLevelModal').modal('show');
                this.editGradeLevelForm.fill(gradeLevel);
            },
            updateGradeLevel() {
                this.editGradeLevelForm.patch('api/grade-levels/' + this.editGradeLevelForm.id)
                    .then(() => {

                        Toast.fire({
                        icon: 'success',
                        title: 'Grade Level updated successfully'
                        });  

                        $('#editGradeLevelModal').modal('hide');

                        this.$Progress.finish();
                        Fire.$emit('reloadGradeLevels');
                    })
            },
            deleteGradeLevel(id) {
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
                        this.editGradeLevelForm.delete('api/grade-levels/' + id)
                        .then(() => {
                            Swal.fire(
                            'Deleted!',
                            'Certain grade level has been deleted.',
                            'success'
                            );

                            Fire.$emit('reloadGradeLevels');
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
            this.loadGradeLevels();
            Fire.$on('reloadGradeLevels', () => {
                this.loadGradeLevels();
            })
        }
    }
</script>
