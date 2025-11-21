<script setup lang="ts">
import { ref, watch } from 'vue'
import SearchComponent from '../../assets/Search.vue';
import CancelComponent from '../../assets/Cancel.vue';

const emit = defineEmits(['search', 'reset'])
const searchQuery = ref('')
let debounceTimeout: ReturnType<typeof setTimeout> | null = null
watch(searchQuery, (value, oldValue) => {
    if (debounceTimeout) clearTimeout(debounceTimeout)

    debounceTimeout = setTimeout(() => {
        const trimmed = value.trim()

        if (trimmed.length > 3 || oldValue.trim().length - trimmed.length > 0) {
            emit('search', trimmed)
        }

    }, 500);
})

function reset() {
    searchQuery.value = ''
    emit('reset')
}
</script>

<template>
    <div class="px-4 pt-4 pb-2">
        <div class="w-full h-10 rounded-sm flex items-center bg-white shadow-sm px-2.5 border">
            <SearchComponent class="w-4 h-4 text-gray-mid" />
            <input
                v-model="searchQuery"
                type="text"
                placeholder="Search"
                class="flex-1 bg-transparent focus:outline-none text-sm text-gray-mid ml-2"
            />
            <CancelComponent
                v-if="searchQuery.trim()"
                class="w-4 h-4 text-gray-mid cursor-pointer"
                @click="reset"
            />
        </div>
    </div>
</template>
