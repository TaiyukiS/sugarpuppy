import { axiosInstance as axios } from 'src/boot/axios'

function get (filtros) {
  return axios
    .get('/pets', { params: filtros })
    .catch((error) => Promise.reject(error))
}

function like (idPet) {
  return axios
    .post(`/pets/${idPet}/like`)
    .catch((error) => Promise.reject(error))
}

function dislike (idPet) {
  return axios
    .post(`/pets/${idPet}/dislike`)
    .catch((error) => Promise.reject(error))
}

function getCaracteristicas () {
  return axios
    .get('/pets/caracteristicas')
    .catch((error) => Promise.reject(error))
}

export const PetService = {
  get,
  like,
  dislike,
  getCaracteristicas
}
