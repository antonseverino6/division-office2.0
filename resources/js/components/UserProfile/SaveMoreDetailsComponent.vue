<template>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Create more details</div>

                        <div class="card-body">
                            <div class="row mb-4" v-if="!dataLoaded">
                                <div class="col-md-1"></div>
                                <div class="col-md-3 text-right">
                                    <img :src="getImage()" style="border: 1px solid #000;" width="200" height="200" alt="">
                                </div>
                                <div class="col-md-8 pl-0 mt-3">

                                    <ul>
                                        <li><h4><strong>{{ fullName }}</strong></h4></li>
                                        <li>{{ profileHeader.representative.name }}</li>
                                        <li>Employee ID: <strong>{{ profileHeader.employee_id }}</strong></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <hr class="mt-0" style="color: #000;">
                                </div>    
                            </div>  
                            <form @submit.prevent="createMoreDetails()" action="" method="post">  
                            <div class="row mb-1">        
                                
                                <div class="col-md-6 border-right border-dark">
                                    <p class="form-header">Type of Employee</p>
                                    <hr>
                                    <div class="form-group">
                                        <label for="emp_type">Employee type</label>
                                        <select v-model="form.type_of_employee_id" @change="pickEmployeeBaseAndPosition()" id="emp_type" 
                                            :class="{ 'is-invalid': form.errors.has('type_of_employee_id') }" class="form-control form-control-sm">
                                            <option value="" selected disabled hidden>-- Select --</option>
                                            <option v-for="employeeType in employeeTypes" :key="employeeType.id" :value="employeeType.id">{{employeeType.name}}</option>
                                        </select>
                                        <has-error :form="form" field="type_of_employee_id"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="emp_base">Employee base</label>
                                        <select v-model="form.employee_base_id" id="emp_base" 
                                            :class="{ 'is-invalid': form.errors.has('employee_base_id') }" class="form-control form-control-sm">
                                            <option value="" selected disabled hidden>-- Select --</option>
                                            <option v-for="employeeBase in selectFromEmployeeBases" :key="employeeBase.id" :value="employeeBase.id">{{employeeBase.name}}</option>
                                        </select>
                                        <has-error :form="form" field="employee_base_id"></has-error>
                                    </div> 
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <select v-model="form.position_id" @change="showSubject" id="position" 
                                            :class="{ 'is-invalid': form.errors.has('position_id') }" class="form-control form-control-sm">
                                            <option value="" selected disabled hidden>-- Select --</option>
                                            <option v-for="position in selectFromPositions" :key="position.id" :value="position.id">{{position.name}}</option>
                                        </select>
                                        <has-error :form="form" field="position_id"></has-error>
                                    </div>  
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <select v-model="form.subject_id" @change="pickArea" :disabled="disableSubject" id="subject" 
                                                :class="{ 'is-invalid': form.errors.has('subject_id') }" class="form-control form-control-sm">
                                            <option value="" selected disabled hidden>-- Select --</option>
                                            <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{subject.name}}</option>
                                        </select>
                                        <has-error :form="form" field="subject_id"></has-error>
                                    </div>  
                                    <div class="form-group">
                                        <label for="area">Area</label>
                                        <select @change="pickComponent" :disabled="disableArea" v-model="form.area_id" id="area" 
                                            :class="{ 'is-invalid': form.errors.has('area_id') }" class="form-control form-control-sm">
                                            <option value="" selected disabled hidden>-- Select --</option>
                                            <option v-for="area in selectFromAreas" :key="area.id" :value="area.id">{{area.name}}</option>
                                        </select>
                                        <has-error :form="form" field="area_id"></has-error>
                                    </div>  
                                    <div class="form-group">
                                        <label for="component">Component</label>
                                        <select v-model="form.component_id" :disabled="disableComponent" id="component" 
                                            :class="{ 'is-invalid': form.errors.has('component_id') }" class="form-control form-control-sm">
                                            <option value="" selected disabled hidden>-- Select --</option>
                                            <option v-for="component in selectFromComponents" :key="component.id" :value="component.id">{{component.name}}</option>
                                        </select>
                                        <has-error :form="form" field="component_id"></has-error>
                                    </div>  
                                    <div class="form-group">
                                        <label for="grade_level">Grade Level</label>
                                        <select v-model="form.grade_level_id" name="" id="grade_level" 
                                            :class="{ 'is-invalid': form.errors.has('grade_level_id') }" class="form-control form-control-sm">
                                            <option value="" selected disabled hidden>-- Select --</option>
                                            <option v-for="gradeLevel in gradeLevels" :key="gradeLevel.id" :value="gradeLevel.id">{{gradeLevel.name}}</option>
                                        </select>
                                        <has-error :form="form" field="grade_level_id"></has-error>
                                    </div>  
                                    <div class="form-group">
                                        <label for="level_of_civil">Level of civil service elegibility</label>
                                        <select v-model="form.levels_of_civil_id" id="level_of_civil" 
                                            :class="{ 'is-invalid': form.errors.has('levels_of_civil_id') }" class="form-control form-control-sm">
                                            <option value="" selected disabled hidden>-- Select --</option>
                                            <option v-for="levelOfCivil in levelOfCivils" :key="levelOfCivil.id" :value="levelOfCivil.id">{{levelOfCivil.name}}</option>
                                        </select>
                                        <has-error :form="form" field="levels_of_civil_id"></has-error>
                                    </div> 
                                    <p class="form-header">Government Identification</p>
                                    <hr> 
                                    <div class="form-group">
                                        <label for="tin_num">Tin no.</label>
                                        <input type="text" v-model="form.tin_num" id="tin_num" 
                                            :class="{ 'is-invalid': form.errors.has('tin_num') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="tin_num"></has-error>
                                    </div> 
                                    <div class="form-group">
                                        <label for="pag_ibig">Pag-ibig no.</label>
                                        <input type="text"  v-model="form.pag_ibig_num" id="pag_ibig" 
                                            :class="{ 'is-invalid': form.errors.has('pag_ibig_num') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="pag_ibig_num"></has-error>
                                    </div> 
                                    <div class="form-group">
                                        <label for="gsis_num">GSIS BP no.</label>
                                        <input type="text" v-model="form.gsis_bp_num" id="gsis_num" 
                                            :class="{ 'is-invalid': form.errors.has('gsis_bp_num') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="gsis_bp_num"></has-error>
                                    </div> 
                                    <div class="form-group">
                                        <label for="philhealth_num">Philhealth no.</label>
                                        <input type="text" v-model="form.philhealth_num" id="philhealth_num" 
                                            :class="{ 'is-invalid': form.errors.has('philhealth_num') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="philhealth_num"></has-error>
                                    </div> 
                                    <div class="form-group">
                                        <label for="lbp_num">LBP no.</label>
                                        <input type="text" v-model="form.lbp_num" id="lbp_num" 
                                            :class="{ 'is-invalid': form.errors.has('lbp_num') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="lbp_num"></has-error>
                                    </div> 
                                    <div class="form-group">
                                        <label for="prc_lic">PRC License</label>
                                        <input type="text" v-model="form.prc_license" id="prc_lic" 
                                            :class="{ 'is-invalid': form.errors.has('prc_license') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="prc_license"></has-error>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <p class="form-header">Other Information</p>
                                    <hr>
                                    <div class="form-group">
                                        <label for="high_deg">Highest grade completed or degree received</label>
                                        <input type="text" v-model="form.highest_grade_degree_rec" 
                                            :class="{ 'is-invalid': form.errors.has('highest_grade_degree_rec') }" class="form-control form-control-sm" id="high_deg" >
                                        <has-error :form="form" field="highest_grade_degree_rec"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="year_rec">Year received</label>
                                        <input type="text" v-model="form.year_received" id="year_rec" 
                                            :class="{ 'is-invalid': form.errors.has('year_received') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="year_received"></has-error>
                                    </div> 
                                    <div class="form-group">
                                        <label for="ins_name">Name of institution</label>
                                        <input type="text"  v-model="form.institution_name" id="ins_name" 
                                            :class="{ 'is-invalid': form.errors.has('institution_name') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="institution_name"></has-error>
                                    </div> 
                                    <div class="form-group">
                                        <label for="spec_qual">Special Qualification</label>
                                        <input type="text" v-model="form.spec_qualification" id="spec_qual" 
                                            :class="{ 'is-invalid': form.errors.has('spec_qualification') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="spec_qualification"></has-error>
                                    </div> 
                                    <div class="form-group">
                                        <label for="prev_exp">Previous Experience</label>
                                        <input type="text" v-model="form.previous_experience" id="prev_exp" 
                                            :class="{ 'is-invalid': form.errors.has('previous_experience') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="previous_experience"></has-error>
                                    </div>
                                    <p class="form-header">Spouse Information</p>
                                    <hr>
                                    <div class="form-group">
                                        <label for="spouse_name">Name</label>
                                        <input type="text" v-model="form.spouse_name" id="spouse_name" 
                                            :class="{ 'is-invalid': form.errors.has('spouse_name') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="spouse_name"></has-error>
                                    </div>   
                                    <div class="form-group">
                                        <label for="spouse_occ">Occupation</label>
                                        <input type="text" v-model="form.spouse_occ" id="spouse_occ" 
                                            :class="{ 'is-invalid': form.errors.has('spouse_occ') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="spouse_occ"></has-error>
                                    </div>  
                                    <div class="form-group">
                                        <label for="spouse_add">Address</label>
                                        <input type="text" v-model="form.spouse_add" id="spouse_add" 
                                            :class="{ 'is-invalid': form.errors.has('spouse_add') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="spouse_add"></has-error>
                                    </div>  
                                    <div class="form-group">
                                        <label for="spouse_phone">Phone Number</label>
                                        <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="spouse_phone_addon">+63</span>
                                        </div>
                                        <input type="text" v-model="form.spouse_phone" class="form-control" id="spouse_phone" aria-label="Username" 
                                            :class="{ 'is-invalid': form.errors.has('spouse_phone') }" aria-describedby="spouse_phone_addon">
                                        <has-error :form="form" field="spouse_phone"></has-error>
                                        </div>
                                    </div> 
                                    <p class="form-header">Contact in case of emergency</p>
                                    <hr>
                                    <div class="form-group">
                                        <label for="em_name">Name</label>
                                        <input type="text" v-model="form.emergency_name" id="em_name" 
                                            :class="{ 'is-invalid': form.errors.has('emergency_name') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="emergency_name"></has-error>
                                    </div>   
                                    <div class="form-group">
                                        <label for="em_relation">Relationship</label>
                                        <input type="text" v-model="form.emergency_relationship" id="em_relation" 
                                            :class="{ 'is-invalid': form.errors.has('emergency_relationship') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="emergency_relationship"></has-error>
                                    </div>  
                                    <div class="form-group">
                                        <label for="em_address">Address</label>
                                        <input type="text" v-model="form.emergency_address" id="em_address" 
                                            :class="{ 'is-invalid': form.errors.has('emergency_address') }" class="form-control form-control-sm">
                                        <has-error :form="form" field="emergency_address"></has-error>
                                    </div>   
                                    <div class="form-group">
                                        <label for="emer_phone">Phone Number</label>
                                        <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="emer_phone_addon">+63</span>
                                        </div>
                                        <input type="text"  v-model="form.emergency_phone" class="form-control" id="emer_phone" aria-label="Username" 
                                            :class="{ 'is-invalid': form.errors.has('emergency_phone') }" aria-describedby="emer_phone_addon">
                                        <has-error :form="form" field="emergency_phone"></has-error>
                                        </div>
                                    </div> 
                                </div>
                                <button type="submit" class="btn btn-success form-control">Submit</button>
                                
                            </div>  
                            </form>         
                        </div> 

                </div>
            </div>
        </div>
    </div>    

