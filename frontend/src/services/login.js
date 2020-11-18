import { axiosInstance as axios, updateAxiosHeaders } from 'src/boot/axios'

import LocalStorage from './LocalStorage'

function login (email, senha) {
  return axios
    .post('/login', {
      id_empresa: email,
      id_usuario: senha
    })
    .then((dadosUsuario) => {
      LocalStorage.set('login', dadosUsuario)
      updateAxiosHeaders(dadosUsuario)

      return dadosUsuario
    })
    .catch((error) => Promise.reject(error))
}

function iamPet (pet) {
  LocalStorage.set('ispet', { is: true })
  const dadosUsuario = LocalStorage.get('login')
  dadosUsuario.id_pet = pet.id
  dadosUsuario.original_nome = dadosUsuario.nome
  dadosUsuario.nome = pet.nome
  dadosUsuario.original_url = dadosUsuario.url
  dadosUsuario.url = pet.url_foto
  LocalStorage.set('login', dadosUsuario)
  updateAxiosHeaders(dadosUsuario)
}
function iamUSer () {
  LocalStorage.delete('ispet')
  const dadosUsuario = LocalStorage.get('login')
  dadosUsuario.nome = dadosUsuario.original_nome
  dadosUsuario.url = dadosUsuario.original_url
  delete dadosUsuario.id_pet
  delete dadosUsuario.original_nome
  delete dadosUsuario.original_url
  LocalStorage.set('login', dadosUsuario)
  updateAxiosHeaders(dadosUsuario)
}

function logoff () {
  LocalStorage.clear()
}

export const LoginService = {
  login,
  iamPet,
  iamUSer,
  logoff
}
