<!-- resources/js/Pages/News/Edit.vue -->

<script setup>
import { router, useForm } from '@inertiajs/vue3' //修正

const props = defineProps({
    news: Object,
})

const form = useForm({
    title: props.news.title,
    body: props.news.body,
    image: null, //追加
    registerd_image: props.news.image //追加
})

const submit = () => {
    //以下修正
    router.post(route('news.update', props.news.id), {
        _method: 'put',
        title: form.title,
        body: form.body,
        image: form.image,
        registerd_image: form.registerd_image,
    });
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
                    <img :src="`/${form.registerd_image}`" alt="">
                </td>
                <td>
                    <input type="file" id="image" @input="form.image = $event.target.files[0]">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="submit" :disabled="form.processing">更新</button>
                </td>
            </tr>
        </table>
    </form>
</template>
