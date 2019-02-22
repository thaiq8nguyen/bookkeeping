import TransactionServices from "Services/transaction-services";
import PDFServices from "Services/pdf-services";

export default {

    getTransactions ({ commit }) {

        return TransactionServices.getTransactions()
        .then(response => {

            commit("SET_TRANSACTIONS", response.data);
            
        })
        .catch(errors => {

            console.log(errors);

        });

    },

    getTransaction ({ commit }, $id) {

        return TransactionServices.getTransaction($id)
        .then(response => {

            commit("SET_TRANSACTION", response.data);

        })
        .catch(errors => {

            console.log(errors);

        });

    },
};