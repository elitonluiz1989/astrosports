import { CONFIG } from "@js/config";
import {isArray, isObject} from "./utils";

function manageMessage(messages) {
    let errorMessages = [];
    for (let key in messages) {
        if (isArray(messages[key]) || isObject(messages[key])) {
            errorMessages.push(...manageMessage(messages[key]));
        } else {
            let message = messages[key];
            if (message.indexOf("[show-user]") !== -1) {
                errorMessages.push(message.replace("[show-user]", ""));
            } else {
                if (CONFIG.REQUEST_MESSAGE_ON_LOG) {
                    console.error(message);
                }
            }
        }
    }

    return errorMessages;
}

export function messageErrorHandler(errors) {
    let messageReturn = {};
    errors = errors.response.data || errors;

    if (errors !== null) {
        if (!isArray(errors) && !isObject(errors)) {
            errors = [errors];
        }

        messageReturn = manageMessage(errors);
    }

    return messageReturn;
}
