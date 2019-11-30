<template>
    <div class="">


        <div :id="'mswindow_maaster'+index"  class="">

        <div :id="'mswindow'+index" >

        </div>




</div>

    </div>
</template>

<script>
    import  MS  from './C/MS';
    import  msform  from './C/msForm';

        import msdockerdashboard from 'E:/MS-Master/Projects/FrameworkPHP/gst_invoice/Master/MS/B/M/DCM/V/Vue/dockerMasterDashboard';
    export default {
        name: "mswindow",
        mixins: [MS],
        props:{
            'msData':{
                type: Object,
                required: true,
                default:true
            },
            'index':{
                type: Number,
                required: true,
                default:true
            }
        },
        data:function () {
            return {
                data:[],
                liveComponent:null,
                currentData:null,
                liveData:null


            };
        },

        mounted() {
            var data=new Object();
            data.modUrl="http://gst.ms/MAS/test/NewTab";
            data.modUrl="http://gst.ms/MAS";

            //this.getGetLink(data.modUrl,this);
            //console.log(this.getGetLink(this.msData.modUrl,this));
        },
        methods:{
            updateTab(data){
               // this.getGetRaw(data.modUrl,this,'setHtml');

                this.getGetLink(data.modUrl,this)
            }
            ,
            setTabData(data){

                this.getGetLink(data.ms.nextData.modUrl,this)
            },
            setHtml(data) {

             if(typeof data == 'object'){
             this.getGetLink(data.ms.nextData.modUrl,this,'setTabData');
                }else{
                 this.currentData=data;
                    this.data.push(data);
                    this.liveComponent = new Vue({
                        name:'mslivetab',
                        data: {
                            message: '{}'
                        },
                        el: '#mswindow'+this.index,
                        template:"<div id='mswindow"+this.index+"' >"+ data +"</div>",
                        //     sharedState: store.state,
                        mounted() {
                            //      console.log(this.$root.$data);
                        }
                    });
                }









              //  document.getElementsByTagName('#mswindow_maaster'+this.index)[0].setAttribute("id", "democlass");
               // console.log(data);
            },

            setMsError(data){
                this.data.push(data);
         //       console.log(data);
            }
        },
        components : {
            msdockerdashboard,msform
        }

    }
</script>

<style scoped>

</style>
