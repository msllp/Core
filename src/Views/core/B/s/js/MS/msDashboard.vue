<template>

    <div class="ms-dashboard-container">
        <div class="fixed w-full ms-nav-container shadow " >
            <nav class="flex items-center justify-between flex-wrap lg:p-1  object-cover " style="min-height: 70px;">

                <div class="flex items-center flex-shrink-0 lg:hidden" >

                <div @click.prvent="hideNavOnlyForMobile($event)" class="ms-nav-btn" :class="{'ms-nav-btn-active':!msNavBar,'border':msNavBar}"  >

                    <i class="fas fa-ellipsis-v p-1" :class="{
                'ms-animation fa-rotate-90':!msNavBar,

                }"></i>


                </div>

                    <div class="ms-nav-btn" :class="{
                        'ms-nav-btn-active':!msNavBar,'border':msNavBar
                    }"  @click.prevent="onCalac($event,67)" >

                        <i class="fi flaticon-technological p-1" :class="{
                'ms-animation fa-rotate-90':!msNavBar,

                }"></i>


                    </div>

            </div>




                <div v-on:click="hideNavBar($event)" class="flex items-center flex-shrink-0 mr-6">

                    <img src="/images/logo.png" class="fill-current h-12 mr-2 ms-company-logo hover:shadow-outline hover:bg-gray-200" >
                    <div :class="{'hidden':false}" class="font-semibold"> Cloud Services</div>
                </div>
                <div v-if="false" class="block lg:hidden">
                    <button v-on:click="clickToggaleButton" class="flex items-center px-3 py-2 border rounded text-black-200 text-black-200 hover:text-white hover:border-white">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                </div>
                <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto " :class="{
        'hidden':!msMenuOn,

        }">


                </div>
            </nav>
        </div>

        <mssidenav :class="{'ms-nav-mian-div-hidden':!msNavBar,'ms-nav-mian-div':msNavBar}"  ref="msMenuSide" :ms-nav ="msNavOn"  ></mssidenav>

        <div style=""
        :class="{
        'ms-livebox bg-white-200 ':true,
        'ms-livebox-full':!msNavOn,
        'ms-livebox-without-nav':!msNavBar
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
                msMenuData:null,



            }
        },props:{
            'msData':{
                type: Object,
                required: true
            }

        }
        ,
        methods:{
            onCalac(event,kCode){
                window.vueApp.msShortCut(event,kCode);
            }
            ,
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
                   // this.$refs['msMenull'].fromOtherCom('hideNav',this.msMenuOn)
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
              //  console.log(link);
               this.getGetRaw(link,this,'setMenuData');
                  // var Han=this.$refs['msMenuSide'];
              //  this.sendNavDatatoBar();
              //  console.log(this.msMenuData);
                  //  console.log(   this.sendNavDatatoBar());
                  // var root= this.$root;
             //   this.$refs['msMenull'].updateMSmenuData(this.msMenuData);

            },
            sendNavDatatoBar(){
                //return "ok"

            //    this.getDataForSideBar() ;
                return this.msMenuData;

            },
            getNavData(){

                return this.sendNavDatatoBar();
            }

            ,
            setMenuData(data){

                this.msMenuData=data;

                var Han=this.$refs['msMenuSide'];
                Han.setData(this.sendNavDatatoBar().items);
                //  console.log(this.msMenuData);
          //      console.log(   this.sendNavDatatoBar());
                //console.log( this.msMenuData);
            },
            hideNavOnlyForMobile(event){
                this.hideNavBar(event);
            }


        },
        beforeCreate(){

        },
        mounted() {
           this.getDataForSideBar();

            // var data = [
            //     {
            //         name:'accessToken',
            //         value:this.msData.accessToken
            //     },
            //
            //     {
            //         name:'type',
            //         value:'json'
            //     },
            //     {
            //         name:'find',
            //         value:'sidebar'
            //     }
            //
            // ];
            // var link = this.makeGetUrl(this.msData.path.sidebar,data);
            //
            //
            // var data2={
            //
            //     path:link,
            //  //   accessToken:this.msData.accessToken
            //
            // };
            // this.setMenuData(this,data2);





            if(this.msNavOn && ( window.innerWidth < 800  ))this.msNavOn=false;
        },
        beforeMount(){
           // this.getDataForSideBar();
        }

        ,






        components : {
          //  msMenubar
        }
    }
</script>

<style scoped>


</style>
