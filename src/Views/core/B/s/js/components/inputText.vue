<template>
    <div class="form-group">


        <label v-if="!inputOnly">   {{ inputVname }}</label>
    <div class="input-group" data-toggle="tooltip" data-placement="left">
    
        <div v-if="inputPrefix" class="input-group-prepend">
            <i :class="'fa fa-'+inputPrefix+ ' input-group-text' " ></i>
        </div>


    <input :type="inputType" :name="inputName"  :class="'form-control '+msValid" v-model="msValue" :aria-describedby="inputName" :placeholder="'Enter '+inputVname+' here'">



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

        <small v-if="msValid == 'is-valid' " class="form-text text-muted text-right" :id="inputName" >
            {{msValue}}
        </small>

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


          //  this.msValid="is-invalid";

            if(this.msData.hasOwnProperty('name'))this.inputName=this.msData.name;
            if(this.msData.hasOwnProperty('vName'))this.inputVname=this.msData.vName;
           // if(!this.msData.hasOwnProperty('vName'))this.inputVname=this.msData.name;
            if(this.msData.hasOwnProperty('prefix'))this.inputPrefix=this.msData.prefix;
            if(this.msData.hasOwnProperty('perfix'))this.inputPerfix=this.msData.perfix;
            if(this.msData.hasOwnProperty('inputOnly'))this.inputOnly=this.msData.inputOnly;
            if(this.msData.hasOwnProperty('type'))this.inputType=this.msData.type;
            if(this.msData.hasOwnProperty('required'))this.inputRequired=this.msData.required;

            if(this.msData.hasOwnProperty('validation'))
            {
                var str=this.msData.validation;
                this.inputValidation=this.msData.validation;
            }



       // console.log( this.inputValidation);
        },
        methods:{


        },
        data: function () {
            return {
                msValid: 0,
                msValue:'',
                msMinCharValidation:0,
                inputValidation:[],
                inputError:new Object(),
                inputName:'',
                inputVname:'',
                inputPrefix:'',
                inputPerfix:'',
                inputOnly:false,
                inputType:'text',
                inputRequired:false
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
