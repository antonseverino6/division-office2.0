<template>
    <div class="row">
            <div class="col-md-6 border-right">
                <table class="table table-borderless" v-if="hasRecord">
                    <tbody v-if="!dataLoading">
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Type of Employee</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="labelInfo">Employee Type</td>
                            <td>{{ details.type_of_employee.name }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Employee Base</td>
                            <td>{{ details.employee_base.name }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Position</td>
                            <td>{{ details.position.name }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Subject</td>
                            <td>{{ details.subject.name }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Area</td>
                            <td>{{ area }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Component</td>
                            <td>{{ component }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Grade Level</td>
                            <td>{{ grade_level }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Level of Civil Service Elegibility</td>
                            <td>{{ details.levels_of_civil.name }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Government Identification</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="labelInfo">Tin No.</td>
                            <td>{{ details.tin_num }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Pag-Ibig No.</td>
                            <td>{{ details.pag_ibig_num }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">GSIS BP No.</td>
                            <td>{{ details.gsis_bp_num }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Philhealth No.</td>
                            <td>{{ details.philhealth_num }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">LBP No.</td>
                            <td>{{ details.lbp_num }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">PRC License</td>
                            <td>{{ details.prc_license }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-borderless" v-else>
                    <tbody>
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Type of Employee</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="labelInfo">Employee Type</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Employee Base</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Position</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Subject</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Area</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Component</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Grade Level</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Level of Civil Service Elegibility</td>
                            <td></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Government Identification</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="labelInfo">Tin No.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Pag-Ibig No.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">GSIS BP No.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Philhealth No.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">LBP No.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">PRC License</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>


            <div class="col-md-6">
                <table class="table table-borderless" v-if="hasRecord">
                    <tbody>
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Other Information</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="labelInfo">Highest grade completed or degree received</td>
                            <td>{{ details.highest_grade_degree_rec }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Year received</td>
                            <td>{{ details.year_received }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Name of institution</td>
                            <td>{{ details.insitution_name }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Special Qualification</td>
                            <td>{{ details.spec_qualification }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Previous Experience</td>
                            <td>{{ details.previous_experience }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Spouse Information</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="labelInfo">Name</td>
                            <td>{{ details.spouse_name }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Occupation</td>
                            <td>{{ details.spouse_occ }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Address</td>
                            <td>{{ details.spouse_add }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Phone Number</td>
                            <td>{{ details.spouse_phone }}</td>
                        </tr>
                        
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Contact in case of emergency</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="labelInfo">Name</td>
                            <td>{{ details.emergency_name }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Relationship</td>
                            <td>{{ details.emergency_relationship }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Address</td>
                            <td>{{ details.emergency_address }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Phone Number</td>
                            <td>{{ '+63' + details.emergency_phone }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-borderless" v-else>
                    <tbody>
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Other Information</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="labelInfo">Highest grade completed or degree received</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Year received</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Name of institution</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Special Qualification</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Previous Experience</td>
                            <td></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Spouse Information</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="labelInfo">Name</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Occupation</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Address</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Phone Number</td>
                            <td></td>
                        </tr>
                        
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Contact in case of emergency</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="labelInfo">Name</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Relationship</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Address</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Phone Number</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>   

    </div>     
</template>

user-more-details

<script>
import { isNull } from 'util';
export default {
    data() {
        return {
            details: {},
            dataLoading: true,
            hasRecord: false,
            area: '',
            component: '',
            grade_level: '',
        }
    },
    methods: {
        getDetails() {
            this.dataLoading = true;
            axios.get('api/user-more-details')
                 .then(({data}) => {
                    this.dataLoading = false;
                    this.details = data[0];

                    if (!isNull(this.details.area)) {
                        this.area = this.details.area.name;
                    }

                    if (!isNull(this.details.component)) {
                        this.component = this.details.component.name;
                    }

                    if (!isNull(this.details.grade_level)) {
                        this.grade_level = this.details.grade_level.name;
                    }

                    console.log(this.area);
                    console.log(this.component);
                 })
        },
        userHasRecordMethod() {
            axios.get('api/userHas-MoreRecord')
                 .then(({data}) => {
                    this.hasRecord = data;

                    if (data == true) {
                        this.getDetails();
                    }
                 })
        },
    },
    created() {
        this.userHasRecordMethod();
    }
}
</script>