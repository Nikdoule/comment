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
        <span class="date text-right">Il y a  {{ format(comment.created_at) }}</span>
      </span>
    </div>
    <form class="form-group" @submit.prevent="submitComment">
      <label for="exampleFormControlTextarea1"></label>
        <input class="text-input p-2 box-area mb-2" :class="{'border border-danger' : errors.author}" value v-model="form.author" placeholder="autheur" />
      <h6 v-if="errors.author" style="color: red;" class="ml-2">The Author is required</h6>
        <textarea
          class="text-area p-2 mt-2 mb-2 box-area" :class="{'border border-danger' : errors.body }"
          v-model="form.body"
          name
          id
          cols="52"
          rows="1"
          placeholder="Ton commentaire"
        ></textarea>
      <h6 v-if="errors.body" style="color: red;" class="ml-2">The comment is required</h6>
      <button type="submit" class="btn btn-success btn-lg btn-block">Envoyer</button>
    </form>
  </div>
</template>

<script>
import { format, formatDistance, formatRelative, subHours } from 'date-fns'
import { fr } from 'date-fns/locale'
export default {
  
  data() {
    return {
      form: {
        body: "",
        author: "",
        url: window.location.href,
      },
      errors: {},
      comments: []
    };
  },
  mounted() {
    axios.get('/comments/'+btoa(window.location.href))
    .then(({data}) => {
      this.comments = data
    })
  },
  methods: {
    submitComment() {
      axios
        .post("/comments", this.form)
        .then(({ data }) => {
          this.comments.push(data);
          this.errors = "";
          this.form.body = "";
          this.form.author = "";
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
    format(date){
      return formatDistance(new Date(date), new Date(), {locale: fr})
    }
  }
};
</script>
