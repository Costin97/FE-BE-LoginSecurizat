import "./assets/style.css";
import { createApp } from "vue";
import App from "./App.vue";
import axios from "axios";
import router from "./router";
import { createStore } from 'vuex'

axios.defaults.headers.common["Access-Control-Allow-Origin"] = "*";

const store = createStore({
  state() {
    return {
      token: "",
    };
  },
  mutations: {
    setToken(state,val) {
      state.token = val;
    },
  },
});

const app = createApp(App);

app.use(router);
app.use(store);

app.mount("#app");
