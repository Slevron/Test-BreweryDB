<template>
    <div class="beer-info-container col-md-12" v-if="showMore" :class="{ active: isLoad}">
        <div class="child-container col-md-8 col-md-offset-2">
            <img class="img-responsive" v-if="beer.labels"  :src="beer.labels.medium">
            <img class="img-responsive" v-else-if="!beer.labels" :src="'/img/no-image.png'">
            <div class="information">
                <div class="title">{{beer.nameDisplay}}</div>
                <ul>
                    <li>by {{brewery.name}}</li>
                    <li>{{beer.description}}</li>
                    <li>{{beer.style.category.name}} - {{beer.abv}}°</li>
                    <li v-if="beer.isOrganic === 'Y'">Organic Beer</li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="child-container-brewery col-md-8 col-md-offset-2">
            <brewery :model="brewery"></brewery>
        </div>
        <div class="child-container col-md-8 col-md-offset-2">
            <breweryBeer :model="brewery"></breweryBeer>
        </div>
        <div class="child-container-brewery col-md-8 col-md-offset-2">
            <button type="button" class="btn btn-default" v-on:click="clickClose">Back</button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            const that = this;
            bus.$on('isLoad', function (event) {
                that.isLoad = event;
            })
        },
        props : ['show', 'model', 'modelBrewery'],
        data: function(){
            return {
                showMore : this.show,
                beer : this.model,
                brewery : this.modelBrewery,
                isLoad : false
            }
        },
        watch : {
            show : function (value) {
                this.showMore = value;
            },
            model : function (value) {
                this.beer = value;
            },
            modelBrewery : function (value) {
                this.brewery = value;
            }
        },
        methods : {
            clickClose : function(){
                this.$emit('close');
            }
        },
        computed :{
        }
    }
</script>
