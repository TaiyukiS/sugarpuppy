import { axiosInstance as axios, updateAxiosHeaders } from 'src/boot/axios'

import LocalStorage from './LocalStorage'

async function login (email, senha) {
  try {
    const dadosUsuario = await axios
      .post('/login', {
        email,
        senha
      })
    LocalStorage.set('login', dadosUsuario)

    updateAxiosHeaders()
    return dadosUsuario
  } catch (error) {
    return await Promise.reject(error)
  }
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
  updateAxiosHeaders()
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
  updateAxiosHeaders()
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
