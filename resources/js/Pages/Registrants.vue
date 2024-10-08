<script setup>
import { Link } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';
import { BiCheckCircleFill } from "oh-vue-icons/icons";

defineProps({ registrants: Array })
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
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
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
                    <button class="mt-10 float-end uppercase bg-blue-500 p-2 rounded text-white font-bold">Import Registrations</button>
                    <Link class="mt-10 mr-10 float-end uppercase bg-blue-950 p-2 rounded text-white font-bold" :href="route('registrations.create')">Register Walk In</Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
