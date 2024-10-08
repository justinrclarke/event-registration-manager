<script setup lang="ts">
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({ registrant: Object });

const form = reactive({
    first_name: null,
    last_name: null,
    company_name: null,
    company_email: null,
    company_phone: null,
    checked_in: null,
    walk_in: null
})

function submit() {
    router.post('/registrations', form);
}
</script>
<template>
    <AppLayout title="Registrations">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ registrant?.id ? 'Edit' : 'Create'}} Registration
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <form @submit.prevent="submit">
                        <label class="block" for="first_name">First Name:</label>
                        <input class="block" id="first_name" v-model="form.first_name" required />

                        <label class="block mt-10" for="last_name">Last Name:</label>
                        <input class="block" id="last_name" v-model="form.last_name" required />

                        <label class="block mt-10" for="company_name">Company Name:</label>
                        <input class="block" id="company_name" v-model="form.company_name" required />

                        <label class="block mt-10" for="company_email">Company Email:</label>
                        <input class="block" id="company_email" v-model="form.company_email" required />

                        <label class="block mt-10" for="company_phone">Company Phone</label>
                        <input class="block" id="company_phone" v-model="form.company_phone" required />

                        <div class="flex flex-row items-center justify-start mt-10">
                            <label class="" for="checked_in">Checked In</label>
                            <input class="" id="checked_in" type="checkbox" v-model="form.checked_in" />
                        </div>

                        <div class="flex flex-row items-center justify-normal mt-5">
                            <label class="" for="walk_in">Walk In</label>
                            <input class="" id="walk_in" type="checkbox" v-model="form.walk_in" />
                        </div>

                        <input class="block mt-10" type="submit" name="submit" value="Submit" />
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
