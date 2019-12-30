<template>
    <div>
        <form class="mb-3" @submit.prevent="addArea()" action="" method="post">
            <div class="form-group">
                <label for="name">Area</label>
                <input type="text" v-model="addAreaForm.name" class="form-control" 
                    :class="{ 'is-invalid': addAreaForm.errors.has('name') }" id="name" placeholder="Area Name">
                <has-error :form="addAreaForm" field="name"></has-error>
            </div>
            <div class="form-group">
                <label for="subject">Assign to a Subject</label>
                <select v-model="addAreaForm.subject" id="subject"
                :class="{ 'is-invalid': addAreaForm.errors.has('subject') }" class="form-control">
                    <option v-for="subject in subjects" :key="subject.id" :value="subject.id">
                        {{subject.name}}
                    </option>
                </select>
                <has-error :form="addAreaForm" field="subject"></has-error> 
            </div>

            <div class="d-flex flex-row-reverse">
            <button type="submit" class="btn btn-success float-right">Add Area</button>
            </div>
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Area</th>
                    <th>Subject</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="area in areas" :key="area.id">
                    <td>{{ area.name }}</td>
                    <td>{{ area.subject.name }}</td>
                    <td>
                        <a href="#" @click="editArea(area)">
                            <i class="far fa-edit" style="color: green"></i>
                        </a>
                        /
                        <a href="#" @click="deleteArea(area.id)">
                            <i class="far fa-trash-alt" style="color: red"></i>
                        </a>   
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Areas Modal -->
        <div class="modal fade" id="editAreaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="updateArea()" action="" method="post">
                    <div class="form-group">
                        <label for="name">Area Name</label>
                        <input type="text" v-model="editAreaForm.name" class="form-control" name="name" 
                            :class="{ 'is-invalid': editAreaForm.errors.has('name') }" placeholder="Name">
                            <has-error :form="editAreaForm" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select name="subject_id" v-model="editAreaForm.subject_id" id="subject" class="form-control" 
                        :class="{ 'is-invalid': editAreaForm.errors.has('subject_id') }">
                            <option v-for="subject in subjects" :key="subject.id" :value="subject.id">
                                {{ subject.name }}
                            </option>
                        </select>
                        <has-error :form="editAreaForm" field="subject_id"></has-error>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Area</button>
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
        props: ['Subjects'],
        data() {
            return {
                areas: {},
                addAreaForm: new Form ({
                    name: '',
                    subject: '',
                }),
                editAreaForm: new Form({
                    id: '',
                    name: '',
                    subject_id: '',
                }), 
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        computed: {
            subjects() {
                return this.Subjects
            }
        },
        methods: {
            loadAreas() { // START OF AREA
                axios.get('api/areas')
                    .then(({data}) => (this.areas = data))
            },
            addArea() {
                this.$Progress.start();
                this.addAreaForm.post('api/areas')
                    .then(() => {
                        Toast.fire({
                        icon: 'success',
                        title: 'Area added successfully'
                        }) 
                        this.addAreaForm.clear();
                        this.addAreaForm.reset();
                        this.$Progress.finish();
                        Fire.$emit('reloadAreas');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            editArea(area) {
                this.editAreaForm.clear();
                this.editAreaForm.reset();
                $('#editAreaModal').modal('show');
                this.editAreaForm.fill(area);
            },
            updateArea() {
                this.$Progress.start();
                this.editAreaForm.patch('api/areas/' + this.editAreaForm.id)
                    .then(() => {
                        Toast.fire({
                        icon: 'success',
                        title: 'Area updated successfully'
                        })  
                        $('#editAreaModal').modal('hide');
                        this.$Progress.finish();
                        Fire.$emit('reloadAreas');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            deleteArea(id) {
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
                        this.editAreaForm.delete('api/areas/' + id)
                            .then(() => {
                                Swal.fire(
                                'Deleted!',
                                'Certain area has been deleted.',
                                'success'
                                );

                                Fire.$emit('reloadAreas');
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
            }, // END OF AREA

        }, 
        created() {
            this.loadAreas();
            Fire.$on('reloadAreas', () => {
                this.loadAreas();
            })
        }
    }
</script>
