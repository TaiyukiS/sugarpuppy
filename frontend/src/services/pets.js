import { axiosInstance as axios } from 'src/boot/axios'

function getPets (filtros) {
  return axios
    .get('/pets', filtros)
    .catch((error) => Promise.reject(error))
}

export const PetService = {
  getPets
}
