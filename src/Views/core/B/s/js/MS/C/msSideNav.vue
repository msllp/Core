<template>

    <div class="ms-nav-mian-div" style="">


        <div class="flex flex-wrap ms-nav-div" v-if="currentMainTab">

            <div v-for="mainNav,index in msData" class="ms-main-title" v-on:click="setMainTab(index)">
                <div class="">

                    <i v-if="mainNav.hasOwnProperty('icon')" :class="mainNav.icon"></i>

                    <span>{{mainNav.text}}</span>

                </div>

            </div>

        </div>

        <div class="flex-wrap ms-nav-div" v-if="!currentMainTab">
            <div class="ms-main-title" v-on:click="backToMain">
                <i class="fas fa-backward"></i>
                back to Main Navigation
            </div>

            <div v-for="mainNav,index in msData" class="ms-main-title" v-if="currentSubTab == index">
                <div class="">

                    <i v-if="mainNav.hasOwnProperty('icon')" :class="mainNav.icon"></i>

                    <span>{{mainNav.text}}</span>

                    <div v-if="mainNav.hasOwnProperty('sub')">
                        <div v-for="subMainNav in mainNav.sub" class="ms-main-title">
                        {{subMainNav.text}}
                        </div>


                    </div>

                </div>

            </div>
        </div>




    </div>



</template>

<script>
    import  MS  from './MS';
    export default {
        name: "mssidenav",
        mixins:[MS],
        props:{
//TODO: Remove this
            'msNav':{
                type: Boolean,
                required: true,
                default:true
            },
      },
        data(){
            return {
                msData:null,
                currentMainTab:true,
                currentSubTab:0
            }
        },
        methods:{
            getData(){

             //   alert(this.msPath);
               // this.getGetRaw(this.msPath,this,'setData');
            //    console.log( this.msPath) ;
            },
            setData(data){
                this.msData=data;
              //  console.log(data);
            },
            setMainTab(index){
                this.currentMainTab=false;
                this.currentSubTab=index;
            },
            backToMain(){
                this.currentMainTab=true;
                this.currentSubTab=0;
            }

        },
        mounted() {
            this.getData();
        }
    }
</script>

<style scoped>
    div> .menu__link{
        @apply block;
        @apply p-2;
        width: 250px;
        @apply bg-teal-300;
        @apply border-t;

    }
    .context-menu-container{
        margin-left:252px ;
        top:80px;
        min-width: 200px;
        @apply bg-teal-400;
        @apply border-t;
        @apply fixed;
    }

    .menu__title{
        margin-left: 0px;
    }
    .menu__top{
        min-width:228px;
        padding: 0px 0px 0px 0px;
        background: rgba(35,37,38,1);
        border-top-left-radius: 0px;
        border-bottom-left-radius: 50px;
    }
    .menu__top_hidden > .menu__top{
        min-width:50px;
        animation: animate2 ease-out;
        animation-delay: 0s;
        animation-duration: 500ms;
    }


</style>
