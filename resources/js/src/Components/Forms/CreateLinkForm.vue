<template>
    <div class="space-y-6">
        <div class="space-y-1">
            <label for="link" class="font-medium">Generate short url for
                free!</label>
            <input v-model="link"
                class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                type="text" placeholder="Enter your url" />
            <error-alert :message="errorMessage" :visibility="errorMessage.length > 0" />
        </div>
        <div class="space-y-1" v-if="successMessage">
            <label for="generatedLink" class="font-medium text-green-500">{{ successMessage }}</label>
            <div class="relative flex items-center space-x-2">
                <input v-model="generatedLink"
                    class="block border border-gray-200 rounded px-5 py-3 leading-6 w-full focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    type="text" id="generatedLink" readonly />
                <button type="button" @click="onClickCopyToClipboard()"
                    class="absolute right-0 mr-2 top-1/2 transform -translate-y-1/2 text-indigo-600 cursor-pointer p-5 copy-btn">
                    Copy
                </button>
            </div>
        </div>
        <div>
            <div class="relative">
                <button type="button" @click="onClickGenerate()"
                    class="space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-indigo-700 bg-indigo-700 text-white hover:text-white hover:bg-indigo-800 hover:border-indigo-800 focus:ring:none relative">
                    Generate
                    <spin-loader :visibility="loading" />
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent, ref, watch } from 'vue';
import ClipboardJS from 'clipboard';
import { useCreateLink } from '../../Hooks/useCreateLink.js';
import ErrorAlert from '../../Components/Alerts/ErrorAlert.vue';
import SpinLoader from '../../Components/Loader/SpinLoader.vue';

export default defineComponent({
    name: 'create-link-form',
    components: {
        ErrorAlert,
        SpinLoader
    },
    setup() {

        const link = ref('');
        const errorMessage = ref('');
        const successMessage = ref('');
        const loading = ref(false);
        const generatedLink = ref('');

        const { process: processLink, response: responseLink } = useCreateLink();

        const onClickGenerate = () => {
            if (!validator()) {
                return;
            }

            resetErrors()

            const params = {
                url: link.value
            }

            processLink(params, (response) => {
                if (response.status_code == 200 || response.status_code == 201) {
                    resetErrors()
                    successMessage.value = response.message;
                    generatedLink.value = response.data.url;
                } else {
                    if (response.status_code == 400) {
                        errorMessage.value = response?.data?.data?.error
                    } else {
                        errorMessage.value = response.message;
                    }
                }
            });

        }

        const onClickCopyToClipboard = () => {

            const clipboard = new ClipboardJS('.copy-btn', {
                text: () => generatedLink.value,
            });

            clipboard.on('success', () => {
                clipboard.destroy();
            });

            clipboard.on('error', () => {
                clipboard.destroy();
            });
        }

        const validator = () => {
            if (!link.value) {
                errorMessage.value = 'URL is required';
                return false;
            }
            const urlRegex = /^(ftp|http|https):\/\/[^ "]+$/;
            if (!urlRegex.test(link.value)) {
                errorMessage.value = 'Enter a valid URL';
                return false;
            }
            return true;
        };

        const resetErrors = () => {
            errorMessage.value = '';
        }

        watch(responseLink, (res) => {
            loading.value = res.loading;
        });

        return {
            link,
            errorMessage,
            successMessage,
            loading,
            generatedLink,
            onClickGenerate,
            onClickCopyToClipboard
        }
    }
});
</script>

