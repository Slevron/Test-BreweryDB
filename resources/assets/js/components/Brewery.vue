<template>
    <div class="brewery-container col-md-12">
        <img class="img-responsive pull-left col-md-6 col-md-offset-3" v-if="brewery.images" :src="brewery.images.medium">
        <div class="information col-md-12">
            <div class="title">
                <a :href="brewery.website" target="_blank">{{brewery.name}}</a>
            </div>
            <ul>
                <li>{{brewery.description}}</li>
                <li v-if="brewery.established">Since {{brewery.established}}</li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        props : ['model'],
        data: function(){
            return {
                brewery : this.model

            }
        },
        watch : {
            model : function (value) {
                this.brewery = value;
            }
        },
        methods : {
        },
        computed :{
        }
    }
</script>
