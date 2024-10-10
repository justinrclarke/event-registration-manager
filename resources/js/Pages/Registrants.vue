<script setup>
import { ref } from "vue";
import { Link, useForm, router } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({ registrants: Array })

const showUploadForm = ref(false);

const form = useForm({
    registrants: null,
})

/**
 * @return null
 */
function submit() {
    let formData = new FormData();

    // Assuming form.registrants contains the single file
    formData.append('file', form.registrants);  // Append the single file

    // Add any other form fields if needed
    axios.post(route('registrations.file-upload'), formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then(response => {
        window.location.href = route('registrations.index');
    }).catch(error => {
        console.error(error.response.data);
    });
}


/**
 * Sets the showUploadForm variable to true.
 *
 * @return null
 */
function displayUploadForm() {
    showUploadForm.value = true;
}
</script>

<template>
    <AppLayout title="Registrations">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Registrations
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="showUploadForm" class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mb-10">
                    <h3 class="uppercase font-bold mb-4">Upload Registrations</h3>
                    <form @submit.prevent="submit">
                        <input type="file" @input="form.registrants = $event.target.files[0]" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
                        <button class="block mt-4" type="submit">Submit</button>
                    </form>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <button @click="displayUploadForm" class="mb-10 float-end uppercase bg-blue-500 p-2 rounded text-white font-bold">Import Registrations</button>
                    <Link class="mb-10 mr-10 float-end uppercase bg-blue-950 p-2 rounded text-white font-bold" :href="route('registrations.create')">Register Walk In</Link>
                    <div class="table w-full border-spacing-y-4">
                        <div class="table-header-group">
                            <div class="table-row">
                                <div class="table-cell uppercase font-bold">First Name</div>
                                <div class="table-cell uppercase font-bold">Last Name</div>
                                <div class="table-cell uppercase font-bold">Company Name</div>
                                <div class="table-cell uppercase font-bold">Company Email</div>
                                <div class="table-cell uppercase font-bold">Company Phone</div>
                                <div class="table-cell uppercase font-bold">Checked In</div>
                                <div class="table-cell uppercase font-bold">Walk In</div>
                                <div class="table-cell"></div>
                            </div>
                        </div>
                        <div class="table-row-group">
                            <div class="table-row" v-for="registrant in registrants">
                                <div class="table-cell">{{ registrant.first_name }}</div>
                                <div class="table-cell">{{ registrant.last_name }}</div>
                                <div class="table-cell">{{ registrant.company_name }}</div>
                                <div class="table-cell">{{ registrant.company_email }}</div>
                                <div class="table-cell">{{ registrant.company_phone }}</div>
                                <div class="table-cell">{{ registrant.checked_in ? "Yes" : "No" }} </div>
                                <div class="table-cell">{{ registrant.walk_in ? "Yes" : "No" }} </div>
                                <div class="table-cell uppercase font-bold text-red-500"><Link :href="route('registrations.show', registrant)">Print</Link></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
