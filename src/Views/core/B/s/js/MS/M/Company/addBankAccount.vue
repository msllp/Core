<template>
<div>
    <div class="ms-company-setup-box  ">
        <div class="ms-company-setup-image">

            <img class="ms-company-setup-image-icon" :src="MainIconImag">
        </div>
        <div  class="ms-company-setup-form">

            <div class="ms-company-setup-form-title" > {{MainTitle}}</div>

            <div class="ms-company-setup-form-body" >

                <div class="ms-company-setup-form-section">
                    <div class="ms-company-setup-form-body-head"> Business Basic Details </div>
                    <div v-for="rows in msForm" class="ms-company-setup-form-body-row">


                        <div v-for="col in rows" class="ms-company-setup-form-body-row-col">


                            <input v-on:keyup.enter="addAccountToCurrentList()" :class="{
                                'ms-sucess-input':(col.hasOwnProperty('validation') && checkInputisValid(col.model)),
                                'ms-failure-input':(col.hasOwnProperty('validation') &&  !checkInputisValid(col.model) ) ,

                            }"  v-on:keyup="updateAllInput()" v-model="allInput[col.model]" v-if="col.type=='text' || col.type=='number'" :type="col.type" class="ms-company-setup-form-input" :placeholder="'Enter '+col.name">
                            <div class="ms-company-setup-form-input" :class="{
                                'ms-sucess-input':checkInputisValid(col.model),
                                'ms-failure-input':!checkInputisValid(col.model),

                            }" v-if="col.type=='option'">
                                <select v-model="allInput[col.model]"   v-on:change="updateAllInput()">
                                    <option disabled selected value="disabled">Select {{col.name}}</option>
                                    <option v-for="op in  (col.hasOwnProperty('data'))?col.data:msDatafromServer[col.model]" :value="op.value">{{op.name}}</option>
                                </select>
                            </div>

                            <div v-if="checkInputisValid(col.model) && col.type!='option' && col.hasOwnProperty('validation')" class="ms-company-setup-form-input-ok"><i class="fas fa-check"></i></div>

                            <div :class="{
                                'ms-company-setup-form-input-lable':checkInputisValid(col.model),
                                'ms-company-setup-form-input-lable-have-error':!checkInputisValid(col.model),
                            }">{{col.name}}
                                <sup v-if="col.hasOwnProperty('required') && col.required" class="ms-company-setup-form-input-lable-required" >*</sup>

                            </div>


                            <div class="ms-company-setup-form-input-error" v-for="er in  getInputError(col.model)">

                                {{ er }}
                            </div>

                        </div>

                    </div>
                </div>

                <div class="ms-company-setup-form-section" v-on:click="addAccountToCurrentList()" :class="{
                        'ms-add-account-btn-disabled':!validToPost(),
                        'ms-add-account-btn':validToPost()
                    }">
                    <div  class=" ms-company-setup-form-body-head" >
                         <span class="fi2 flaticon-plus" ></span>   Add Account
                    </div>
                </div>

                <div class="ms-company-setup-form-section">
                    <div class="ms-company-setup-form-body-head">Bank Accounts</div>
                    <div class="ms-company-setup-form-body-row border-b">


                        <div class="ms-company-setup-form-body-row-col text-center">
                        Bank
                        </div>
                        <div class="ms-company-setup-form-body-row-col text-center">
                        IFSC
                        </div>
                        <div class="ms-company-setup-form-body-row-col text-center">
                        Type
                        </div>
                        <div class="ms-company-setup-form-body-row-col text-center">
                        Account Holder
                        </div>
                        <div class="ms-company-setup-form-body-row-col text-center">
                        Account No.
                        </div>
                        <div class="ms-company-setup-form-body-row-col text-center">
                        Balance
                        </div>

                    </div>


                    <div class="ms-company-setup-form-body-row border-t border-b" v-for="(ac,key) in allAccounts">


                        <div class="ms-company-setup-form-body-row-col text-center" >
                            <span
                                :class="{
                                'ms-delete-btn-disabled':ac.hasOwnProperty('delete') && ac.delete==false,
                                'ms-delete-btn':(!ac.hasOwnProperty('delete') || (ac.hasOwnProperty('delete') && ac.delete==true))
                                }"
                                v-on:click="removeAcFromList(key)" class="fi2 flaticon-trash"></span>   <span class="block py-1">{{forNice(ac.BankName)}},<small>{{forNice(ac.BankBranch)}}</small> </span>
                        </div>
                        <div class="ms-company-setup-form-body-row-col text-center  py-1" >
                           {{ac.IFSC}}
                        </div>
                        <div class="ms-company-setup-form-body-row-col text-center  py-1" >
                           {{forNice(ac.AccountType)}}
                        </div>
                        <div class="ms-company-setup-form-body-row-col text-center py-1" >
                           {{ac.AccounHolder}}
                        </div>
                        <div class="ms-company-setup-form-body-row-col text-center py-1" >
                           {{ac.BankAcNo}}
                        </div>
                        <div class="ms-company-setup-form-body-row-col text-center py-1" >
                          {{currency}} {{forIndianFormat(ac.CurrentBalance)}}
                        </div>


                    </div>


                </div>





            </div>

            <div class="ms-company-setup-form-footer">

                <div
                    :class="{ 'ms-company-setup-form-footer-btn-save':true}"
                    v-on:click="postForm()"> Save </div>

            </div>


        </div>



    </div>
