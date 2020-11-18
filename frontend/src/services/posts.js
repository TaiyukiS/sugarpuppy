import { axiosInstance as axios } from 'src/boot/axios'

async function get (filtros) {
  try {
    return axios
      .get('/posts', { params: filtros })
  } catch (error) {
    return await Promise.reject(error)
  }
}

async function like (idPost) {
  try {
    return axios
      .post(`/posts/${idPost}/like`)
  } catch (error) {
    return await Promise.reject(error)
  }
}

async function dislike (idPost) {
  try {
    return axios
      .post(`/posts/${idPost}/dislike`)
  } catch (error) {
    return await Promise.reject(error)
  }
}

async function publicar (body) {
  try {
    return axios
      .post('/posts', body)
  } catch (error) {
    return await Promise.reject(error)
  }
}

async function atualizar (idPost, body) {
  try {
    return axios
      .put('/posts/' + idPost, body)
  } catch (error) {
    return await Promise.reject(error)
  }
}

async function apagar (idPost) {
  try {
    return axios
      .delete('/posts/' + idPost)
  } catch (error) {
    return await Promise.reject(error)
  }
}

export const PostService = {
  get,
  like,
  dislike,
  publicar,
  atualizar,
  apagar
}
