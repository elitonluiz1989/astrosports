const capitalize = value => {
    if (!value) {
        return '';
    }

    value = value.toString().toLowerCase();
    return value.charAt(0).toUpperCase() + value.slice(1);
};

const cleanArray = value => {
    let len = value.length;
    let _arr = [];

    for (let i = 0; i < len; i++) {
        if (!isNullOrUndefined(value[i])) {
            _arr.push(value[i]);
        }
    }

    return _arr;
};

const isArray = value => {
    return value instanceof Array;
};

const isEmptyArray = arr => {
    return isNullOrUndefined(arr) || arr.length === 0;
};

const isEmptyString = string => {
    return isNullOrUndefined(string) || string === "";
};

const isNullOrUndefined = value => {
    return value === undefined || value === null;
};

const isObject = value => {
    return value instanceof Object;
};

const isString = value => {
    return typeof value == 'string' || value instanceof String;
};

export { capitalize, cleanArray, isArray, isEmptyArray, isEmptyString, isNullOrUndefined, isObject, isString };
