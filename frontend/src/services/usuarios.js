import { axiosInstance as axios } from 'src/boot/axios'

function get (filtros) {
  return axios
    .get('/usuarios', { params: filtros })
    .catch((error) => Promise.reject(error))
}

function follow (id) {
  return axios
    .post(`/usuarios/${id}/follow`)
    .catch((error) => Promise.reject(error))
}

function unfollow (id) {
  return axios
    .post(`/usuarios/${id}/unfollow`)
    .catch((error) => Promise.reject(error))
}

export const UserService = {
  get,
  follow,
  unfollow
}
