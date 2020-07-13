<template>
    <div>


        <div class="ms-company-setup-box  " >
            <div class="ms-company-setup-image">

                <img class="ms-company-setup-image-icon" :src="MainIconImag">
            </div>
            <div  class="ms-company-setup-form">

                <div class="ms-company-setup-form-title" > {{MainTitle}}</div>

                <div class="ms-company-setup-form-body" >



                    <div  v-if="!isMsLoading() && commanError" class="ms-company-setup-form-section-error">
                        <div class="ms-company-setup-form-body-head"> Sorry We Found some Error !  </div>
                        <div class="ms-company-setup-form-body-row"  v-for="er in commanErrorArray">

                            <div class="w-full">

                                <div v-if="typeof er =='array'||typeof er =='object'"  class="w-full" v-for="e in er">
                                    <i class="fas fa-exclamation-circle"></i>   {{e}}
                                </div>

                            </div>



                            <div  class="ms-company-setup-form-body-row-col">




                            </div>

                        </div>
                    </div>

                    <div v-if="!isMsLoading()" class="ms-company-setup-form-section">
                        <div class="ms-company-setup-form-body-head"> Type Of Customer </div>
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
                    <div v-if="!isMsLoading()" class="ms-company-setup-form-section">
                        <div class="ms-company-setup-form-body-head"> Basic Customer Details </div>
                        <div v-for="rows in msFormConditional1['typeOfCustomer'][allInput['typeOfCustomer']]" class="ms-company-setup-form-body-row">


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
                    <div v-if="!isMsLoading()" class="ms-company-setup-form-section">
                        <div class="ms-company-setup-form-body-head">Customer Settings </div>
                        <div v-for="rows in msForm2" class="ms-company-setup-form-body-row">


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








                </div>

                <div class="ms-company-setup-form-footer">

                    <div
                        :class="{ 'ms-company-setup-form-footer-btn-save':true,
                    'ms-add-account-btn-disabled':!validToPost(),
                        'ms-add-account-btn':validToPost()
                    }"
                        v-on:click="postForm()"> Save </div>

                </div>


            </div>



        </div>
    </div>

</template>

