/**
 * Defines the API route
 */
var request_url = window.location.origin + '/dashboard';
const google_key = "AIzaSyAAKp4YSno6--i2Bk5r9Hz2uiC4qcxS2Ok";
const photos_path = 'storage/photos/';
const photo_anonymous  = photos_path + 'anonymous.png'

export const CONFIG = {
    REQUEST_URL: request_url,
    GOOGLE_KEY: google_key,
    PHOTOS: {
        PATH: photos_path,
        DEFAULT: photo_anonymous
    }
};