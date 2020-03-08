<template>

    <div class="ms-dashboard-container" :class="{'ms-dark-mode':this.msDarkMode}">
        <div class="fixed w-full ms-nav-container shadow " >
            <nav class="flex items-center justify-between flex-wrap lg:p-1  object-cover " style="min-height: 70px;">

                <div class="flex items-center flex-shrink-0 lg:hidden" >

                <div @click.prvent="hideNavOnlyForMobile($event)" class="ms-nav-btn" :class="{'ms-nav-btn-active':!msNavBar,'border':msNavBar}"  >
                                      <i class="fas fa-level-down-alt p-1" :class="{
                'ms-animation fa-rotate-90':!msNavBar,
                'ms-animation':msNavBar,

                }"></i>


                </div>

                    <div v-if="false" class="ms-nav-btn" :class="{
                        'ms-nav-btn-active':!msNavBar,'border':msNavBar
                    }"  @click.prevent="onCalac($event,67)" >

                        <i class="fi flaticon-technological p-1" :class="{
                'ms-animation fa-rotate-90':!msNavBar,

                }"></i>


                    </div>

            </div>




                <div v-on:click="hideNavBar($event)" class="flex items-center flex-shrink-0 mr-6">

                    <img src="/images/logo.png" class="fill-current h-12 mr-2 ms-company-logo " >



                </div>
                <div v-if="false" class="block lg:hidden">
                    <button v-on:click="clickToggaleButton" class="flex items-center px-3 py-2 border rounded text-black-200 text-black-200 hover:text-white hover:border-white">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                </div>

                <div class='ms-dashboard-right-nav-box'>
                    <div class="ms-dashboard-right-nav-btn" v-on:click="oprateNotificationBox">
                        <div class="ms-dashboard-right-nav-btn-notification">
                        <svg class="">
                        <use xlink:href="#msicon-svg-notification-read" />
                        </svg>
                        </div>
                    </div>

                    <div class="ms-dashboard-right-nav-btn " v-on:click="oprateProfileBox" >
                        <div class="ms-dashboard-right-nav-btn-profile" >

                            <span >{{msUserData.Username.charAt(0)}}</span>

                        </div>
                    </div>
                </div>

            </nav>

            <div :class="{
        'ms-dashboard-profile-box':msProfileDiv,
        'ms-dashboard-profile-box-hidden':!msProfileDiv,


        }">
                <div class="ms-dashboard-profile-body">

                    <div class="ms-dashboard-profile-user-box ">
                        <svg  class="ms-dashboard-profile-user-icon">
                            <use v-bind:xlink:href="'#msicon-svg-user-'+msUserData.sex+'-1'" />
                        </svg>

                    </div>

                    <hr class="ms-dashboard-profile-hr">
                    <div class="text-center">{{msUserData.Username}}
                    <br>{{msUserData.email}}
                    </div>
                    <hr class="ms-dashboard-profile-hr">
                    <div class="ms-dashboard-profile-footer">

                        <div class="ms-dashboard-profile-edit-btn" v-on:click="openProfile">

                        <svg  class="ms-dashboard-profile-edit-icon">
                            <use xlink:href="#msicon-svg-user-edit" />
                        </svg>
                            <span>Edit Profile</span>
                        </div>
                        <div class="ms-dashboard-profile-signout-btn">
                    <span>Log out</span>
                            <svg  class="ms-dashboard-profile-signout-icon">
                                <use xlink:href="#msicon-svg-user-signout" />
                            </svg>
                        </div>


                    </div>
                    <hr class="ms-dashboard-profile-hr">
                    <div class="ms-dashboard-profile-footer">
                        <span class="flex">Switch mode : </span>
                        <div class="ms-dashboard-profile-darkmode-btn " v-on:click="darkModeToggel">

                            <span>
<i class="ms-dashboard-profile-darkmode-icon fi2 flaticon-replace" :class="{
                              'flaticon-replace':msDarkMode
                          }"></i>
                                {{(msDarkMode)?'Light':'Dark'}} </span>

                        </div>
                    </div>

                </div>


            </div>


        <div :class="{
        'ms-dashboard-profile-box':msNotificationDiv,
        'ms-dashboard-profile-box-hidden':!msNotificationDiv,


        }">
                <div class="ms-dashboard-profile-body">

                    <div class="ms-dashboard-profile-user-box ">
                        <small>Notification</small>
                        <svg  class="ms-dashboard-profile-user-icon">
                            <use v-bind:xlink:href="'#msicon-svg-user-'+msUserData.sex+'-1'" />
                        </svg>

                    </div>

                    <hr class="ms-dashboard-profile-hr">
                    <div class="text-center">{{msUserData.Username}}
                    <br>{{msUserData.email}}
                    </div>
                    <hr class="ms-dashboard-profile-hr">
                    <div class="ms-dashboard-profile-footer">

                        <div class="ms-dashboard-profile-edit-btn" v-on:click="openProfile">

                        <svg  class="ms-dashboard-profile-edit-icon">
                            <use xlink:href="#msicon-svg-user-edit" />
                        </svg>
                            <span>Edit Profile</span>
                        </div>
                        <div class="ms-dashboard-profile-signout-btn">
                    <span>Log out</span>
                            <svg  class="ms-dashboard-profile-signout-icon">
                                <use xlink:href="#msicon-svg-user-signout" />
                            </svg>
                        </div>

                    </div>

                </div>


            </div>

        </div>



        <mssidenav :class="{'ms-nav-mian-div-hidden':!msNavBar,'ms-nav-mian-div':msNavBar}"  ref="msMenuSide" :ms-nav ="msNavOn"  ></mssidenav>

        <div style=""
        :class="{
        'ms-livebox ':true,
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
                msProfileDiv:false,
                msNotificationDiv:false,

                msUserData:{
                    Username:'maxirooney',
                    sex:'male',
                    email:'user@company.com',

                },


            }
        },
        props:{
            'msData':{
                type: Object,
                required: true
            }

        }
        ,
        methods:{
            openProfile(){
                if(this.msProfileDiv)this.msProfileDiv=false;
                var data ={
                    modCode:"USERS4O3",
                    modDView:"View Profile",
                    modUrl:"/o3/User/profile"};

                this.$refs['ms-live-tab'].addActionToTab(data);
            },
            oprateProfileBox(){

                this.msProfileDiv=(this.msProfileDiv)?false:true;
                if(this.msNotificationDiv)this.msNotificationDiv=false;
            },
            oprateNotificationBox(){
                if(this.msProfileDiv)this.msProfileDiv=false;
                this.msNotificationDiv=(this.msNotificationDiv)?false:true;
            },
            onCalac(event,kCode){
                window.vueApp.msShortCut(event,kCode);
            },
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
            },

            darkModeToggel(){
                this.$root.$data.msDarkMode=(this.$root.$data.msDarkMode)?false:true;
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
        computed : {
            msDarkMode(){
             //   console.log(this.$root.$data.msDarkMode);
                return this.$root.$data.msDarkMode;
            }

        }
    }
</script>

<style scoped>


</style>
