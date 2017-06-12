<template>
    <div class="brewery-info-container col-md-12" v-if="beers.length > 0">
        <div class="col-md-12 title">
            Other Beer by {{brewery.name}}
        </div>
        <div class="col-md-3 beers" v-for="beer in beers" v-on:click="clickShowMore(beer)">
            <img class="img-responsive" v-if="beer.labels"  :src="beer.labels.medium">
            <img class="img-responsive" v-else-if="!beer.labels" :src="'/img/no-image.png'">
            <div class="title">{{beer.nameDisplay}}</div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            if(this.model){
                this.loadData()
            }
        },
        props : ['model'],
        data: function(){
            return {
                brewery : this.model,
                beers : [],
                isLoad: false
            }
        },
        watch : {
            model : function (value) {
                if(this.brewery !== value){
                    this.brewery = value; 
                }
                this.loadData();
            }
        },
        methods : {
            loadData : function(){
                this.isLoad = false;
                this.$http.get('/brewery/'+this.brewery.id).then(response => {  
                    if(response.body.status === "success"){
                        this.beers = _.shuffle(response.body.data);
                        this.beers = _.slice(this.beers, 0, 4);
                        this.isLoad = true;
                        bus.$emit('isLoad', this.isLoad);
                    }else{
                        this.beers = [];
                    }
                }, response => {
                    
                });
            },
            clickShowMore : function(beer){
                this.information = [beer,this.brewery]
                bus.$emit('showMore', this.information);
            }
        },
        computed :{
        }
    }
</script>

