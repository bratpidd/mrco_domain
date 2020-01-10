<template>

    <div id="about" class="container">
        <div class="">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Post</div>
                    <div class="panel-body">
                        <form class="form-horizontal">

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

                            <div class="form-group row">
                                <label for="tags" class="col-md-2 control-label">Tags</label> <!--TAGS-->

                                <div class="col-md-3">
                                    <autocomplete :suggestions="AC_sugg"  :value= "tagInput"
                                        @input_AC = "ACInputHandler($event)"
                                        @submit = "addNewTag"
                                        id = "tags"
                                    ></autocomplete>
                                </div>
                                <div class="col-md-5">
                                    <button type="button" class="btn btn-primary pull-right" v-on:click="post_submit">
                                        Submit New Post!
                                    </button>
                                </div>

                            </div>

                        </form>

                        <div class="row" style="margin-top: 15px">

                            <div class="col-md-2">
                                <label v-if="false" class="pull-right padding-top-sm" for="accepted_tags">Your Tags:
                                </label>
                            </div>

                            <div id="accepted_tags" class="col-md-8 form-inline paddy_zero margin-bottom-md">
                                <tag_item
                                        class="font_tag paddy_tags"
                                        v-for = "(tag, index) in post_tags"
                                        v-bind:key = "tag.id"
                                        v-bind:title = "tag.title"
                                        @tag_remove = "removeTag(index)"
                                        label_class = "label-success"
                                        :cross = true
                                >
                                </tag_item>
                                <tag_item
                                        class="font_tag paddy_tags"
                                        v-if = "post_tags.length === 0"
                                        label_class = "label-info"
                                        title = "No tags so far"
                                        :cross = false
                                >
                                </tag_item>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <label v-if="suggested_tags.length !== 0" class="pull-right text-muted" for="suggested_tags">Suggested Tags:
                                </label>
                            </div>

                            <div id="suggested_tags" class=" form-inline paddy_zero">
                                <tag_item
                                        class="font_tag_sugg paddy_tags_sugg"
                                        v-for = "(tag, index) in suggested_tags"
                                        :title = "tag.title"
                                        :key = "index"
                                        label_class = "label-default"
                                        @tag_add = "addSuggestedTag($event, index)">
                                </tag_item>
                            </div>
                        </div>

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
                suggested_tags: [],

                nextTagTitle: '',
                post_title:'',
                post_text:'',
                post_tags: [],
                nextTagId: 1,
                tagInput: '',
                AC_sugg: [],
            }
        },

        methods: {
            requestSuggestedTags: function(){
                let tags=[];
                let thiss = this;
                this.post_tags.forEach(function(item){
                    tags.push(item.title);
                });
                console.log(tags);
                axios.post('/suggested_tags', {
                    tags: tags,
                })
                    .then(function(response){
                        thiss.suggested_tags=[];
                        let sug_tags = response.data;
                        sug_tags.forEach(function(item){
                            thiss.suggested_tags.push({title: item.title})
                        });
                        //console.log(sug_tags);
                    })
                    .catch(function (error) {
                    console.log(error);
                });

            },

            tagWritten: function (tag) {
                let resp = false;
                this.post_tags.forEach(function (item) {
                    if (tag === item.title){
                        //console.log('true!');
                        resp = true;
                    }
                    //console.log(item.title);
                });
                return resp;
            },

            ACInputHandler(event){
                let sel = this.tagInput = event;
                let thiss = this;
                axios.post('/get_tags', {
                    searchString: sel,
                })
                    .then(function (response){
                        let tags = response.data;
                        thiss.AC_sugg = [];
                        tags.forEach(function (item){
                            if (!thiss.tagWritten(item)){
                                thiss.AC_sugg.push({text: item, state: ''});
                            }
                        });
                        //console.log(sug);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            addSuggestedTag(event, id){
                this.post_tags.push({
                    id: this.nextTagId++,
                    title: event
                });
                this.requestSuggestedTags();
                //alert (event);
            },

            addNewTag: function(){

                for (let tag of this.post_tags){
                    if ((this.tagInput === tag.title) || (this.tagInput.length === 0)) {
                        return;
                    }
                }

                this.post_tags.push({
                    id: this.nextTagId++,
                    title: this.tagInput
                });
                this.tagInput='';
                this.requestSuggestedTags();

            },

            removeTag: function(id){
                this.post_tags.splice(id, 1);
                this.requestSuggestedTags();
            },

            post_submit: function (event){
//alert(this.post_title);
                if (this.post_text.length === 0){
                    alert('rejected: text is emptou');
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
        font-family: 'Raleway', 'sans-serif';
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: left;
        /*color: #2c3e50;*/
        /*margin-top: 60px;*/
    }

</style>