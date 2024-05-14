<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    blogs : Object,
    filters : Object,
    message : String
});

const filters = {
    filter: props.filters.filter,
}
const form = useForm(filters);

const deleteTrade = (id) => {
    if (confirm("Are you sure you want to move this to trash")) {
	   form.delete(route('blogs.destroy',{id:id}), {
		  preserveScroll: true,
	   });
    }
};
</script>
<template>
    <h2><a :href="route('blogs.index')">Blogs</a>
        <Link :href="route('blogs.index', {filter:'only'})" >View Trashed</Link>
    </h2>

    <div >
        <div >
            <div
                v-if="props.message"
                role="alert"
            >
                <span >
                {{ props.message }}
                </span>
            </div>
            <div >
            <table >
                <thead>
                <tr >
                    <th >ID</th>
                    <th >Heading</th>
                    <th >Publsihed Date</th>
                    <th >Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="entry in props.blogs.data" :key="entry.id" >
                    <td >
                    <span >
                    {{ entry.heading }}
                    </span>
                    </td>
                    <td >
                    <span >
                    {{ entry.slug }}
                    </span>
                    </td>
                    <td >
                    <span >
                    {{ entry.created_at }}
                    </span>
                    </td>
                    <td  >
                    <Link v-if="entry.deleted_at == null" :href="route('blogs.show', {'id': entry.id})"  >VIEW</Link>
                    <Link v-if="entry.deleted_at == null" :href="route('blogs.edit', {'id': entry.id})"  >EDIT</Link>
                    <button

                    @click="deleteTrade(entry.id)" v-if="entry.deleted_at == null"
                    >
                    Trash
                    </button>
                    </td>
                </tr>
                <tr v-if="props.blogs.data.length === 0">
                    <td >No posts found.</td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</template>
