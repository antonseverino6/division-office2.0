<template>
    <div>
        <form class="mb-3" @submit.prevent="addPosition()" action="" method="post">
            <div class="form-group">
                <label for="name">Position</label>
                <input type="text" v-model="addPositionForm.name" name="name" id="name" 
                :class="{ 'is-invalid': addPositionForm.errors.has('name') }" class="form-control">
                <has-error :form="addPositionForm" field="name"></has-error>
            </div>
            <div class="form-group">
                <label for="emptype">Employee Type</label>
                <select id="emptype" v-model="addPositionForm.employeeType" class="form-control" :class="{ 'is-invalid': addPositionForm.errors.has('employeeType') }">
                    <option v-for="employeeType in employeeTypes" :key="employeeType.id" :value="employeeType.id">
                        {{employeeType.name}}
                    </option>
                </select>
                <has-error :form="addPositionForm" field="employeeType"></has-error>
            </div>

            <div class="d-flex flex-row-reverse">
            <button class="btn btn-success" type="submit">Add Position</button>
            </div>
        </form>


        <table class="table">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Assigned To</th>
                    <th>Link Subject</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="position in positions" :key="position.id">
                    <td>{{position.name}}</td>
                    <td>{{position.type_of_employee.name}}</td>
                    <td><toggle-button :value="(! position.subject) ? false : true" @change="linkSubject(position.id)" :font-size="15" :height="30" :width="100" color="#75C791" :labels="{checked: 'Linked ', unchecked: 'Unlinked '}"/></td>
                    <td>
                        <a href="#" @click="editPosition(position)">
                            <i class="far fa-edit" style="color: green"></i>
                        </a>
                        /
                        <a href="#" @click="deletePosition(position.id)">
                            <i class="far fa-trash-alt" style="color: red"></i>
                        </a>  
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Position Modal -->
        <div class="modal fade" id="editPositionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="updatePosition()" action="" method="post">
                    <div class="form-group">
                        <label for="name">Position</label>
                        <input type="text" v-model="editPositionForm.name" class="form-control" name="name" 
                            :class="{ 'is-invalid': editPositionForm.errors.has('name') }">
                            <has-error :form="editPositionForm" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="employeeType">Employee Type</label>
                        <select name="type_of_employee_id" v-model="editPositionForm.type_of_employee_id" id="employeeType" class="form-control" 
                        :class="{ 'is-invalid': editPositionForm.errors.has('type_of_employee_id') }">
                            <option v-for="employeeType in employeeTypes" :key="employeeType.id" :value="employeeType.id">
                                {{ employeeType.name }}
                            </option>
                        </select>
                        <has-error :form="editPositionForm" field="type_of_employee_id"></has-error>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Position</button>
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
        props: ['EmployeeTypeObject'],
        data() {
            return {
                positions: {},
                addPositionForm: new Form({
                    name: '',
                    employeeType: '',
                }),
                editPositionForm: new Form({
                    id: '',
                    name: '',
                    type_of_employee_id: '',
                    subject: '',
                }),
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            loadPositions() {
                axios.get('api/positions')
                     .then(({data}) => (this.positions = data))
            },
            addPosition() {
                this.$Progress.start();
                this.addPositionForm.post('api/positions')
                    .then(() => {
                        
                        Toast.fire({
                        icon: 'success',
                        title: 'Position added successfully'
                        })  
                        
                        this.addPositionForm.clear();
                        this.addPositionForm.reset();

                        this.$Progress.finish();
                        Fire.$emit('reloadPositions');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            editPosition(position) {
                this.editPositionForm.clear();
                this.editPositionForm.reset();
                $('#editPositionModal').modal('show');
                this.editPositionForm.fill(position);
            },
            updatePosition() {
                this.$Progress.start();
                this.editPositionForm.patch('api/positions/' + this.editPositionForm.id)
                    .then(() => {
                        Toast.fire({
                        icon: 'success',
                        title: 'Position updated successfully'
                        })  
                        $('#editPositionModal').modal('hide');
                        this.$Progress.finish();
                        Fire.$emit('reloadPositions');                    
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            deletePosition(id) {
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
                        this.editPositionForm.delete('api/positions/' + id)
                            .then(() => {
                                Swal.fire(
                                'Deleted!',
                                'Certain position has been deleted.',
                                'success'
                                );

                                Fire.$emit('reloadPositions');
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
            linkSubject(id) {
                axios.patch('api/linkSubject/'  + id)
                     .catch(() => {
                         alert('something went wrong')
                     });

            },
        },
        created() {
            this.loadPositions();
            Fire.$on('reloadPositions', () => {
                this.loadPositions();
            });
            
        },
        computed: {
            employeeTypes() {
                return this.EmployeeTypeObject
            }
        }
    }
</script>
