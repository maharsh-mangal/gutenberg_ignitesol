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
            class="cursor-pointer flex flex-col items-center"
            @click="emit('open', book)"
        >
            <img :src="getImageUrl(book)" alt="" class="w-[114px] h-[162px] rounded-[8px] object-cover image-shadow"/>
            <div class="mt-2 text-xs max-w-36 text-gray-dark font-semibold truncate">{{ book.title }}</div>
            <div class="text-[10px] text-gray-mid">{{ book.authors[0]?.name || 'Unknown Author' }}</div>
        </div>
    </div>
</template>

<style scoped>
.image-shadow{
    box-shadow: 0 2px 5px 0 rgba(211, 209, 238, 0.5);
}
</style>
