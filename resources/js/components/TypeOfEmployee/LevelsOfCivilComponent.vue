<template>
    <div>
        <form class="mb-3" @submit.prevent="addLevelOfCivil()" action="" method="post">
            <div class="form-group">
                <label for="level-of-civil">Levels Of Civil Service Elegibility</label>
                <input v-model="addCivilForm.name" type="text" id="level-of-civil" 
                    :class="{ 'is-invalid': addCivilForm.errors.has('name') }" class="form-control">
                    <has-error :form="addCivilForm" field="name"></has-error>
            </div>
            <div class="d-flex flex-row-reverse">
                <button class="btn btn-success" type="submit">Add Level</button>
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
                <tr v-for="levelOfCivil in levelsOfCivils" :key="levelOfCivil.id" >
                    <td>{{levelOfCivil.name}}</td>
                    <td>
                        <a href="#" @click="editLevelOfCivil(levelOfCivil)">
                            <i class="far fa-edit" style="color: green"></i>
                        </a>
                        /
                        <a href="#" @click="deleteLevelOfCivil(levelOfCivil.id)">
                            <i class="far fa-trash-alt" style="color: red"></i>
                        </a> 
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Employee Type Modal -->
        <div class="modal fade" id="editCivilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Civil Service Elegibility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="updateLevelOfCivil()" action="" method="post">
                    <div class="form-group">
                        <label for="name">Level of Civil Service Elegibility</label>
                        <input type="text" v-model="editCivilForm.name" class="form-control" name="name" 
                            :class="{ 'is-invalid': editCivilForm.errors.has('name') }">
                            <has-error :form="editCivilForm" field="name"></has-error>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Level of Civil</button>
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
                levelsOfCivils: {},
                addCivilForm: new Form({
                    name: '',
                }),
                editCivilForm: new Form({
                    id: '',
                    name: '',
                }),
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            loadLevels() {
                axios.get('api/levelsOfCivil')
                     .then(({data}) => {
                         (this.levelsOfCivils = data)
                     })
                     .catch(() => {
                         alert('something went wrong')
                     })
            },
            addLevelOfCivil() {
                this.addCivilForm.post('api/levelsOfCivil')
                    .then(() => {
                        this.addCivilForm.reset();
                        this.addCivilForm.clear();
                        Toast.fire({
                        icon: 'success',
                        title: 'Level of Civil added successfully'
                        }) 
                        Fire.$emit('reloadLevels');
                    })
            },
            editLevelOfCivil(levelOfCivil) {
                this.editCivilForm.clear();
                this.editCivilForm.reset();
                $('#editCivilModal').modal('show');
                this.editCivilForm.fill(levelOfCivil);
            },
            updateLevelOfCivil() {
                this.editCivilForm.patch('api/levelsOfCivil/' + this.editCivilForm.id)
                    .then(() => {
                        Toast.fire({
                        icon: 'success',
                        title: 'Level of Civil updated successfully'
                        }) 

                        $('#editCivilModal').modal('hide');
                        Fire.$emit('reloadLevels');
                    })
            },
            deleteLevelOfCivil(id) {
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
                        this.editCivilForm.delete('api/levelsOfCivil/' + id) 
                            .then(() => {
                                Swal.fire(
                                'Deleted!',
                                'Certain level of civil has been deleted.',
                                'success'
                                );

                                Fire.$emit('reloadLevels');
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
            this.loadLevels();
            Fire.$on('reloadLevels', () => {
                this.loadLevels();
            })
        }
    }
</script>
