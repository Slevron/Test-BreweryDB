<template>
    <div class="col-md-12 all-height">
        <div class="col-md-12" v-if="!showMore && isLoad">
            <div class="col-md-2">
                <label class="col-md-12">Just Beer organic</label>
                <div class="btn-group col-md-12" role="group" aria-label="...">
                    <button type="button" class="btn btn-default" v-bind:class="{'btn-primary': selectOrganic}"  v-on:click="clickOrganic(true)">Yes</button>
                    <button type="button" class="btn btn-default" v-bind:class="{'btn-primary': !selectOrganic}" v-on:click="clickOrganic(false)">No</button>
                </div>
            </div>
        </div>
        <div class="spinner" v-if="!isLoad"></div>
        <div class="col-md-12 scroll-container scroll-custom" v-if="!showMore && isLoad">   
            <div v-for="item in beers" class="col-md-12">
                <beer :model="item" v-on:showMore="clickShowMore($event)"></beer>    
            </div>            
        </div>
        <beerInfo :show="showMore" :model="beer" :modelBrewery="brewery" v-on:close="clickClose()"></beerInfo>
    </div>
</template>

<script>
    export default {
        mounted() {
            const that = this;
            this.loadData();
            bus.$on('showMore', function (event) {
                that.clickShowMore(event)
            })
        },
        data: function(){
            return {
                beers : [],
                showMore : false,
                beer: [],
                brewery: [],
                isLoad: false,
                selectOrganic : false
            }
        },
        methods : {
            loadData : function(){
                this.$http.get('/beers').then(response => {
                    this.beers = response.body.data;
                    this.isLoad = true;
                }, response => {

                });
            },
            clickShowMore : function(event){
                this.beer     = event[0];
                this.brewery  = event[1];
                this.showMore = true;
            },
            clickClose : function(){
                this.beer     = [];
                this.brewery  = [];
                this.showMore = false;
                this.isLoad   = false;
                this.loadData();
            },
            clickOrganic : function(value){
                this.selectOrganic = value;
                if(this.selectOrganic){
                    this.oldBeers = this.beers;
                    this.beers = _.filter(this.beers, function(o) { return o.isOrganic === 'Y'; });
                }else{
                    this.beers = this.oldBeers
                }
            }
        },
        computed :{
 
        }
    }
</script>
