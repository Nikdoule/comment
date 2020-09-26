<template>
    <div>
        <form class="form-group" @submit.prevent="submitComment">
            <label for="exampleFormControlTextarea1"></label>
            <input
                class="text-input p-2 box-area mb-2"
                :class="{ 'border border-danger': errors.author }"
                value
                v-model="form.author"
                placeholder="Autheur"
            />
            <h6 v-if="errors.author" style="color: red;" class="ml-2">
                The Author is required
            </h6>
            <textarea
                class="text-area p-2 mt-2 mb-2 box-area"
                :class="{ 'border border-danger': errors.body }"
                v-model="form.body"
                name
                id
                cols="52"
                rows="1"
                placeholder="Ton Message"
            ></textarea>
            <h6 v-if="errors.body" style="color: red;" class="ml-2">
                The comment is required
            </h6>
            <button type="submit" class="btn btn-success btn-lg btn-block">
                Envoyer
            </button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                body: "",
                author: "",
                url: window.location.href
            },
            errors: {},
            
        };
    },
    methods: {
        submitComment() {
            axios
                .post("/comments", this.form)
                .then(({ data }) => {
                    console.log(data)
                    this.$emit('newComment', data)
                    this.errors = "";
                    this.form.body = "";
                    this.form.author = "";
                    
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        }
    }
};
</script>

<style lang="scss" scoped></style>
