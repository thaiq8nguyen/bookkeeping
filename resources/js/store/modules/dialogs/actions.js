export default {

    showDialog ({ commit }, dialog) {

        if (dialog.name === "createInvoice") {

            commit("SHOW_CREATE_INVOICE", dialog.visibility);

        } else if (dialog.name === "invoiceCreatedConfirmation") {

            commit("SHOW_INVOICE_CREATED_CONFIRMATION", dialog.visibility);

        }

    },
}