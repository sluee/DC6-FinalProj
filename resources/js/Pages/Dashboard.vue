<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue'
import {inject, computed} from 'vue'
import { Calendar } from 'v-calendar'
const themeMode = inject('themeMode')
const props = defineProps({
    user:Number,
    payroll:Number,
    cashAdvance:Object
})

const attributes = computed(() => {
    if (!props.cashAdvance.data) {
        return [];
    }

        return props.cashAdvance.data.map(cashAdvance => ({
        key: `cashAdvance-${cashAdvance.id}`,
        dates: cashAdvance.requestDate,
        employee: cashAdvance.employee.user.firstName + ' ' + cashAdvance.employee.user.lastName,
        highlight: 'green',
        popover: {
            label: cashAdvance.employee.user.firstName+' '+cashAdvance.employee.user.lastName+' cash advance amount ₱ '+cashAdvance.amount, // Use a different name for the amount  
            hideIndicator: true
        },
        order: 0
    }));

});
</script>

<template>
    <Head title="Dashboard" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
             
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="container  mx-auto grid">
                    <div class="grid  mb-8 md:grid-cols-2 xl:grid-cols-2"  >
                    <!-- Cards -->
                    <Card :class="themeMode">
                        <template #content>
                            <div class="flex items-center p-4  rounded-lg shadow-xs " >
                                <div class="p-3 mr-4 text-green-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-green-500">
                                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                                  </svg>
                                </div>
                                <div>
                                  <p class="mb-2 text-lg font-medium text-black ">
                                   Users
                                  </p>
                                  <p class="text-xl font-semibold text-black">
                                    {{ user }}
                                  </p>
                                </div>
                              </div>
                        </template>
                     </Card>
                    
                    <Card>
                        <template #content>
                            <div class="flex items-center p-4  rounded-lg shadow-xs">
                                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                  </svg>
                                </div>
                                <div>
                                  <p class="mb-2 text-lg font-medium text-black">
                                      No of Payrolls
                                  </p>
                                  <p class="text-xl font-semibold text-black">
                                   {{ payroll }}
                                  </p>
                                </div>
                              </div>
                        </template>        
                    </Card>    
                      
                </div>
            </div>
        </div> 
        <div class="mx-5 mt-5">
            <Calendar :attributes="attributes" />
        </div>
               
    </div>
       
    </SideBarLayout>
</template>
