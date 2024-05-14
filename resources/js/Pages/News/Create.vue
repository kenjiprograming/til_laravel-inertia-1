<!-- resources/js/Pages/News/Create.vue -->

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: null,
    body: null,
    image: null,
})

const submit = () => {
    form.post(route('news.store'));
}

</script>

<template>
    <form @submit.prevent="submit">
        <table>
            <tr>
                <th><label for="title">title:</label></th>
                <td>
                    <div v-if="form.errors.title">{{ form.errors.title }}</div>
                    <input id="title" type="text" v-model="form.title">
                </td>
            </tr>
            <tr>
                <th><label for="body">body:</label></th>
                <td>
                    <div v-if="form.errors.body">{{ form.errors.body }}</div>
                    <textarea id="body" cols="22" rows="20" v-model="form.body"></textarea>
                </td>
            </tr>
            <!-- 以下追加 -->
            <tr>
                <th><label for="image">image:</label></th>
                <td>
                    <input type="file" id="image" @input="form.image = $event.target.files[0]">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="submit" :disabled="form.processing">登録</button>
                </td>
            </tr>
        </table>
    </form>
</template>
