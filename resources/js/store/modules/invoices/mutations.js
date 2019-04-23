export default {

    SET_EXPENSE_ACCOUNTS (state, accounts) {

        state.expenseAccounts = accounts;

    },

    CREATE_INVOICE_ITEM (state, item) {

        state.invoiceItems.push(item);

    },

    DELETE_INVOICE_ITEM (state, item) {

        const newInvoiceItems = state.invoiceItems.filter(element => element !== item);
        state.invoiceItems = newInvoiceItems;

    },

    UPDATE_INVOICE_ITEM (state, item) {

    },

    DELETE_ALL_INVOICE_ITEMS (state) {

        state.invoiceItems = [];

    },

    SET_SAVING (state, value) {

        state.saving = value;

    },

    SET_NEW_TRANSACTION_ID (state, value) {

        state.newTransactionID = value;

    },

    SET_MEMO (state, memo) {

        state.memo = memo;

    }

};
