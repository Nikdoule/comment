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
    <comment-form @newComment="comments.push($event)"></comment-form>
  </div>
</template>

<script>
import  CommentForm from "./CommentForm.vue"
import { format, formatDistance, formatRelative, subHours } from 'date-fns'
import { fr } from 'date-fns/locale'

export default {
  components:{CommentForm},
  data() {
    return{
      comments: []
    }
    
  },
  mounted() {
    axios.get('/comments/'+btoa(window.location.href))
    .then(({data}) => {
      this.comments = data
    })
  },
  methods: {
    
    format(date){
      return formatDistance(new Date(date), new Date(), {locale: fr})
    }
  }
};
</script>
