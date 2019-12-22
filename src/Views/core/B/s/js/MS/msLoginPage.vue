<template>
    <div>





        <div v-for="formGroup in  msPageData.fData.formData">


            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full" :src="msPageData.bgImg" alt="Sunset in the mountains">
                <img class="w-full" :src="msPageData.cIcon" >

                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                    <p class="text-gray-700 text-base">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                    </p>
                </div>
                <div class="px-6 py-4">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#photography</span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#travel</span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#winter</span>
                </div>
            </div>





            <div v-for="input in formGroup.inputs" >

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
                    propName:'loginPostUrl',
                    setPropName:'pUrl'
                }
                ,
                {
                    propName:'CheckUsernamePostUrl',
                    setPropName:'cuUrl'
                }
                ,{
                    propName:'bgImg',
                    setPropName:'bgImg'
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
