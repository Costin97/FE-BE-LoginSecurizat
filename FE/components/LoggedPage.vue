<template>
  <div class="container">
    <button @click.prevent="logoutMethod" type="submit">LogOut</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      token: this.$store.state.token,
    };
  },
  methods: {
    setup() {
      this.$router.push("/");
    },
    logoutMethod() {
      for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        const item = localStorage.getItem(key);
        console.log(this.token);
        if (item === this.token) {
          localStorage.removeItem("token");
          break;
        }
      }
      this.setup();
    },
  },
};
</script>
