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

        records: [],

        status: {
            add: {
                code: 0,
                messages: null
            },
            edit: {
                code: 0,
                messages: null
            },
            delete: {
                code: 0,
                messages: null
            },
            load: {
                code: 0,
                messages: null
            },
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

        setRecords(state, records) {
            state.records = records;
        },

        setStatus(state, values) {
            state.status[values[0]].code = values[1];

            if (!isEmptyString(values[2])) {
                state.status[values[0]].messages = messageErrorHandler(values[2]);
            }
        }
    };

    return Object.assign(mutations, addOns);
};

const baseGetters = (state = {}, addOns = {}) => {
    const getters = {
        getStatus: state => action => {            
            return {
                code: state.status[action].code,
                messages: state.status[action].messages
            };
        }
    };

    return Object.assign(getters, addOns);
};

export default {
    extend(base) {
        const module = Object.assign({}, base);
        module.namespaced = true;
        module.state = baseState(base.state);
        module.mutations = baseMutations(base.state, base.mutations);
        module.getters = baseGetters(base.state, base.getters);

        return module;
    }
};
