<template>
    <div
        class="w-full h-[50px] px-2.5 flex items-center justify-between rounded-sm shadow-guten bg-guten-muted cursor-pointer select-none hover:shadow-lg transition-all duration-200"
    >
        <!-- Icon + Title -->
        <div class="flex items-center gap-3">
            <component :is="icon" class="w-6 h-6 text-[var(--color-guten)]" />
            <span class="font-montserrat font-semibold text-[var(--color-gray-dark)] text-base tracking-wide">
        {{ title }}
      </span>
        </div>

        <!-- Arrow Right -->
        <NextComponent class="w-5 h-5 text-guten" @click="handleClick(title)" />
    </div>
</template>

<script setup lang="ts">
import NextComponent from '../../assets/Next.vue'

const emit = defineEmits(['navigate'])
defineProps({
    title: String,
    icon: Object,
})

const handleClick = (title:string|undefined) => {
    emit('navigate', title) // Emit only name
}
</script>
