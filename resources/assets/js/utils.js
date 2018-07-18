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

const isNullOrEmpty = string => {
    return string === undefined || string === null || string === "";
};

const isNullOrUndefined = value => {
    return value === undefined || value === null;
};

const isObject = value => {
    return value instanceof Object;
};

export { cleanArray, isArray, isNullOrEmpty, isNullOrUndefined, isObject };