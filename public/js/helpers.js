import { TIMEOUT_SEC } from "./config.js";

/**
 * 
 * AJAX function make fetch request, trying n times before returning error if occurs
 * 
 * @param {String} url          URL for the fetching
 * @param {Object} uploadData   formData. If undefined, fetch method will be GET, otherwise it is POST
 * @param {String} type         type of data that will be return, basically JSON or Text
 * @param {Number} n            number of tries before returning an error if occurs
 * @returns data from the fetch, in JSON or Text
 */
export const AJAX = async (url, uploadData = undefined, n = 3) => {
    try {
        const fetchData = uploadData ? { method: 'POST', body: uploadData } : {};
        const timeout = function (s) {
            return new Promise(function (_, reject) {
                setTimeout(function () {
                    reject(new Error(`Request took too long! Timeout after ${s} second`));
                }, s * 1000);
            });
        };
        const res = await Promise.race([fetch(url, fetchData), timeout(TIMEOUT_SEC)]);
        if (!res.ok)
            throw new Error(`${res.status}`);
        const data = await res.text();
        return JSON.parse(data);
    } catch (err) {
        if (n === 1) throw err;
        return await AJAX(url, uploadData, n - 1);
    }
}