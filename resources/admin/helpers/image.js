export function list(query) {
    return new Promise((resolve, reject) => {
        axios.get('/backend/images/list', { params: query })
            .then(result => {
                resolve(result.data);
            })
            .catch(err => {
                reject(err)
            })
    })
}