<template>
    <div>

        <div class="ms-company-setup-box">

            <div class="ms-company-setup-image">

                <img class="ms-company-setup-image-icon" src="/ms/user/addrole.svg">
            </div>

            <div  class="ms-company-setup-form">

                <div class="ms-company-setup-form-title" > <span v-if="this.msData.hasOwnProperty('fillData')">Edit</span><span v-else>Add</span> Role</div>

                <div class="ms-company-setup-form-body" >

                    <div class="ms-company-setup-form-section">
                        <div class="ms-company-setup-form-body-head"> Basic Role Details </div>
                        <div v-for="rows in msForm" class="ms-company-setup-form-body-row">


                            <div v-for="col in rows" class="ms-company-setup-form-body-row-col">


                                <input :class="{
                                'ms-sucess-input':(col.hasOwnProperty('validation') && checkInputisValid(col.model)),
                                'ms-failure-input':(col.hasOwnProperty('validation') &&  !checkInputisValid(col.model) ) ,

                            }"  v-on:keyup="updateAllInput()" v-model="allInput[col.model]" v-if="col.type=='text'" type="text" class="ms-company-setup-form-input" :placeholder="'Enter '+col.name">
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
                    <div class="ms-company-setup-form-section">
                        <div class="ms-company-setup-form-body-head">Grant Access to Company  </div>

                        <div class="ms-company-setup-form-body-row ">
                            <div class="ms-company-setup-form-body-row-col  pt-2" v-for="(company,key) in companies">
                            <div class="p-1 flex flex-wrap border cursor-pointer" v-on:click="changeCurrentCompany(key)" :class="{ 'bg-gray-200':companySelected==key}">
                                <div class="w-full">  <img :src="company.CompanyLogo" class="h-12"> </div>
                                <div v-on:click="selectCompany(key)" class="flex flex-wrap">
                                    <div class="p-2 flex" ><input type="checkbox" class="cursor-pointer" :checked="companySelectedOrnot(key)"></div>

                                    <div class="p-1 flex-1" >{{company.CompanyName}}</div>
                                </div>


                            </div>

                            </div>

                        </div>

                    </div>




                    <div class="ms-company-setup-form-section">
                        <div class="ms-company-setup-form-body-head">Grant Access to Modules & Actions (For {{getCurrentCompany().CompanyName}})  </div>
                        <div class="ms-company-setup-form-body-row ">
                            <div class="ms-company-setup-form-body-row-col border pt-2">
                                <div v-on:click="selectModule(key)"  v-for="(mod,key) in modules" :class="{'bg-blue-300':key==selctedModule}" class="flex flex-wrap cursor-pointer ">
                                  <div class="p-1">
                                      <input v-on:click="changeMod(key,mod)" type="checkbox"  class="cursor-pointer" :checked="checkModSelectedOrNot(mod)"></div>

                                    <div class="p-1" >{{mod.name}}</div>

                                </div>

                            </div>
                            <div class="ms-company-setup-form-body-row-col border">
                                <div class="border-b p-1 bg-blue-300 mt-2">
                                    {{ modules[selctedModule].name }}
                                </div>
                                <div v-for="(option,key) in modules[selctedModule].action" class="pt-2">

                                    <div>
                                        <div class="flex flex-wrap cursor-pointer border" v-on:click="selectSubSectionMod(key,option,$event)" >
                                            <div class="p-1"><input class="cursor-pointer"  type="checkbox" :checked="checkSectionSelectedOrNot(option)" ></div>
                                            <div class="p-1">{{option.section}}</div>
                                        </div>
                                        </div>
                                    <ul class="pl-4">
                                            <li class="pl-2" v-for="ac  in option.action">


                                            <div class="flex flex-wrap cursor-pointer border" v-on:click="selectSubActionSelection(option,ac)">
                                                <div class="p-1"><input  class="cursor-pointer" type="checkbox"  :checked="checkSubActionSelectedOrNot(option,ac)" ></div>
                                                <div class="p-1">{{ac.name}}</div>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                        </div>

                    </div>




                </div>

                <div class="ms-company-setup-form-footer">

                    <div
                        :class="{ 'ms-company-setup-form-footer-btn-save-diabled':!validToPost(),
                                    'ms-company-setup-form-footer-btn-save':validToPost()
                                    }"
                        v-on:click="postForm()"> Save </div>

                </div>


            </div>

        </div>


    </div>
</template>

