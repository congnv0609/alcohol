export function smokers(query) {
    return new Promise((resolve, reject) => {
        axios.get('/backend/smokers/list', {params: query})
            .then(result => {
                resolve(result.data);
            })
            .catch(err => {
                reject(err)
            })
    })
}

export function get(query) {
    return new Promise((resolve, reject) => {
        axios.get(`/backend/smokers/detail/${query.id}`)
            .then(result => {
                resolve(result.data);
            })
            .catch(err => {
                reject(err)
            })
    })
}

export function update(data) {
    return new Promise((resolve, reject) => {
        axios.put(`/backend/smokers/update/${data.id}`, data)
            .then(result => {
                resolve(result.data);
            })
            .catch(err => {
                reject(err)
            })
    })
}

export function overview(id) {
    return new Promise((resolve, reject) => {
        axios.get(`/backend/smokers/overview/user/${id}`)
            .then(result => {
                resolve(result.data);
            })
            .catch(err => {
                reject(err)
            })
    })
}

export function exportData(query) {
    return new Promise((resolve, reject) => {
        axios.get(`/backend/smokers/export`, {responseType: 'blob'})
            .then(response => {
                const url = URL.createObjectURL(new Blob([response.data]))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute(
                    'download',
                    `${new Date().toLocaleDateString()}.xlsx`
                )
                document.body.appendChild(link)
                link.click()
            })
            .catch(err => {
                reject(err)
            })
    })
}

export function exportPersonal(id) {
    return new Promise((resolve, reject) => {
        axios.get(`/backend/smokers/export-personal/${id}`, { responseType: 'blob' })
            .then(response => {
                const url = URL.createObjectURL(new Blob([response.data]))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute(
                    'download',
                    `${new Date().toLocaleDateString()}.xlsx`
                )
                document.body.appendChild(link)
                link.click()
            })
            .catch(err => {
                reject(err)
            })
    })
}