import createPersistedState from 'vuex-persistedstate'

export default new Vuex.Store({
  // ...
  plugins: [createPersistedState()]
})