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
        axios.post('/backend/images/download', images, { responseType: 'blob'})
            .then(response => {
                const url = URL.createObjectURL(new Blob([response.data], { type: 'application/zip'}))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute(
                    'download',
                    `photo ${new Date().toGMTString()}.zip`
                )
                document.body.appendChild(link)
                link.click()
                resolve(response)
            })
            .catch(err => {
                reject(err)
            })
    })
}