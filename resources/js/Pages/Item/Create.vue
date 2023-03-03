<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref  } from 'vue';
const data = ref(null);
const headers = {headers: {
    'Content-type':'application/json',
    'Authorization':'Bearer '+localStorage.getItem('token')
}}
axios.get(route('item_family.index'),headers).then(response=>{
    data.value = response.data
})

const form = useForm({
    item: '',
    item_family_id: '',
});

const submit = () => {
    form.transform(data => ({
        ...data,
    })).post(route('items.store'), {
        onFinish: () => form.reset('item|item_family_id'),
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <div class="mt-4">
            <InputLabel for="item_family_id" value="Family" />
            <select 
                id="item_family_id"
                v-model="form.item_family_id">
                <option v-for="item in data" :key="item.id">
                    {{item.item_family}}
                </option>
            </select>
        </div>
        <div>
            <InputLabel for="item" value="Item" />
            <TextInput
                id="item"
                v-model="form.item"
                class="mt-1 block w-full"
                required
                autofocus
            />
            <InputError class="mt-2" :message="form.errors.item" />
        </div>
    </form>
</template>

