<template>
    <div>


<div :id="'mswindow'+index" ></div>


    </div>
</template>

<script>
    import  MS  from '../MS';
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


            };
        },

        mounted() {
            this.getGetLink(data.modUrl,this)
            console.log(this.getGetLink(this.msData.modUrl,this));
        },
        methods:{
            updateTab(data){

                this.getGetLink(data.modUrl,this)
            }
            ,
            setHtml(data) {
                this.data.push(data);
                this.liveComponent = new Vue({
                    data: {
                        message: '{}'
                    },
                    el: '#mswindow'+this.index,
                    template:data,
                });
                console.log(data);
            },

            setMsError(data){
                this.data.push(data);
                console.log(data);
            }
        },
        components : {
            msdockerdashboard
        }

    }
</script>

<style scoped>

</style>
