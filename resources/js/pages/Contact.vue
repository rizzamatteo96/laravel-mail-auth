<template>
  <div class="container">
    <h1>Contattaci</h1>
    <div v-if="success" class="alert alert-success">
      Messaggio inviato
    </div>
    <form @submit.prevent="sendForm">
      <div class="mb-3">
        <label for="name" class="form-label">Nome utente</label>
        <input v-model="name" type="text" class="form-control" id="name" name="name">
        <div v-for="(error, i) in errors.name" :key="i" class="alert alert-danger">
          {{error}}
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input v-model="email" type="email" class="form-control" id="email" name="email">
        <div v-for="(error, i) in errors.email" :key="i" class="alert alert-danger">
          {{error}}
        </div>
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Messaggio</label>
        <textarea v-model="message" type="message" class="form-control" id="message" name="message"></textarea>
        <div v-for="(error, i) in errors.message" :key="i" class="alert alert-danger">
          {{error}}
        </div>
      </div>
      <button type="submit" class="btn btn-primary"> {{sending ? 'Invio in corso...' : 'Invia'}} </button>
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
      errors: {},
      sending: false,
      success: false
    }
  },
  methods: {
    sendForm(){
      let data = {
        'name': this.name,
        'email': this.email,
        'message': this.message
      };

      this.sending = true;

      axios.post('/api/contacts', data)
            .then(response => {
              // console.log(response);
              this.sending = false;

              if (!response.data.success) {
                this.errors = response.data.errors;
                console.log(this.errors);
                this.success = false;
              } else {
                this.success = true;
                this.name = '';
                this.email = '';
                this.message = '';
              }

            })
            .catch(errors => {
              this.sending = false;
              console.log(errors);
            });
    }
  }
}
</script>

<style lang="scss" scoped>

</style>