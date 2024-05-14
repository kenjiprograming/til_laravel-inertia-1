<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';

const form = useForm({
    heading: '',
    slug: '',
    description : ''
});

const submit = () => {
    form.post(route("blogs.store"));
};
</script>
<template>
    <h2 >Create Blog</h2>

    <div >
        <div >
            <section>
                <form @submit.prevent="submit" >
                    <div>
                        <label for="heading">heading:</label>

                        <input
                            id="heading"
                            type="text"

                            v-model="form.heading"
                            autofocus
                        />

                    </div>

                    <div>

                        <label for="slug">slug:</label>
                        <input
                            id="slug"
                            type="text"

                            v-model="form.slug"
                        />

                    </div>
                    <div>
                        <label for="description">description:</label>

                        <textarea
                            id="description"
                            type="text"

                            v-model="form.description"
                        />

                    </div>

                    <div >
                        <button :disabled="form.processing">Save</button>

                        <p v-if="form.recentlySuccessful" >Saved.</p>
                    </div>
                </form>
            </section>
        </div>
    </div>
</template>
