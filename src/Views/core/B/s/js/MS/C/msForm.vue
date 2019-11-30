<template>

    <div  class="bg-white border">
        <div v-if="msData.hasOwnProperty('formTitle')"  clasa="w-full">
            <div class="px-5 py-2 text-xl bg-blue-200 font-medium  subpixel-antialiased  select-none  cursor-not-allowed">
            <i class="fab fa-wpforms pr-2 font-black-500 hover:font-bold"></i>
                {{ msData.formTitle }}
            </div>



        </div>

    <div class="block ">



        <div class="w-full rounded  border-t shadow-lg mb-4 bg-gray-100"  v-for="(section,id,key) in  msFormData">

            <div class=" w-full px-3 py-2 cursor-pointer mb-2 border-b"  :class="{ 'show': id === 0 , }" :id="section.id+'_target'" :aria-labelledby="section.id" >
                <div class="font-bold text-md border-b pb-2  flex flex-wrap">

                    <div  class="expand-btn flex"
                                                                      :style="{

                          'opacity':checkImHiddenOrNot(section)
                          }"
                                                                      :class="{'bg-gray-200':!checkImHiddenOrNot(section),
                    'bg-gray-500':checkImHiddenOrNot(section)}"  v-on:click.prevent="showCollapse(section.id)"><i :class="{
                    'fas fa-search-minus ':!checkImHiddenOrNot(section),
                    'fas fa-search-plus ':checkImHiddenOrNot(section)

                    }"  ></i> </div>


                    {{section.gruoupHeading}}

                    <div class="flex px-3 border ml-3 hover:bg-white hover:shadow" v-if="section.groupDynamic">

                        <div class="text-green-500" v-if="checkMutlipleFirst(section)" v-on:click.prevent="addInputGroup(id)"><i class="fa fa-times-circle " style="transform: rotate(45deg)"></i> </div>

                        <div class="text-red-500" v-if="checkMutlipleSub(section)" v-on:click.prevent="removeInputGroup(id,section.rootId)"><i class="fa fa-times-circle "></i> </div>


                    </div>


                </div>

                <div >



                    <div class="text-gray-700 text-base flex flex-wrap"  v-bind:class="{
                'hidden':checkImHiddenOrNot(section),
                // 'flex':onMobile,
                // 'flex':!onMobile
                }">

                        <msinput class="w-1/2"  :class="section.inputs[id2].inputSize" v-for="(inputRaw,id2) in section.inputs" :key="inputRaw.name.toLowerCase()" :ref="inputRaw.name.toLowerCase()" v-bind:ms-data="inputRaw"   v-bind:ms-group-index="id" :ms-input-index="id2" >
                        </msinput>
                    </div>



                </div>


            </div>

        </div>

        <div class="w-full rounded overflow-hidden shadow-lg">
        <div class=" px-6 py-4 border-t">
            <div class="inline-flex w-full cursor-pointer text-center" :class="{}" >
             <span
                 @click.prevent="formActionFromBtn(index)"
                 class="w-1/3 bg-gray-200  hover:bg-gray-400 border-t border-b  border-r px-3 py-1 text-sm font-semibold text-gray-700"

                      v-for="(msBtn,index) in msActionBtn" type="button" v-bind:class="[msBtn.btnClass]"

                >
                       <i v-if="msBtn.hasOwnProperty('btnIcon')" :class="msBtn.btnIcon"></i> {{displauActionBtnText(msBtn)}}

                    </span>
            </div>
        </div>

    </div>


    </div>

    <div v-if="false">
        <h1></h1>
        <form class="ms-form" enctype="multipart/form-data" type="post">

            <div class="card" v-for="(section,id,key) in  msFormData"  style="border-radius: 0px">
                <div class="card-header sticky-top bg-light"   data-toggle="collapse" :id="section.id" :data-target="section.id+'_target'" aria-expanded="false" :aria-controls="section.id+'_target'">
                    <h4 class="float-left">  {{section.gruoupHeading}}  </h4>

                    <div class="float-right">
                        <div class="btn-group btn-group-sm" role="group" aria-label="..." style="border-radius:0px;cursor: pointer;">
                            <div class="btn btn-outline-success " v-if="checkMutlipleFirst(section)" v-on:click.prevent="addInputGroup(id)"><i class="fa fa-times-circle " style="transform: rotate(45deg)"></i> </div>

                            <div class="btn btn-outline-info"  v-on:click.prevent="showCollapse(section.id+'_target')"><i class="fa fa-compress-arrows-alt "  ></i> </div>
                            <div class="btn btn-outline-danger" v-if="checkMutlipleSub(section)" v-on:click.prevent="removeInputGroup(id,section.rootId)"><i class="fa fa-times-circle "></i> </div>
                        </div>
                    </div>
                </div>



                <div  class="collapse card card-body" :class="{ 'show': id === 0 }" :id="section.id+'_target'" :aria-labelledby="section.id"  style="border-radius: 0px">
                    <!--<table class="table table-bordered">-->
                    <div class="row">
                        <msinput class="col col-6" v-for="(inputRaw,id2) in section.inputs" :key="inputRaw.name.toLowerCase()" :ref="inputRaw.name.toLowerCase()" v-bind:ms-data="inputRaw"   v-bind:ms-group-index="id" ></msinput>
                    </div>
                    <!--</table>-->
                </div>



            </div>

            <div class="card-footer text-muted bg-light" >


                <div class="btn-group btn-group-sm btn-block " role="group" aria-label="First group">


                    <button  v-for="(msBtn,index) in msActionBtn" type="button" v-bind:class="[msBtn.btnClass]" @click="getAllData(msBtn.route)">
                        {{msBtn.btnColor}}
                        <i v-if="msBtn.hasOwnProperty('btnIcon')" :class="msBtn.btnIcon"></i> {{displauActionBtnText(msBtn)}}

                    </button>



                </div>


            </div>

        </form>


        <p  v-if="false" class="text-center text-muted" translate="no" style="opacity: 0.6;pointer-events: none;" ><br><img @click.prevent="msNoClick()" @contextmenu="msNoClick()" :src="msQ.image"  style="max-height:120px"><br>{{msQ['0']}}<br><small class="text-right" translate="no">said by {{msQ['1']}}</small><br></p>
        </div>


        </div>




