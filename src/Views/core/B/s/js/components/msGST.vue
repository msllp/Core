<template>
    <div>


        <div class="cssload-tetrominos" :class="msLoading" style="z-index: 1;">
            <div class="cssload-tetromino cssload-box1"></div>
            <div class="cssload-tetromino cssload-box2"></div>
            <div class="cssload-tetromino cssload-box3"></div>
            <div class="cssload-tetromino cssload-box4"></div>
        </div>

        <div >
<div style="padding: 10px;padding-top: 15px;padding-bottom: 15px;z-index: 2" >
        <div class="input-group" >
            <input type="text" class="form-control"  v-model="msSearch" placeholder="Enter Your Product Or Service Name" aria-label="Product Or Service Name" >
            <div class="input-group-append">
                <button class="btn btn-success"  v-on:click="getSearch()" type="button" style="border-top-right-radius: 0;
                        border-bottom-right-radius: 0;" >Search</button>

            </div>
        </div>
</div>
<table class="table  table-bordered table-hover" :class="msVisibleClass" style="z-index: 2">
        <thead  class="thead-info">
    <tr>
        <td  >HSN/SAC Code</td>
        <td  > Code Description  </td>
    </tr>

    </thead>
    <tbody>
    <tr v-for="row in msDataFor">
        <td >{{row.hsn_code}} </td>
        <td >{{row.description}}</td>
    </tr>
    </tbody>
</table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "msgst",
        props:{
            'msData':{
                type: String,
                required: true
            }
        },
        data:function () {
            return {
                msDataFor:{},
                msSearch:"",
                msVisibleClass:"display",
                msLoading:"hidden"
            }
            },
        methods:{
            getHSNCode(searchKeyWord){
                this.msVisibleClass="hidden";
                this.msLoading="display";
                var url='http://gst.ms/MAS/getHsnCode?key='+searchKeyWord

                var self=this

                let re= axios.get(url)

                    .then(
                        function(response){

                           var  returnX=response.data;
                           // console.log(response.data);
                           // self.setmsDataFor(returnX);
                            self.msDataFor=response.data.result.hsn_results;

                        }
                    )
                    .catch(function (error) {
                        // handle error
                       // self.setMsError(error.response.data);
                        //  console.log(error.response.data);
                   //     console.log(error);
                      //  this.setmsDataFor(this,error);
                    })
                    .finally( response => {
                        self.msVisibleClass="display";
                        self.msLoading="hidden";
                    });
            },
            setmsDataFor(data){
                this.msDataFor=data;
            },
            getSearch(){
                this.getHSNCode( encodeURI( this.msSearch));
            }

        },
        mounted() {
            //this.msDataFor= JSON.parse(this.msData);
           this.getHSNCode("Demo");
        },
        watch:{

        }
    }
</script>

