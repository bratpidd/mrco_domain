<template>

    <div id="about" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Post</div>
                    <div class="panel-body">
                        <form v-on:submit.prevent id="formPost" class="form-horizontal" method="POST" action="">
                            <div class="form-group">
                                <label for="title" class="col-md-2 control-label">Title</label> <!--TITLE-->

                                <div class="col-md-8">
                                    <input v-model="post_title" id="title" type="text" class="form-control" name="title" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-md-2 control-label">Text</label> <!--TEXT-->

                                <div class="col-md-8">
                                    <textarea v-model="post_text" id="content" class="form-control" name="content" rows = '5' required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tags" class="col-md-2 control-label">Tags</label> <!--TAGS-->

                                <div class="col-md-8">
                                    <input v-model="nextTagTitle" @keyup.enter="addNewTag" id="tags" type="text" class="form-control" name="tags" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                        <div class="col-md-offset-2 col-md-8 form-inline" >
                                            <h3>
                                                <tag-item
                                                        v-for="(tag, index) in post_tags"
                                                        v-bind:key="tag.id"
                                                        v-bind:title="tag.title"
                                                        v-on:nigger="removeTag(index)"
                                                        >
                                                </tag-item>
                                            </h3>
                                        </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="button" class="btn btn-primary" v-on:click="post_submit">
                                        Submit
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'about',
        data(){
            return {
                nextTagTitle: '',
                post_title:'',
                post_text:'',
                post_tags: [],
                nextTagId: 1,
            }
        },

        methods: {
            addNewTag: function(){

                for (let tag of this.post_tags){
                    if ((this.nextTagTitle == tag.title) || (this.nextTagTitle.length == 0)) {
                        return;
                    }
                }

                this.post_tags.push({
                    id: this.nextTagId++,
                    title: this.nextTagTitle
                });
                this.nextTagTitle='';

            },

            removeTag: function(id){
                this.post_tags.splice(id, 1);
            },

            post_submit: function (event){
//alert(this.post_title);
                if (this.post_text.length == 0){
                    alert('rejected: text is emeptu');
                    return;
                }

                if (this.post_title.length === 0){
                    alert('rejected: title is emptu');
                    return;
                }

                let resp={};
                axios.post('/vue_newpost', {
                    title: this.post_title,
                    content: this.post_text,
                    tags: this.post_tags
                })
                    .then(function(response) {
                        console.log(response);
                        resp = response.data;
                        alert(resp);
                        window.location.href='/';
                })
                .catch(function (error) {
                    console.log(error);

                });

            }


        }
    }
</script>

<style scoped>
    #about {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: left;
        /*color: #2c3e50;*/
        /*margin-top: 60px;*/
    }

</style>