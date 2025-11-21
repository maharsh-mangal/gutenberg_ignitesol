<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import { ref, onMounted, onUnmounted } from 'vue'

import SearchBooks from '@/components/SearchBooks.vue'
import BookGrid from '@/components/BookGrid.vue'
import BackComponent from '../../assets/Back.vue'

interface Author { name: string }
interface Format { mime_type: string; url: string }
interface Book { id: number; title: string; authors: Author[]; formats: Format[] }
interface ApiResponse { count: number; next: string | null; previous: string | null; results: Book[] }

const genre = usePage().props.genre as string

const books = ref<Book[]>([])
const nextPageUrl = ref<string | null>(null)
const isLoading = ref(false)
const currentTitleQuery = ref<string | null>(null)

const urlParams = new URLSearchParams(window.location.search)
const idsParam = urlParams.get('ids')
const languagesParam = urlParams.get('languages')
const mimeTypeParam = urlParams.get('mime_type')
const searchParam = urlParams.get('search')

const buildFilterSuffix = (includeTitle = true): string => {
    let suffix = ''
    if (idsParam)       suffix += `&ids=${idsParam}`
    if (languagesParam) suffix += `&languages=${languagesParam}`
    if (mimeTypeParam)  suffix += `&mime_type=${mimeTypeParam}`
    if (searchParam)    suffix += `&search=${searchParam}`

    if (includeTitle && currentTitleQuery.value && currentTitleQuery.value.trim().length >= 3) {
        suffix += `&title=${currentTitleQuery.value}`
    }
    return suffix
}

const fetchBooks = async (url?: string, titleQuery?: string) => {
    if (isLoading.value) return
    isLoading.value = true

    if (typeof titleQuery === 'string') {
        currentTitleQuery.value = titleQuery
    }

    const endpoint = url
        ? url
        : `/api/books?topic=${genre}&mime=image${buildFilterSuffix(true)}`

    const res = await fetch(endpoint)
    const data = (await res.json()) as ApiResponse

    books.value = [...books.value, ...data.results]

    nextPageUrl.value = data.next
        ? `${data.next}&topic=${genre}&mime=image${buildFilterSuffix(true)}`
        : null

    isLoading.value = false
}

const applySearch = (q: string) => {
    books.value = []
    nextPageUrl.value = null
    fetchBooks(undefined, q)
}

const resetBooks = () => {
    currentTitleQuery.value = null
    books.value = []
    nextPageUrl.value = null
    fetchBooks()
}

const getBestFormatUrl = (book: Book): string | null => {
    const html = book.formats.find(f => f.mime_type.includes('html'))
    if (html) return html.url
    const pdf = book.formats.find(f => f.mime_type.includes('pdf'))
    if (pdf) return pdf.url
    const txt = book.formats.find(f => f.mime_type.includes('plain'))
    if (txt) return txt.url
    return null
}

const openBook = (book: Book) => {
    const url = getBestFormatUrl(book)
    if (!url) return alert('No viewable version available')
    window.open(url, '_blank')
}

const handleScroll = () => {
    if (!nextPageUrl.value) return
    const nearBottom = window.innerHeight + window.scrollY >= document.body.offsetHeight - 200
    if (nearBottom) fetchBooks(nextPageUrl.value)
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll)
    fetchBooks()
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})
</script>

<template>
    <div class="min-h-screen bg-guten-muted font-montserrat">
        <div class="flex items-center gap-3 px-4 pt-8">
            <BackComponent class="w-6 h-6 text-guten cursor-pointer" @click="$inertia.visit('/')" />
            <h1 class="text-2xl font-semibold text-guten">
                {{ genre.charAt(0).toUpperCase() + genre.slice(1) }}
            </h1>
        </div>

        <SearchBooks @search="applySearch" @reset="resetBooks" />

        <BookGrid :books="books" @open="openBook" />

        <div v-if="isLoading" class="text-center text-sm text-gray-mid py-4">
            Loading…
        </div>
    </div>
</template>
