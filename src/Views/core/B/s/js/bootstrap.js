import Echo from 'laravel-echo'
import Pusher from "pusher-js";

window._ = require('lodash');

window.axios = require('axios');
window.msValidate = require("validate.js");
window.msFrontEnd = process.env.MIX_APP_FRONTEND_URL;
window.msBackEnd = process.env.MIX_APP_BACKEND_URL;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['MS-APP-ID'] = 'o3-backend';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0';
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});
window.MS = require('./MS/C/MS');
window.MSStream = require('simple-peer');
window.MSwrtc = require('wrtc');

window.Vue = require('vue');
window.MSclientName="o3-backend";
// var path = require('path');
// var appDir = path.dirname(require.main.filename);
var VueTouch = require('vue-touch');
window.msChart = require('chart.js');

Vue.component('msinput', require('./MS/C/msInput.vue').default);
Vue.component('msform', require('./MS/C/msForm.vue').default);
Vue.component('msviewpanel', require('./MS/msViewpanel.vue').default);
Vue.component('msdashboard', require('./MS/msDashboard.vue').default);
Vue.component('mswindow', require('./MS/msWindow.vue').default);
Vue.component('msmenubar', require('./MS/msMenubar.vue').default);
Vue.component('msdatatable', require('./MS/msDatatable.vue').default);
Vue.component('msvideoconf', require('./MS/C/msVideoConf.vue').default);
Vue.component('msmodal', require('./MS/C/msModal.vue').default);
Vue.component('mssidenav', require('./MS/C/msSideNav.vue').default);
Vue.component('newtab', require('./MS/C/msNewTab.vue').default);
Vue.component('salesdashboard', require('./MS/D/Sales.vue').default);
Vue.component('msvmeet', require('./MS/C/msSchedulevMeet.vue').default);
Vue.component('mscalc', require('./MS/C/msCalc.vue').default);
Vue.component('mslogin', require('./MS/msLoginPage.vue').default);
Vue.component('profile', require('./MS/P/profilePage.vue').default);
Vue.component('mslistmaker', require('./MS/C/msListMaker.vue').default);
Vue.component('setupcompany', require("./MS/M/Company/setupCompany").default);
Vue.component('msupgradeuser', require("./MS/M/User/msUpgradeUser").default);
Vue.component('addbankaccount', require("./MS/M/Company/addBankAccount").default);
Vue.component('allinone', require("./MS/D/AllInOne").default);
Vue.component('addrole', require("./MS/M/User/msAddRole").default);

window.ms_debug=process.env.MIX_MS_DEBUG;
if(process.env.MIX_MS_DEBUG){
    Vue.component('makedataformsdb', require("./MS/Dev/MakeTableForMSDB").default);
}

Vue.use(VueTouch, {name: 'v-touch'})


window.vm = {};


