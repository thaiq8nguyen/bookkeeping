import DateServices from "Services/date-services";
import { totalmem } from "os";

export default {

    transactions (state) {

        return state.transactions;
        
    },

    transaction (state) {

        return state.transaction;

    },
};