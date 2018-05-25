<template>
    <div style="position:relative" v-bind:class="{'open': openSuggestion && (textfocus||suggestionsfocus)}"
       >
        <input class="form-control" type="text" :value="value"
               @focus="setTextFocus()"
               @blur="unsetTextFocus()"
               @input="updateValue($event.target.value)"
               @keydown.enter = 'enter'
               @keydown.down = 'down'
               @keydown.up = 'up'
               @keydown.space = "$emit('key_space')"
        >
        <ul class="dropdown-menu" style="width:100%"

            @mouseover="setSuggestionsFocus()"
            @mouseout="unsetSuggestionsFocus()"
        >

            <li v-for="(suggestion, index) in matches"
                v-bind:class="{'active': isActive(index)}"
                @click="suggestionClick(index)"
            >
                <a href="#">{{ suggestion.text }} <small>{{ suggestion.state }}</small>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "autocomplete",
        props: {
            value: {
                type: String,
                required: true
            },
            suggestions: {
                type: Array,
                required: true
            }
        },

        data (){
            return {
                open: false,
                current: 0,
                textfocus: false,
                suggestionsfocus: false,
            }
        },

        computed: {
            matches () {
                //return this.suggestions.filter((obj) => {
                  //  return obj.text.toLowerCase().indexOf(this.value.toLowerCase()) >= 0
                //}
                return this.suggestions;
            },

            openSuggestion () {
                //console.log(this.value)
                return this.value !== '' &&
                    this.matches.length !==0 &&
                     this.open === true;
            }
        },

        methods: {
            setTextFocus() {
                this.textfocus = true;
                //console.log('tf true')
            },

            unsetTextFocus(){
                this.textfocus = false;
                //console.log('tf false')

            },

            setSuggestionsFocus() {
                this.suggestionsfocus = true;
                //console.log('sf true')

            },

            unsetSuggestionsFocus(){
                this.suggestionsfocus = false;
               // console.log('sf false')

            },

            updateValue (value) {
                if (this.open === false) {
                    this.open = true;
                    this.current = 0;
                }
                this.$emit('input_AC', value)
            },

            enter () {
                let TextToEmit = this.value;
                let thiss = this;
                if (thiss.matches[thiss.current] !== undefined)
                    {TextToEmit = this.matches[this.current].text}
                this.$emit('input_AC', TextToEmit);
                this.$emit('submit');
                this.open = false;
            },

            up () {
                if (this.current > 0) {
                    this.current--;
                }
            },

            down () {
                if (this.current < this.matches.length-1) {
                    this.current++;
                }
            },

            isActive (index) {
                return index === this.current
            },

            suggestionClick (index) {
                this.$emit('input_AC', this.matches[index].text);
                this.$emit('submit');
                this.open = false;
            }
        }
    }
</script>

<style scoped>

</style>