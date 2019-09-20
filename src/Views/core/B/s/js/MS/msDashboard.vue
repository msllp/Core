<template>

    <div>
        <div class="fixed w-full" >
            <nav class="flex items-center justify-between flex-wrap bg-teal-100  lg:p-1  object-cover " style="min-height: 70px;">
                <div v-on:click="hideNavBar($event)" class="flex items-center flex-shrink-0 text-black mr-6">

                    <img src="/images/logo.png" class="fill-current h-12 mr-2 ms-company-logo hover:shadow-outline hover:bg-gray-200" >
                    <div :class="{'hidden':!msNavBar}" class="font-semibold"> Cloud Services</div>
                </div>
                <div class="block lg:hidden">
                    <button v-on:click="clickToggaleButton" class="flex items-center px-3 py-2 border rounded text-black-200 text-black-200 hover:text-white hover:border-white">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                </div>
                <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto " :class="{
        'hidden':!msMenuOn,

        }">
                    <div v-if="false" class="text-sm lg:flex-grow text-right" :class="{'ms-hidden-fix':!msNavBar,'ms-hidden-fix-2':msNavBar}">

                        <div class="block  lg:inline-flex ms-nav-btn">

                            <a href="#responsive-header" :class="{'hidden':!msNavBar}" class="inline-block mt-2 inline-block text-black-200 hover:text-teal-500 mr-4">

                                Docs
                            </a>
                            <span class="fa fa-plus inline-block  text-sm px-4 py-2 leading-none border rounded text-black border-teal-300 hover:border-teal-900  hover:text-teal-900 hover:bg-blue " ></span>
                        </div>

                        <div class="block  lg:inline-flex  ms-nav-btn">

                        <a href="#responsive-header" :class="{'hidden':!msNavBar}" class="inline-block mt-2 inline-blocktext-black-200 hover:text-teal-500 mr-4">
                            Examples
                        </a>
                            <span class="fa fa-plus inline-block  text-sm px-4 py-2 leading-none border rounded text-black border-teal-300 hover:border-teal-900  hover:text-teal-900 hover:bg-blue " ></span>
                        </div>

                        <div class="block   lg:inline-flex ms-nav-btn">

                        <a href="#responsive-header":class="{'hidden':!msNavBar}" class="inline-block mt-2 inline-block text-black-200 hover:text-teal-500 mr-4">
                            Blog
                        </a>
                            <span class="fa fa-plus inline-block  text-sm px-4 py-2 leading-none border rounded text-black border-teal-300 hover:border-teal-900  hover:text-teal-900 hover:bg-blue  " ></span>
                        </div>
                    </div>

                </div>
            </nav>
        </div>

        <msmenubar ref="msMenull" :ms-nav ="msNavOn" :ms-data2="msMenuData" ></msmenubar>

        <div style=""
        :class="{
        'ms-livebox border-t border-b border-l shadow ':true,
        'ms-livebox-full':!msNavOn
        }"
        >
            <msviewpanel ref="ms-live-tab"></msviewpanel>

        </div>
    </div>
</template>

<script>
    import  MS  from './C/MS';
   // import msMenubar from './msMenubar';
    export default {
        name: "msdashboard", mixins: [MS],
        data() {
            return {
              //  msRoot:app,
                msNavOn:true,
                msMenuOn:false,
                msNavBar:true,
                windowWidth:window.innerWidth,
                msMenuData:{},



            }
        },props:{
            'msData':{
                type: Object,
                required: true
            }

        }
        ,
        methods:{
            setNavOn(show=false,event){

                //this.$children['msMenu'].hideNav();
                
                if(!show){
                    this.msNavOn=false;

                }else {
                    this.msNavOn=true
                }

               // console.log(event.offsetY);

            },
            clickToggaleButton(){

                if (this.msMenuOn){
                    this.msMenuOn=false;
                }else {
                    this.msMenuOn=true;
                    this.$refs['msMenull'].fromOtherCom('hideNav',this.msMenuOn)
                   // console.log();
                }


            },
            hideNavBar($event){
                if (this.msNavBar){
                    this.msNavBar=false;
                }else {
                    this.msNavBar=true;
                }

            },
            driveRequestFromNavToLiveTab(data){

                    this.$refs['ms-live-tab'].addActionToTab(data);
            },

            getDataForSideBar(){
                var data = [
                    {
                        name:'accessToken',
                        value:this.msData.accessToken
                    },

                    {
                        name:'type',
                        value:'json'
                    },
                    {
                        name:'find',
                        value:'sidebar'
                    }

                ];
                var link = this.makeGetUrl(this.msData.path.sidebar,data);
                this.getGetRaw(link,this,'setMenuData');

            },
            setMenuData(data){

                this.msMenuData=data.items;
            }


        },
        mounted() {

            if(this.msNavOn && ( window.innerWidth < 800  ))this.msNavOn=false;
        },
        beforeMount(){
            this.getDataForSideBar();
        }

        ,






        components : {
          //  msMenubar
        }
    }
</script>

<style scoped>
.hidden{
    transition: all 500ms ease-in-out;
}
.ms-livebox{
    min-height: 1000px;
    padding-left:252px;
}
    .ms-livebox-full{
        padding-left: 82px;
    }
    .ms-company-logo {
        cursor: pointer;
        max-height:70px;
    }
    .hidden{
        @appply hidden;
        @apply overflow-hidden;
    }
    .ms-hidden-fix{
        padding-left: 0px;
    }

.ms-hidden-fix-2{
    padding-top: 10px;
    padding-left: 0px;
}

    .ms-nav-btn > .fa {
        margin: 5px;
    }
    .ms-nav-btn > .a {
    padding-top: 8px;
}


</style>
