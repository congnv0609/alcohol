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

export function download(images) {
    return new Promise((resolve, reject) => {
        axios.post('/backend/images/download', images)
            .then(response => {
                const url = URL.createObjectURL(new Blob([response.data]))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute(
                    'download',
                    `${new Date().toLocaleDateString()}.zip`
                )
                document.body.appendChild(link)
                link.click()
            })
            .catch(err => {
                reject(err)
            })
    })
}