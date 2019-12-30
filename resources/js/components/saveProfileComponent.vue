<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div v-if="!userHasRecord" class="card-header">Create Your Profile</div>
                    <div v-else class="card-header">Update Profile</div>

                        <form @submit.prevent="(!userHasRecord) ? addEmployee() : updateProfile()" action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-center mb-5">
                            <div class="col-md-4">
                                <input type="file" ref="image" @change="uploadImage" accept="image/jpeg,image/jpg,image/png" id="file" style="display: none;">
                                <img v-if="!userHasRecord" :src="setProfilePicture()" @click="pickFile" class="mr-5" style="border: 1px solid #000; cursor: pointer" width="200" height="200" alt="">
                                <img v-else :src="getProfilePhotoForUpdate()" @click="pickFile" class="mr-5" style="border: 1px solid #000; cursor: pointer" width="200" height="200" alt="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <hr class="mt-0" style="color: #000;">
                            </div>    
                        </div>    
                        <div class="row mb-1">        
                            <div class="col-md-6 border-right border-dark">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control form-control-sm" id="fname" name="fname" 
                                    :class="{ 'is-invalid': form.errors.has('fname') }" v-model="form.fname">
                                    <has-error :form="form" field="fname"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" id="mname" name="middle_name" class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('mname') }" v-model="form.mname">
                                    <has-error :form="form" field="mname"></has-error>
                                </div> 
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="last_name" class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('lname') }" v-model="form.lname">
                                    <has-error :form="form" field="lname"></has-error>
                                </div> 
                                <div class="form-group">
                                    <label for="suffix">Suffix</label>
                                    <input type="text" id="suffix" name="suffix" class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('suffix') }" v-model="form.suffix">
                                    <has-error :form="form" field="suffix"></has-error>
                                </div>                                         
                                <div class="form-group">
                                    <label for="birth_date">Birth Date</label>
                                    <input type="text" id="datepicker" name="birth_date" class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('birth_date') }" v-model="form.birth_date">
                                    <has-error :form="form" field="birth_date"></has-error>
                                </div>  
                                <div class="form-group">
                                    <label for="birth_place">Birth Place</label>
                                    <input type="text" id="birth_place" name="birth_place" class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('birth_place') }" v-model="form.birth_place">
                                    <has-error :form="form" field="birth_place"></has-error>
                                </div> 
                                <div class="form-group mb-4">
                                    <label for="gender" class="mr-2" style="display:block">Gender</label>
                                    <div class="form-check-inline ml-3">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" v-model="form.gender" name="gender" value="Male">
                                        <i class="fas fa-male"></i> Male
                                    </label>
                                    </div>
                                    <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" v-model="form.gender" name="gender" value="Female">
                                        <i class="fas fa-female"></i> Female
                                    </label>
                                    </div>
                                    <has-error :form="form" field="gender"></has-error> 
                                </div>    
                                <div class="form-group">
                                    <label for="civil_status">Civil Status</label>
                                    <select name="civil_status_id" id="civil_status" class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('civil_status_id') }" v-model="form.civil_status_id">
                                        <option value="">-- Select --</option>
                                        <option v-for="civilStatus in civilStatuses" :key="civilStatus.id" :value="civilStatus.id">{{civilStatus.name}}</option>
                                    </select>
                                    <has-error :form="form" field="civil_status_id"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="per_address">Permanent Address</label>
                                    <input type="text" class="form-control form-control-sm" name="per_address" id="per_address"
                                    :class="{ 'is-invalid': form.errors.has('per_address') }" v-model="form.per_address">
                                    <has-error :form="form" field="per_address"></has-error>
                                </div>    
                                <div class="form-group">
                                    <label for="phone_num">Phone Number</label>
                                    <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="phone_number">+63</span>
                                    </div>
                                    <input type="text"  v-model="form.phone_num" class="form-control" id="phone_num" aria-label="Username" 
                                        :class="{ 'is-invalid': form.errors.has('phone_num') }" aria-describedby="phone_number">
                                    <has-error :form="form" field="phone_num"></has-error>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control form-control-sm" name="email" id="email"
                                    :class="{ 'is-invalid': form.errors.has('email') }" v-model="form.email">
                                    <has-error :form="form" field="email"></has-error>
                                </div>                                    
                            </div>     

                            <div class="col-md-6">
                                <div class="form-group">
                                <div class="form-group">
                                    <label for="emp_id">Employee ID</label>
                                    <input type="text" id="emp_id" name="employee_id" class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('employee_id') }" v-model="form.employee_id">
                                        <has-error :form="form" field="employee_id"></has-error>
                                </div>
                                    <label for="role_type">Role Type</label>
                                    <input type="text" class="form-control form-control-sm" name="role_type" id="role_type"
                                    :class="{ 'is-invalid': form.errors.has('role_type') }" v-model="form.role_type">
                                        <has-error :form="form" field="role_type"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="emp_status">Employment Status</label>
                                    <select class="form-control form-control-sm" name="emp_status" id="emp_status"
                                    :class="{ 'is-invalid': form.errors.has('employment_status_id') }" v-model="form.employment_status_id">
                                        
                                        <option value="">-- Select --</option>
                                        <option v-for="empStatus in empStatuses" :key="empStatus.id" :value="empStatus.id">{{empStatus.name}}</option>
                                    </select>
                                    <has-error :form="form" field="employment_status_id"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="job_code">Job Title Code</label>
                                    <input type="text" class="form-control form-control-sm" name="job_code" id="job_code"
                                    :class="{ 'is-invalid': form.errors.has('job_code') }" v-model="form.job_code">
                                        <has-error :form="form" field="job_code"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="date_join">Date of Joining</label>
                                    <input type="text" id="datepicker" name="date_join" class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('date_join') }" v-model="form.date_join">
                                        <has-error :form="form" field="date_join"></has-error>
                                </div> 
                                <div class="form-group">
                                    <label for="date_appoint">Date of Original Appointment</label>
                                    <input type="text" id="datepicker" name="date_appoint" class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('date_appoint') }" v-model="form.date_appoint">
                                        <has-error :form="form" field="date_appoint"></has-error>
                                </div> 
                                <div class="form-group">
                                    <label for="work_shift">Work Shift</label>
                                    <input type="text" class="form-control form-control-sm" name="work_shift" id="work_shift"
                                    :class="{ 'is-invalid': form.errors.has('work_shift') }" v-model="form.work_shift">
                                        <has-error :form="form" field="work_shift"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="biometric">Biometric ID/RFID</label>
                                    <input type="text" class="form-control form-control-sm" name="biometric" id="biometric"
                                    :class="{ 'is-invalid': form.errors.has('biometric') }" v-model="form.biometric">
                                        <has-error :form="form" field="biometric"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="item_num">Complete Item No.</label>
                                    <input type="text" class="form-control form-control-sm" name="item_num" id="item_num"
                                    :class="{ 'is-invalid': form.errors.has('item_num') }" v-model="form.item_num">
                                        <has-error :form="form" field="item_num"></has-error>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-0">
                            <div class="col-md-12">
                            <button v-if="!userHasRecord" class="btn btn-success form-control" type="submit">Submit</button>
                            <button v-else class="btn btn-success form-control" type="submit">Save Changes</button>
                            
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                default_img: '/img/profile/default_userprofile.png',
                userHasRecord: false,
                empStatuses: {},
                civilStatuses: {},
                form: new Form({
                    id: '',
                    user_id: '',
                    fname: '',
                    mname: '',
                    lname: '',
                    suffix: '',
                    birth_date: '',
                    birth_place: '',
                    gender: '',
                    civil_status_id: '',
                    per_address: '',
                    phone_num: '',
                    email: '',
                    image: '',

                    employee_id: '',
                    role_type: '',
                    employment_status_id: '',
                    job_code: '',
                    date_join: '',
                    date_appoint: '',
                    work_shift: '',
                    biometric: '',
                    item_num: '',
                }),
            }
        },
        methods: {
            pickFile() {
                this.$refs.image.click()
                // document.getElementById('file').click();
            },
            getUserId() {
                axios.get('api/get-user')
                     .then(({data}) => {
                        this.form.user_id = data;
                     })
            },
            loadEmpStatus() {
                axios.get('api/employment-status')
                     .then(({data}) => {
                         (this.empStatuses = data)
                     })
            },
            loadCivilStatus() {
                axios.get('api/civil-status')
                     .then(({data}) => {
                         (this.civilStatuses = data)
                     });
            },  
            // FOR ADDING PROFILE
            userHasRecordMethod() {
                axios.get('api/userHas-record')
                     .then(({data}) => {
                        this.userHasRecord = data;
                        if (data) {
                            this.fillForm();
                        }
                     }); 
            },        
            uploadImage(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onloadend = (file) => {
                    this.form.image = reader.result;
                }
                reader.readAsDataURL(file);
            },
            setProfilePicture() {
                let photo = (this.form.image !== '') ? this.form.image : this.default_img;

                return photo;
            },
            addEmployee() {
                this.$Progress.start();
                this.form.post('api/employees')
                    .then(() => {

                        Toast.fire({
                        icon: 'success',
                        title: 'Employee added successfully'
                        });
                        this.$Progress.finish();
                        this.$router.push('/user-profile');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },
            //FOR UPDATING PROFILE
            getProfilePhotoForUpdate() {
                let photo = (this.form.image.length > 200) ? this.form.image : 'img/profile/' + this.form.image;
                return photo;
            },
            fillForm() {
                this.dataLoaded = true;
                axios.get('api/user-profile')
                     .then(({data}) => {
                         (this.form.fill(data[0]));
                         this.dataLoaded = false;
                     })
            },
            updateProfile() {
                this.$Progress.start();
                this.form.patch('api/employees/' + this.form.id)
                    .then(() => {

                        Toast.fire({
                        icon: 'success',
                        title: 'Profile updated successfully'
                        });

                        this.$Progress.finish();
                        this.$router.push('/user-profile');
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
            },            

        },
        mounted() {
            console.log('Component mounted.')
            flatpickr('#datepicker')
        },
        created() {
            this.userHasRecordMethod();
            this.loadEmpStatus();
            this.loadCivilStatus();
            this.getUserId();
        }

    }
</script>
