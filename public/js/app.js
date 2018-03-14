Vue.prototype.$http = axios;

var app = new Vue({
    el: '#app',

    data: {
        comments: [],
        thread: [],
        body: '',
        thread_id: -1,
        auth_id: -1,
        edit_thread: false,
        edit_comment: -1,
    },

    created() {
        this.thread_id = window.location.pathname.split('/')[2];
        this.getComment();
        this.getUser();
        this.getThread();
    },

    methods: {
        isLike: function (likes) {

            if (likes != null) {
                const result = likes.filter(like => like.user_id == this.auth_id);

                if (result != null && result.length > 0)
                    return true;
            }

            return false;
        },

        countLike: function (likes) {
            if (likes != null) {
                return likes.length;
            }
            return 0;
        },

        getComment: function () {
            this.$http.get('/comment/' + this.thread_id).then(response => this.comments = response.data);
        },

        getThread: function () {
            this.$http.get('/getthread/' + this.thread_id).then(response => this.thread = response.data);
        },

        getUser: function () {
            this.$http.get('/user').then(response => this.auth_id = response.data);
        },

        createComment: function () {
            this.$http.post('/comment', {
                body: this.body,
                thread_id: this.thread_id
            });
            this.body = '';
            this.getComment();
        },

        setLike: function (comment_id, event) {
            event.preventDefault();
            this.$http.post('/like', {
                comment_id: comment_id
            });
            this.getComment();
        },
        deleteLike: function (comment_id, event) {
            event.preventDefault();

            this.$http.delete('/like/' + comment_id);
            this.getComment();
        },
        deleteComment: function (comment_id, event) {
            event.preventDefault();

            this.$http.delete('/comment/' + comment_id);

            this.getComment();

        },

        editComment: function (comment, event) {
            event.preventDefault();

            this.$http.post('/comment/edit', {
                'body': comment.body,
                'user_id': comment.user_id,
                'id': comment.id,
                'thread_id': comment.thread_id
            });

            this.edit_comment = -1;

            this.getComment();
        },

        editThread: function (thread, event) {
            event.preventDefault();


            this.$http.post('/thread/edit', {
                'body': thread.body,
                'user_id': thread.user_id,
                'id': thread.id,
                'title': thread.title
            });

            this.edit_thread = false;
            this.getComment();
        },

        setEditThread: function (event) {
            event.preventDefault();
            if (this.edit_thread)
                this.edit_thread = false;
            else
                this.edit_thread = true;
        },

        setEditComment: function (id_comment,event) {
            event.preventDefault();
            if(this.edit_comment === -1)
                this.edit_comment = id_comment;
            else
                this.edit_comment = -1;
        },

        deleteThread: function () {
            this.$http.delete('/thread/delete/' + this.thread_id);
        }

    },

});