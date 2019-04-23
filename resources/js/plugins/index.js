import Axios from "axios";
import Moment from "moment";
import FormatDollar from "./format-dollar";
import PersistStates from "./persist-states";
import store from "../store";

Axios.defaults.baseURL = "/api/";

/* const auth = localStorage.authentications ? localStorage.getItem("authentications") : "";
if (auth) {

    const token = JSON.parse(auth).accessToken;

    Axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

} */

// Axios.defaults.headers.common = { "X-Requested-With": "XMLHttpRequest" };

const apiClient = Axios.create({
    headers: {
        "accept": "application/json",
        "Content-Type": "application/json"
    }
});

const apiUploadFileClient = Axios.create({
    headers: {
        "accept": "application/json",
        "Content-Type": "multipart/form-data"
    }
});
const apiDownloadPDFFileClient = Axios.create({
    responseType: "blob",
    headers: {
        "accept": "application/pdf",
        "Content-Type": "application/pdf"
    }
});

apiClient.interceptors.request.use(function (config) {

    const token = store.getters["Authentications/accessToken"];
    config.headers["Authorization"] = `Bearer ${token}`;

    return config;

}, function (error) {

    return Promise.reject(error);

});

apiUploadFileClient.interceptors.request.use(function (config) {

    const token = store.getters["Authentications/accessToken"];
    config.headers["Authorization"] = `Bearer ${token}`;

    return config;

}, function (error) {

    return Promise.reject(error);

});

apiDownloadPDFFileClient.interceptors.request.use(function (config) {

    const token = store.getters["Authentications/accessToken"];
    config.headers["Authorization"] = `Bearer ${token}`;

    return config;

}, function (error) {

    return Promise.reject(error);

});
export default {
    install: function (Vue) {

        Object.defineProperties(Vue.prototype, {
            "moment": {
                value: Moment,
            },
            "apiClient": {
                value: apiClient,
            },
            "apiUploadFileClient": {
                value: apiUploadFileClient
            },
            "apiDownloadPDFFileClient": {
                value: apiDownloadPDFFileClient
            },
            "$dollar": {
                value: FormatDollar,
            },
            "persistState": {
                value: PersistStates
            }
        });

    }
};
