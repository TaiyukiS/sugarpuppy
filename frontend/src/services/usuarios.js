import { axiosInstance as axios } from 'src/boot/axios'

function get (filtros) {
  return axios
    .get('/usuarios', { params: filtros })
    .catch((error) => Promise.reject(error))
}
export const UserService = {
  get
}
