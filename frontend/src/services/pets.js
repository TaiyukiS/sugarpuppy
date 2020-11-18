import { axiosInstance as axios } from 'src/boot/axios'

import LocalStorage from './LocalStorage'

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

function getMeus () {
  return axios
    .get('/pets/meus')
    .then((pets) => {
      LocalStorage.set('pets', pets)
      return pets
    })
    .catch((error) => Promise.reject(error))
}

export const PetService = {
  get,
  like,
  dislike,
  getCaracteristicas,
  getMeus
}
