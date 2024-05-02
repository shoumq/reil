<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';

let users = ref([]);

const loadUsers = () => {
    axios.get('/users')
        .then((response) => {
            users.value = response.data
        })
}

const descriptionNames = (descriptionArg) => {
    let description = ref(descriptionArg);
    const keyValueArray = [
        { key: "golang", value: "Go" },
        { key: "js", value: "JavaScript" },
        { key: "java", value: "Java" },
        { key: "php", value: "PHP" }
    ];

    const descriptionNames = computed(() => {
        let descriptionArray = ref(description.value.split(', '))

        const updatedArray = descriptionArray.value.map(item => {
            const found = keyValueArray.find(obj => obj.key === item);
            return found ? found.value : item;
        });

        return updatedArray
    })

    return descriptionNames.value.join(", ")
}
onMounted(() => {
    loadUsers()
})

</script>

<template>

    <Head title="Список пользователей" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список пользователей</h2>
        </template>

        <div class="w-3/6 mx-auto mt-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="block border-b-2 border-stone-400" v-for="item in users">
                        <div>{{ item.name }}</div>
                        <div class="mutted">{{ item.email }}</div>
                        <div>{{ descriptionNames(item.description) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>
.mutted {
    color: #7b7b7b;
    line-height: 10px;
}
.border-b-2:last-child {
    border-bottom: none;
}
</style>