 <template>
  <div class="cards">
    <div class="courseLogo">
        <div v-bind:class="{courseBefore:yes,courseAfter:no}" 
             v-bind:style="{backgroundImage: 'url('+ imgFront + ')'}" 
             v-on:click="clickImg" id="front">
        </div>
        <div v-bind:class="{courseBefore:no,courseAfter:yes}"  
             v-bind:style="{backgroundImage: 'url('+ imgBack + ')'}"  
             v-on:click="clickImg" id="back" >
        </div>
    </div>
        <span v-on:click="clickLeft">左</span>
        <span v-on:click="clickRight">右</span>
        <span v-on:click="clickSpan2016">2016</span>
        <span v-on:click="clickSpan2017">2017</span>
        <span v-on:click="clickSpanOthers">others</span>
  </div>
</template>

<script>
export default {
    name: 'Cards',

    data () {
        return {
        yes:true,
        no:false,
        
        timeClickImg:0,//记录是否第一次点击图片
        times:0,//点击左右按钮次数，初始值为0
        
        frontColor:"black",
        targetFront:"/static/img/16-1-1.png",//初始图片16级第一张正面
        targetBack :"/static/img/16-1-2.png",
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
            this.targetFront  = this.picture[0];
            this.targetBack  =  this.picture[1];
            this.timeClickImg = 0;
        },
        clickSpan2017(){
            this.times = 0;
            this.pictures = this.allpictures[1];
            this.picture  = this.pictures[0];
            this.targetFront  = this.picture[0];
            this.targetBack  =  this.picture[1];
            this.timeClickImg = 0;

        },
        clickSpanOthers(){
            this.times = 0;
            this.pictures = this.allpictures[2];
            this.picture  = this.pictures[0];
            this.targetFront  = this.picture[0];
            this.targetBack  =  this.picture[1];
            this.timeClickImg = 0;
        },
        
        clickLeft(){ 
            this.times = this.times - 1;
            var picturesNumber = Object.getOwnPropertyNames(this.pictures).length-2;
            if(this.times < 0){
                this.times = picturesNumber-1;
                this.picture = this.pictures[this.times];
                this.targetFront  = this.picture[0];//左边越界
                this.targetBack  =  this.picture[1];
                this.timeClickImg = 0;
            }else{
                this.picture = this.pictures[this.times];
                this.targetFront  = this.picture[0];//在中间
                this.targetBack  =  this.picture[1];
                this.timeClickImg = 0;
            }
        },

        clickRight(){
            this.times = this.times + 1;
            var picturesNumber = Object.getOwnPropertyNames(this.pictures).length-2;
            if(this.times > picturesNumber-1){
                this.times   = 0;
                this.picture = this.pictures[this.times];
                this.targetFront  = this.picture[0];//右边越界
                this.targetBack  =  this.picture[1];
                this.timeClickImg = 0;
            }else{
                this.picture = this.pictures[this.times];
                this.targetFront  = this.picture[0];//在中间
                this.targetBack  =  this.picture[1];
                this.timeClickImg = 0;
            }
        },

        clickImg(){
                if(this.timeClickImg == 0){
                   this.timeClickImg++;//如果是第一次点击就不让它执行else的代码块
                }else{
                    this.yes = !this.yes;
                    this.no  = !this.no; //courseAfter和Before交替切换
                }   
        },

    },

    computed:{
        activeColor(){
            return this.frontColor;
        },
        imgFront(){
            return this.targetFront;
        },
        imgBack(){
            return this.targetBack;
        }
    }

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
span{border: 1px solid black;width: 20px;}
 
.courseLogo{
    width: 274px;
    height: 437px;
    /*float: left;
    margin-top: 1px;*/
    position: relative;
    box-sizing: border-box;
    /*perspective: 800px;*/
}

.courseBefore{
    width: 100%;
    height: 100%;
    position: absolute;
    top:0;
    left: 10%;
    background-repeat: no-repeat;
    background-position: center center;
    backface-visibility: hidden;
    transition: 1s;
    background-color: pink;

}
.courseAfter{
    width: 100%;
    height: 100%;
    position: absolute;
    top:0;
    left: 10%;
    color: #fff;
    background-color: dodgerblue;
    text-indent: 2em;
    transform: rotateY(-180deg);
    backface-visibility: hidden;
    transition: 1s;
}

 .courseLogo:hover .courseBefore{
    transform: rotateY(180deg);
}

.courseLogo:hover .courseAfter{
    transform: rotateY(0deg);
}

</style>
