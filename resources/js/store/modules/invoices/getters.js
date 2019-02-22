import DateServices from "Services/date-services";

export default {
    expenseAccounts (state) {

        return state.expenseAccounts;

    },
    invoiceItems (state) {

        return state.invoiceItems;
        
    },
    saving (state) {

        return state.saving;

    },

    newTransactionID (state) {

        return state.newTransactionID;

    },

    memo (state) {

        return state.memo;

    },
    
    invoice (state, getters, rootState, rootGetters) {

        let newInvoiceItems = [];
        let renter = rootGetters["Renters/renterFullName"];

        if (state.invoiceItems.length) {

            newInvoiceItems = state.invoiceItems.map((invoiceItem) => {

                return {
                    account: state.expenseAccounts.find(expenseAccount => expenseAccount.accountID === invoiceItem.accountID).accountName,
                    amount: invoiceItem.amount
                };

            });

        }

        return {

            renter: renter,
            invoiceItems: newInvoiceItems,
            totalInvoiceAmount: getters.totalInvoiceAmount,
            dueDate: DateServices.getDateFromToday(3),
            memo: getters.memo

        };

    },

    totalInvoiceAmount (state) {

        return state.invoiceItems.reduce((total, invoiceItem) => {

            return total + parseFloat(invoiceItem.amount);

        }, 0);

    }
};