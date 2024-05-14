<!-- resources/js/Pages/News/Index.vue -->

<script setup>
import { Link, useForm } from '@inertiajs/vue3' //←修正

defineProps({
    news: Object,
})
// ↓以下6行追加
const form = useForm({});
const deleteNews = (news) => {
    form.delete(route('news.destroy', news), {
        preserveScroll: true,
    })
}
</script>

<template>
    <Link :href="route('news.create')">新規作成</Link>
    <div v-if="news">
        <div v-for="n in news">
            <h1>{{ n.title }}</h1>
            <p>{{ n.body }}</p>
            <div>
                <Link :href="route('news.show', n)">詳細</Link>
            </div>
            <div>
                <Link :href="route('news.edit', n)">編集</Link>
            </div>
            <div>
                <Link href="#" @click="deleteNews(n)">削除</Link> <!-- ←追加 -->
            </div>
        </div>
    </div>
</template>