</template>


<style>
    .form-header {
        color: #7785a0; 
        font-weight: bold;
    }
</style>
<script>
    import { isNull } from 'util';
export default {
    
    data() {
        return {
            disableSubject: true,
            disableArea: true,
            disableComponent: true,
            visiblePosition: 0,
            profileHeader: {},
            fullName: '',
            dataLoaded: true,
            userHasRecord: false,
            employeeTypes: {},
            employeeBases: {},
            positions: {},
            selectFromEmployeeBases: {},
            selectFromPositions: {},
            subjects: {},
            levelOfCivils: {},
            areas: {},
            selectFromAreas: {},
            components: {},
            selectFromComponents: {},
            gradeLevels: {},
            form: new Form ({
                id: '',
                user_id: '',
                employee_personal_detail_id: '',
                spouse_name: '',
                spouse_occ: '',
                spouse_add: '',
                spouse_phone: '',
                type_of_employee_id: '',
                employee_base_id: '',
                position_id: '',
                subject_id: '',
                area_id: '',
                component_id: '',
                grade_level_id: '',
                levels_of_civil_id: '',
                pag_ibig_num: '',
                gsis_bp_num: '',
                philhealth_num: '',
                lbp_num: '',
                prc_license: '',
                highest_grade_degree_rec: '',
                year_received: '',
                institution_name: '',
                spec_qualification: '',
                previous_experience: '',
                emergency_name: '',
                emergency_relationship: '',
                emergency_address: '',
                emergency_phone: '',
            }),
        }
    },
    mounted() {
        console.log('mounted');
    },
    methods: {
        getUserId() {
            axios.get('api/get-user')
            .then(({data}) => {
            this.form.user_id = data;
            })
        },
        getHeader() {
            this.dataLoaded = true;
            axios.get('api/user-header')
                .then(({data}) => {
                    this.dataLoaded = false;
                    if (data == false) {
                        this.$router.push('/save-profile');
                    }
                    (this.profileHeader = data[0]);
                    this.form.employee_personal_detail_id = data[0]['id'];
                    this.getfullName();
                })
                // .catch(() => {
                //     this.$router.push('/save-profile');
                // })
        },
        getfullName() {
            this.fullName = this.profileHeader.fname + " " + this.profileHeader.mname + " " + this.profileHeader.lname;
            if (isNull(this.profileHeader.mname) && isNull(this.profileHeader.suffix)) {
                this.fullName = this.profileHeader.fname + " " + this.profileHeader.lname;
            } else if (isNull(this.profileHeader.mname)) {
                this.fullName = this.profileHeader.fname + " " + this.profileHeader.lname + " " + this.profileHeader.suffix;
            } else if (!isNull(this.profileHeader.suffix)) {
                this.fullName = this.fullName + " " + this.profileHeader.suffix;
            } else {
                this.fullName;
            }
            
        },
        getImage() {
            return '/img/profile/' + this.profileHeader.image;
        },
        getEmployeeTypes() {
            axios.get('api/typeOfEmployees')
                .then(({data}) => (this.employeeTypes = data))
        },
        getEmployeeBases() {
            axios.get('api/employeeBase')
                 .then(({data}) => (this.employeeBases = data))
        },
        getPositions() {
            axios.get('api/positions')
                 .then(({data}) => (this.positions = data))
        },
        getSubjects() {
            axios.get('api/subjects')
                 .then(({data}) => (this.subjects = data))
        },
        getAreas() {
            axios.get('api/areas')
                 .then(({data}) => (this.areas = data))
        },
        getLevelOfCivils() {
            axios.get('api/levelsOfCivil')
                 .then(({data}) => (this.levelOfCivils = data))
        },
        getComponents() {
            axios.get('api/components')
                 .then(({data}) => (this.components = data))
        },
        getGradeLevels() {
            axios.get('api/grade-levels')
                 .then(({data}) => (this.gradeLevels = data))
        },
        pickEmployeeBaseAndPosition() {
            let showEmployeeBase = this.employeeBases.filter(obj => {
                return obj.type_of_employee_id == this.form.type_of_employee_id
            }); 
            
            let showPosition = this.positions.filter(obj => {
                return obj.type_of_employee_id == this.form.type_of_employee_id
            }); 

            this.selectFromEmployeeBases = showEmployeeBase;
            this.selectFromPositions = showPosition;

            this.form.employee_base_id =  '';
            this.form.position_id = '';
            this.form.subject_id = '';
            this.form.area_id = '';
            this.form.component_id = '';

            this.disableSubject = true;
            this.disableArea = true;
            this.disableComponent = true;

        },
        resetComponent() {
            this.form.component_id = '';
        },
        pickArea() {
            let showAreas = this.areas.filter(obj => {
                return obj.subject_id == this.form.subject_id
            }); 

            this.selectFromAreas = showAreas;
            if (showAreas.length > 0) {
                this.disableArea = false;
            } else {
                this.disableArea = true;
                this.disableComponent = true;
            }
            this.form.area_id = '';
            this.form.component_id = '';
            this.selectFromComponents = {};
        },
        pickComponent() {
            this.resetComponent();
            let showComponents = this.components.filter(obj => {
                return obj.area_id == this.form.area_id
            }); 

            this.selectFromComponents = showComponents;

            if (showComponents.length > 0) {
                this.disableComponent = false;
            } else {
                this.disableComponent = true;
            }

        },
        showSubject() {
            this.disableSubject = true;
            let showPosition = this.positions.filter(obj => {
                return obj.id == this.form.position_id
            }); 

            this.disableSubject = (!showPosition[0]['subject']) ? true : false;

            if (! showPosition[0]['subject']) {
                this.form.subject_id = '';
                this.form.area_id = '';
                this.form.component_id = '';
                this.disableArea = true;
                this.disableComponent = true;
            }
            // console.log(showPosition[0]['subject']);
        },
        createMoreDetails() {
            this.$Progress.start();
            this.form.post('api/more-details')
                .then(() => {

                    Toast.fire({
                    icon: 'success',
                    title: 'Details submitted successfully'
                    });

                    this.$Progress.finish();
                    this.$router.push('/user-profile');
                })
                .catch(() => {
                    this.$Progress.fail();
                })
        },
        userHasRecordMethod() {
            axios.get('api/userHas-MoreRecord')
                .then(({data}) => {
                this.userHasRecord = data;
                if (data) {
                    this.fillForm();
                }
                }); 
        },
        fillForm() {
            axios.get('api/user-more-details')
                 .then(({data}) => {
                     (this.form.fill(data[0]));
                 })
        },
    },
    created() {
        this.getUserId()
        this.userHasRecordMethod()
        this.getHeader();
        this.getEmployeeTypes();
        this.getEmployeeBases();
        this.getPositions();
        this.getSubjects();
        this.getAreas();
        this.getComponents();
        this.getLevelOfCivils();
        this.getGradeLevels();
    },
}
</script>