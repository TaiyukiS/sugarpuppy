import { axiosInstance as axios } from 'src/boot/axios'

function get (filtros) {
  return axios
    .get('/posts', { params: filtros })
    .catch((error) => Promise.reject(error))
}

function like (idPost) {
  return axios
    .post(`/posts/${idPost}/like`)
    .catch((error) => Promise.reject(error))
}

function dislike (idPost) {
  return axios
    .post(`/posts/${idPost}/dislike`)
    .catch((error) => Promise.reject(error))
}

function publicar (body) {
  return axios
    .post('/posts', body)
    .catch((error) => Promise.reject(error))
}

export const PostService = {
  get,
  like,
  dislike,
  publicar
}
