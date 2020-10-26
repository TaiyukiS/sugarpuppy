import { axiosInstance as axios, updateAxiosHeaders } from 'src/boot/axios';

import LocalStorage from './LocalStorage';

function login(email, senha) {
  return axios
    .post('/login', {
      id_empresa: email,
      id_usuario: senha
    })
    .then((dadosUsuario) => {
      LocalStorage.set('login', dadosUsuario);

      updateAxiosHeaders(dadosUsuario);

      return dadosUsuario;
    })
    .catch((error) => Promise.reject(error));
}

export default {
  login
}