<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import GenreCard from '@/components/GenreCard.vue'
import Fiction from '../../assets/Fiction.vue'
import Philosophy from '../../assets/Philosophy.vue'
import Politics from '../../assets/Politics.vue'
import Drama from '../../assets/Drama.vue'
import Humour from '../../assets/Humour.vue'
import History from '../../assets/History.vue'
import Adventure from '../../assets/Adventure.vue'

const genres = [
    { title: 'FICTION', icon: Fiction },
    { title: 'DRAMA', icon: Drama },
    { title: 'HUMOR', icon: Humour },
    { title: 'POLITICS', icon: Politics },
    { title: 'PHILOSOPHY', icon: Philosophy },
    { title: 'HISTORY', icon: History },
    { title: 'ADVENTURE', icon: Adventure },
]

const navigateToGenre = (genreTitle: string) => {
    router.visit(`/genre/${genreTitle.toLowerCase()}`)
}
</script>

<template>
    <div class="h-screen max-w-screen bg-guten-muted">
        <div class=" bg-guten-muted bg-pattern">
            <div class="lg:max-w-5xl lg:mx-auto">
                <div class="font-montserrat px-4 pt-20 pb-6 text-5xl font-semibold text-guten">
                    Gutenberg Project
                </div>
                <div class="font-montserrat px-4 py-4 text-base font-semibold text-gray-dark">
                    A social cataloging website that allows you to freely search its
                    database of books, annotations, and reviews.
                </div>
            </div>
        </div>

        <div
            class="my-6 grid grid-cols-1 lg:grid-cols-2 lg:max-w-5xl gap-4 p-4 sm:grid-cols-2 lg:gap-8 lg:mx-auto"
        >
            <GenreCard
                v-for="(genre, index) in genres"
                :key="`${index}-${genre.title}`"
                :title="genre.title"
                :icon="genre.icon"
                @click="navigateToGenre(genre.title)"
            />
        </div>
    </div>
</template>