<style scoped>
    .hidden{
        display: none;
        transition: display 1s;
    }
    .display{
        display: block;
        transition: display 1s;
    }
    .cssload-tetrominos {
        position: absolute;
        left: 50%;
        top:50%;
        transform: translate(-109px, -94px);
        -o-transform: translate(-109px, -94px);
        -ms-transform: translate(-109px, -94px);
        -webkit-transform: translate(-109px, -94px);
        -moz-transform: translate(-109px, -94px);
    }

    .cssload-tetromino {
        width: 94px;
        height: 109px;
        position: absolute;
        transition: all ease 0.35s;
        -o-transition: all ease 0.35s;
        -ms-transition: all ease 0.35s;
        -webkit-transition: all ease 0.35s;
        -moz-transition: all ease 0.35s;
        background: url('data:image/svg+xml;utf-8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 612 684"%3E%3Cpath fill="%23010101" d="M305.7 0L0 170.9v342.3L305.7 684 612 513.2V170.9L305.7 0z"/%3E%3Cpath fill="%23fff" d="M305.7 80.1l-233.6 131 233.6 131 234.2-131-234.2-131"/%3E%3C/svg%3E') no-repeat top center;
    }

    .cssload-box1 {
        animation: cssload-tetromino1 1.73s ease-out infinite;
        -o-animation: cssload-tetromino1 1.73s ease-out infinite;
        -ms-animation: cssload-tetromino1 1.73s ease-out infinite;
        -webkit-animation: cssload-tetromino1 1.73s ease-out infinite;
        -moz-animation: cssload-tetromino1 1.73s ease-out infinite;
    }

    .cssload-box2 {
        animation: cssload-tetromino2 1.73s ease-out infinite;
        -o-animation: cssload-tetromino2 1.73s ease-out infinite;
        -ms-animation: cssload-tetromino2 1.73s ease-out infinite;
        -webkit-animation: cssload-tetromino2 1.73s ease-out infinite;
        -moz-animation: cssload-tetromino2 1.73s ease-out infinite;
    }

    .cssload-box3 {
        animation: cssload-tetromino3 1.73s ease-out infinite;
        -o-animation: cssload-tetromino3 1.73s ease-out infinite;
        -ms-animation: cssload-tetromino3 1.73s ease-out infinite;
        -webkit-animation: cssload-tetromino3 1.73s ease-out infinite;
        -moz-animation: cssload-tetromino3 1.73s ease-out infinite;
        z-index: 2;
    }

    .cssload-box4 {
        animation: cssload-tetromino4 1.73s ease-out infinite;
        -o-animation: cssload-tetromino4 1.73s ease-out infinite;
        -ms-animation: cssload-tetromino4 1.73s ease-out infinite;
        -webkit-animation: cssload-tetromino4 1.73s ease-out infinite;
        -moz-animation: cssload-tetromino4 1.73s ease-out infinite;
    }









    @keyframes cssload-tetromino1 {
        0%, 40% {
            transform: translate(0, 0);
        }
        50% {
            transform: translate(47px, -26px);
        }
        60%, 100% {
            transform: translate(94px, 0);
        }
    }

    @-o-keyframes cssload-tetromino1 {
        0%, 40% {
            -o-transform: translate(0, 0);
        }
        50% {
            -o-transform: translate(47px, -26px);
        }
        60%, 100% {
            -o-transform: translate(94px, 0);
        }
    }

    @-ms-keyframes cssload-tetromino1 {
        0%, 40% {
            -ms-transform: translate(0, 0);
        }
        50% {
            -ms-transform: translate(47px, -26px);
        }
        60%, 100% {
            -ms-transform: translate(94px, 0);
        }
    }

    @-webkit-keyframes cssload-tetromino1 {
        0%, 40% {
            -webkit-transform: translate(0, 0);
        }
        50% {
            -webkit-transform: translate(47px, -26px);
        }
        60%, 100% {
            -webkit-transform: translate(94px, 0);
        }
    }

    @-moz-keyframes cssload-tetromino1 {
        0%, 40% {
            -moz-transform: translate(0, 0);
        }
        50% {
            -moz-transform: translate(47px, -26px);
        }
        60%, 100% {
            -moz-transform: translate(94px, 0);
        }
    }

    @keyframes cssload-tetromino2 {
        0%, 20% {
            transform: translate(94px, 0px);
        }
        40%, 100% {
            transform: translate(140px, 26px);
        }
    }

    @-o-keyframes cssload-tetromino2 {
        0%, 20% {
            -o-transform: translate(94px, 0px);
        }
        40%, 100% {
            -o-transform: translate(140px, 26px);
        }
    }

    @-ms-keyframes cssload-tetromino2 {
        0%, 20% {
            -ms-transform: translate(94px, 0px);
        }
        40%, 100% {
            -ms-transform: translate(140px, 26px);
        }
    }

    @-webkit-keyframes cssload-tetromino2 {
        0%, 20% {
            -webkit-transform: translate(94px, 0px);
        }
        40%, 100% {
            -webkit-transform: translate(140px, 26px);
        }
    }

    @-moz-keyframes cssload-tetromino2 {
        0%, 20% {
            -moz-transform: translate(94px, 0px);
        }
        40%, 100% {
            -moz-transform: translate(140px, 26px);
        }
    }

    @keyframes cssload-tetromino3 {
        0% {
            transform: translate(140px, 26px);
        }
        20%, 60% {
            transform: translate(94px, 53px);
        }
        90%, 100% {
            transform: translate(47px, 26px);
        }
    }

    @-o-keyframes cssload-tetromino3 {
        0% {
            -o-transform: translate(140px, 26px);
        }
        20%, 60% {
            -o-transform: translate(94px, 53px);
        }
        90%, 100% {
            -o-transform: translate(47px, 26px);
        }
    }

    @-ms-keyframes cssload-tetromino3 {
        0% {
            -ms-transform: translate(140px, 26px);
        }
        20%, 60% {
            -ms-transform: translate(94px, 53px);
        }
        90%, 100% {
            -ms-transform: translate(47px, 26px);
        }
    }

    @-webkit-keyframes cssload-tetromino3 {
        0% {
            -webkit-transform: translate(140px, 26px);
        }
        20%, 60% {
            -webkit-transform: translate(94px, 53px);
        }
        90%, 100% {
            -webkit-transform: translate(47px, 26px);
        }
    }

    @-moz-keyframes cssload-tetromino3 {
        0% {
            -moz-transform: translate(140px, 26px);
        }
        20%, 60% {
            -moz-transform: translate(94px, 53px);
        }
        90%, 100% {
            -moz-transform: translate(47px, 26px);
        }
    }

    @keyframes cssload-tetromino4 {
        0%, 60% {
            transform: translate(47px, 26px);
        }
        90%, 100% {
            transform: translate(0, 0);
        }
    }

    @-o-keyframes cssload-tetromino4 {
        0%, 60% {
            -o-transform: translate(47px, 26px);
        }
        90%, 100% {
            -o-transform: translate(0, 0);
        }
    }

    @-ms-keyframes cssload-tetromino4 {
        0%, 60% {
            -ms-transform: translate(47px, 26px);
        }
        90%, 100% {
            -ms-transform: translate(0, 0);
        }
    }

    @-webkit-keyframes cssload-tetromino4 {
        0%, 60% {
            -webkit-transform: translate(47px, 26px);
        }
        90%, 100% {
            -webkit-transform: translate(0, 0);
        }
    }

    @-moz-keyframes cssload-tetromino4 {
        0%, 60% {
            -moz-transform: translate(47px, 26px);
        }
        90%, 100% {
            -moz-transform: translate(0, 0);
        }
    }
</style>
