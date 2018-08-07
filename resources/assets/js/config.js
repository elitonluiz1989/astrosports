/**
 * Defines the API route
 */
const api_url = window.location.origin + '/api';
const google_key = "AIzaSyAAKp4YSno6--i2Bk5r9Hz2uiC4qcxS2Ok";
const photos_path = 'storage/photos/';
const photo_anonymous  = photos_path + 'anonymous.png';

export const CONFIG = {
    API_URL: api_url,
    GOOGLE_KEY: google_key,
    PHOTOS: {
        PATH: photos_path,
        DEFAULT: photo_anonymous
    },
    REQUEST: {
        DEFAULT_ERROR_MESSAGE: "Houve um erro no carregamento da página.",
        MESSAGE_ON_LOG: true
    }
};