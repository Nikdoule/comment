<template>
  <div>
    <form class="form-group" @submit.prevent="submitReply">
      <label for="exampleFormControlTextarea1"></label>
      <input
        class="text-input p-2 box-area mb-2"
        value
        v-model="form.author"
        placeholder="Autheur"
      />
      <h6 v-if="errors.author" style="color: red" class="ml-2">The Author is required</h6>
      <textarea
        class="text-area p-2 mt-2 mb-2 box-area"
        :class="{ 'border border-danger': errors.body }"
        v-model="form.body"
        cols="50"
        rows="1"
        placeholder="Ton Message"
      ></textarea>
      <h6 v-if="errors.body" style="color: red" class="ml-2">The comment is required</h6>
      <button type="submit" class="btn btn-success btn-block">
        Envoyer
      </button>
    </form>
  </div>
</template>

<script>
export default {
  props: ["comment-ids"],
  data() {
    return {
      close: true,
      form: {
        body: "",
        author: "",
        comment_id: this.commentIds,
        url: window.location.href,
        close:false
      },
      errors: {},
    };
  },
  methods: {
    submitReply(close) {
      axios
        .post("/replies", this.form)
        .then(({ data }) => {
          this.$emit("closeReply", this.form.close);
          this.$emit("openReplyButton", true)
          this.$emit("newReply", data);
          this.errors = "";
          this.form.body = "";
          this.form.author = "";
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
</style>














