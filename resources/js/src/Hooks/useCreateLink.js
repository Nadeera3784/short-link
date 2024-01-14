import { reactive } from "vue";
import axios from "axios";

export const useCreateLink = () => {
    const response = reactive({
        status: true,
        loading: false,
        errored: false,
        data: [],
        status_code: null,
        message: ''
    });

    const process = (data, finallyCallback) => {
        response.loading = true;
        const ENDPOINT = `/api/v1/links`;
        axios
            .post(ENDPOINT, data)
            .then(apiResponse => {
                response.errored = false;
                response.status = apiResponse.data.status;
                response.message = apiResponse.data.message;
                response.data = apiResponse.data.data;
                response.status_code = apiResponse.status;
            })
            .catch(error => {
                response.errored = true;
                response.message = error.response.data.errors || error.response.data.message || error.message;
                response.data = error.response.data || [];
                response.status = false;
                response.status_code = error.response.status;
            })
            .finally(() => {
                response.loading = false;
                if (typeof finallyCallback === 'function') {
                    finallyCallback(response);
                }
            });
    }

    return {
        response,
        process
    }
};