</div>

</template>

<script>
   import  MS from '../../C/MS';
    export default {
        name: "addbankaccount",
        mixins:[MS],
        props:{
            'msData':{
                type: Object,
                required: true
            }
        },
        data(){
            return {
                MainIconImag:this.msData.path.img.ac,
                MainTitle:'Add bank Account',
                allAccounts:[],
                currency:'₹',
                msForm:[
                    [
                        {
                            name:'Name Of Bank',
                            type:'text',
                            model:'BankName',
                            required:true,
                            validation:{presence: {allowEmpty: false}}
                        },
                        {
                            name:'Branch',
                            type:'text',
                            model:'BankBranch',
                            required:true,
                            validation:{presence: {allowEmpty: false}}
                        },
                        {
                            name:'IFSC',
                            type:'text',
                            model:'IFSC',
                            required:true,
                            validation:{presence: {allowEmpty: false}}
                        },
                        {
                            name:'Type of Account',
                            type:'option',
                            model:'AccountType',
                            required:true,
                            validation:{presence: {allowEmpty: false}},
                            data:[
                                {
                                    name:'Current',
                                    value:'current'
                                },
                                {
                                    name:'Saving',
                                    value:'saving'
                                },
                            ]
                        },

                    ],
                    [

                       {
                             name:'Account Holder',
                             type:'text',
                             model:'AccounHolder',
                             required:true,
                             validation:{presence: {allowEmpty: false}},

                       },
                       {
                             name:'Bank Account No.',
                             type:'number',
                             model:'BankAcNo',
                             required:true,
                             validation:{presence: {allowEmpty: false}},

                                    },
                       {
                            name:'Current balance',
                            type:'number',
                            model:'CurrentBalance',
                            required:true,
                            validation:{presence: {allowEmpty: false}},

                        },
                    ]
                ],
                msFormDefaultValue:[
                    {
                        name:'AccountType',
                        value:'disabled'
                    },
                ],
                msDatafromServer:{},
                allInput:{},
                logo:'',
                validationInput:{},
                formPostedAndWaitingForData:false,
                valdidationInputError:{}
            };
        },
        mounted() {
            var def= {};
            for (var i in this.msFormDefaultValue){
                def[this.msFormDefaultValue[i].name]=this.msFormDefaultValue[i].value;
            }
            this.setDataFromServer(this.msForm2);
            this.allInput=def;
            this.getExistingAccounts();
           // this.addSampleAC();


       //     this.validateAll(this.allInput,this.msConditionalForm[this.allInput.typeOfBusiness])

        },

        methods:{
            setExistingAccounts(data){
                this.allAccounts=data;
            },
            getExistingAccounts(){
            var msClient=msInstance;
            var url=this.msData.path.data.allAccounts;
            var th=this;
            msClient.get(url).then((res)=>th.setExistingAccounts(res.data.msData));


            },
            removeAcFromList(key){

                this.allAccounts.splice(key,1);
            },
            scrollToTop() {
                window.scrollTo(0,0);
            },
            addAccountToCurrentList(){
                if(this.validToPost()){
                    this.addAccount();
                    this.resetForm();
                    this.scrollToTop();
                }
            },

            addSampleAC(){
            var ac={
                AccountType:"current",
                BankAcNo:"1280398120830810",
                BankName:"bank of baroda",
                BankBranch:"piplod",
                IFSC:"212312",
                CurrentBalance: this.forIndianFormat("10000")
            };
            this.addAccount(ac);
            },

            addAccount(ac=null){
                if(ac==null)ac=this.allInput;
                this.allAccounts.push(ac);
            },

            resetForm(){
                var def= {};
                for (var i in this.msFormDefaultValue){
                    def[this.msFormDefaultValue[i].name]=this.msFormDefaultValue[i].value;
                }
                this.allInput=def;
            },

            onDragLogo(e){
                e.stopPropagation();
                e.preventDefault();
                var files = e.dataTransfer.files;
                this.showLogo(files[0]);

            },
            msCurrentCusomForm(formInput){
                switch (formInput) {
                    case 'typeOfBusiness':
                        return  (this.msConditionalForm.hasOwnProperty(formInput) && this.allInput.hasOwnProperty(formInput) && this.msConditionalForm[formInput].hasOwnProperty(this.allInput[formInput]))?this.msConditionalForm[formInput][this.allInput[formInput]]:[];

                        break;
                }

            },
            setFile(e,name){
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.showLogo(files[0]);
            },
            showLogo(file){
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.allInput.logo=e.target.result;
                    vm.logo = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            validateAll(val,form) {

                if (val == 'undfined' || typeof val=='undfined') val = this.allInput;
                if (form == 'undfined' || typeof form=='undfined') val = this.msForm;
                var verify = window.msValidate;
                var validated = {};
                var error={};
                for (var p in form) {
                    //console.log(p);

                    for (var i in form[p]) {
                        //   console.log(i);
                        var input = form[p][i];
                        // console.log(this.msForm[p][i]);
                        if (input.hasOwnProperty('validation') && this.allInput.hasOwnProperty(input.model)) {

                            var validInputState=verify.single(this.allInput[input.model], input.validation);
                            //   console.log(validInputState);
                            validated[input.model] = ((validInputState == 'undefined' || typeof validInputState == 'undefined') && this.allInput[input.model]!='disabled' ) ? true : false;
                            //     if(input.model=='state')console.log(validated[input.model]);
                            if(validated[input.model]){

                                error[input.model]= [];

                            }else {
                                //     if(input.model=='state')console.log(validated[input.model]);

                                error[input.model]= verify.single(this.allInput[input.model], input.validation);
                                if((error[input.model] == 'undefined' || typeof error[input.model] == 'undefined') && input.type=='option',val[input.model]=='disabled'){
                                    error[input.model]=["can't be blansk"];
                                }



                            }
                            //console.log((verify.single(this.allInput[this.msForm[p][i].model], input.validation) == 'undefined') ? true : false);
                        } else {

                            if(input.hasOwnProperty('validation')) error[form[p][i].model]=verify.single(this.allInput[form[p][i].model], input.validation);
                            validated[form[p][i].model] = (input.hasOwnProperty('validation')) ? false : true;
                        }
                    }

                }
                this.valdidationInputError={...this.valdidationInputError,...error};
                this.validationInput = {...this.validationInput,...validated};
            },
            checkInputisValid(name){

                return (this.validationInput.hasOwnProperty(name))?this.validationInput[name]:false;
            },
            getInputError(name){

                return (this.valdidationInputError.hasOwnProperty(name) )?this.valdidationInputError[name]:[];

            },
            updateAllInput(){
                var newVal=this.allInput;
                this.allInput={};
                this.allInput=newVal;
            },
            getDataForInput(input){
                var th=this;
                if(!th.msDatafromServer.hasOwnProperty(input.model)){
                    var url =input.dataUrl;
                    var client = window.msInstance;
                    //  console.log('Dta from Server');
                    th.msDatafromServer[input.model]
                    client.get(url).then(function (res) {
                        // console.log('data fetched from server')
                        th.msDatafromServer[input.model]=res.data.msData;
                        th.allInput[input.model]='disabled';
                        th.updateAllInput();
                    });
                }
            },
            setDataFromServer(form){

                for (var p in form ){
                    for (var i in form[p] ){
                        if(form[p][i].hasOwnProperty('dataUrl')){
                            this.getDataForInput(form[p][i]);
                        }
                    }
                }

            },

            postForm (){
                if(!this.formPostedAndWaitingForData ){
                     this.formPostedAndWaitingForData=true;
                    var client=window.msInstance;
                    var url=this.msData.path.form.post;
                    var th=this;

                    client.post(url,this.allAccounts).then(function (res) {
                        if(res.data.hasOwnProperty('ms')){
                            var msData=res.data.ms;
                            th.formPostedAndWaitingForData=false;
                            if(msData.hasOwnProperty('nextData')){
                                vueApp.updateTab(msData.nextData);
                            }

                        }else{
                            th.formPostedAndWaitingForData=false;
                            console.log('Not Valid Response');
                            console.log(res.data);

                        }

                    }).catch(function (er) {
                        th.formPostedAndWaitingForData=false;
                        console.log(er);
                    });
                }

            },

            validToPost(){
                for (var i in this.validationInput){
                    if(!this.validationInput[i])return false;
                }
                return true;

            }


        },
        watch:{
            allInput(newVal,oldVal){
                //   console.log('validates');
                this.validateAll(newVal,this.msForm);
             //   this.validateAll(newVal,this.msForm2);
                //console.log(newVal.typeOfBusiness);
                //  console.log(this.msConditionalForm.typeOfBusiness[newVal.typeOfBusiness]);
              //  if(newVal.typeOfBusiness !='disabled')this.validateAll(newVal,this.msConditionalForm.typeOfBusiness[newVal.typeOfBusiness]);


            }


        },



    }
</script>

<style scoped>

</style>
