<template>
    <div class="row">
            <div class="col-md-6 border-right">
                <table class="table table-borderless">
                    <tbody>
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Basic Information</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">First Name</td>
                            <td>{{ profileDetails.fname }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Middle Name</td>
                            <td>{{ profileDetails.mname }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Last Name</td>
                            <td>{{ profileDetails.lname }}</td>
                        </tr> 
                        <tr>
                            <td class="labelInfo">Suffix</td>
                            <td>{{ profileDetails.suffix }}</td>
                        </tr> 
                        <tr>
                            <td class="labelInfo">Birth Date</td>
                            <td>{{ profileDetails.birth_date | myDate }}</td>
                        </tr> 
                        <tr>
                            <td class="labelInfo">Birth Place</td>
                            <td>{{ profileDetails.birth_place }}</td>
                        </tr> 
                        <tr>
                            <td class="labelInfo">Gender</td>
                            <td>{{ profileDetails.gender }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Civil Status</td>
                            <td>{{ profileDetails.civil_status.name }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Contact Information</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Permanent Address</td>
                            <td>{{ profileDetails.per_address }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Phone Number</td>
                            <td>{{ '+63' + profileDetails.phone_num }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Email Address</td>
                            <td>{{ profileDetails.email }}</td>
                        </tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <table class="table table-borderless">
                    <tbody>
                        <tr style="border-bottom: 1px solid #90949c;">
                            <th class="labelInfo">Employment Information</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Employee ID</td>
                            <td>{{ profileDetails.employee_id }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Role Type</td>
                            <td>{{ profileDetails.role_type }}</td>
                        </tr> 
                        <tr>
                            <td class="labelInfo">Employment Status</td>
                            <td>{{ profileDetails.employment_status.name }}</td>
                        </tr> 
                        <tr>
                            <td class="labelInfo">Job Title Code</td>
                            <td>{{ profileDetails.job_code }}</td>
                        </tr> 
                        <tr>
                            <td class="labelInfo">Date of Joining</td>
                            <td>{{ profileDetails.date_join | myDate }}</td>
                        </tr> 
                        <tr>
                            <td class="labelInfo">Date of Original Appointment</td>
                            <td>{{ profileDetails.date_appoint | myDate }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Work Shift</td>
                            <td>{{ profileDetails.work_shift }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Biometric ID/RFID</td>
                            <td>{{ profileDetails.biometric }}</td>
                        </tr>
                        <tr>
                            <td class="labelInfo">Complete Item Number</td>
                            <td>{{ profileDetails.item_num }}</td>
                        </tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                    </tbody>
                </table>
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
        color: #90949c;
    }
</style>

<script>
export default {
    props: ['profileDetails'],
}
</script>