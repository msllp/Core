<template>
    <div class="ms-login-div">




        <div v-for="formGroup in  msPageData.fData.formData">


            <div class="ms-login-h" >

                <img class="w-full" :src="msPageData.cIcon" >

                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{msPageData.fData.formTitle}}</div>

                    <div class="text-gray-700 text-base" v-for="input in formGroup.inputs" >
                {{input.vName}}

                        <input :type="input.type" :name="input.name">
                    </div>



                </div>
                <div class="px-6 py-4  flex justify-center ">
                        <span
                        v-for="btn in msPageData.fData.actionButton"
                        class="flex-wrap  w-full text-center bg-gray-200 rounded-full px-3 py-1 text-gray-700 mr-2">
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
                <hr>

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

            if(this.msData.hasOwnProperty('ClientIcon'))this.msPageData.cIcon=this.msData.ClientIcon;
        }

    }
</script>

<style scoped>

</style>
