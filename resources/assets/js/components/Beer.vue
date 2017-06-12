<template>
    <div class="beer-container" v-if="isLoad" v-on:click="clickShowMore">
        <img class="img-responsive" v-if="beer.labels"  :src="beer.labels.icon">
        <img class="img-responsive" v-else-if="!beer.labels" :src="'/img/no-image.png'">
        <div class="information">
            <div class="title">{{beer.nameDisplay}}</div>
            <ul>
                <li>by {{brewery.name}}</li>
                <li>{{beer.abv}}°</li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</template>

<script>
    export default {
        mounted() {
            if(this.model){
                this.loadData();
            }
                
        },
        props : ['model'],
        data: function(){
            return {
                beer : this.model,
                brewery : [],
                isLoad : false,
                information : []
            }
        },
        methods : {
            loadData : function(){
                this.$http.get('/beer/'+this.beer.id).then(response => {  
                    if(response.body.status === "success"){
                        this.brewery = response.body.data[0];
                    }else{
                        this.brewery.name = 'Unknow'
                    }
                    this.isLoad = true;
                }, response => {
                    
                });
            },
            clickShowMore : function(){
                this.information = [this.beer,this.brewery]
                this.$emit('showMore', this.information);
            }
        },
        computed :{
        }
    }
</script>
