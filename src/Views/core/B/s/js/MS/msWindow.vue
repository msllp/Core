<template>
    <div>


        <div :id="'mswindow_maaster'+index" >

        <div :id="'mswindow'+index" >

</div>



</div>

    </div>
</template>

<script>
    import  MS  from './C/MS';

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
                currentData:null


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
                this.currentData=data;
                this.getGetLink(data.modUrl,this)
            }
            ,
            setHtml(data) {
                this.data.push(data);
                //this.currentData=data;



                if( this.liveComponent != null){
                    // this.liveComponent.getElement('.mswindow_maaster'+this.index).then((el) => {
                    //     //console.log(el);
                    //     el.template=data;
                    //     return el;
                    // });

                    const HelloCtor = Vue.extend(this.liveComponen);
                    const vm = new HelloCtor({
                        template:data
                    }).$mount('#mswindow'+this.index);

                    this.liveComponent.template=data;


                }else{
                    this.liveComponent = new Vue({
                        data: {
                            message: '{}'
                        },
                        el: '#mswindow'+this.index,
                        template:data,
                        attr:{
                            id:'mswindow'+this.index
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
            msdockerdashboard
        }

    }
</script>

<style scoped>

</style>
