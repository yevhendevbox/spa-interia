<script setup>
const emit = defineEmits(['submit'])

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    categories: {
        type: Array,
        required: true
    }
})
</script>

<template>
    <form class="relative bg-white rounded-lg shadow" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-6">
                    <label
                        for="name"
                        class="block mb-2 text-sm font-medium"
                        :class="{ 'text-red-500': form.errors.name, 'text-gray-900': !form.errors.name}"
                    >
                        Product name
                    </label>
                    <input
                        type="text"
                        name="name"
                        v-model="form.name"
                        id="name"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{ 'border-red-500 bg-red-50 text-red-900': form.errors.name, 'border-gray-300 bg-gray-50 text-gray-900': !form.errors.name }"
                    >
                    <div v-if="form.errors.name" class="font-sm text-red-500 mt-2">{{ form.errors.name }}</div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label
                        for="brand"
                        class="block mb-2 text-sm font-medium"
                        :class="{ 'text-red-500': form.errors.brand, 'text-gray-900': !form.errors.brand}"
                    >
                        Brand
                    </label>
                    <input
                        type="text"
                        name="brand"
                        v-model="form.brand"
                        id="brand"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{ 'border-red-500 bg-red-50 text-red-900': form.errors.brand, 'border-gray-300 bg-gray-50 text-gray-900': !form.errors.brand }"
                    >
                    <div v-if="form.errors.brand" class="font-sm text-red-500 mt-2">{{ form.errors.brand }}</div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label
                        for="category_id"
                        class="block mb-2 text-sm font-medium"
                        :class="{ 'text-red-500': form.errors.category_id, 'text-gray-900': !form.errors.category_id}"
                    >
                        Category
                    </label>

                    <select
                        name="category_id"
                        v-model="form.category_id"
                        id="category_id"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{ 'border-red-500 bg-red-50 text-red-900': form.errors.category_id, 'border-gray-300 bg-gray-50 text-gray-900': !form.errors.category_id }"
                    >
                        <option value="">Select a category</option>
                        <option v-for="category in props.categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>

                    <div v-if="form.errors.category_id" class="font-sm text-red-500 mt-2">{{ form.errors.category_id }}</div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label
                        for="price"
                        class="block mb-2 text-sm font-medium"
                        :class="{ 'text-red-500': form.errors.price, 'text-gray-900': !form.errors.price}"
                    >
                        Price
                    </label>
                    <input
                        type="number"
                        name="price"
                        v-model="form.price"
                        id="price"
                        class="shadow-sm  border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{ 'border-red-500 bg-red-50 text-red-900': form.errors.price, 'border-gray-300 bg-gray-50 text-gray-900': !form.errors.price }"
                    >
                    <div v-if="form.errors.price" class="font-sm text-red-500 mt-2">{{ form.errors.price }}</div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label
                        for="stocks"
                        class="block mb-2 text-sm font-medium"
                        :class="{ 'text-red-500': form.errors.weight, 'text-gray-900': !form.errors.weight}"
                    >
                        Weight
                    </label>
                    <input
                        type="number"
                        name="stocks"
                        v-model="form.weight"
                        id="stocks"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{ 'border-red-500 bg-red-50 text-red-900': form.errors.weight, 'border-gray-300 bg-gray-50 text-gray-900': !form.errors.weight }"
                    >
                    <div v-if="form.errors.weight" class="font-sm text-red-500 mt-2">{{ form.errors.weight }}</div>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <label
                        for="description"
                        class="block mb-2 text-sm font-medium"
                        :class="{ 'text-red-500': form.errors.description, 'text-gray-900': !form.errors.description}"
                    >
                        Description
                    </label>
                    <textarea
                        name="description"
                        v-model="form.description"
                        id="description"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" rows="3"
                        :class="{ 'border-red-500 bg-red-50 text-red-900': form.errors.description, 'border-gray-300 bg-gray-50 text-gray-900': !form.errors.description }"
                    ></textarea>
                    <div v-if="form.errors.description" class="font-sm text-red-500 mt-2">{{ form.errors.description }}</div>
                </div>
                <div class="col-span-6 sm:col-span-6 space-x-2">
                    <slot></slot>
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
