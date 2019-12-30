<template>
    <div>

            <form class="mb-3" @submit.prevent="addComponent()" action="" method="post">
                <div class="form-group">
                    <label for="name">Component</label>
                    <input type="text" v-model="addComponentForm.name" class="form-control" 
                        :class="{ 'is-invalid': addComponentForm.errors.has('name') }" id="name" placeholder="Component Name">
                    <has-error :form="addComponentForm" field="name"></has-error>
                </div>
                <div class="form-group">
                    <label for="area">Assign to an Area</label>
                    <select v-model="addComponentForm.area" id="area"
                    :class="{ 'is-invalid': addComponentForm.errors.has('area') }" class="form-control">
                        <option v-for="area in areas" :key="area.id" :value="area.id">
                            {{area.name}}
                        </option>
                    </select>
                    <has-error :form="addComponentForm" field="area"></has-error> 
                </div>
                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-success float-right">Add Component</button>
                </div>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>Component</th>
                        <th>Area</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody v-if="components.length > 0">
                    <tr v-for="component in components" :key="component.id">
                        <td>{{ component.name }}</td>
                        <td>{{ component.area.name }}</td>
                        <td>
                            <a href="#" @click="editComponent(component)">
                                <i class="far fa-edit" style="color: green"></i>
                            </a>
                            /
                            <a href="#" @click="deleteComponent(component.id)">
                                <i class="far fa-trash-alt" style="color: red"></i>
                            </a>    
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <h3 class="text-center">No Components Yet</h3>
                </tbody>
            </table>

        <!-- Components Modal -->
        <div class="modal fade" id="editComponentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Component</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="updateComponent()" action="" method="post">
                    <div class="form-group">
                        <label for="name">Component Name</label>
                        <input type="text" v-model="editComponentForm.name" class="form-control" name="name" 
                            :class="{ 'is-invalid': editComponentForm.errors.has('name') }" placeholder="Name">
                            <has-error :form="editComponentForm" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="area">Area</label>
                        <select name="area_id" v-model="editComponentForm.area_id" id="area" class="form-control" 
                        :class="{ 'is-invalid': editComponentForm.errors.has('area_id') }">
                            <option v-for="area in areas" :key="area.id" :value="area.id">
                                {{ area.name }}
                            </option>
                        </select>
                        <has-error :form="editComponentForm" field="area_id"></has-error>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Component</button>
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
                components: {},
                addComponentForm: new Form({
                    name: '',
                    area: '',
                }),
                editComponentForm: new Form({
                    id: '',
                    name: '',
                    area_id: '',
                }), 
                areas: {},
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            loadComponents() { // START OF COMPONENTS
                axios.get('api/components') 
                    .then(({data}) => (this.components = data))
            },
            addComponent() {
                this.$Progress.start();
                this.addComponentForm.post('api/components')
                    .then(() => {

                        Toast.fire({
                        icon: 'success',
                        title: 'Component updated successfully'
                        })  

                        $('#editComponentModal').modal('hide');

                        this.addComponentForm.clear();
                        this.addComponentForm.reset();
                        this.$Progress.finish();
                        Fire.$emit('reloadComponents');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            editComponent(component) {
                $('#editComponentModal').modal('show');
                this.editComponentForm.reset();
                this.editComponentForm.clear();
                this.editComponentForm.fill(component);
            },
            updateComponent() {
                this.$Progress.start();
                this.editComponentForm.patch('api/components/' + this.editComponentForm.id)
                    .then(() => {

                        Toast.fire({
                        icon: 'success',
                        title: 'Component updated successfully'
                        });  

                        $('#editComponentModal').modal('hide');

                        this.$Progress.finish();
                        Fire.$emit('reloadComponents');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            deleteComponent(id) {
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
                        this.editComponentForm.delete('api/components/' + id)
                        .then(() => {
                            Swal.fire(
                            'Deleted!',
                            'Certain component has been deleted.',
                            'success'
                            );

                            Fire.$emit('reloadComponents');
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
            loadAreas() {
                axios.get('api/areas')
                    .then(({data}) => (this.areas = data))
            }
        }, 
        created() {
            this.loadComponents();
            Fire.$on('reloadComponents', () => {
                this.loadComponents();
            })
            this.loadAreas();
            Fire.$on('reloadAreas', () => {
                this.loadAreas();
            })
        }
    }
</script>
