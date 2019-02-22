import Vue from "vue";
import Plugins from "../plugins";

let Services = new Vue();
Vue.use(Plugins);

export default ({

    getExpenseAccounts () {

        return Services.apiClient.get("/expense-accounts");

    },

    createInvoice (data) {
        
        return Services.apiClient.post("/transactions", data);

    },

    uploadInvoice (invoice) {

        return Services.apiUploadFileClient.post("/files", invoice);

    },
    
    downloadInvoice (transactionID) {

        return Services.apiDownloadPDFFileClient.get("/files/" + transactionID);
        
    },

    deleteInvoice (transactionID) {

        return Services.apiClient.delete("/transactions/" + transactionID);

    }
});