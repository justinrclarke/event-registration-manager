<script setup>
defineProps({ registrant: Array, qrcode: String })
</script>
<template>
    <div class="w-[90mm] h-[29mm] p-2 text-center flex flex-row items-center">
        <div class="">
            <img v-bind:src="qrcode" class="w-[100px]"/>
        </div>
        <div class="flex flex-col flex-1">
            <p class="uppercase font-bold">{{ registrant.first_name }} {{ registrant.last_name}}</p>
            <p class="uppercase">{{ registrant.company_name }}</p>
        </div>
    </div>
</template>
