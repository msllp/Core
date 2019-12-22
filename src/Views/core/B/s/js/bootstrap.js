
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

window.Vue = require('vue');

var path = require('path');
var appDir = path.dirname(require.main.filename);



//Vue.component('inputtext', require('./components/inputText.vue').default);
//Vue.component('panelbackend', require('./components/panelBackend.vue').default);
//Vue.component('msform', require('./components/msForm.vue').default);
//Vue.component('msinvoice', require('./components/msInvoice.vue').default);
//Vue.component('msgst', require('./components/msGST.vue').default);
Vue.component('msinput', require('./MS/C/msInput.vue').default);
Vue.component('msform', require('./MS/C/msForm.vue').default);
//Vue.component('msmenu', require('./components/msMenu.vue').default);
Vue.component('msviewpanel', require('./MS/msViewpanel.vue').default);
Vue.component('msdashboard', require('./MS/msDashboard.vue').default);
Vue.component('mswindow', require('./MS/msWindow.vue').default);
Vue.component('msmenubar', require('./MS/msMenubar.vue').default);
Vue.component('msdatatable', require('./MS/msDatatable.vue').default);
Vue.component('msdockerdashboard', require('E:/MS-Master/Projects/FrameworkPHP/gst_invoice/Master/MS/B/M/DCM/V/Vue/dockerMasterDashboard.vue').default);
Vue.component('mssidenav', require('./MS/C/msSideNav.vue').default);
Vue.component('newtab', require('./MS/C/msNewTab.vue').default);


Vue.component('mscalc', require('./MS/C/msCalc.vue').default);

Vue.component('mslogin', require('./MS/msLoginPage.vue').default);


//Components


import MS from './MS/C/MS';


var store = {
    debug: true,
    state: {
        message: 'Hello!'
    },
    setMessageAction (newValue) {
        if (this.debug) console.log('setMessageAction triggered with', newValue)
        this.state.message = newValue
    },
    clearMessageAction () {
        if (this.debug) console.log('clearMessageAction triggered')
        this.state.message = ''
    }
}
window.vm = {};

$( "body" ).on( "keydown", function( event ) {

    if(event.altKey){
        app.msShortCut(event,event.which);
    }
    }


);


    const app = new Vue({
    el: '#msapp',
    mixins: [MS],
    methods:{
        msShortCut(event,keyCode=false){
            var fKeyCode=0;
            if(keyCode!=false){fKeyCode=keyCode}else{
                fKeyCode=event.which;
            }
            switch(fKeyCode){

                case 67:
                   if(this.msCalc){
                       this.msCalc=false;
                   }else {
                       this.msCalc=true;
                   }



                    break;
            }


        }
        ,

        updateTab(data){
            var dashBoard=this.$children[0];
            var viewPanel=dashBoard.$refs['ms-live-tab'];
            viewPanel.addActionToTab(data);

        },

        addNewTab(data){
            var dashBoard=this.$children[0];
            var viewPanel=dashBoard.$refs['ms-live-tab'];
            viewPanel.addNewTabnUpdate(data);
        },
        getModBtn:function(url){

           // console.log(this);
        this.setMsErrorZero();
        this.getGetLink(url,this);



        },
        setMsError:function (Data) {

            this.mserror=Data;
          //  console.log(Data);

              //  console.log(Data);

            for (var inputName in Data){
                var key=inputName.toString().toLowerCase();
            //
                if(this.$refs['msFrom'].$refs.hasOwnProperty(key) && this.$refs['msFrom'].$refs[key].hasOwnProperty(0)){
                   // console.log(inputName);
                    this.$refs['msFrom'].$refs[key][0].setError();
                    this.$refs['msFrom'].$refs[key][0].inputError=Data[inputName];
                    this.$refs['msFrom'].allErrors.push(
                        {
                            inputName:inputName,
                            errors:Data[inputName]
                        }


                    );
                }


            }

         //    this.mserror.forEach(function(value, index) {
         //        var key=value.name.toString();
         //        this.$refs[key].setError();
         //        this.$refs[key].inputError=value.msg;
         //
         // //       console.log(this.$refs[key].getValue());
         //
         //    },this)
            this.mserrorCount=true;
         //   console.log(this.mserror);

        },

        setMsErrorZero:function(){

            for (var inputName in this.mserror){
                var key=inputName.toString().toLowerCase();
                this.$refs['msFrom'].$refs[key][0].setErrorZero();
            }

            this.mserrorCount=false;
            this.mserror=[];


        },
        setUpGroup:function (data) {
           // alert("demo");
            //console.log(data);
            this.msform=data;
            //this.msform.push(data);

        },
        checkGroupExist:function(value){

            if(this.msform.length > 0 )return false;
            return false;
            return this.in_array(value,this.msform);
        },




    },
    data: function () {
        return {
            mserror: [],
            mstab: [],
            mserrorCount: false,
            msform: [],
            msNavigation:false,
            msCalc:false



        }
    },
    mounted:function (){
   // console.log(this.msform);


    },
    sharedState: store.state

});

window.vueApp=app;
