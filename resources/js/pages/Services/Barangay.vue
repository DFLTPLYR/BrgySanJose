<script setup>
import { router, useForm } from '@inertiajs/vue3';

const form = useForm({
    lastName: null,
    firstName: null,
    middleName: null,
    provincialAddress: null,
    yearsInTagaytay: null,
    presentAddress: null,
    contactNumber: null,
    civilStatus: null,
    citizenship: null,
    birthdate: null,
    birthplace: null,
    age: null,
    occupation: null,
    companyName: null,
    spouseName: null,
    spouseOccupation: null,
    fatherName: null,
    fatherOccupation: null,
    motherName: null,
    motherOccupation: null,
    personalAppearance: false,
    validId: null,
    email: null,
});

function submitForm() {
    form.post(route('barangay-clearance-form'), { preserveScroll: true, errorBag: 'barangayClearanceErrorForm' });
}

function handleFileUpload(event) {
    const file = event.target.files[0]
    form.validId = file
}

const submit = () => {
    router.post(route('test'));
};

</script>

<template>


    <button @click="submit">
        Submit Application
    </button>


    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex flex-col my-4 relative">
        <img src="/images/logo/logomain.png" alt="Barangay Logo" class="w-40 h-40 object-contain mx-auto mb-4" />
        <ReturnHomeButton />
        <div class="text-[#0D98BA] flex items-center justify-center text-2xl font-bold mb-4">
            Barangay Clearance
        </div>
        <div>
            <p class="text-gray-600 mb-6 justify-center flex items-center">
                Please fill out the form below to apply for a Barangay Clearance.
            </p>
        </div>

        <form @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-6">
            <div class="bg-white shadow-md rounded-lg p-6 space-y-6">
                <!-- Name Section -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">Name</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-1">Last Name
                                <span v-if="form.errors.lastName">{{ form.errors.lastName }}</span>
                            </label>
                            <input v-model="form.lastName" type="text"
                                class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">First Name</label>
                            <input v-model="form.firstName" type="text"
                                class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1">Middle Name</label>
                            <input v-model="form.middleName" type="text"
                                class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                        </div>
                    </div>
                </div>

                <!-- Provincial Address -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">Provincial Address</h2>
                    <input v-model="form.provincialAddress" type="text"
                        class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                </div>

                <!-- No. of years in Tagaytay -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">No. of Years in Tagaytay</h2>
                    <input v-model="form.yearsInTagaytay" type="number" min="0"
                        class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                </div>

                <!-- Present Address -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">Present Address</h2>
                    <input v-model="form.presentAddress" type="text"
                        class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                </div>

                <!-- Contact Number -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">Contact Number</h2>
                    <input v-model="form.contactNumber" type="text"
                        class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                </div>

                <!-- Civil Status & Citizenship -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Civil Status</h2>
                        <input v-model="form.civilStatus" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Citizenship</h2>
                        <input v-model="form.citizenship" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Birthdate, Birthplace, Age -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Birthdate</h2>
                        <input v-model="form.birthdate" type="date"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Birthplace</h2>
                        <input v-model="form.birthplace" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Age</h2>
                        <input v-model="form.age" type="number" min="0"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Occupation & Company -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Occupation</h2>
                        <input v-model="form.occupation" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Name of Company</h2>
                        <input v-model="form.companyName" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Spouse -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Name of Spouse</h2>
                        <input v-model="form.spouseName" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Spouse Occupation</h2>
                        <input v-model="form.spouseOccupation" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Father -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Father's Name</h2>
                        <input v-model="form.fatherName" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Father's Occupation</h2>
                        <input v-model="form.fatherOccupation" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Mother -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Mother's Name</h2>
                        <input v-model="form.motherName" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Mother's Occupation</h2>
                        <input v-model="form.motherOccupation" type="text"
                            class="w-full border border-[#0D98BA] rounded px-3 py-2" required />
                    </div>
                </div>

                <!-- Requirements -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2">
                            <input type="checkbox" v-model="form.personalAppearance" class="mr-2" />
                            Personal Appearance

                        </label>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-semibold">
                            <span class="text-base text-white bg-[#0D98BA] px-3 py-1 rounded-lg">Valid ID (Upload a
                                file)</span>

                            <input type="file" accept=".jpg,.jpeg,.png,.pdf" @change="handleFileUpload"
                                class="block w-full mt-2 border-2 border-[#0D98BA] rounded px-3 py-2 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0D98BA] cursor-pointer" />
                        </label>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">
                            Email Address
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

        <div class="my-8">
            <p class="text-gray-600 text-sm text-center">
                Note: Ensure all requirements are met before submitting.
            </p>
            <p class="text-gray-600 text-sm text-center">
                For any issues, please contact the Barangay Office.
            </p>
        </div>
    </div>
</template>
