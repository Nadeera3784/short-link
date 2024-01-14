<template>
	<div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
		<div class="p-5 lg:p-6 flex-grow w-full">
			<div class="sm:p-5 lg:px-10 lg:py-8">
			      <create-link-form/>
			</div>
		</div>
		<div class="py-4 px-5 lg:px-6 w-full text-sm text-center bg-gray-50">
			Report a link?
			<a class="font-medium text-indigo-600 hover:text-indigo-400" href="https://www.google.com" title="support email">support@shortlink.io</a>
		</div>
	</div>
</template>
<script>
import { defineComponent } from 'vue';
import CreateLinkForm  from '../Components/Forms/CreateLinkForm.vue';

export default defineComponent({
	name: 'home',
	components: {
		CreateLinkForm,
	},

});
</script>

