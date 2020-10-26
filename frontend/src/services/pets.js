import { axiosInstance as axios, updateAxiosHeaders } from 'src/boot/axios';

function getPets(filtros) {
  return axios
    .get('/pets', filtros)
    .catch((error) => Promise.reject(error));
}

export default {
  getPets
}