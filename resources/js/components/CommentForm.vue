<template>
  <div class="box-com rounded-top rounded-bottom p-2 mt-5 d-flex flex-column bg-primary">
    <div class="text-center mt-3 d-flex flex-column align-items-start">
      <span
        class="com p-2 mb-3 d-flex flex-column shadow text-white"
        v-for="comment in comments"
        :key="comment.id"
      >
        <span class="author text-left">{{ comment.author }}</span>
        <span class="body">{{ comment.body }}</span>
        <span class="date text-right">{{ comment.created_at }}</span>
      </span>
    </div>
    <form class="form-group" @submit.prevent="submitComment">
      <label for="exampleFormControlTextarea1"></label>
      <div class="box-area mb-2">
        <input class="text-input p-2" value v-model="form.author" placeholder="autheur" />
      </div>
      <h6 v-if="errors.author" style="color: red;">The comment is required</h6>
      <div class="box-area mt-2 mb-2">
        <textarea
          class="text-area p-2"
          v-model="form.body"
          name
          id
          cols="52"
          rows="1"
          placeholder="Ton commentaire"
        ></textarea>
      </div>
      <h6 v-if="errors.body" style="color: red;">The comment is required</h6>
      <button type="submit" class="btn btn-success btn-lg btn-block">Envoyer</button>
    </form>
  </div>
</template>

<script>
export default {
  props: ["dataComments"],
  data() {
    return {
      form: {
        body: "",
        author: ""
      },
      errors: {},
      comments: this.dataComments
    };
  },
  mounted() {
    
  },
  methods: {
    submitComment() {
      axios
        .post("/comments", this.form)
        .then(({ data }) => {
          this.comments.push(data);
          this.errors = "";
          this.form.body = "";
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    }
  }
};
</script>
