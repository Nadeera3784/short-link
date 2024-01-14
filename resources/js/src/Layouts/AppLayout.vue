<template>
    <div class="flex flex-col mx-auto w-full min-h-screen bg-gray-100">
        <main class="flex flex-auto flex-col max-w-full">
            <div
                class="min-h-screen flex items-center justify-center relative overflow-hidden max-w-10xl mx-auto p-4 lg:p-8 w-full">
                <div
                    class="pattern-dots-md text-gray-300 absolute top-0 right-0 w-32 h-32 lg:w-48 lg:h-48 transform translate-x-16 translate-y-16">
                </div>
                <div
                    class="pattern-dots-md text-gray-300 absolute bottom-0 left-0 w-32 h-32 lg:w-48 lg:h-48 transform -translate-x-16 -translate-y-16">
                </div>
                <div class="py-6 lg:py-0 w-full md:w-8/12 lg:w-6/12 xl:w-4/12 relative">
                    <div class="mb-8 text-center">
                        <h1 class="text-4xl font-bold inline-flex items-center mb-1 space-x-3">
                            <span>LinkShort.io</span>
                        </h1>
                        <p class="text-gray">
                            More than just url shorter.
                        </p>
                    </div>
                    <slot></slot>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { defineComponent } from 'vue';
export default defineComponent({
    name: 'app-layout',
});
</script>

