export const loadState = (state) => {

    try {

        const serializedState = localStorage.getItem(state);
        if (serializedState === null) {

            return undefined;
        
    }
        return JSON.parse(serializedState);
    
    } catch (errors) {

        return undefined;
    
    }

};

export const saveState = (module, state) => {

    try {

        const serializedState = JSON.stringify(state);
        localStorage.setItem(module, serializedState);
    
    } catch (errors) {

    }

};

export const removeState = (module) => {

    try {

        localStorage.removeItem(module);

    } catch (errors) {

    }

};