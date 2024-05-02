<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, computed } from 'vue';

const inputs = ref([
    {
        value: null,
        placeholder: 'Имя'
    },
    {
        value: null,
        placeholder: 'E-mail'
    },
    {
        value: null,
        placeholder: 'Пароль'
    }
])

const checkboxes = ref([
    {
        name: 'PHP',
        id: 'php',
        checked: false
    },
    {
        name: 'JavaScript',
        id: 'js',
        checked: false
    },
    {
        name: 'GoLang',
        id: 'golang',
        checked: true
    },
    {
        name: 'Java',
        id: 'java',
        checked: false
    }
])

const checkboxesCount = computed(() => checkboxes.value.length)
const inputsCount = computed(() => inputs.value.length)

const ckeckedInputs = () => {
    let arr = ref([]);
    for (let i = 0; i < checkboxesCount.value; i++) {
        if (checkboxes.value[i].checked) {
            arr.value.push(checkboxes.value[i].id)
        }
    }
    return arr.value;
}

const formSubmit = () => {
    axios.post('/user_store', {
        name: inputs.value[0].value,
        email: inputs.value[1].value,
        password: inputs.value[2].value,
        password_confirmation: inputs.value[2].value,
        description: ckeckedInputs()
    })
        .then(() => {
            for (let i = 0; i < inputsCount.value; i++) {
                inputs.value[i].value = null;
            }
        })
}

</script>

<template>

    <Head title="Добавить пользователя" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Добавить пользователя</h2>
        </template>

        <div class="w-3/6 mx-auto mt-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="formSubmit" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="block">
                        <input type="text" class="px-3 py-2 border rounded-md mr-2 block mb-5 w-full"
                            v-for="item in inputs" :placeholder="item.placeholder" v-model="item.value">
                        <label class="inline-flex items-center mr-4" v-for="item in checkboxes">
                            <input type="checkbox" :data-id="item.id" v-model="item.checked"
                                class="form-checkbox text-blue-500 h-5 w-5">
                            <span class="ml-2">{{ item.name }}</span>
                        </label>
                    </div>
                    <button type="submit" id="btn"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-5 rounded w-2/6 flex mx-auto justify-center">
                        Добавить
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
