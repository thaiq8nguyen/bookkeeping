export default {
    INITIALIZE_STATE (state) {

        if (localStorage.getItem("state")) {

            this.replaceState(

                Object.assign(state, JSON.parse(localStorage.getItem("state")))

            );

        }

    },
    SET_DATE (state, date) {

        state.date = date;

    }

};
