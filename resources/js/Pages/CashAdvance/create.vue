<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue'
    import {Head, useForm} from '@inertiajs/vue3'
    import {inject} from 'vue'
    const themeMode = inject('themeMode')
    const form = useForm({
        emp_id: '',
        requestDate:'',
        amount:'',
        reason:''
        // status: '',

    })
    const props = defineProps({
    cashAdvance: Object,
    employee: Object,

});

function submit() {
        form.post('/cashAdvance/')
    }
</script>

<template>
    <Head title="Cash Advance" />

    <SideBarLayout>
        <template #header >
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl  leading-tight">Create Cash Advance</h2>
                <!-- <div style="position:relative">
                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-9 p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search customer here" @keydown.enter="search($event)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#444  " width="20px" height="20px" viewBox="0 0 16 16"
                    style="position:absolute; top:10px; right:10px">
                    <path d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z" fill-rule="evenodd"/>
                    </svg>
                </div>
                <div class="flex">
                    <Link class="button1 mb-2 py-2 px-3 bg-blue-300 shadow border-gray-300 border hover:bg-blue-400 rounded mr-3" as="button" href="/customers/create">Create Customer</Link>
                    <a href="/customers/pdf" class="flex  mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3 " target="blank">
                        <svg viewBox="0 0 512 512" version="1.1" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#6666"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>pdf-document</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="add" fill="#000000" transform="translate(85.333333, 42.666667)"> <path d="M75.9466667,285.653333 C63.8764997,278.292415 49.6246897,275.351565 35.6266667,277.333333 L1.42108547e-14,277.333333 L1.42108547e-14,405.333333 L28.3733333,405.333333 L28.3733333,356.48 L40.5333333,356.48 C53.1304778,357.774244 65.7885986,354.68506 76.3733333,347.733333 C85.3576891,340.027178 90.3112817,328.626053 89.8133333,316.8 C90.4784904,304.790173 85.3164923,293.195531 75.9466667,285.653333 L75.9466667,285.653333 Z M53.12,332.373333 C47.7608867,334.732281 41.8687051,335.616108 36.0533333,334.933333 L27.7333333,334.933333 L27.7333333,298.666667 L36.0533333,298.666667 C42.094796,298.02451 48.1897668,299.213772 53.5466667,302.08 C58.5355805,305.554646 61.3626692,311.370371 61.0133333,317.44 C61.6596233,323.558965 58.5400493,329.460862 53.12,332.373333 L53.12,332.373333 Z M150.826667,277.333333 L115.413333,277.333333 L115.413333,405.333333 L149.333333,405.333333 C166.620091,407.02483 184.027709,403.691457 199.466667,395.733333 C216.454713,383.072462 225.530463,362.408923 223.36,341.333333 C224.631644,323.277677 218.198313,305.527884 205.653333,292.48 C190.157107,280.265923 170.395302,274.806436 150.826667,277.333333 L150.826667,277.333333 Z M178.986667,376.32 C170.098963,381.315719 159.922142,383.54422 149.76,382.72 L144.213333,382.72 L144.213333,299.946667 L149.333333,299.946667 C167.253333,299.946667 174.293333,301.653333 181.333333,308.053333 C189.877212,316.948755 194.28973,329.025119 193.493333,341.333333 C194.590843,354.653818 189.18793,367.684372 178.986667,376.32 L178.986667,376.32 Z M254.506667,405.333333 L283.306667,405.333333 L283.306667,351.786667 L341.333333,351.786667 L341.333333,329.173333 L283.306667,329.173333 L283.306667,299.946667 L341.333333,299.946667 L341.333333,277.333333 L254.506667,277.333333 L254.506667,405.333333 L254.506667,405.333333 Z M234.666667,7.10542736e-15 L9.52127266e-13,7.10542736e-15 L9.52127266e-13,234.666667 L42.6666667,234.666667 L42.6666667,192 L42.6666667,169.6 L42.6666667,42.6666667 L216.96,42.6666667 L298.666667,124.373333 L298.666667,169.6 L298.666667,192 L298.666667,234.666667 L341.333333,234.666667 L341.333333,106.666667 L234.666667,7.10542736e-15 L234.666667,7.10542736e-15 Z" id="document-pdf"> </path> </g> </g> </g></svg>
                            Export
                    </a>
                </div> -->
            </div>
        </template>
        <div class="py-12">
            <div class="flex flex-col justify-center items-center">
                <div class="relative flex flex-col items-center rounded-[20px] w-[500px] max-w-[95%] mx-auto bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800  p-3" :class="themeMode">
                    <div class="mt-2 mb-8 w-full">
                        <form @submit.prevent="submit" class="flex">
                            <div class="flex-1 pr-4">
                                <h4 class="px-2 text-xl font-bold text-navy-700 dark:text-black">
                                    Cash Advance Details
                                </h4>
                                <div class="px-5 py-5">
                                    <label class="font-semibold text-sm text-gray-600  block" for="emp_id">Employee Name</label>
                                    <select name="" id="emp_id" v-model="form.emp_id" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 ">
                                        <option value="" disabled>Select a Employee</option>
                                        <option v-for="emp in employee" :value="emp.id" :key="emp.id" >{{ emp.user.firstName }} {{ emp.user.lastName }}</option>
                                    </select>
                                    <div class="text-red-600" v-if="form.errors.emp_id">{{ form.errors.emp_id }}</div>

                                    <label class="font-semibold text-sm text-gray-600  block" for="requestDate">Request Date</label>
                                    <input type="date" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600 " v-model="form.requestDate" />
                                    <div class="text-red-600" v-if="form.errors.requestDate">{{ form.errors.requestDate }}</div>


                                    <label class="font-semibold text-sm text-gray-600 block" for="amount">Amount</label>
                                    <input type="number" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600"
                                      v-model="form.amount"  />

                                    <div class="text-red-600" v-if="form.errors.reason">{{ form.errors.reason }}</div>
                                    <label class="font-semibold text-sm text-gray-600 block" for="reason">reason</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600"
                                      v-model="form.reason"  />
                                    <div class="text-red-600" v-if="form.errors.reason">{{ form.errors.reason }}</div>

                                    <!-- <label class="font-semibold text-sm text-gray-600 block" for="status">Remarks</label>
                                    <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full text-gray-600"
                                      v-model="form.status" />
                                    <div class="text-red-600" v-if="form.errors.status">{{ form.errors.status }}</div> -->



                                    <button class="px-4 py-2 mt-2 bg-blue-400 w-full rounded border border-blue-600 shadow hover:bg-blue-500">
                                        Create Cash Advance
                                    </button>
                                  </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>
