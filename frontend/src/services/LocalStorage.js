import { LocalStorage } from 'quasar'

const PREFIX = 'br.com.sugarpuppy_'

export default {
  set: (key, value) => {
    try {
      const jsonValue = JSON.stringify(value)
      LocalStorage.set(PREFIX + key, jsonValue)
      return true
    } catch (e) {
      console.log(e)
      return false
    }
  },
  get: (key) => {
    try {
      const value = LocalStorage.getItem(PREFIX + key)
      return JSON.parse(value)
    } catch (e) {
      console.log(e)
      return false
    }
  },
  delete: (key) => {
    try {
      LocalStorage.remove(PREFIX + key)
      return true
    } catch (e) {
      console.log(e)
      return false
    }
  },
  clear: () => {
    try {
      LocalStorage.clear()
      return true
    } catch (e) {
      console.log(e)
      return false
    }
  }
}
