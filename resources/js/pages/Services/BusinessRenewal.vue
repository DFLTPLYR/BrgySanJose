<script setup>
import ReturnHomeButton from '@/components/ReturnHomeButton.vue';
import { router, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { onMounted } from 'vue'
import { Head } from '@inertiajs/vue3';
const props = defineProps({
    clearanceForm: {
        type: Object,
        required: false
    }
});

onMounted(() => {
    if (props.clearanceForm) {
        form.defaults(props.clearanceForm);
        Object.assign(form, props.clearanceForm);
    }
});
const form = useForm({
    id: null,
    lastName: '',
    firstName: '',
    middleName: '',
    provincialAddress: '',
    yearsInTagaytay: '',
    presentAddress: '',
    contactNumber: '',
    civilStatus: '',
    citizenship: '',
    birthdate: '',
    birthplace: '',
    age: '',
    occupation: '',
    companyName: '',
    spouseName: '',
    spouseOccupation: '',
    fatherName: '',
    fatherOccupation: '',
    motherName: '',
    motherOccupation: '',
    latestPhoto: null,  // added for file
    priorYear: null,
    financialState: null,      // added for file
    email: '',
})

function handleFileUpload(event, key) {
    const file = event.target.files[0]
    form[key] = file
}

function submitForm() {
    form.post(route('submit-business-clearance-renewal'), {
        preserveScroll: true, errorBag: 'BusinessRenewalErrorForm',
        onError: e => console.log(e),
        onSuccess: () => {
            form.reset(), Swal.fire({
                title: 'Do you want to register again?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Yes',
                denyButtonText: 'No',
                customClass: {
                    actions: 'my-actions',
                    cancelButton: 'order-1 right-gap',
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Sent!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Thank you!', '', 'info')
                    router.visit(route('home'))
                }
            })
        }
    });
}
</script>


<template>

    <Head title="Business Renewal" />
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex flex-col my-4 relative">
        <img src="/images/logo/logomain.png" alt="Barangay Logo" class="w-40 h-40 object-contain mx-auto mb-4" />
        <ReturnHomeButton />
        <div class="text-[#0D98BA] flex items-center justify-center text-2xl font-bold mb-4">
            Business Clearance Renwal
        </div>
        <div>
            <p class="text-gray-600 mb-6 justify-center flex items-center">
                Please fill out the form below to apply for a Business Clearance Renwal.
            </p>
        </div>

        <form @submit.prevent="submitForm" class="space-y-6">
            <div class="bg-white shadow-md rounded-lg p-6 space-y-6">
                <!-- Name Section -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">Name <span class="text-xs text-red-400">
                            *
                        </span></h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-1">Last Name <span class="text-xs text-red-400">
                                    *
                                </span>
                                <span class="text-red-600 text-xs" v-if="form.errors.lastName">{{ form.errors.lastName
                                }}</span></label>
                            <input v-model="form.lastName" type="text"
                                class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">First Name <span class="text-xs text-red-400">
                                    *
                                </span>
                                <span class="text-red-600 text-xs" v-if="form.errors.firstName">{{ form.errors.firstName
                                }}</span></label>
                            <input v-model="form.firstName" type="text"
                                class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Middle Name
                                <span class="text-red-600 text-xs" v-if="form.errors.middleName">{{
                                    form.errors.middleName
                                }}</span></label>
                            <input v-model="form.middleName" type="text"
                                class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                        </div>
                    </div>
                </div>

                <!-- Provincial Address -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">Provincial Address <span class="text-xs text-red-400">
                            *
                        </span>
                        <span class="text-red-600 text-xs" v-if="form.errors.provincialAddress">{{
                            form.errors.provincialAddress
                        }}</span>
                    </h2>
                    <input v-model="form.provincialAddress" type="text"
                        class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                </div>

                <!-- No. of years in Tagaytay -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">No. of Years in Tagaytay <span class="text-xs text-red-400">
                            *
                        </span>
                        <span class="text-red-600 text-xs" v-if="form.errors.yearsInTagaytay">{{
                            form.errors.yearsInTagaytay
                        }}</span>
                    </h2>
                    <input v-model="form.yearsInTagaytay" type="number" min="0"
                        class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                </div>

                <!-- Present Address -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">Present Address <span class="text-xs text-red-400">
                            *
                        </span>
                        <span class="text-red-600 text-xs" v-if="form.errors.presentAddress">{{
                            form.errors.presentAddress
                        }}</span>
                    </h2>
                    <input v-model="form.presentAddress" type="text"
                        class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                </div>

                <!-- Contact Number -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">Contact Number <span class="text-xs text-red-400">
                            *
                        </span>
                        <span class="text-red-600 text-xs" v-if="form.errors.contactNumber">{{ form.errors.contactNumber
                        }}</span>
                    </h2>
                    <input v-model="form.contactNumber" type="text"
                        class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                </div>

                <!-- Civil Status & Citizenship -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">
                            Civil Status
                            <span class="text-xs text-red-400">*</span>
                        </h2>
                        <select v-model="form.civilStatus" class="w-full border border-[#0D98BA] rounded px-3 py-2"
                            required>
                            <option value="" disabled>Select status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Citizenship <span class="text-xs text-red-400">
                                *
                            </span>
                            <span class="text-red-600 text-xs" v-if="form.errors.citizenship">{{ form.errors.citizenship
                            }}</span>
                        </h2>
                        <input v-model="form.citizenship" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Birthdate, Birthplace, Age -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Birthdate <span class="text-xs text-red-400">
                                *
                            </span>
                            <span class="text-red-600 text-xs" v-if="form.errors.birthdate">{{ form.errors.birthdate
                            }}</span>
                        </h2>
                        <input v-model="form.birthdate" type="date"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Birthplace <<span class="text-xs text-red-400">
                                *
                                </span>
                                <span class="text-red-600 text-xs" v-if="form.errors.birthplace">{{
                                    form.errors.birthplace
                                }}</span></h2>
                        <input v-model="form.birthplace" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Age <span class="text-xs text-red-400">
                                *
                            </span>
                            <span class="text-red-600 text-xs" v-if="form.errors.age">{{ form.errors.age
                            }}</span>
                        </h2>
                        <input v-model="form.age" type="number" min="0"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!--  * & Company -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Occupation <span class="text-xs text-red-400">
                                *
                            </span>
                            <span class="text-red-600 text-xs" v-if="form.errors.occupation">{{ form.errors.occupation
                            }}</span>
                        </h2>
                        <input v-model="form.occupation" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Name of Company<span class="text-xs text-red-400">
                                *
                            </span>
                            <span class="text-red-600 text-xs" v-if="form.errors.companyName">{{ form.errors.lastName
                            }}</span>
                        </h2>
                        <input v-model="form.companyName" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Spouse -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Name of Spouse <span class="text-xs text-red-400">
                                *
                            </span>
                            <span class="text-red-600 text-xs" v-if="form.errors.spouseName">{{ form.errors.spouseName
                            }}</span>
                        </h2>
                        <input v-model="form.spouseName" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Spouse Occupation <<span class="text-xs text-red-400">
                                *
                                </span>
                                <span class="text-red-600 text-xs" v-if="form.errors.spouseOccupation">{{
                                    form.errors.spouseOccupation
                                }}</span></h2>
                        <input v-model="form.spouseOccupation" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Father -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Father's Name <span class="text-xs text-red-400">
                                *
                            </span>
                            <span class="text-red-600 text-xs" v-if="form.errors.fatherName">{{ form.errors.fatherName
                            }}</span>
                        </h2>
                        <input v-model="form.fatherName" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Father's Occupation <span class="text-xs text-red-400">
                                *
                            </span>
                            <span class="text-red-600 text-xs" v-if="form.errors.fatherOccupation">{{
                                form.errors.fatherOccupation
                            }}</span>
                        </h2>
                        <input v-model="form.fatherOccupation" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Mother -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Mother's Name <<span class="text-xs text-red-400">
                                *
                                </span>
                                <span class="text-red-600 text-xs" v-if="form.errors.motherName">{{
                                    form.errors.motherName
                                }}</span></h2>
                        <input v-model="form.motherName" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Mother's Occupation <span class="text-xs text-red-400">
                                *
                            </span>
                            <span class="text-red-600 text-xs" v-if="form.errors.motherOccupation">{{
                                form.errors.motherOccupation
                            }}</span>
                        </h2>
                        <input v-model="form.motherOccupation" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Requirements -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2 font-semibold">
                            <span class="text-base text-white bg-[#0D98BA] px-3 py-1 rounded-lg">2x2 Latest Picture
                                <span class="text-xs text-red-400">
                                    *
                                </span>
                                <span class="text-red-600 text-xs" v-if="form.errors.latestPhoto">{{
                                    form.errors.latestPhoto
                                }}</span></span>

                            <input type="file" accept=".jpg,.jpeg,.png,.pdf"
                                @change="(e) => handleFileUpload(e, 'latestPhoto')"
                                class="block w-full mt-2 border-2 border-[#0D98BA] rounded px-3 py-2 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0D98BA] cursor-pointer" />
                            <label class="block text-gray-700 mb-2 font-semibold mt-2">
                                <span class="text-base text-white bg-[#0D98BA] px-3 py-1 rounded-lg">Prior Years
                                    Business Clearance /Permit
                                    <span class="text-xs text-red-400">
                                        *
                                    </span>
                                    <span class="text-red-600 text-xs" v-if="form.errors.priorYear
                                    ">{{ form.errors.priorYear

                                    }}</span>

                                </span>
                                <input type="file" accept=".jpg,.jpeg,.png,.pdf"
                                    @change="(e) => handleFileUpload(e, 'priorYear')"
                                    class="block w-full mt-2 border-2 border-[#0D98BA] rounded px-3 py-2 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0D98BA] cursor-pointer" />
                                <label class="block text-gray-700 mb-2 font-semibold mt-2">
                                    <span class="text-base text-white bg-[#0D98BA] px-3 py-1 rounded-lg">Financial
                                        Statement /ITR/Certification of Registration (BIR) <span
                                            class="text-xs text-red-400">
                                            *
                                        </span>
                                        <span class="text-red-600 text-xs" v-if="form.errors.financialState">{{
                                            form.errors.financialState
                                        }}</span></span>
                                    <input type="file" accept=".jpg,.jpeg,.png,.pdf"
                                        @change="(e) => handleFileUpload(e, 'financialState')"
                                        class="block w-full mt-2 border-2 border-[#0D98BA] rounded px-3 py-2 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0D98BA] cursor-pointer" />


                                </label>
                            </label>
                        </label>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-bold
                ">
                            Email Address <span class="text-xs text-red-400">
                                *
                            </span>
                            <span class="text-red-600 text-xs" v-if="form.errors.email">{{ form.errors.email
                            }}</span>
                            <input type="email" v-model="form.email"
                                class="w-full border border-[#0D98BA] rounded px-3 py-2 mt-2"
                                placeholder="Enter your email" required />
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="bg-[#0D98BA] text-white px-4 py-2 rounded hover:bg-[#0A7A9C] flex item-center justify-center ease-in-out duration-300 w-full">
                        Submit
                    </button>
                </div>
            </div>
        </form>

        <div class="my-8 ">
            <p class="text-gray-600 text-sm item-center flex justify-center">
                Note: Ensure all requirements are met before submitting.
            </p>
            <p class="text-gray-600 text-sm item-center flex justify-center">
                For any issues, please contact the Barangay Office.
            </p>
        </div>
    </div>
</template>