<script>
    export default {
        name: "addrole",
        props:{
        'msData':{
            type: Object,
            required: true
        }
        },
        data: function() {
            return {
                companySelected:0,
                modules:[
                    {
                        name:'Sales',
                        action:[
                            {
                                section:'Inovoice',
                                action: [
                                    {
                                    name:'Add Invoice'
                                },
                                    {
                                        name:'View Invoice'
                                    },
                                    {
                                        name:'Edit Invoice'
                                    }
                                    ]
                            }

                        ]
                    },
                    {
                        name:'Purchase',
                        action:[
                            {
                                section:'Bills',
                                action: [
                                    {
                                    name:'Add Purchase Bill'
                                },
                                    {
                                        name:'View Purchase Bill'
                                    },
                                    {
                                        name:'Edit Purchase Bill'
                                    }
                                    ]
                            }

                        ]
                    }
                ],
                companies:{},
                selctedModulesArray:[],
                selctedModule:0,
                msForm:[
                    [
                        {
                            name:'User Role Name',
                            type:'text',
                            model:'userrolename',
                            required:true,
                            validation:{presence: {allowEmpty: false}}
                        },
                        {
                            name:'User Role Description',
                            type:'text',
                            model:'userdescription',
                            required:true,
                            validation:{presence: {allowEmpty: false}}
                        },

                    ],
                ],

                msFormDefaultValue:[
                    {
                        name:'subModules',
                        value: {}
                    },
                    {
                        name:'modules',
                        value: {}
                    },
                    ,
                    {
                        name:'companies',
                        value: {}
                    },

                ],
                msDatafromServer:{},
                //   msCurrentCusomForm:[],
                allInput:{},
                logo:'',
                greeting: "Hello",
                validationInput:{},
                formPostedAndWaitingForData:false,
                valdidationInputError:{},
                modalForm:false
            };
        },
        methods:{

            companySelectedOrnot(key){
                var CompanyId= this.companies[key].UniqId;
                return this.allInput.companies.hasOwnProperty(CompanyId) && this.allInput.companies[CompanyId];
            },

            selectCompany(key){
                var CompanyId= this.companies[key].UniqId;
               // console.log((this.allInput.companies.hasOwnProperty(CompanyId) && this.allInput.companies[CompanyId]));
                this.allInput.companies[CompanyId]=(this.allInput.companies.hasOwnProperty(CompanyId) && this.allInput.companies[CompanyId])?false:true;
                this.updateAllInput();
                },
            getCurrentCompany(){
              return   this.companies[this.companySelected];
            },
            changeCurrentCompany(key){
              this.companySelected=key;
            },
            checkSectionSelectedOrNot(data){

                var secName=data.id;
                var mainMod=this.modules[this.selctedModule].id;
                var companyId=this.getCurrentCompany()['UniqId'];
                if(!this.allInput.subModules.hasOwnProperty(companyId))return false;

                if(!this.allInput.subModules[companyId].hasOwnProperty(mainMod))return false;

                if(!this.allInput.subModules[companyId][mainMod].hasOwnProperty(secName))return false;

              //  console.log(data);

                for (var i in data.action){
                    var actionName=data.action[i].id;
                    if(!this.allInput.subModules[companyId][mainMod][secName].hasOwnProperty(actionName))return false;
                    if(this.allInput.subModules[companyId][mainMod][secName].hasOwnProperty(actionName) && !this.allInput.subModules[companyId][mainMod][secName][actionName])return false;

                 }
                return  true;
            },
            checkSubActionSelectedOrNot(sub,ac){

                var modName=sub.id;
                var actionName=ac.id;
                var mainMod=this.modules[this.selctedModule].id;
                var companyId=this.getCurrentCompany()['UniqId'];
                //console.log('Section : '+modName +' Action: '+actionName)
                if(  this.allInput.subModules.hasOwnProperty(companyId) && this.allInput.subModules[companyId].hasOwnProperty(mainMod) && this.allInput.subModules[companyId][mainMod].hasOwnProperty(modName) && this.allInput.subModules[companyId][mainMod][modName].hasOwnProperty(actionName) && this.allInput.subModules[companyId][mainMod][modName][actionName]){
                    return true;
                }
                return false;
            },
            checkModSelectedOrNot(mod){
                var modName=mod.id;
                var companyId=this.getCurrentCompany()['UniqId'];
                if(!this.allInput.modules.hasOwnProperty(companyId))this.allInput.modules[companyId]={};
                if(!this.allInput.modules[companyId].hasOwnProperty(modName))return false;
                return this.allInput.modules[companyId][modName];
            },
            changeMod(key,mod){
                var modName=mod.id;
                var companyId=this.getCurrentCompany()['UniqId'];
                console.log(companyId);
                if(!this.allInput.modules.hasOwnProperty(companyId))this.allInput.modules[companyId]={};
                if(this.allInput.modules[companyId].hasOwnProperty(modName)){
                    this.allInput.modules[companyId][modName]=(this.allInput.modules[companyId][modName])?false:true;
                }else{
                    this.allInput.modules[companyId][modName]=true;
                }
                this.updateAllInput();
            },
            selectSubSectionMod(key,mod,e){
                var section=mod.id;
                var mainMod=this.modules[this.selctedModule].id;
                var companyId=this.getCurrentCompany()['UniqId'];
                if(!this.allInput.subModules.hasOwnProperty(companyId))this.allInput.subModules[companyId]={};
                if(!this.allInput.subModules[companyId].hasOwnProperty(mainMod))this.allInput.subModules[companyId][mainMod]={};

               // if(!this.allInput.subModules.hasOwnProperty(section))this.allInput.subModules[section]={};

                if(this.allInput.subModules[companyId][mainMod].hasOwnProperty(section)){


                    var sectionSelected=this.checkSectionSelectedOrNot(mod);

                    for(var i in mod.action){
                                var actionName=mod.action[i].id;
                                this.allInput.subModules[companyId][mainMod][section][actionName]= (this.allInput.subModules[companyId][mainMod][section].hasOwnProperty(actionName) && this.allInput.subModules[companyId][mainMod][section][actionName] && sectionSelected)?false:true;

                            }


                }else {
                    this.allInput.subModules[companyId][mainMod][section]={};
                    for(var i in mod.action){
                        var actionName=mod.action[i].id;
                        this.allInput.subModules[companyId][mainMod][section][actionName]=true;
                    }

                }
                this.updateAllInput();
              //  console.log(e.target.checked);

            },
            selectSubActionSelection(sec,ac){
                var secName=sec.id;
                var actioName=ac.id;
                var mod=this.modules[this.selctedModule].id;
                var companyId=this.getCurrentCompany()['UniqId'];
                //console.log(mod);
                if(!this.allInput.subModules.hasOwnProperty(companyId))this.allInput.subModules[companyId]={};
                if(!this.allInput.subModules[companyId].hasOwnProperty(mod))this.allInput.subModules[companyId][mod]={};

                if(this.allInput.subModules[companyId][mod].hasOwnProperty(secName)){
               //     console.log(1);
                   if(this.allInput.subModules[companyId][mod][secName].hasOwnProperty(actioName))this.allInput.subModules[companyId][mod][secName][actioName]=(this.allInput.subModules[companyId][mod][secName][actioName])?false:true ;
                   if(!this.allInput.subModules[companyId][mod][secName].hasOwnProperty(actioName))this.allInput.subModules[companyId][mod][secName][actioName]=true ;

                }else {
                 //   console.log(2);
                    this.allInput.subModules[companyId][mod][secName]={};
                    this.allInput.subModules[companyId][mod][secName][actioName]=true;
                }
                this.updateAllInput();
            },
            selectModule(key){
               this.selctedModule=key;
            },

            msCurrentCusomForm(formInput){
                switch (formInput) {
                    case 'typeOfBusiness':
                        return  (this.msConditionalForm.hasOwnProperty(formInput) && this.allInput.hasOwnProperty(formInput) && this.msConditionalForm[formInput].hasOwnProperty(this.allInput[formInput]))?this.msConditionalForm[formInput][this.allInput[formInput]]:[];

                        break;
                }

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
                if(!this.formPostedAndWaitingForData && this.validToPost()){
                    // this.formPostedAndWaitingForData=true;
                    var client=window.msInstance;
                    var url=this.msData.path.post;
                    console.log(url);
                    var th=this;

                    client.post(url,this.allInput).then(function (res) {
                        if(res.data.hasOwnProperty('ms')){
                            var msData=res.data.ms;

                            if(th.modalForm){
                                vueApp.closeModal();
                            }else {
                                if(msData.hasOwnProperty('nextData')){
                                    vueApp.updateTab(msData.nextData);
                                }
                            }


                        }else{
                            console.log('Not Valid Response');
                            console.log(res.data);

                        }

                    }).catch(function (er) {
                        console.log(er);
                    });

                    console.log("form ");
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
             //   if(newVal.typeOfBusiness !='disabled')this.validateAll(newVal,this.msConditionalForm.typeOfBusiness[newVal.typeOfBusiness]);


            }


        },
        beforeMount() {
            var def={};
            for (var i in this.msFormDefaultValue){
                def[this.msFormDefaultValue[i].name]=this.msFormDefaultValue[i].value;
            }
            this.modules=this.msData.permissions;
            this.companies=this.msData.companies;
            this.allInput=def;
            if(this.msData.hasOwnProperty('modalForm'))this.modalForm=this.msData.modalForm;

        },
        mounted(){

            if(this.msData.hasOwnProperty('fillData') && this.msData.fillData.hasOwnProperty('companies') && (this.msData.fillData.companies.length == undefined || this.msData.fillData.companies.length>0)){
            this.allInput=this.msData.fillData;
            this.updateAllInput();
        }else{
            if(!this.msData.fillData==undefined){
                this.allInput.userdescription=this.msData.fillData.userdescription;
                this.allInput.userrolename=this.msData.fillData.userrolename;
                this.updateAllInput();

            }

            }



           // this.validateAll(this.allInput,this.msConditionalForm[this.allInput.typeOfBusiness])

        },
        computed:{



        }
    }
</script>

<style scoped>

</style>
