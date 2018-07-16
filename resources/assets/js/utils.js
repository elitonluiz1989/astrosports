const isArray = value => {
    return value instanceof Array;
};

const isNullOrEmpty = string => {
    return string === undefined || string === null || string === "";
};

const isObject = value => {
    return value instanceof Object;
};

export { isArray, isNullOrEmpty, isObject };