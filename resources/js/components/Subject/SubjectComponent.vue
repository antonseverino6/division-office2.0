<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-3">
                <div class="card mt-2">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="subjects-tab" data-toggle="tab" href="#subjects" role="tab" aria-controls="subjects" aria-selected="true">Subjects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="area-tab" data-toggle="tab" href="#area" role="tab" aria-controls="area" aria-selected="true">Areas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="component-tab" data-toggle="tab" href="#component" role="tab" aria-controls="component" aria-selected="true">Components</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="gradeLevel-tab" data-toggle="tab" href="#gradeLevel" role="tab" aria-controls="gradeLevel" aria-selected="true">Grade Level</a>
                            </li>                            
                        </ul> 
                    </div>
                    <div class="tab-content">
                        <!---------------------------------- Subjects -------------------------------------> 
                        <div class="card-body tab-pane active" id="subjects" aria-labelledby="subjects-tab">
                            <form @submit.prevent="addSubject()" action="" method="post">
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" v-model="addSubjectForm.name" class="form-control" 
                                     :class="{ 'is-invalid': addSubjectForm.errors.has('name') }" id="subject" placeholder="Subject Name">
                                    <has-error :form="addSubjectForm" field="name"></has-error>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-success float-right">Add Subject</button>
                                </div>
                            </form>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Subjects</th>
                                        <th></th>
                                    </tr>
                                    
                                </thead>
                                <tbody v-if="subjects.length > 0">
                                    <tr v-for="subject in subjects" :key="subject.id">
                                        <td>{{ subject.name }}</td>
                                        <td>
                                            <a href="#" @click="editSubject(subject)">
                                                <i class="far fa-edit" style="color: green"></i>
                                            </a>
                                            /
                                            <a href="#" @click="deleteSubject(subject.id)">
                                                <i class="far fa-trash-alt" style="color: red"></i>
                                            </a>     
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <h3 class="text-center">No Subjects Yet</h3>
                                </tbody>
                            </table>

                        </div>

                        <!-- Subjects Modal -->
                        <div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="updateSubject()" action="" method="post">
                                    <div class="form-group">
                                        <label for="name">Subject Name</label>
                                        <input type="text" v-model="editSubjectForm.name" class="form-control" name="name" 
                                            :class="{ 'is-invalid': editSubjectForm.errors.has('name') }" placeholder="Name">
                                            <has-error :form="editSubjectForm" field="name"></has-error>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update Subject</button>
                                    </div>

                                </form>
                            </div>

                            </div>
                        </div>
                        </div>

                        <!---------------------------------- Area ------------------------------------->
                        <div class="card-body tab-pane" id="area" aria-labelledby="area-tab">
                            <areas v-bind:Subjects="subjects"></areas>
                        </div>

                        <!---------------------------------- Components ------------------------------------->
                        <div class="card-body tab-pane" id="component" aria-labelledby="component-tab">
                            <components></components>
                        </div>

                        <!---------------------------------- Grade Level ------------------------------------->
                        <div class="card-body tab-pane" id="gradeLevel" aria-labelledby="gradeLevel-tab">
                            <grade-level></grade-level>
                        </div>


                    </div>  
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import GradeLevel from './GradeLevelComponent.vue'
    import Components from './ComponentsComponent.vue'
    import Areas from './AreasComponent.vue'
    export default {
        components: {
            GradeLevel,
            Components,
            Areas
        },
        data() {
            return {
                subjects: {},
                addSubjectForm: new Form ({
                    name: '',
                }),
                editSubjectForm: new Form ({
                    id: '',
                    name: '',
                }),            
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            loadSubjects() {
                axios.get('api/subjects')
                    .then(({data}) => (this.subjects = data));
            },
            addSubject() {
                this.$Progress.start();
                this.addSubjectForm.post('api/subjects')
                    .then(() => {

                        Toast.fire({
                        icon: 'success',
                        title: 'Subject added successfully'
                        })

                        this.$Progress.finish();
                        Fire.$emit('reloadSubjects');
                        this.addSubjectForm.clear();
                        this.addSubjectForm.reset();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            editSubject(subject) {
                $('#editSubjectModal').modal('show');
                this.editSubjectForm.clear();
                this.editSubjectForm.reset();
                this.editSubjectForm.fill(subject);
            },
            updateSubject() {
                this.$Progress.start();
                this.editSubjectForm.patch('api/subjects/' + this.editSubjectForm.id)
                    .then(() => {
                        $('#editSubjectModal').modal('hide');
                        Toast.fire({
                        icon: 'success',
                        title: 'Subject updated successfully'
                        })

                        this.$Progress.finish();
                        Fire.$emit('reloadSubjects');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            deleteSubject(id) {
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
                        this.editSubjectForm.delete('api/subjects/' + id)
                            .then(() => {
                                Swal.fire(
                                'Deleted!',
                                'Certain subject has been deleted.',
                                'success'
                                );

                                Fire.$emit('reloadSubjects');
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
            }, // END OF SUBJECTS

        },
        created() {
            this.loadSubjects();
            Fire.$on('reloadSubjects', () => {
                this.loadSubjects();
            });
        }
    }
</script>
