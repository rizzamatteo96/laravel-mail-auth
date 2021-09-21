<template>
  <div class="container">
    <form @submit.prevent="sendForm">
      <div class="mb-3">
        <label for="name" class="form-label">Nome utente</label>
        <input v-model="name" type="text" class="form-control" id="name" name="name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input v-model="email" type="email" class="form-control" id="email" name="email">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Messaggio</label>
        <textarea v-model="message" type="message" class="form-control" id="message" name="message"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'Contact',
  data(){
    return {
      name: '',
      email: '',
      message: '',
      errors: {}
    }
  },
  methods: {
    sendForm(){
      axios.post('/api/contacts', {
        'name': this.name,
        'email': this.email,
        'message': this.message
      })
        .then(response => {
          console.log(response);
        })
        .catch(errors => {
          console.log(errors);
        });
    }
  }
}
</script>

<style lang="scss" scoped>

</style>