<script>
    import  MS from '../../C/MS';
    export default {
        name: "msclientform",
        mixins:[MS],
        props:{
            'msData':{
                type: Object,
                required: true
            }
        },
        data(){
            return {
                MainIconImag: this.msData.path.img.ac,
                MainTitle: 'Add New Customer',
                allAccounts: [],
                currency: '₹',
                msForm: [
                    [

                        {
                            name: 'Type of Customer',
                            type: 'option',
                            model: 'typeOfCustomer',
                            required: true,
                            validation: {presence: {allowEmpty: false}},
                            data: [
                                {
                                    name: 'Walk in',
                                    value: 'walkin'
                                },
                                {
                                    name: 'Business/Firm',
                                    value: 'company'
                                },
                            ]
                        },

                    ],
                ],
                msFormConditional1: {
                    typeOfCustomer:

                        {
                            walkin: [

                                [
                                    {
                                        name: 'First Name',
                                        type: 'text',
                                        model: 'FirstName',
                                        required: true,
                                        validation: {presence: {allowEmpty: false}},

                                    },
                                    {
                                        name: 'Last Name',
                                        type: 'text',
                                        model: 'LastName',
                                        required: true,
                                        validation: {presence: {allowEmpty: false}},

                                    },

                                    {
                                        name: 'Sex',
                                        type: 'option',
                                        model: 'sex',
                                        required: true,
                                        validation: {presence: {allowEmpty: false}},
                                        data: [
                                            {
                                                name: 'Male',
                                                value: true
                                            },
                                            {
                                                name: 'Female',
                                                value: false
                                            },
                                        ]
                                    },
                                ],
                                [
                                    {
                                        name: 'Mobile No.',
                                        type: 'text',
                                        model: 'contactNo',
                                        required: true,
                                        validation: {presence: {allowEmpty: false}},
                                    },
                                    {
                                        name: 'Email',
                                        type: 'text',
                                        model: 'email',
                                        required: false,
                                    },
                                ],
                                [
                                    {
                                        name: 'Block/Building No',
                                        type: 'text',
                                        model: 'adressLine1',
                                        required: false

                                    },
                                    {
                                        name: 'Road/Street',
                                        type: 'text',
                                        model: 'adressLine2',
                                        required: false
                                    },
                                    {
                                        name: 'Landmark/Area',
                                        type: 'text',
                                        model: 'adressLine3',
                                        required: false
                                    }
                                    ,
                                ],
                                [

                                    {
                                        name: 'City/Town',
                                        type: 'text',
                                        model: 'city',
                                        required: false,
                                    },
                                    {
                                        name: 'Pincode',
                                        type: 'text',
                                        model: 'pincode',
                                        required: false,
                                    },
                                    {
                                        dataUrl: msBackEnd + "/o3/Company/setup/company/get/states",
                                        name: 'State',
                                        type: 'option',
                                        model: 'state',
                                        required: false,
                                    }
                                ],
                                [
                                    {
                                        name: 'PAN',
                                        type: 'text',
                                        model: 'pan'

                                    },
                                    {
                                        name: 'GSTIN',
                                        type: 'text',
                                        model: 'gstin'
                                    }
                                ]


                            ],
                            company: [

                                [
                                    {
                                        name: 'Type of Company',
                                        type: 'option',
                                        model: 'typeOfCompany',
                                        required: true,
                                        validation: {presence: {allowEmpty: false}},
                                        data:[
                                            {
                                                name:'Sole proprietorship',
                                                value:'solo'
                                            },
                                            {
                                                name:'Partnership Firm',
                                                value:'partnership'
                                            },
                                            {
                                                name:'Limited Liability Partnership (LLP)',
                                                value:'llp'
                                            },
                                            {
                                                name:'Private Ltd Company (Pvt. Ltd.)',
                                                value:'private'
                                            },
                                            {
                                                name:'Public Ltd Company',
                                                value:'public'
                                            },
                                            {
                                                name:'Co-operatives Firm',
                                                value:'coop'
                                            }
                                        ]
                                    },
                                    {
                                        name: 'Category of Business',
                                        type:'option',
                                        model:'categoryOfBusiness',
                                        required:true,
                                        validation:{presence: {allowEmpty: false}},
                                        data:[
                                            {
                                                name:'Accounting Services',
                                                value:'as'
                                            },
                                            {
                                                name:'Consultants,Doctors,Lawyers & Similar',
                                                value:'consultants'
                                            },
                                            {
                                                name:'Information Technology',
                                                value:'it'
                                            },
                                            {
                                                name:'Manufacturing',
                                                value:'man'
                                            },
                                            {
                                                name:'Professional, Scientific & Technical Services ',
                                                value:'ts'
                                            },
                                            {
                                                name:'Resturants/Bars & Similar',
                                                value:'res'
                                            },
                                            {
                                                name:'Retail & Similar',
                                                value:'retail'
                                            },
                                            {
                                                name:'Other Financial Services',
                                                value:'ofs'
                                            },
                                            {
                                                name:'Other Services',
                                                value:'os'
                                            },
                                            {
                                                name:'Tours & Travel/Hospitality',
                                                value:'tours'
                                            },
                                            {
                                                name:'Wholesale Trade',
                                                value:'wt'
                                            },
                                            {
                                                name:'Logistics Transportation',
                                                value:'lt'
                                            },
                                            {
                                                name:'Other',
                                                value:'other'
                                            },
                                        ]
                                    },
                                    {
                                        name: 'Business Name',
                                        type: 'text',
                                        model: 'name',
                                        required: true,
                                        validation: {presence: {allowEmpty: false}},

                                    }

                                ],
                                [

                                    {
                                        name: 'PAN',
                                        type: 'text',
                                        model: 'pan',
                                        required: true,
                                        validation: {presence: {allowEmpty: false}},
                                    },
                                    {
                                        name: 'LLP No/ CIN',
                                        type: 'text',
                                        model: 'llporcin',
                                        required: false
                                    },
                                    {
                                        name: 'GSTIN',
                                        type: 'text',
                                        model: 'gstin',
                                        required: false
                                    },
                                ],
                                [
                                    {
                                        name: 'Block/Building No',
                                        type: 'text',
                                        model: 'adressLine1',
                                        required: false

                                    },
                                    {
                                        name: 'Road/Street',
                                        type: 'text',
                                        model: 'adressLine2',
                                        required: false
                                    },
                                    {
                                        name: 'Landmark/Area',
                                        type: 'text',
                                        model: 'adressLine3',
                                        required: false
                                    }
                                    ,
                                ],
                                [

                                    {
                                        name: 'City/Town',
                                        type: 'text',
                                        model: 'city',
                                        required: false,
                                    },
                                    {
                                        name: 'Pincode',
                                        type: 'text',
                                        model: 'pincode',
                                        required: false,
                                    },
                                    {
                                        dataUrl: msBackEnd + "/o3/Company/setup/company/get/states",
                                        name: 'State',
                                        type: 'option',
                                        model: 'state',
                                        required: false,
                                    }
                                ],
                                [
                                    {
                                        name: 'Contact Person',
                                        type: 'text',
                                        model: 'ContactPerson',
                                        required: false

                                    },
                                    {
                                        name: 'Contact No.',
                                        type: 'text',
                                        model: 'ContactNoofPerson',
                                        required: false
                                    },
                                    {
                                        name: 'Contact Email',
                                        type: 'text',
                                        model: 'ContactEmail',
                                        required: false
                                    },
                                ],


                            ]
                        }


                },
                msForm2: [
                    [

                        {
                            name: 'Customer Allow to use Payment Pending Status ?',
                            type: 'option',
                            model: 'allowTo',
                            required: true,
                            validation: {presence: {allowEmpty: false}},
                            data: [
                                {
                                    name: 'Yes',
                                    value: true
                                },
                                {
                                    name: 'No',
                                    value: false
                                },
                            ]
                        },
                        {
                            name: 'Credit Limit (Total)',
                            type: 'text',
                            model: 'CreditLimit',
                            required: false

                        },
                        {
                            name: 'Payment Credit Period (in Days)',
                            type: 'text',
                            model: 'paymentCreditPeriod',
                            required: false

                        },
                        {
                            name: 'Credit Invoice Limit',
                            type: 'text',
                            model: 'creditInvoiceLimit',
                            required: false

                        },

                    ],
                ],
                msFormDefaultValue: {},


                conditionMaterInputs:{
                    msFormConditional1:[
                        'typeOfCustomer'
                    ]

            },
                msDatafromServer:{},
                allInput:{},
                logo:'',
                validationInput:{},
                formPostedAndWaitingForData:false,
                valdidationInputError:{},
                commanError:false,
                commanErrorArray:[],
                inputError:{}

            };
        },
        mounted() {
            var def= {};
            if(this.msData.hasOwnProperty('default')){
                this.msFormDefaultValue=this.msData.default;
            }
            for (var i in this.msFormDefaultValue){
                def[this.msFormDefaultValue[i].name]=this.msFormDefaultValue[i].value;
            }
            this.setDataFromServer(this.msFormConditional1['typeOfCustomer'][this.allInput['typeOfCustomer']]);
            this.allInput=def;


            this.getExistingAccounts();


            // this.addSampleAC();


            //     this.validateAll(this.allInput,this.msConditionalForm[this.allInput.typeOfBusiness])

        },

        methods:{
            isMsLoading(){
                // console.log(window.vueApp.isMSLoading());
                // return window.vueApp.isMSLoading();
            },
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
            setDefaultValues(model){

                    this.allInput[model]=this.msFormDefaultValue[model].value;

            },
            validateAll(val,form,oldval={}) {

                if (val == 'undfined' || typeof val=='undfined') val = this.allInput;
                if (form == 'undfined' || typeof form=='undfined') form = this.msForm;
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
                for (var i in this.conditionMaterInputs){

                    for (var o in this.conditionMaterInputs[i]){

                        for (var inputms in this[i][this.conditionMaterInputs[i][o]]){

                            if(oldval.hasOwnProperty(this.conditionMaterInputs[i][o])) {

                                for(var h in this[i][this.conditionMaterInputs[i][o]][oldval[this.conditionMaterInputs[i][o]]]){
                                    for (var hr in this[i][this.conditionMaterInputs[i][o]][oldval[this.conditionMaterInputs[i][o]]][h]){
                                        this.valdidationInputError[this[i][this.conditionMaterInputs[i][o]][oldval[this.conditionMaterInputs[i][o]]][h][hr].model]={};
                                    //    console.log(this[i][this.conditionMaterInputs[i][o]][oldval[this.conditionMaterInputs[i][o]]][h][hr].model);
                                        this.validationInput[this[i][this.conditionMaterInputs[i][o]][oldval[this.conditionMaterInputs[i][o]]][h][hr].model]=true;
                                    }


                                }
                            }
                        }
                    }
                }
                this.valdidationInputError={...this.valdidationInputError,...error};
                this.validationInput = {...this.validationInput,...validated};
            },
            checkInputisValid(name){

                return (this.validationInput.hasOwnProperty(name))?this.validationInput[name]:true;
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
                        th.setDefaultValues(input.model);
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
                    th.commanError=true;
                    th.commanErrorArray=[];
                    client.post(url,this.allInput).then(function (res) {

                        if(res.data.hasOwnProperty('ms')){
                            var msData=res.data.ms;
                            th.formPostedAndWaitingForData=false;
                            if(msData.hasOwnProperty('nextData')){
                                vueApp.updateTab(msData.nextData);
                            }

                        }else{
                            th.formPostedAndWaitingForData=false;
                           // console.log('Not Valid Response');
                           // console.log(res.data);

                        }

                    }).catch(function (er) {
                        th.formPostedAndWaitingForData=false;
                        th.commanError=true;
                        th.commanErrorArray=er.response.data.errors;

                            if(er.response.data.hasOwnProperty('inputError'))for (var i in er.response.data.inputError){
                                th.valdidationInputError[i]=er.response.data.inputError[i];
                                th.validationInput[i]=false;
                            }
                        document.body.scrollTop = 0; // For Safari
                        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

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
                this.validateAll(newVal,this.msForm2);
                this.validateAll(newVal,this.msFormConditional1['typeOfCustomer'][newVal['typeOfCustomer']],oldVal);
                this.setDataFromServer(this.msFormConditional1['typeOfCustomer'][newVal['typeOfCustomer']]);

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
