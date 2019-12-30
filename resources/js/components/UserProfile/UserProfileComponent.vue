<template>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                        <div class="row mb-4" v-if="!dataLoaded">
                            <div class="col-md-1"></div>
                            <div class="col-md-3 text-right">
                                <img :src="getImage()" style="border: 1px solid #000;" width="200" height="200" alt="">
                            </div>
                            <div class="col-md-8 pl-0 mt-3">

                                <ul>
                                    <li><h4><strong>{{ fullName }}</strong></h4></li>
                                    <li>{{ profileDetails.representative.name }}</li>
                                    <li>Employee ID: <strong>{{ profileDetails.employee_id }}</strong></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="official-details-tab" data-toggle="tab" href="#official-details" role="tab" aria-controls="official-details" aria-selected="true">Official Details</a>                                                
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="more-details-tab" data-toggle="tab" href="#more-details" role="tab" aria-controls="more-details" aria-selected="true">More Details</a>
                                            </li>
                                        </ul> 
                                    </div>

                                    <div class="tab-content">
                                        <div class="card-body tab-pane active" id="official-details" aria-labelledby="official-details-tab">
                                            <div class="row">
                                                <div class="col-md-12 text-right pr-4">
                                                    <a href="#" @click="editProfile">
                                                    <i class="far fa-edit" style="color: green; font-size: 20px;"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div v-if="!dataLoaded">
                                                <official-details v-bind:profileDetails="profileDetails"></official-details>
                                            </div>
                                        </div>
                                        <div class="card-body tab-pane" id="more-details" aria-labelledby="more-details-tab">
                                            <div class="row">
                                                <div class="col-md-12 text-right pr-4">
                                                    <a href="#" @click="editMoreDetails">
                                                    <i class="far fa-edit" style="color: green; font-size: 20px;"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <more-details></more-details>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    ul {
        list-style-type: none;
        /* margin-left: 0%; */
        padding-left: 5%;
    }
    .labelInfo {
        color: #7785a0;
    }
</style>


<script>
    import OfficialDetails from './OfficialDetailsComponent.vue'
    import MoreDetails from './MoreDetailsComponent.vue'
    import { isNull } from 'util';
    export default {
        components: {
            OfficialDetails,
            MoreDetails,
        },
        data() {
            return {
                // editMode: false,
                hasRecord: false,
                default_img: 'img/profile/default_userprofile.png',
                userId: '',
                dataLoaded: true,
                empStatuses: {},
                profileDetails: {},
                civilStatuses: {},
                fullName: '',
            }
        },
        methods: {
            pickFile() {
                this.$refs.image.click()
                // document.getElementById('file').click();
            },
            userHasRecord() {
                axios.get('api/userHas-record')
                     .then(({data}) => {
                         (this.hasRecord = data)
                         if (data == false) {
                            this.$router.push('/save-profile');
                         }
                         this.loadProfile();
                     }); 
            },
            loadUser() {
                axios.get('api/get-user')
                     .then(({data}) => {
                         (this.userId = data);
                     })
            },
            loadProfile() {
                this.dataLoaded = true;
                axios.get('api/user-profile')
                     .then(({data}) => {
                         (this.profileDetails = data[0]);
                         this.dataLoaded = false;
                         this.getfullName();
                     })
            },
            getImage() {
                return '/img/profile/' + this.profileDetails.image;
            },
            editProfile() {
                this.$router.push('/save-profile');
            },
            editMoreDetails() {
                this.$router.push('/save-more-details');
            },
            getfullName() {
                this.fullName = this.profileDetails.fname + " " + this.profileDetails.mname + " " + this.profileDetails.lname;
                if (isNull(this.profileDetails.mname) && isNull(this.profileDetails.suffix)) {
                    this.fullName = this.profileDetails.fname + " " + this.profileDetails.lname;
                } else if (isNull(this.profileDetails.mname)) {
                    this.fullName = this.profileDetails.fname + " " + this.profileDetails.lname + " " + this.profileDetails.suffix;
                } else if (!isNull(this.profileDetails.suffix)) {
                    this.fullName = this.fullName + " " + this.profileDetails.suffix;
                } else {
                    this.fullName;
                }
                
            }
        },
        mounted() {
            console.log('Component mounted.')
            flatpickr('#datepicker')
        },
        created() {
            this.userHasRecord();
            this.loadUser();
        }
    }
</script>
