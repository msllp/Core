<template>
    <div  class=" ms-live-tab  "   contextmenu.prevent="rightClick($event)">
        <ul class="flex border-b cursor-pointer">

            <li

                :class="{
                '-mb-px shadow-inner bg-teal-200 ':checkActive(index),
                ' ':true
                }"

                 v-for="(tab,index) in allTab" v-on:click="tabClicked(index)">
                <a

                :class="{
                ' inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold':checkActive(index),
                'inline-block py-2 px-4 border-t border-r border-l border-t  text-blue-500 hover:text-blue-800 font-semibold':!checkActive(index)
                }"
>{{tab.modDView}} <span class="fa fa-window-close " v-on:click="deleteTab(index)"></span></a >

            </li>
            <li
                :class="{

                'ml-1 mr-1 ':true,
                'hidden':!(this.maxTabLimit > this.allTab.length)
                }"
                v-on:click="addNewTab({ tabCode:'01',
                    modCode:'New Tab',
            modDView:'New Tab',
            modUrl:'/newtab',
            data:''})"
            > <span class="fa fa-plus p-3 border-l border-r border-t "></span></li>

        </ul>

        <div class="flex flex-wrap">
            <div v-for="(tab,index) in allTab" class="flex">


                <div
                    :class="{
                'hidden':!checkActive(index),
                'visible ':checkActive(index),

                }"
                   >
                    <mswindow :ms-data="tab"  :index="index"  :ref= "index" > </mswindow>


            </div>

        </div>
        <div :class="{
' inset-x-0 bottom-0 pl-3 border-t':true}
">

            {{ getModCoode()}}
        </div>

    </div>
    </div>
</template>

<script>
    import  MS  from './C/MS';
    import  MDD from 'mobile-device-detect';
    export default {
        name: "msviewpanel",
        props:{},
        mixins:[MS],
        mounted(){
           if ( window.innerWidth < 800  )this.maxTabLimit=3;
            let sampleData=[
                {
                    tabCode:'01',
                    modCode:"MAS",
                    modDView:"Make image for Container",
                    modUrl:"/DCM/action/make/image",
                    data:""
                },

                ];
            this.currentTab=0;
            this.allTab=sampleData;



        },
        data:function () {
            return {
                allTab:[],
                currentTab:0,
                maxTabLimit:5


            };
        },
        methods:{

            tabClicked(index){
              //  console.log(index);
                this.currentTab=index;
            }
            ,
            checkActive(index){
                if(index==this.currentTab)return true;
                return false;
            },
            getModCoode(){
                var mObj=this.allTab[this.currentTab];

                if (mObj === undefined) {       //if t=undefined, call tt
                //    console.log(this.allTab)      //call t
                }else {
                    return mObj.modDView.toString();

                }

            },rightClick(event){

                // screenX/Y gives the coordinates relative to the screen in device pixels.
              //  console.log(event.screenX);
                //console.log(event.screenY);

            },
            deleteTab(index){
             //   console.log("deltetTab")
                delete this.allTab.splice(index, 1);
            },
            addNewTab(data){
                if(this.maxTabLimit > this.allTab.length){
                    data.tabCode=this.ms_rand(5,1);
                    this.allTab.push(data);
                }else{
                    alert("Opps... Max tab limit reached. Contact Million Solution to Increase it.");
                    console.log("Limite: "+this.maxTabLimit+" current lenth: "+this.allTab.length);

                }
            },
            addActionToTab(data){
                //delete this.allTab[this.currentTab];
              //  console.log(this.allTab.length);

                if(this.allTab.length < 1){
                    data.tabCode=this.ms_rand(5,1);
                    data.modCode="MAS";

                    this.addNewTab(data);
                }else{
                    this.allTab[this.currentTab].modDView=data.modDView;
                }
                //

                this.$refs[this.currentTab][0].updateTab(data);
            }

        },
        watch:{},

    }
</script>

<style scoped>
    .shadow-lg{
        transition: all 400ms ease-in-out;
    }
    .ms-live-tab{
        @apply px-1;
        @apply py-2;
    }

</style>
