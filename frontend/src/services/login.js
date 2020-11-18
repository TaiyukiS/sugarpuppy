import { axiosInstance as axios, updateAxiosHeaders } from 'src/boot/axios'

import LocalStorage from './LocalStorage'

async function login (email, senha) {
  console.log(email,senha)
  try {
    const dadosUsuario = await axios
      .post('/login', {
        email,
        senha
      })
    LocalStorage.set('login', dadosUsuario)

    updateAxiosHeaders(dadosUsuario)
    return dadosUsuario
  } catch (error) {
    return await Promise.reject(error)
  }
}

export default {
  login
}
