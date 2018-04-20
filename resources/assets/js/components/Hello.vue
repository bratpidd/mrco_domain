<template>
    <div class="hello">
        <h1>{{ msg }}</h1>
        <h2>Essential Links</h2>
        <ul>
            <li><a href="https://vuejs.org" target="_blank">Core Docs</a></li>
            <li><a href="https://forum.vuejs.org" target="_blank">Forum</a></li>
            <li><a href="https://gitter.im/vuejs/vue" target="_blank">Gitter Chat</a></li>
            <li><a href="https://twitter.com/vuejs" target="_blank">Twitter</a></li>
            <br>
            <li><a href="http://vuejs-templates.github.io/webpack/" target="_blank">Docs for This Template</a></li>
        </ul>
        <h2>Ecosystem</h2>
        <ul>
            <li><a href="http://router.vuejs.org/" target="_blank">vue-router</a></li>
            <li><a href="http://vuex.vuejs.org/" target="_blank">vuex</a></li>
            <li><a href="http://vue-loader.vuejs.org/" target="_blank">vue-loader</a></li>
            <li><a href="https://github.com/vuejs/awesome-vue" target="_blank">awesome-vue</a></li>
        </ul>

        <div>
            <ul>
                <li v-for="user in users">
                    {{user.lastname}} {{user.lastname}}
                </li>
            </ul>
        </div>
        <div>
            <input type="text" v-model="input_val"><br>
            Input Value: <span v-text="input_val"></span>
        </div>
        <input type="button" id="btn1" :value="btn_text[0]" v-on:click="ajax_retarded">
        <span id="SPAN1">SPAN1</span>
        <a href="/login" v-if = login_link>zaloginsya debil</a>
    </div>
</template>
<script>

    export default {
        name: 'hello',
        data () {
            return {
                msg: 'wwwel to Your Vue.js App',
                users: [
                    {firstname: 'Sebastian', lastname: 'Eschweiler'},
                    {firstname: 'Bill', lastname: 'Smith'},
                    {firstname: 'John', lastname: 'Porter'}
                ],
                input_val: '',
                login_link: false,
                btn_text: [],
            }

        },
        methods: {
            ajax_retarded: function (event) {
                let thiss = this;
                // `this` внутри методов указывает на экземпляр Vue
                //alert('Привет, ' + this.name + '!')
                // `event` — нативное событие DOM
                //if (event) {
                   // alert(event.target.tagName)
                //}

                axios.post('/test_post', {
                    firstName: 'Fred',
                    lastName: 'Flintstone',
                   // _token: csrf_token,

                })
                    .then(function (response) {
                        //document.getElementById('btn1').value = 'poshel nahuy';
                        console.log(response);

                        let resp = response.data.username;
                        //let resp=response.data;
                        thiss.login_link = true;
                        thiss.btn_text[0] = "t";
                       // btn = document.getElementById('btn1');
                        //alert(resp);
                        if (resp) {
                            //btn.value = resp;
                            thiss.login_link = false;
                            thiss.btn_text[0] = resp;
                        } else {
                           // btn.value = "poshel nahuy";
                           // btn.value = resp;
                            thiss.login_link = true;
                            thiss.btn_text[0] = 'poshel nahuy';
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        }
    }


</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    h1, h2 {
        font-weight: normal;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        display: inline-block;
        margin: 0 10px;
    }
    a {
        color: #42b983;
    }
</style>