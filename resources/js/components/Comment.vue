<template>
  <div
    class="box-com rounded-top rounded-bottom p-2 mt-5 d-flex flex-column bg-secondary"
  >
    <div class="text-center mt-3 d-flex flex-column align-items-start align-items-center">
      <div
        class="com p-2 mb-3 d-flex flex-column shadow text-white col-12"
        v-for="comment in comments"
        :key="comment.id"
      >
        <div class="p-2 d-flex flex-column shadow com" >
          <span class="author text-left">{{ comment.author }}</span>
          <span class="text-left body">{{ comment.body }}</span>
          <span class="date text-left"
            >Il y a {{ format(comment.created_at) }}</span
          >
        </div>
        <div
          class="com p-2 mb-3 mt-3 ml-5 flex-column shadow text-white"
          v-for="reply in replies"
          :key="reply.id"
          v-show="reply.comment_id == comment.id"
          :class="{ 'd-flex': reply.comment_id == comment.id }"
        >
          <span class="author text-left">{{ reply.author }}</span>
          <span class="text-left body">{{ reply.body }}</span>
          <span class="date text-right"
            >Il y a {{ format(reply.created_at) }}</span
          >
        </div>
        <button v-show="replyButton" class="btn btn-success mt-3" @click="showForm(comment.id)">
          reply
        </button>
        <replies-form
          v-show="showReply ? getCommentId == comment.id : ''"
          @newReply="replies.push($event)"
          @closeReply="showReply = $event"
          @openReplyButton="replyButton = $event"
          v-bind:comment-ids="comment.id"
        ></replies-form>
      </div>
    </div>
    <comment-form @newComment="comments.push($event)"></comment-form>
  </div>
</template>

<script>
import CommentForm from "./CommentForm.vue";
import RepliesForm from "./RepliesForm.vue";
import { format, formatDistance, formatRelative, subHours } from "date-fns";
import { fr } from "date-fns/locale";

export default {
  components: { CommentForm, RepliesForm },
  data() {
    return {
      comments: [],
      replies: [],
      showReply: false,
      getCommentId: "",
      replyButton: true
    };
  },
  mounted() {
    axios.get("/comments/" + btoa(window.location.href)).then(({ data }) => {
      this.comments = data;
    }),
      axios.get("/replies/" + btoa(window.location.href)).then(({ data }) => {
        this.replies = data;
      });
  },
  methods: {
    format(date) {
      return formatDistance(new Date(date), new Date(), { locale: fr });
    },
    showForm(e) {
      this.hid = true
      this.getCommentId = e;
      this.showReply = true;
      this.replyButton = false
    },
  },
};
</script>
<style lang="scss" scoped>

</style>