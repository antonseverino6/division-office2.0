<template>
    <div>
        <form class="mb-3" @submit.prevent="AddEmployeeBase()" action="" method="post">
            <div class="form-group">
                <label for="name">Employee Base</label>
                <input type="text" v-model="addEmpBaseForm.name" name="name" id="name" 
                :class="{ 'is-invalid': addEmpBaseForm.errors.has('name') }" class="form-control">
                <has-error :form="addEmpBaseForm" field="name"></has-error>
            </div>
            <div class="form-group">
                <label for="emptype">Employee Type</label>
                <select id="emptype" v-model="addEmpBaseForm.employeeType" class="form-control" :class="{ 'is-invalid': addEmpBaseForm.errors.has('employeeType') }">
                    <option v-for="employeeType in employeeTypes" :key="employeeType.id" :value="employeeType.id">{{employeeType.name}}</option>
                </select>
                <has-error :form="addEmpBaseForm" field="employeeType"></has-error>
            </div>

            <div class="d-flex flex-row-reverse">
            <button class="btn btn-success" type="submit">Add Employee Base</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Employee Base</th>
                    <th>Assigned To</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="employeeBase in employeeBases" :key="employeeBase.id">
                    <td>{{employeeBase.name}}</td>
                    <td>{{employeeBase.type_of_employee.name}}</td>
                    <td>
                        <a href="#" @click="editEmployeeBase(employeeBase)">
                            <i class="far fa-edit" style="color: green"></i>
                        </a>
                        /
                        <a href="#" @click="deleteEmployeeBase(employeeBase.id)">
                            <i class="far fa-trash-alt" style="color: red"></i>
                        </a>  
                    </td>
                </tr>
            </tbody>
        </table>

    <!-- Employee Base Modal -->
    <div class="modal fade" id="editEmpBaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Employee Base</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form @submit.prevent="updateEmployeeBase()" action="" method="post">
                <div class="form-group">
                    <label for="name">Component Name</label>
                    <input type="text" v-model="editEmpBaseForm.name" class="form-control" name="name" 
                        :class="{ 'is-invalid': editEmpBaseForm.errors.has('name') }">
                        <has-error :form="editEmpBaseForm" field="name"></has-error>
                </div>
                <div class="form-group">
                    <label for="employeeType">Employee Type</label>
                    <select name="type_of_employee_id" v-model="editEmpBaseForm.type_of_employee_id" id="employeeType" class="form-control" 
                    :class="{ 'is-invalid': editEmpBaseForm.errors.has('type_of_employee_id') }">
                        <option v-for="employeeType in employeeTypes" :key="employeeType.id" :value="employeeType.id">
                            {{ employeeType.name }}
                        </option>
                    </select>
                    <has-error :form="editEmpBaseForm" field="type_of_employee_id"></has-error>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update Employee Base</button>
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
                employeeBases: {},
                addEmpBaseForm: new Form({
                    name: '',
                    employeeType: '',
                }),
                editEmpBaseForm: new Form({
                    id: '',
                    name: '',
                    type_of_employee_id: '',
                }),
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            loadEmployeeBase() {
                axios.get('api/employeeBase')
                     .then(({data}) => (this.employeeBases = data))
            },
            AddEmployeeBase() {
                this.$Progress.start();
                this.addEmpBaseForm.post('api/employeeBase')
                    .then(() => {
                        Toast.fire({
                        icon: 'success',
                        title: 'Employee Type added successfully'
                        }) 

                        this.addEmpBaseForm.reset();
                        this.addEmpBaseForm.clear();

                        Fire.$emit('reloadEmployeeBase');
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            editEmployeeBase(employeeBase) {
                this.editEmpBaseForm.reset();
                this.editEmpBaseForm.clear();
                $('#editEmpBaseModal').modal('show');
                this.editEmpBaseForm.fill(employeeBase);
            },
            updateEmployeeBase() {
                this.$Progress.start();
                this.editEmpBaseForm.patch('api/employeeBase/' + this.editEmpBaseForm.id)
                    .then(() => {
                        Toast.fire({
                        icon: 'success',
                        title: 'Employee Base updated successfully'
                        })  
                        $('#editEmpBaseModal').modal('hide');
                        this.$Progress.finish();
                        Fire.$emit('reloadEmployeeBase');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            deleteEmployeeBase(id) {
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
                        this.editEmpBaseForm.delete('api/employeeBase/' + id)
                            .then(() => {
                                Swal.fire(
                                'Deleted!',
                                'Certain employee base has been deleted.',
                                'success'
                                );

                                Fire.$emit('reloadEmployeeBase');
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
        },
        created() {
            this.loadEmployeeBase();
            Fire.$on('reloadEmployeeBase', () => {
                this.loadEmployeeBase();
            });
            
        },
        computed: {
            employeeTypes() {
                return this.EmployeeTypeObject
            }
        }
    }
</script>
