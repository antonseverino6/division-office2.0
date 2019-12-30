<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 mt-3">
                <div class="card mt-2">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="employee-type-tab" data-toggle="tab" href="#employee-type" role="tab" aria-controls="employee-type" aria-selected="true">Employee Type</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="employee-base-tab" data-toggle="tab" href="#employee-base" role="tab" aria-controls="employee-base" aria-selected="true">Employee Base</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="position-tab" data-toggle="tab" href="#position" role="tab" aria-controls="position" aria-selected="true">Position</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="levelsOfCivil-tab" data-toggle="tab" href="#levelsOfCivil" role="tab" aria-controls="levelsOfCivil" aria-selected="true">Levels of Civil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="employmentStatus-tab" data-toggle="tab" href="#employmentStatus" role="tab" aria-controls="employmentStatus" aria-selected="true">Employment Status</a>
                            </li>
                        </ul> 
                    </div>
                    <div class="tab-content"> 
                        <!------------------------------------- EMPLOYEE TYPE --------------------------------------------------->
                        <div class="card-body tab-pane active" id="employee-type" aria-labelledby="employee-type-tab">
                            <form class="mb-3" @submit.prevent="AddEmployeeType()" action="" method="post">
                                <div class="form-group">
                                    <label for="name">Employee Type</label>
                                    <input type="text" v-model="addEmpTypeForm.name" name="name" id="name" 
                                    :class="{ 'is-invalid': addEmpTypeForm.errors.has('name') }" class="form-control">
                                    <has-error :form="addEmpTypeForm" field="name"></has-error>
                                </div>

                                <div class="d-flex flex-row-reverse">
                                <button class="btn btn-success" type="submit">Add Employee Type</button>
                                </div>
                            </form>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Employee Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="employeeType in employeeTypes" :key="employeeType.id">
                                        <td>{{employeeType.name}}</td>
                                        <td>
                                            <a href="#" @click="editEmployeeType(employeeType)">
                                                <i class="far fa-edit" style="color: green"></i>
                                            </a>
                                            /
                                            <a href="#" @click="deleteEmployeeType(employeeType.id)">
                                                <i class="far fa-trash-alt" style="color: red"></i>
                                            </a>  
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        <!-- Employee Type Modal -->
                        <div class="modal fade" id="editEmpTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Employee Type</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="updateEmployeeType()" action="" method="post">
                                    <div class="form-group">
                                        <label for="name">Employee Type</label>
                                        <input type="text" v-model="editEmpTypeForm.name" class="form-control" name="name" 
                                            :class="{ 'is-invalid': editEmpTypeForm.errors.has('name') }">
                                            <has-error :form="editEmpTypeForm" field="name"></has-error>
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

                        </div>
                        <!------------------------------------- EMPLOYEE BASE --------------------------------------------------->
                        <div class="card-body tab-pane" id="employee-base" aria-labelledby="employee-base-tab">
                            <employee-base v-bind:EmployeeTypeObject="employeeTypes"></employee-base>
                        </div>
                        <!------------------------------------- POSITION --------------------------------------------------->
                        <div class="card-body tab-pane" id="position" aria-labelledby="position-tab">
                            <position v-bind:EmployeeTypeObject="employeeTypes"></position>
                        </div>

                        <div class="card-body tab-pane" id="levelsOfCivil" aria-labelledby="levelsOfCivil-tab">
                            <levels-of-civil></levels-of-civil>
                        </div>

                        <div class="card-body tab-pane" id="employmentStatus" aria-labelledby="employmentStatus-tab">
                            <employment-status></employment-status>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LevelsOfCivil from './LevelsOfCivilComponent.vue'
    import EmployeeBase from './EmployeeBaseComponent.vue'
    import Position from './PositionComponent.vue'
    import EmploymentStatus from './EmploymentStatusComponent.vue'
    export default {
        components: {
            LevelsOfCivil,
            EmployeeBase,
            Position,
            EmploymentStatus
        },
        data() {
            return {
                employeeTypes: {},
                addEmpTypeForm: new Form({
                    name: '',
                }),
                editEmpTypeForm: new Form({
                    id: '',
                    name: '',
                }),
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            loadEmployeeType() {
                axios.get('api/typeOfEmployees')
                     .then(({data}) => (this.employeeTypes = data))
            },
            AddEmployeeType() {
                this.$Progress.start();
                this.addEmpTypeForm.post('api/typeOfEmployees')
                    .then(() => {
                        Toast.fire({
                        icon: 'success',
                        title: 'Employee Type added successfully'
                        }) 

                        this.addEmpTypeForm.reset();
                        this.addEmpTypeForm.clear();

                        Fire.$emit('reloadEmployeeType');
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            editEmployeeType(employeeType) {
                this.editEmpTypeForm.reset();
                this.editEmpTypeForm.clear();
                $('#editEmpTypeModal').modal('show');
                this.editEmpTypeForm.fill(employeeType);
            },
            updateEmployeeType() {
                this.$Progress.start();
                this.editEmpTypeForm.patch('api/typeOfEmployees/' + this.editEmpTypeForm.id)
                    .then(() => {
                        Toast.fire({
                        icon: 'success',
                        title: 'Employee Type updated successfully'
                        }) 

                        this.addEmpTypeForm.reset();
                        this.addEmpTypeForm.clear();

                        Fire.$emit('reloadEmployeeType');
                        $('#editEmpTypeModal').modal('hide');
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            deleteEmployeeType(id) {
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
                        this.editEmpTypeForm.delete('api/typeOfEmployees/' + id)
                            .then(() => {
                                Swal.fire(
                                'Deleted!',
                                'Certain employee type has been deleted.',
                                'success'
                                );

                                Fire.$emit('reloadEmployeeType');
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
            this.loadEmployeeType();
            Fire.$on('reloadEmployeeType', () => {
                this.loadEmployeeType();
            });
        }
    }
</script>
