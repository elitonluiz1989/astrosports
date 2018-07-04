let showOnLog;

function manageMessage(messages) {
    let errorMessages = [];
    for (let key in messages) {
        if (messages[key] instanceof Array || messages[key] instanceof Object) {
            errorMessages.push(...manageMessage(messages[key]));
        } else {
            let message = messages[key];
            if (message.indexOf("[show-user]") !== -1) {
                errorMessages.push(message.replace("[show-user]", ""));
            } else {
                if (showOnLog) {
                    console.error(message);
                }
            }
        }
    }

    return errorMessages;
}

export function messageErrorHandler(errors, requestMessageOnLog) {
    showOnLog = requestMessageOnLog || true;
    let _errors = null;
    let messageReturn = {};

    if (errors.data !== undefined && errors.data.errors !== undefined) {
        _errors = errors.data.errors;
    } else if (errors.message !== undefined) {
        _errors = errors.message;
    } else {
        _errors = errors;
    }

    if (_errors !== null) {
        if (_errors instanceof Array || _errors instanceof Object) {
            messageReturn = manageMessage(_errors);
        } else {
            if (showOnLog) {
                console.error(_errors);
            }
        }
    }

    return messageReturn;
}
