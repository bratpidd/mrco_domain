<template>
    <div v-if="cross"  class="form-group">
        <span class="label span-margin" :class="label_class">{{title}}
            <a href="javascript:void(0)" class="canceltag" v-on:click="$emit('tag_remove')">🗙
            </a>
        </span>
    </div>

    <div v-else class="form-group">
        <a href = "javascript:void(0)" @click = "$emit('tag_add', title)">
            <span class="label span-margin" :class="label_class">{{title}}
            </span>
        </a>
    </div>
</template>

<script>
    export default {
        name: "tag_item",
        props: {
            title: {
                type: String,
                required: true
            },
            label_class: {
                type: String,
                required: true
            },
            cross: {
                type: Boolean
            }
        }
    }
</script>

<style scoped>

</style>