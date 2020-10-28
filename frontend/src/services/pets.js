import { axiosInstance as axios } from 'src/boot/axios'

function getPets (filtros) {
  return axios
    .get('/pets', filtros)
    .catch((error) => Promise.reject(error))
}

function getCaracteristicas () {
  return axios
    .get('/pets/caracteristicas')
    .catch((error) => Promise.reject(error))
}

export const PetService = {
  getPets,
  getCaracteristicas
}
