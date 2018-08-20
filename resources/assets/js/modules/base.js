import {isEmptyString, isNullOrUndefined} from "../helpers/utils";
import {messageErrorHandler} from "@js/helpers/messageErrorHandler";

const baseState = (addOns = {}) => {
    const state = {
        pagination: {
            total: 0,
            page: 0,
            next: 0,
            prev: 0,
            limit: 0
        },

        status: {
            add: 0,
            edit: 0,
            delete: 0,
            load: 0,
            message: null
        }
    };

    return Object.assign(state, addOns);
};

const baseMutations = (state = {}, addOns = {}) => {
    const mutations = {
        setPagination(state, values) {
            if (isNullOrUndefined(values)) {
                for (let key in state.pagination) {
                    state.pagination[key] = 0;
                }
            } else {
                state.pagination.total = values.total;
                state.pagination.page = values.current_page;
                state.pagination.next = values.to;
                state.pagination.prev = values.from;
                state.pagination.limit = values.per_page;
            }
        },

        setStatus(state, values) {
            state.status[values[0]] = values[1];

            if (!isEmptyString(values[2])) {
                state.status.message = messageErrorHandler(values[2]);
            }
        }
    };

    return Object.assign(mutations, addOns);
};

export default {
    extend(base) {
        const module = Object.assign({}, base);
        module.state = baseState(base.state);
        module.mutations = baseMutations(base.state, base.mutations);

        return module;
    }
};