<script setup lang="ts">
interface Author { name: string }
interface Format { mime_type: string; url: string }
interface Book { id: number; title: string; authors: Author[]; formats: Format[] }

const props = defineProps<{ books: Book[] }>()
const emit = defineEmits(['open'])

function getImageUrl(book: Book) {
    const img = book.formats.find(f => f.mime_type.includes('image'))
    return img ? img.url : '/fallback.jpg'
}
</script>

<template>
    <div class="grid grid-cols-3 gap-4 px-4 pb-6">
        <div
            v-for="book in props.books"
            :key="book.id"
            class="cursor-pointer"
            @click="emit('open', book)"
        >
            <img :src="getImageUrl(book)" alt="" class="w-full h-40 object-cover"/>
            <div class="mt-2 text-xs text-gray-dark font-semibold truncate">{{ book.title }}</div>
            <div class="text-[10px] text-gray-mid">{{ book.authors[0]?.name || 'Unknown Author' }}</div>
        </div>
    </div>
</template>
