<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
    defineProps({
    collapse:Boolean,

    })

    let showManageUser = ref(false);
    const isOpenUser = () => (showManageUser.value = !showManageUser.value);

</script>

<template>
    <div class="overflow-y-auto overflow-x-hidden flex-grow">
        <ul class="flex flex-col py-4 space-y-1">
            <li class="px-5">
              <div class="flex flex-row items-center h-2">
                  <div class="text-m font-light tracking-wide text-white" v-show="!collapse">
                    <p class="font-semibold tracking-wide text-m text-white leading-tight mb-3">
                      <span v-if="$page.props.auth.user.type === 'admin'">Administrator</span>
                      <span v-else-if="$page.props.auth.user.type ==='employee'">Employee</span>
                      <span v-else>Unknown Role</span>
                    </p>
                  </div>
                </div>
            </li>
            <hr class="text-white mt-5">
            <li  :class="{ 'bg-green-700 font-bold text-gray-800  border-transparent ': route().current('dashboard') }">
              <Link :href="route('dashboard')"  class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-green-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </span>
                <span class="ml-2 text-m tracking-wide truncate" v-show="!collapse">Dashboard</span>
              </Link>
            </li>
            <li v-if="$page.props.auth.permissions.includes('read_payslip')" :class="{ 'bg-green-700 font-bold text-gray-800  border-transparent ': route().current('payroll.payslip') }">
              <Link  :href="route('payroll.payslip')" class=" relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                  <hr class="text-white mt-5">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                    </svg>

                </span>
                <span class="ml-2 text-m tracking-wide truncate" v-show="!collapse">Payslip</span>
              </Link>
            </li>
            <li v-if="$page.props.auth.permissions.includes('manage_payroll')"  :class="{ 'bg-green-700 font-bold text-gray-800  border-transparent ': route().current('payroll.index') }">

              <Link :href="route('payroll.index')"   class="flex justify-start items-center space-x-6 hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 rounded px-3 py-2 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>
                <span class="ml-2 text-m tracking-wide truncate" v-show="!collapse">Payroll</span>

            </Link>

          </li>
          <li v-if="$page.props.auth.permissions.includes('manage_payroll')" :class="{ 'bg-green-700 font-bold text-gray-800  border-transparent ': route().current('cashAdvance.index') }" >
            <Link :href="route('cashAdvance.index')"  class="flex justify-start items-center space-x-6 hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 rounded px-3 py-2 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                </svg>

                <span class="ml-2 text-m tracking-wide truncate" v-show="!collapse">Cash Advance</span>

            </Link>
          </li>
          <li v-if="$page.props.auth.permissions.includes('manage_payroll')"  >
            <button  @click="isOpenUser" class="relative flex flex-row items-center cursor-pointer w-full h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </span>
                <span class="ml-2 text-m tracking-wide truncate" v-show="!collapse">Manage User</span>
            </button>
            <div v-show="showManageUser" class="flex justify-start  flex-col w-full md:w-auto items-start pb-1 ml-3 ">
            <Link :href="route('positions.index')" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </span>
                <span class="ml-2 text-m tracking-wide truncate" v-show="!collapse">Position</span>
            </Link>
            <li class="relative flex flex-row items-center cursor-pointer w-full h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                <Link :href="route('employees.index')" class="relative flex flex-row items-center cursor-pointer w-full h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        <hr class="text-white mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>

                    </span>
                    <span class="ml-2 text-m tracking-wide truncate" v-show="!collapse">Employee</span>
                </Link>
            </li>
            <Link :href="route('user.index')" class="relative flex flex-row items-center cursor-pointer w-full h-11 focus:outline-none hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>

                </span>
                <span class="ml-2 text-m tracking-wide truncate" v-show="!collapse">Users</span>
            </Link>
        </div>
        </li>
        <li v-if="$page.props.auth.permissions.includes('manage_payroll')" :class="{ 'bg-green-700 font-bold text-gray-800  border-transparent ': route().current('logs.index') }" >
            <Link :href="route('logs.index')"  class="flex justify-start items-center space-x-6 hover:bg-gray-50 text-white hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 rounded px-3 py-2 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                  </svg>


                <span class="ml-2 text-m tracking-wide truncate" v-show="!collapse">Logs</span>

            </Link>
          </li>
        </ul>
    </div>
</template>
