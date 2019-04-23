const load = () => {

	try {

		const serializedState = localStorage.getItem("state");
		if (serializedState === null) {

			return undefined;

		}
		const state = JSON.parse(serializedState);

		return state;

	} catch (errors) {

		return undefined;

	}

};

const save = (state) => {

	try {

		const serializedState = JSON.stringify(state);
		localStorage.setItem("state", serializedState);

	} catch (errors) {

	}

};

const remove = () => {

	try {

		localStorage.removeItem("state");

	} catch (errors) {

	}

};

export default {
	load, save, remove
};
