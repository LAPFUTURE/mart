<template>
  <div class="hello">
    <!-- <div>
        <img v-bind:src="img" v-on:click="clickImg">
        <span v-on:click="clickLeft">左</span>
        <span v-on:click="clickRight">右</span>
        <span v-on:click="clickSpan2016">2016</span>
        <span v-on:click="clickSpan2017">2017</span>
        <span v-on:click="clickSpanOthers">others</span>
    </div> -->
    <cards></cards>
  </div>
</template> 

<script>

import Cards from './Cards' 

export default {
    name: 'HelloWorld',

    components:{
       "cards" : Cards
    },

    data () {
        return {
        times:0,//点击左右按钮次数，初始值为0

        target:"/static/img/16-1-1.png",//初始图片16级第一张正面

        picture:['/static/img/16-1-1.png','/static/img/16-1-2.png'],

        pictures:[['/static/img/16-1-1.png','/static/img/16-1-2.png'],
                  ['/static/img/16-2-1.png','/static/img/16-2-2.png'],
                  ['/static/img/16-3-1.png','/static/img/16-3-2.png']
             ],//初始切换卡片为16级三张

        allpictures:[
                     [['/static/img/16-1-1.png','/static/img/16-1-2.png'],
                      ['/static/img/16-2-1.png','/static/img/16-2-2.png'],
                      ['/static/img/16-1-1.png','/static/img/16-1-2.png']],
                     [['/static/img/17-1-1.png','/static/img/17-1-2.png'],
                      ['/static/img/17-2-1.png','/static/img/17-2-2.png'],
                      ['/static/img/17-3-1.png','/static/img/17-3-2.png']],
                     [['/static/img/o-1-1.png','/static/img/o-1-2.png'],
                      ['/static/img/o-2-1.png','/static/img/o-2-2.png'],
                      ['/static/img/o-3-1.png','/static/img/o-3-2.png']]],
        }
    },

    methods:{
        clickSpan2016(){
            this.times = 0;
            this.pictures = this.allpictures[0];
            this.picture  = this.pictures[0];
            this.target   = this.picture[0];
        },
        clickSpan2017(){
            this.times = 0;
            this.pictures = this.allpictures[1];
            this.picture  = this.pictures[0];
            this.target   = this.picture[0];
        },
        clickSpanOthers(){
            this.times = 0;
            this.pictures = this.allpictures[2];
            this.picture  = this.pictures[0];
            this.target   = this.picture[0];
        },
        
        clickLeft(){ 
            this.times = this.times - 1;
            var picturesNumber = Object.getOwnPropertyNames(this.pictures).length-2;
            if(this.times < 0){
                this.times = picturesNumber-1;
                this.picture = this.pictures[this.times];
                this.target   = this.picture[0];//左边越界
            }else{
                this.picture = this.pictures[this.times];
                this.target   = this.picture[0];//在中间
            }
        },

        clickRight(){
            // console.log(this.times);
            this.times = this.times + 1;
            var picturesNumber = Object.getOwnPropertyNames(this.pictures).length-2;
            // console.log("picturesNumber:",picturesNumber);
            // console.log("this.times:",this.times);
            if(this.times > picturesNumber-1){
                this.times   = 0;
                // console.log(this.times);
                this.picture = this.pictures[this.times];
                this.target  = this.picture[0];//右边越界
            }else{
                this.picture = this.pictures[this.times];
                // console.log(this.picture);
                this.target  = this.picture[0];//在中间
            }
        },

        clickImg(){
            if(this.target == this.picture[0]){
                this.target = this.picture[1];
            }else{
                this.target = this.picture[0];
            }
        },

    },

    computed:{
        img(){
            return this.target;
        }
    }

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
/*div{}*/
/*span{border: 1px solid black;width: 20px;}*/
</style>