</template>

<script>
    import MS from './MS';
   /// console.log(MS);
    export default {
        name: "msform",
        mixins: [MS],
      //  components:[msinput],
        props:{
            'msData':{
                type: Object,
                required: true
            }

        },
        mounted() {
          //  console.log(this.msData);
            var d = new Date();
            var n = d.getTime();

            this.mslastActive=n;
            //console.log(this.checkLastActive());
            if(this.msData.hasOwnProperty('multipleGroup'))this.msMultiple=this.msData.multipleGroup;
            if(this.msData.hasOwnProperty('actionButton'))this.msActionBtn=this.msData.actionButton;
            if(this.msData.hasOwnProperty('q'))this.msQ=this.msData.q;

            //console.log();

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
            if ( window.innerWidth < 800  )this.onMobile=true;
        },
        data: function () {
            return {
                msclass:"collapse card card-body",
                msMultiple:[],
                msFormData:[],
                msFormDataValue:[],
                msCount:{},
                mslastActive:0,
                msActionBtn:null,
                msFormDataFinal:{},
                msQ:{},
                msViewIcon:"fa-eye",
                msCurrentTab:null,
                onMobile:false,
                allErrors:[],
                CurrentDataFromServer:null
            }
        },
        methods:{
            msNoClick(){

            },
            showCollapse:function(id,event){
                // this.msclass +=' show';
                if(this.checkLastActive())
                    this.msCurrentTab=id;
               // console.log(section.id);
                    //$("#"+id).collapse('toggle');
                // event.target.tagName
                //console.log(this.section.class);
            },
            checkMutlipleFirst:function (section) {
                // console.log(section);
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
            },
            displauActionBtnText(actionBtn){
                var str="";


                //if(actionBtn.hasOwnProperty('btnColor'));
                //if(actionBtn.hasOwnProperty('route'));
                //  if(actionBtn.hasOwnProperty('btnIcon'))str=str+"<i class='"+actionBtn.btnIcon+"'></i> ";
                if(actionBtn.hasOwnProperty('btnText'))str=str+actionBtn.btnText;


                return this.forNice(str);

            },
            getAllData(link){


                //  console.log(link);
                var formData=new FormData();
                var signLink="http://gst.ms/MAS/core/signRequest";

                for(var propertyName in this.msFormDataFinal) {


                    if(this.msFormDataFinal[propertyName] instanceof Object){
                        var d=this.$refs[propertyName]

                     //   console.log(d.msValue);

                        for(var file in this.msFormDataFinal[propertyName]){

                            formData.append(propertyName+"["+file+"]",this.msFormDataFinal[propertyName][file]);
                        }

                    }else{

                        formData.append(propertyName,this.msFormDataFinal[propertyName]);
                    }


                    // propertyName is what you want
                    // you can get the value like this: myObject[propertyName]
                }





                var data =  this.postLink(link,formData,this,'getData');


          //      console.log(data);




                // console.log($('form'));


            },
            getData(data){
                //console.log(data.nextData);
                window.vueApp.updateTab(data.nextData);

            }
            ,setInputData(name,value,name2="test"){
                //console.log(name2 != "");
                // console.log(name2);
                if(name2 != "test"){
                    if(!(this.msFormDataFinal[name] instanceof Object))
                    {
                        this.msFormDataFinal[name]={};

                    }

                    //  console.log("226");
                    if( this.msFormDataFinal.hasOwnProperty(name) && this.msFormDataFinal[name].hasOwnProperty(name2) ){
                        // console.log(name);
                    }else{
                        this.msFormDataFinal[name][name2]=value ;
                    }



                }else {


                    this.msFormDataFinal[name]= value;


                }
                //

                //console.log(this.msFormDataFinal[name].mslength);
            },
            viewIconTogle(){}
            ,setAllMsError(data){

                //    console.log(data);

     //           this.$emit('setMsError',data,this.$refs);

       //         this.$refs.msFrom.setMsError(data,this.$refs);

                //this.$root.setMsError(data,this.$refs);
                this.setMsError(data);

            },
            setError(data){
                this.allErrors.push(data);



            },
            setMsError:function (Data) {

                if(Data != undefined){
                    this.mserror=Data;
                    //console.log(Data);
                    if(Data.hasOwnProperty('errorsRaw')){
                        alert(Data.errorsRaw);
                    }else{
                        for (var inputName in Data){
                            var key=inputName.toString().toLowerCase();
                            //
                            //console.log(inputName);
                            if(this.$refs.hasOwnProperty(key) && this.$refs[key].hasOwnProperty(0)){

                                this.$refs[key][0].setError();
                                this.$refs[key][0].inputError=Data[inputName];
                                this.allErrors.push(
                                    {
                                        inputName:inputName,
                                        errors:Data[inputName]
                                    }


                                );
                            }
                        }
                    }


                }else{
                        alert('Opps...System had some wrong enviroment to work please reload your page. Sorry & Thank you.');
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

            }
            ,
            removeError(key){

               // console.log(key);
                var fkey=this.allErrors.findIndex(o => o.inputName == key);
              //  console.log(fkey);
                if(fkey != -1)this.allErrors.splice(fkey,1);



            }


            ,checkImHiddenOrNot(section){

              //  if()this.msCurrentTab=section.id;

                if(this.msCurrentTab!=null){

                     //   console.log(this.msCurrentTab==section.id);
                        if(this.msCurrentTab==section.id)return false;
                        return true;



                }
                    //&& (this.msCurrentTab != section.id))return true;
                this.msCurrentTab=section.id;
                return false;

            }
            ,formActionFromBtn(id,row){
                if(this.allErrors.length<1){
                    var row=this.msData.actionButton[id];
                    var mKey=row.msLinkKey;
                    //console.log(mKey);
                    var route=this.msData.actionButton[id].route;


                    return this.getAllData(route);

                 //   console.log(this.msData.actionButton[id].route);
                }else{
                    var route=this.msData.actionButton[id].route;
                    return this.getAllData(route);
                }

                //console.log(this.msData.actionButton[id].route);
            }

        }


    }
</script>

<style scoped>
    .btn{
        text-transform: capitalize;
    }

    .expand-btn{
        @apply block;

        @apply text-center;
        @apply inline-flex;
        @apply rounded;
        @apply pl-2 pr-2 pt-1 pb-1;
        @apply mr-2;
        @apply float-left;
        @apply inset-y-0;
        @apply inset-y-0;

    }

    .hiiden{

        transition: all 1s ease-in-out;
    }

</style>
