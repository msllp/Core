
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
Vue.component('msmenu', require('./components/msMenu.vue').default);
Vue.component('msviewpanel', require('./MS/msViewpanel.vue').default);
Vue.component('msdashboard', require('./MS/msDashboard.vue').default);
Vue.component('mswindow', require('./MS/msWindow.vue').default);
Vue.component('msmenubar', require('./MS/msMenubar.vue').default);
Vue.component('msdockerdashboard', require('E:/MS-Master/Projects/FrameworkPHP/gst_invoice/Master/MS/B/M/DCM/V/Vue/dockerMasterDashboard.vue').default);

//Components


import MS from './MS';



const app = new Vue({
    el: '#msapp',
    mixins: [MS],
    methods:{
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
                console.log(this.$refs['msFrom'].$refs[key][0].setError());
                this.$refs['msFrom'].$refs[key][0].setError();
                this.$refs['msFrom'].$refs[key][0].inputError=Data[inputName];
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
            msNavigation:false


        }
    },
    mounted:function (){
   // console.log(this.msform);


    }

});

