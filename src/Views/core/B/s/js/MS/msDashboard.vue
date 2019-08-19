<template>

    <div>
        <div class="fixed ">
            <nav class="flex items-center justify-between flex-wrap bg-teal-100 p-6  object-cover">
                <div v-on:click="hideNavBar($event)" class="flex items-center flex-shrink-0 text-black mr-6">
                    <svg   class="fill-current h-8 w-8 mr-2 ms-company-logo" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
                    <span :class="{'hidden':!msNavBar}" class="font-semibold text-xl tracking-tight">Company Name</span>
                </div>
                <div class="block lg:hidden">
                    <button v-on:click="clickToggaleButton" class="flex items-center px-3 py-2 border rounded text-black-200 text-black-200 hover:text-white hover:border-white">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                </div>
                <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto " :class="{
        'hidden':!msMenuOn,

        }">
                    <div class="text-sm lg:flex-grow text-right" :class="{'ms-hidden-fix':!msNavBar}">

                        <span

                            class="fa fa-plus inline-block inline-block text-sm px-4 py-2 leading-none border rounded text-black border-teal-300 hover:border-teal-900  hover:text-teal-900 hover:bg-blue mt-4 lg:mt-0" ></span>
                        <a href="#responsive-header" :class="{'hidden':!msNavBar}" class="block mt-4 inline-block lg:mt-0 text-black-200 hover:text-teal-500 mr-4">
                            Docs
                        </a>

                        <span class="fa fa-plus inline-block inline-block text-sm px-4 py-2 leading-none border rounded text-black border-teal-300 hover:border-teal-900  hover:text-teal-900 hover:bg-blue mt-4 lg:mt-0" ></span>
                        <a href="#responsive-header" :class="{'hidden':!msNavBar}" class="block mt-4 inline-block lg:mt-0 text-black-200 hover:text-teal-500 mr-4">
                            Examples
                        </a>

                        <span class="fa fa-plus inline-block inline-block text-sm px-4 py-2 leading-none border rounded text-black border-teal-300 hover:border-teal-900  hover:text-teal-900 hover:bg-blue mt-4 lg:mt-0" ></span>
                        <a href="#responsive-header":class="{'hidden':!msNavBar}" class="block mt-4 inline-block lg:mt-0 text-black-200 hover:text-teal-500">
                            Blog
                        </a>
                    </div>
                    <div class="ml-3">
                        <a href="#" class="inline-block text-sm px-4 py-2 leading-none border rounded text-black border-teal-300 hover:border-teal-900  hover:text-teal-900 hover:bg-blue mt-4 lg:mt-0">Download</a>
                    </div>
                </div>
            </nav>
        </div>

        <ms-menubar ref="msMenull" :ms-nav ="msNavOn" ></ms-menubar>

        <div style=""
        :class="{
        'ms-livebox border-t border-b border-l shadow ':true,
        'ms-livebox-full':!msNavOn
        }"
        >
            <msviewpanel></msviewpanel>

        </div>
    </div>
</template>

<script>
    import msMenubar from './msMenubar';
    export default {
        name: "msdashboard",
        data() {
            return {
                msNavOn:true,
                msMenuOn:false,
                msNavBar:true,
                bus: new Vue(),


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
                    console.log(this.$refs['msMenull'][0].fromOtherCom('hideNav'));
                }


            },
            hideNavBar($event){
                if (this.msNavBar){
                    this.msNavBar=false;
                }else {
                    this.msNavBar=true;
                }

            }


        }

        ,

        components : {
            msMenubar
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
    .ms-company-logo{
        cursor: pointer;
    }
    .hidden{
        @appply hidden;
        @apply overflow-hidden;
    }
    .ms-hidden-fix{
        padding-left: 80px;
    }

</style>
