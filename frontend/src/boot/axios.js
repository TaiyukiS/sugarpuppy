import axios from 'axios'

import LocalStorage from '../services/LocalStorage'

const axiosInstance = axios.create({
  baseURL: 'http://localhost/sugarpuppy',
  headers: {
    'Content-Type': 'application/json',
    'api-key': 'c4e00bb8f7d21b50fc56a91d775f61d2'
  }
})

axiosInstance.interceptors.response.use((response) => {
  if (response.data.status !== 200) {
    return Promise.reject(response.data)
  }

  return response.data.dados
})

const updateAxiosHeaders = (headers) => {
  axiosInstance.interceptors.request.use((config) => {
    config.headers['access-key'] = headers.access_key
    config.headers['id-usuario'] = headers.id_usuario
    if (config.headers['id-pet']) {
      config.headers['id-pet'] = headers.id_pet
    } else {
      delete config.headers['id-pet']
    }
    return config
  })
}

const { CancelToken } = axios
const createSource = () => CancelToken.source()

export { axiosInstance, updateAxiosHeaders }
export default async ({ Vue }) => {
  const dadosUsuario = LocalStorage.get('login')

  if (dadosUsuario) {
    updateAxiosHeaders(dadosUsuario)
  }

  Vue.prototype.$axios = axiosInstance
  Vue.prototype.$updateAxiosHeaders = updateAxiosHeaders
  Vue.prototype.$getAxiosSource = createSource
}
