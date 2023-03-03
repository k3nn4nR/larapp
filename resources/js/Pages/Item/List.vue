<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'datatables.net-vue3'
import DataTablesLib from 'datatables.net';
import Dashboard from './Dashboard.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import CreateItem from './Create.vue';
import 'datatables.net-select';
import { ref  } from 'vue';

DataTable.use(DataTablesLib);

const data = ref(null);
const sended = ref();
const headers = {headers: {
    'Content-type':'application/json',
    'Authorization':'Bearer '+localStorage.getItem('token')
}}
const confirmingUserDeletion = ref(false)
const columns = [
    { data: 'item' },
    { data: 'family' },
    { data: 'types' },
];
axios.get(route('item.index'),headers).then(response=>{
    data.value = response.data.data
})

function showModal() {
  confirmingUserDeletion.value = !confirmingUserDeletion.value
}
</script>

<style>
@import 'datatables.net-dt';
</style>

<template>
    <AppLayout title="Items">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Items
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    <Dashboard/>
                </div>
                <div>
                    <DataTable :data="data" class="display" :columns="columns">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Family</th>
                                <th>Types</th>
                            </tr>
                        </thead>
                    </DataTable>
                </div>
                <div>
                    <PrimaryButton @click="showModal">
                        Insert Item
                    </PrimaryButton>
                    <ConfirmationModal :show="confirmingUserDeletion" @close="confirmingUserDeletion = false">
                        <template #title>
                            Insert Item
                        </template>

                        <template #content>
                            <CreateItem/>
                        </template>

                        <template #footer>
                            <SecondaryButton class="ml-2" @click.enter="$refs.SendCreate.submit()">
                                Create
                            </SecondaryButton>

                            <DangerButton @click.enter="confirmingUserDeletion = false">
                                Cancel
                            </DangerButton>
                        </template>
                    </ConfirmationModal>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
