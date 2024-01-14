<template>
	<app-layout>
		<home/>
	</app-layout>
</template>
<script>
import { defineComponent } from 'vue';
import AppLayout from './Layouts/AppLayout.vue';
import Home from './Pages/Home.vue';

export default defineComponent({
	components: {
		AppLayout,
		Home
	}
});
</script>