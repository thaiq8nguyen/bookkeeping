import TransactionServices from "Services/transaction-services";

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

    getRenterTransactions ({ commit }, renterID) {

        return TransactionServices.getRenterTransactions(renterID)
            .then(response => {

                commit("SET_TRANSACTIONS", response.data.result);

            })
            .catch(errors => {

                console.log(errors);

            });

    },

    getRenterTransaction ({ commit }, request) {

        return TransactionServices.getRenterTransaction(request)
            .then(response => {
                console.log(response.data);
                commit("SET_TRANSACTION", response.data.result);

            })
            .catch(errors => {

                console.log(errors);

            });

    }
};
