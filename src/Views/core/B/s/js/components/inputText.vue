<template>
    <div class="form-group"  >

<section  v-for="(input,key) in finalInput">

    <label v-if="!input.baseValue.inputOnly">   {{ input.baseValue.inputVname }}</label>
    <div class="input-group" data-toggle="tooltip" data-placement="left">
    
        <div v-if="input.inputPrefix" class="input-group-prepend">
            <i :class="'fa fa-'+input.inputPrefix+ ' input-group-text' " ></i>
        </div>


    <input  :type="inputType" :list="inputName" :name="inputName"  :class="'form-control '+msValid" v-model="msValue" :aria-describedby="inputName" :placeholder="'Enter '+inputVname+' here'">


        <datalist :id="inputName" class="col-lg-12">
            <option v-for ="autofiled in inputAuto" :value="autofiled[dValue]" > {{autofiled[dText]}} </option>

        </datalist>

            <div v-if="inputPerfix" class="input-group-append ">
                <i :class="'fa fa-'+inputPerfix+ ' input-group-text' " ></i>
            </div>

    </div>



        <small v-if="msValid == 'is-invalid'" class="form-text text-muted text-center" :id="inputName +'_error'" >

            <div v-for="item in inputError" class="alert alert-danger" role="alert" style="font-size: smaller;
    padding: 5px;">
                {{ item }}
            </div>

        </small>


    <!--<div class="btn btn-success" v-if="inputMultiple" @click="addinput()">add </div>-->
    <!--<div class="btn btn-danger" v-if="inputMultiple" v-on:click="removeinput(input.baseValue.inputCount)">Remove </div>-->
</section>

    </div>
</template>

<script>
    import MS from '../MS';
    //console.log(MS);
    export default {

        name: 'inputtext',
        mixins: [MS],
        props:{
            'msData':{
                type: Object,
                required: true
            }
        },

        mounted() {

           // console.log(this.msData);

            if(this.msData.hasOwnProperty('groupInput'))this.groupInput=this.msData.groupInput;
            if(this.msData.hasOwnProperty('name'))this.inputName=this.msData.name;
            if(this.msData.hasOwnProperty('vName'))this.inputVname=this.msData.vName;
           // if(!this.msData.hasOwnProperty('vName'))this.inputVname=this.msData.name;
            if(this.msData.hasOwnProperty('prefix'))this.inputPrefix=this.msData.prefix;
            if(this.msData.hasOwnProperty('perfix'))this.inputPerfix=this.msData.perfix;
            if(this.msData.hasOwnProperty('inputOnly'))this.inputOnly=this.msData.inputOnly;
            if(this.msData.hasOwnProperty('type'))this.inputType=this.msData.type;
            if(this.msData.hasOwnProperty('required'))this.inputRequired=this.msData.required;
            if(this.msData.hasOwnProperty('verifyBy'))
            {

                if(this.msData.verifyBy.hasOwnProperty('msdata'))this.inputAuto=this.msData.verifyBy.msdata;
                if(this.msData.verifyBy.hasOwnProperty('value'))this.dValue=this.msData.verifyBy.value;
                if(this.msData.verifyBy.hasOwnProperty('text'))this.dText=this.msData.verifyBy.text;



            }
            if(this.msData.hasOwnProperty('inputMultiple'))this.inputMultiple=this.msData.inputMultiple;

            if(this.msData.hasOwnProperty('validation'))
            {
                var str=this.msData.validation;
                this.inputValidation=this.msData.validation;
            }

         //   var finalArray= this.makeArrayForInput(this);

            this.setFinalInput(this.makeArrayForInput(this));

            if(!this.$root.checkGroupExist(this.groupInput)){
                this.$root.setUpGroup(this.groupInput);
            }



       // console.log( this.inputValidation);
        },
        methods:{

            setError:function () {
                this.msValid="is-invalid";
            },
            getValue:function () {
                var returnF=this.msValue;
                return returnF;
            },
            removeinput(count){

                delete this.finalInput.splice(count, 1);
              //  this.finalInput.push(this.makeArrayForInput(this));
                inputCount--;
            },
            addinput(){
                this.finalInput.push(this.makeArrayForInput(this));
                inputCount++
            },
            setFinalInput(array){
                this.finalInput=[array];
             //   console.log(this.finalInput);
            },


        },
        data: function () {
            return {
                msValid: 0,
                msValue:'',
                msMinCharValidation:0,
                inputValidation:[],
                inputAuto:[],
                inputError:new Object(),
                inputName:'',
                inputVname:'',
                inputPrefix:'',
                inputPerfix:'',
                inputOnly:false,
                inputType:'text',
                inputRequired:false,
                dValue:'',
                dText:'',
                finalInput:new Object({}),
                inputMultiple:false,
                inputCount:0,
                groupInput:[]
            }
        }
        ,
        computed: {


        },
        watch: {
            msValue: function(val, oldVal) {

                if(this.inputRequired){

                    var error=0;

                    var inputLen=1;
                    if(this.inputValidation.hasOwnProperty("minSize")){
                        inputLen=this.inputValidation.minSize;
                    }


                    switch (this.inputType) {
                        case 'password':
                            inputLen=8;
                            if (this.validatePassword(val,inputLen)){

                                if(this.inputError.hasOwnProperty('passwordNotStrong'))
                                    delete this.inputError.passwordNotStrong;
                                if(error)error=0;

                            }else{

                                error=1;
                                if(!this.inputError.hasOwnProperty('string'))
                                    this.inputError.passwordNotStrong="Password Must have a lowercase, upercase, number, symbol & "+inputLen+" char. required";
                            }

                            break;
                    }





                    if(this.validateLen(val,inputLen)){
                        delete this.inputError.MinLen;
                        if(error)error=0;
                    }else {
                        error=1;
                        this.inputError.MinLen="Min. "+inputLen+" char. required";
                    }


                    if (!error) {
                        this.msValid="is-valid";
                    }else{

                        this.msValid="is-invalid";
                    }

                }else {
                    this.msValid=" ";
                }


            }
        }
    }
</script>
