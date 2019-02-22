export default {

    SHOW_CREATE_INVOICE (state, visibility) {

        state.createInvoice = visibility;

    },

    SHOW_INVOICE_CREATED_CONFIRMATION (state, visibility) {

        state.invoiceCreatedConfirmation = visibility;
        
    }

}