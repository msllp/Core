<template>

    <div>

        <div class="card" v-for="(section,id,key) in  msFormData">
            <div class="card-header" v-on:click="showCollapse(section.id+'_target')"  data-toggle="collapse" :id="section.id" :data-target="section.id+'_target'" aria-expanded="false" :aria-controls="section.id+'_target'">
                <h4 class="float-left">  {{section.gruoupHeading}}  </h4>

                <div class="float-right">
                    <div class="btn btn-outline-success" v-if="checkMutlipleFirst(section)" v-on:click="addInputGroup(id)"><i class="fa fa-times-circle " style="transform: rotate(45deg)"></i> </div>
                    <div class="btn btn-outline-danger" v-if="checkMutlipleSub(section)" v-on:click="removeInputGroup(id,section.rootId)"><i class="fa fa-times-circle "></i> </div>
                </div>
            </div>

            
            
            <div  class="collapse card card-body" :class="{ 'show': id === 0 }" :id="section.id+'_target'" :aria-labelledby="section.id" >

                <inputtext v-for="(inputRaw,id2) in section.inputs" v-bind:key="id2" v-bind:ms-data="inputRaw" ></inputtext>

            </div>
        </div>


    </div>


</template>

<script>
    import MS from '../MS';
    export default {
        name: "msform",
        mixins: [MS],
        props:{
        'msData':{
            type: Object,
            required: true
        }

        },
        mounted() {
         //   console.log(this.msData);
            var d = new Date();
            var n = d.getTime();

            this.mslastActive=n;
            //console.log(this.checkLastActive());
            if(this.msData.hasOwnProperty('multipleGroup'))this.msMultiple=this.msData.multipleGroup;
            if(this.msData.hasOwnProperty('formData'))
            {
                Object.keys(this.msData.formData).forEach(function(key,index) {
                    //console.log(index);
                    var data=this.msData.formData[key];
                    data.id=key;
                    this.msFormData.push(data);
                    //   console.log(index);

                    if(this.msCount.hasOwnProperty(index)){
                        this.msCount[index]++
                    }else{
                        this.msCount[index]=1;
                    }

                },this);
            }
               // this.msFormData= this.msData.formData;

        },
        data: function () {
            return {
                msclass:"collapse card card-body",
                msMultiple:[],
                msFormData:[],
                msCount:{},
                mslastActive:0
            }
        },
        methods:{
            showCollapse:function(id,event){
               // this.msclass +=' show';
                if(this.checkLastActive())
                $("#"+id).collapse('toggle');
               // event.target.tagName
                //console.log(this.section.class);
            },
            checkMutlipleFirst:function (section) {
              //  console.log(section.hasOwnProperty("rootId"));
                if(section.groupDynamic)
                {

                    if(section.hasOwnProperty("rootId"))return false;
                  //  console.log(section);
                    return true;
                }

            return false;
            },
            checkMutlipleSub:function (section) {
                if(section.groupDynamic)
                {

                    if(section.hasOwnProperty("rootId"))return true;
                    //  console.log(section);
                    return false;
                }
                return false;

            }
            ,
            addInputGroup:function (id,event) {
                if(true){

                    //console.log(this.msCount.hasOwnProperty(id))
                    if(this.msCount.hasOwnProperty(id)){
                        this.msCount[id]++
                    }else{
                        this.msCount[id]=1;
                    }
                    //  console.log(this.makeArrayForInputGroup(this,id,this.msCount[id]))
                    this.msFormData.push(this.makeArrayForInputGroup(this,id,this.msFormData.length)) ;
                }

                //console.log(this.msData.formData[id]);
            },
            removeInputGroup:function (id,rootId) {
                //console.log(this.msCount.hasOwnProperty(id))
                if(this.checkLastActive()){
                    if(this.msCount.hasOwnProperty(rootId) && this.msCount[rootId] >1){
                        //    console.log(id);
                        delete this.msFormData.splice(id, 1);
                        this.msCount[rootId]--;

                    }
                }




                //console.log(this.msData.formData[id]);
            },
            checkLastActive:function(){
                var d = new Date();
                var n = d.getTime();
              //  console.log(this.get_time_diff(this.mslastActive));
                if(this.get_time_diff(this.mslastActive) > 250){
                    this.mslastActive=n
                    return true;
                }

                this.mslastActive=n
                return false
            }

        }

    }
</script>

<style scoped>


</style>
