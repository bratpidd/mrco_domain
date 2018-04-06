<template>

    <div id="about" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Post</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="">
                            <div class="form-group">
                                <label for="title" class="col-md-2 control-label">Title</label> <!--TITLE-->

                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control" name="title" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-md-2 control-label">Text</label> <!--TEXT-->

                                <div class="col-md-8">
                                    <textarea id="content" class="form-control" name="content" rows = '15' required></textarea>
                                </div>
                            </div>






                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="form-group">
                            <label for="tags" class="col-md-2 control-label">Tags</label> <!--TAGS-->

                            <div class="col-md-8">
                                <input v-model="nextTagTitle" v-on:keyup.enter="addNewTag" id="tags" type="text" class="form-control" name="tags" value="">
                            </div>
                            <div class="panel col-md-offset-2 col-md-8 form-inline" style="min-height: 50px;">
                                <h3>
                                    <!--  <div v-for="n in 10" class="form-group paddy">
                                          <span class="label label-default span-margin" >tag {{n}}<a class="canceltag" href="#">🗙</a></span> -->
                                    <tag-item
                                            v-for="(tag, index) in tags"
                                            v-bind:key="tag.id"
                                            v-bind:title="tag.title"
                                            v-on:nigger="removeTag(index)"
                                            >
                                    </tag-item>
                                    <!--    </div> -->
                                </h3>
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
                nextTagTitle: '',
                tags: [
                    {
                        id: 1,
                        title: 'dick'
                    }
                    ],
                nextTagId: 2,
            }
            },
        methods: {
            addNewTag: function(){
                this.tags.push({
                    id: this.nextTagId++,
                    title: this.nextTagTitle
                });
                this.nextTagTitle='';

            },
            removeTag: function(id){
                this.tags.splice(id, 1);
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