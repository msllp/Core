<template>
    <div class="ms-login-div select-none">




        <div v-for="formGroup in  msPageData.fData.formData">


            <div class="ms-login-h" >

                <img class="ms-clientlogo" :src="msPageData.cIcon" >
                <hr>

                <div class="px-6 py-1 ">

                    <div class="font-bold text-xl mb-4 ">{{msPageData.fData.formTitle}}</div>
                    <div class="ms-login-error-box text-xs" v-if="msError">
                        <ul v-for="er in msErrorData">
                            <li v-for="e in er">{{e}} </li>
                        </ul>
                    </div>

                    <table class="ms-login-table  mb-2" v-if="!waitingForData">
                    <tr class="text-gray-700 text-base" v-for="input in formGroup.inputs" >

                        <th>{{input.vName}}  <i class="fi2 flaticon-key" v-if="(input.type == 'password')" > </i><i class="fi2 flaticon-user-2" v-if="input.type == 'text'"></i>    </th>
                        <td >        <input class="" :type="input.type" :name="input.name"></td>


                    </tr>
</table>
                    <div v-if="waitingForData">Please wait...</div>

                </div>
                <div class="px-6 py-4  flex justify-center ">
                        <span
                        v-for="btn in msPageData.fData.actionButton"
                        class="ms-login-btn" v-on:click="sendDataToLoginData(btn)">
                        <i :class='{[btn.btnIcon]:true,"inline-flex":true}'></i>
                        <strong :class='{"inline-flex":true}'> {{btn.btnText}}</strong>
                        </span>

                </div>



                <div class="ms-login-others-box" v-if="msPageData.os">
                    <div class="text-center">
                        <hr>
                        or <br> Sign in
                        with your social network
                        <div class="ms-login-others-btn-box ">

                        <div v-for="sor in msPageData.asd" class="cursor-pointer">
                       <a :href="sor.VerifyUrl">   <i :class="{[sor.VerifyIcon]:true}"></i></a>
                        </div>


                        </div>


                    </div>

                </div>

                <div class="ms-login-copyright-box">

                    <span class="ms-login-copyright-pre"> {{msPageData.copyrightPre}}</span>
                    <span class="ms-login-copyright-icon-class">

                        <img :src="msPageData.mIcon" class="ms-login-msater-icon"> </span>
                    <span class="ms-login-copyright-per"> {{msPageData.copyrightPer}}</span>
                </div>
            </div>




<div class="ms-login-bottom-line">
    {{msPageData.inspire}}
</div>


        </div>



    </div>

</template>

<script>
    //TODO Make Post Request & Error Display and Show Forgot Password Button after 3 unsuccessful Try to login.
    export default {
        name: "msLoginPage",
        props:{
            'msData':{
                type:Object,
                required: true,
                default:{}
            }
        },
        data(){
            return {
                msPageData:{},
                waitingForData:false,
                msError:false,
                msErrorData:[],
              //  loader:null

                    };
        },
        beforeMount() {
            var loader=[
                {
                    propName:'ClientIcon',
                    setPropName:'cIcon'
                },
                {
                    propName:'MasterIcon',
                    setPropName:'mIcon'
                },
                {
                    propName:'formData',
                    setPropName:'fData',
                    defualt:{}
                },
                {
                    propName:'inspire',
                    setPropName:'inspire'
                }
                ,
                {
                    propName:'copyrightPre',
                    setPropName:'copyrightPre'
                },
                {
                    propName:'copyrightPer',
                    setPropName:'copyrightPer'
                },
                {
                    propName:'bgImg',
                    setPropName:'bgImg'
                }

                ,{
                    propName:'bgImg',
                    setPropName:'bgImg'
                },
                {
                    propName:'OtherSource',
                    setPropName:'os'
                },
                {
                    propName:'AllSoucesData',
                    setPropName:'asd'
                },
                {
                    propName:'VerifyCallback',
                    setPropName:'vcurl'
                },
                {
                    propName:'VerifyUrl',
                    setPropName:'vurl'
                }



            ];
          //  this.loader=loader;
            var mThis=this;
            loader.forEach(function (load) {
             //   console.log(load);
                if(this.msData.hasOwnProperty(load.propName))
                {this.msPageData[load.setPropName]=this.msData[load.propName];}else {
                    if (load.hasOwnProperty('defualt')){
                        this.msPageData[load.setPropName]=load.defualt;}
                    else{
                        this.msPageData[load.setPropName]=null;
                    }


                }
            },this);
            //for (load ,key in loader)

         //   if(this.msData.hasOwnProperty('ClientIcon'))this.msPageData.cIcon=this.msData.ClientIcon;
        },
        methods:{
            sendDataToLoginData(data={}){
            //  console.log(data.hasOwnProperty('route'));



                var link = (data.hasOwnProperty('route')) ? data.route : "";
                if (link != ""){
                   // console.log(window.axios);
                    var t=this;
                    t.waitingForData=true;
                    t.msErrorData=[];
                    t.msError=(t.msError) ? false : false;
                    window.axios.post(link, {
                        firstName: 'Fred',
                        lastName: 'Flintstone'
                    })
                        .then(function (response) {
                            t.msError=false;
                            t.waitingForData=false;
                            console.log(response);
                        })
                        .catch(function (error) {
                            t.msError=true;
                            t.waitingForData=false;
                            //t.msErrorData=;
                            t.setMSErrorData(error.response.data.errors);
                            //console.log();
                        });
                }
              //if()var link = data.route
            },
            setMSErrorData(data){
                var t =this;
                Object.keys(data).forEach(function(key,index) {

                    console.log(data[key]);
                    // key: the name of the object key
                    // index: the ordinal position of the key within the object
                    t.msErrorData.push(data[key]);
                });
                //this.msErrorData=data;
            }
        }


    }
</script>

<style scoped>

</style>
