
import InvoiceServices from "Services/invoice-services";
import PDFServices from "Services/pdf-services";
import Router from "Router";

export default {

    getExpenseAccounts ({ commit }) {

        InvoiceServices.getExpenseAccounts()
        .then(response => {

            commit("SET_EXPENSE_ACCOUNTS", response.data);

        })
        .catch(errors => {

            console.log(errors);

        });

    },
    createInvoiceItem ({ commit }, item) {

        commit("CREATE_INVOICE_ITEM", item);

    },

    createMemo ({ commit }, memo) {

        console.log(memo);
        commit("SET_MEMO", memo);

    },

    createTransaction ({ commit, state, rootGetters }) {
     
        const transaction = {
            "renterID": rootGetters["Renters/renterID"],
            "date": rootGetters.date,
            "lineItems": state.invoiceItems,
        };
        return new Promise((resolve, reject) => {

            InvoiceServices.createInvoice(transaction)
            .then(response => {

                commit("SET_NEW_TRANSACTION_ID", response.data.transactionID);
                resolve(response.data.transactionID);

            })
            .catch(error => {
                
                reject(error);

            });

        });
        
    },

    async createAndUploadInvoice ({ commit, dispatch, getters }) {

        commit("SET_SAVING", true);

        const transactionID = await dispatch("createTransaction");

        let pdf = PDFServices.createInvoicePDF(getters.invoice);

        let formData = new FormData();

        formData.append("invoice", pdf);
        formData.set("transactionID", transactionID);

        return InvoiceServices.uploadInvoice(formData)
        .then(response => {

            commit("SET_SAVING", false);
            dispatch("Dialogs/showDialog", { name: "invoiceCreatedConfirmation", visibility: true }, { root: true });
            
        })
        .catch(errors => {

        });

    },

    downloadInvoice ({ state, dispatch, commit }) {

        return InvoiceServices.downloadInvoice(state.newTransactionID)
            .then(response => {

                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement("a");
                link.href = url;
                link.setAttribute("download", "invoice.pdf");
                document.body.appendChild(link);
                link.click();

                dispatch("Dialogs/showDialog", { name: "invoiceCreatedConfirmation", visibility: false }, { root: true });
                dispatch("Dialogs/showDialog", { name: "createInvoice", visibility: false }, { root: true });

                commit("DELETE_INVOICE_ITEMS");
                commit("Renters/UNSELECT_RENTER", null, { root: true });
                commit("SET_NEW_TRANSACTION_ID", "");

            })
            .catch(errors => {

            });

    },

    downloadInvoiceOnly ({ commit }, transactionID) {

        return InvoiceServices.downloadInvoice(transactionID)
            .then(response => {

                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement("a");
                link.href = url;
                link.setAttribute("download", "invoice.pdf");
                document.body.appendChild(link);
                link.click();

            })
            .catch(errors => {

            });

    },

    deleteInvoice ({ commit }, transactionID) {

        return InvoiceServices.deleteInvoice(transactionID)
            .then(response => {

                Router.push("/dashboard");
            
            })
            .catch(errors => {

            })
            .then(() => {

            });

    },

    deleteInvoiceItem ({ commit }, item) {

        commit("DELETE_INVOICE_ITEM", item);

    }

};