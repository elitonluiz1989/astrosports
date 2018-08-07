import { CONFIG } from "@js/config";
import {isArray, isNullOrEmpty, isObject} from "./utils";

function manageMessage(messages) {
    let errorMessages = [];
    for (let key in messages) {
        if (isArray(messages[key]) || isObject(messages[key])) {
            errorMessages.push(...manageMessage(messages[key]));
        } else {
            let message = messages[key];
            if (typeof message === "string" && message.indexOf("[show-user]") !== -1) {
                errorMessages.push(message.replace("[show-user]", ""));
            } else {
                if (CONFIG.REQUEST.MESSAGE_ON_LOG && !isNullOrEmpty(message)) {
                    console.error(message);
                }
            }
        }
    }

    return errorMessages;
}

export function messageErrorHandler(err) {
    let messageReturn = [];
    let errors = null;

    if (err.response.data !== undefined) {
        errors = err.response.data;
    } else {
        errors = err;
    }

    if (errors !== null) {
        if (!isArray(errors) && !isObject(errors)) {
            errors = [errors];
        }

        messageReturn = manageMessage(errors);
    }

    if (messageReturn.length === 0) {
        messageReturn[0] = CONFIG.REQUEST.DEFAULT_ERROR_MESSAGE;
    }

    return messageReturn;
}
