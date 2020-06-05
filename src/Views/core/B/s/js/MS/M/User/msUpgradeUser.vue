<template>
<div>

    <div class="ms-active-plan">


        <div class="flex flex-wrap">
            <div class="flex-1">
                <h2 class="text-center">Current Plan Details</h2>
                <table class="ms-active-table">

                <tr>
                    <td rowspan="7">
                        <img class="ms-active-plan-img"  src="/ms/error/limit2.svg">
                    </td>
                    <th>Current Active Plan</th>
                    <td>{{  msData.UserPlans.name }}</td>
                </tr>
                <tr v-for="(type,key) in msData.UserPlans.limits">
                    <th>{{type.vName}}</th>
                    <td class="ms-active-limits"> {{type.usage}}/{{type.limit}} </td>
                </tr>
            </table>

                <div class="mt-2">
                    <table class="ms-active-table">

                        <tr>
                            <th colspan="2">Selected To Upgrade Plan</th>
                            <td colspan="3" v-if="plans.length>0">{{  plans[selectedPlan].PlanName}}</td>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-center" style="text-align: center;">Plan Details</th>
                        </tr>
                        <tr>
                            <th v-if="type.vName !='Valid upto'" v-for="(type,key) in msData.UserPlans.limits">
                                {{type.vName}}
                            </th>

                        </tr>
                        <tr >
                            <td class="ms-active-limits" v-if="type.vName !='Valid upto'" v-for="(type,key) in msData.UserPlans.limits">
                            {{getPlanLimit(type)}} <small v-if="getPlanLimit(type,true)!=0" class="text-green-500">( {{getPlanLimit(type,true)}} <i class="fas fa-long-arrow-alt-up "></i> )</small>
                            </td>
                        </tr>

                        <tr>
                            <th colspan="2">Cost : {{allCurrency[currentCurrency].symbol}} {{ (plans.length>0)? (getPlanCurrentPrice(plans[selectedPlan],selectedPlan,true)):0}}</th>
                            <th colspan="2" style="text-align: right;">{{(currentCurrency==2)?'GST':'IGST' }} (18%) : {{allCurrency[currentCurrency].symbol}} {{ (plans.length>0)? (getPlanCurrentPrice(plans[selectedPlan],selectedPlan,true) * 0.18).toFixed(2):0 }}</th>
                            <th colspan="1" style="text-align: right;">Total : {{allCurrency[currentCurrency].symbol}} {{ (plans.length>0)?((getPlanCurrentPrice(plans[selectedPlan],selectedPlan,true)) * 1.18).toFixed(2) :0}}</th>
                        </tr>
                    </table>

                </div>


            </div>
            <div class="flex-1">
                <h2 class="text-center">Select Plan to Upgrade</h2>

                <div class="ms-price-box">
                    <table class="ms-price-table">


                        <tr>
                            <th>Features</th>
                            <th v-for="(plan,key) in plans" rowspan="2" :class="{
                                    'ms-padding-fix':true,
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">
                                <img class="ms-plan-icon" :src="'/'+plan.PlanIcon"><br>
                                {{ plan.PlanName }}</th>

                        </tr>

                        <tr  >
                            <th class="relative  h-1 " >
                                <div class="absoluteinset-0 text-center pb-2">Plan Name</div>
                            </th>

                        </tr>


                        <tr>
                            <th>Company</th>
                            <td v-for="(plan,key) in plans"
                                :class="{
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">{{ plan.Company }}</td>
                        </tr>
                        <tr>
                            <th>Company/Users</th>
                            <td v-for="(plan,key) in plans" :class="{
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">{{ plan.PerCompanyUser * plan.Company}}</td>
                        </tr>
                        <tr>
                            <th>Product</th>
                            <td v-for="(plan,key) in plans" :class="{
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">{{ plan.Product * plan.Company}}</td>
                        </tr>

                        <tr>
                            <th>Invoice</th>
                            <td v-for="(plan,key) in plans" :class="{
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">{{ plan.Invoice * plan.Company}} <small>/ mon.</small></td>
                        </tr>
                        <tr>
                            <th>Purchase</th>
                            <td v-for="(plan,key) in plans" :class="{
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">{{ plan.Purchase * plan.Company}}<small>/ mon.</small></td>
                        </tr>


                        <tr>
                            <th>Buy for </th>
                            <td v-for="(plan,key) in plans" :class="{
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">
                                <select v-if="true" class="f_size_15" v-model="buyOption[key]">
                                    <option :value="1">1 Months</option>
                                    <option :value="2">6 Months</option>
                                    <option :value="3">1 Year</option>
                                    <option :value="4" selected>2 Year</option>
                                </select></td>
                        </tr>

                        <tr>
                            <th>Price</th>
                            <td v-for="(plan,key) in plans" :class="{
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">{{allCurrency[currentCurrency].symbol}} {{ getPlanCurrentPrice(plan,key)}}<small>/ mon.</small></td>
                        </tr>
                        <tr>
                            <th>Total Amount to Pay </th>
                            <td v-for="(plan,key) in plans" :class="{
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">{{allCurrency[currentCurrency].symbol}} {{ getPlanCurrentPrice(plan,key,true)}}<small class="f_size_15"> + {{ (currentCurrency==2)?'GST':'IGST' }}</small></td>
                        </tr>
                        <tr>
                            <th>    <select class="border cursor-pointer" v-model="currentCurrency">
                                <option v-for="(cur,key) in allCurrency" :value="key">{{cur.desc}}</option>
                            </select> </th>
                            <td v-for="(plan,key) in plans" :class="{
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">

                                <button class="ms-select-btn" v-on:click="selectPlan(key)" v-if="!(selectedPlan==key)">Select This</button>
                                <button class="ms-select-btn-selected"  disabled="disabled" v-else>Selected</button>

                            </td>
                        </tr>




                    </table>

                </div>



            </div>



        </div>
        <div class="flex flex-wrap my-3 py-2 background-blue-200">
            <button class="flex-1 text-center">Procced to Checkout</button>
        </div>

    </div>




</div>
</template>

<script>
    export default {
        name: "msupgradeuser",
        props:{
            'msData':{
                type: Object,
                required: true
            }
        },
        data:function () {
            return {
                plans:[],
                selectedPlan:0,
                buyOption:[],
                //AllCurrencyRates:{},
                allCurrency: [
                    {name:"USD", desc:"US Dollar",symbol:'$'},
                    {name:"EUR", desc:"Euro",symbol:'€'},
                    {name:"INR", desc:"Indian Rupee",symbol:'₹'}
                ],
                currentCurrency:2
            }
        },
        mounted() {


            this.getAllCurrencyRates();
          this.plans=this.msData.AllPlans;
            for(var i  in this.plans )
            {
                if(this.msData.UserPlans.planId== this.plans[i]['UniqId'])this.selectedPlan=i;
                this.buyOption.push(1);
            }
            var th= this;
            th.setNextPlan();


        },
        methods:{
            setNextPlan(){
            switch (this.msData.UserPlans.name) {
                    case 'Paper Plane':
                        this.selectedPlan='1';
                        break;

                    case 'Jet Plane':
                      this.selectedPlan='2';
                      break;
              }
            },
            getPlanLimit(type,increase=false){
                var planSelected=this.selectedPlan;
                var plan=this.plans;
                var out='';

                switch (type.vName) {
                        case 'Products':
                            if(plan.length>0){
                           out= type.usage+"/"+plan[planSelected].Product;
                           if(increase)out= plan[planSelected].Product - type.limit ;

                            }
                            break;

                        case 'Invoice':
                            if(plan.length>0){
                                out= type.usage+"/"+plan[planSelected].Invoice;
                                if(increase)out= plan[planSelected].Invoice - type.limit ;
                            }
                            break;
                        case 'Purchase':
                            if(plan.length>0){
                                out= type.usage+"/"+plan[planSelected].Purchase;
                                if(increase)out= plan[planSelected].Purchase - type.limit ;

                            }
                            break;
                        case 'Company':
                            if(plan.length>0){
                               out= type.usage+"/"+plan[planSelected].Company;
                                if(increase)out= plan[planSelected].Company - type.limit ;
                            }
                            break;
                        case 'Users/Company':
                            if(plan.length>0){
                                out= type.usage+"/"+plan[planSelected].PerCompanyUser;
                                if(increase)out= plan[planSelected].PerCompanyUser - type.limit ;
                            }
                            break;
                }


                return out;


            //  console.log(type);
            },
            setCurrenyRate(res,err=false){
                if(!err){
                   for (var i in this.allCurrency){
                       if(this.allCurrency[i].name != 'INR')this.allCurrency[i].rate= res.rates[this.allCurrency[i].name];
                   }
                }

            },
            getAllCurrencyRates(){
              var url='https://api.exchangeratesapi.io/latest?base=INR';
              var msClient=msInstance;
              var th=this;
              var data= {};
              let promise = fetch(url, {
                    method: "GET", // POST, PUT, DELETE, etc.
                  //  headers: {'Content-Type': 'application/json'},
                   // body: JSON.stringify(data)
                 }).then((res)=>res.json()).then((res)=>th.setCurrenyRate(res));

              console.log(promise);
             // msClient.get(url).then((res)=> th.setCurrenyRate(res)).catch((err)=>th.setCurrenyRate(err,true));
            },
            selectPlan(key){
                this.selectedPlan=key;
            },
            getPlanCurrentPrice(plan,key,total=false){
                // console.log(typeof this.buyOption[key]);
                var fp=0;
                var multiplier=1;

                var perMonth=plan.PerMonth;

                if(this.currentCurrency!=2)multiplier=this.allCurrency[this.currentCurrency].rate;
                perMonth=plan.PerMonth*multiplier;
                switch (this.buyOption[key]) {
                    case 1:
                        fp=perMonth;
                        break;
                    case 2:

                        fp=perMonth - (perMonth* plan.PerMonthFor6Month)/100;
                        if(total)fp=(fp*6);
                        break;
                    case 3:
                        fp=perMonth- (perMonth* plan.PerMonthFor1Year)/100;
                        if(total)fp=(fp*12);
                        break;
                    case 4:
                        fp=perMonth - (perMonth* plan.PerMonthFor2Year)/100;
                        if(total)fp=(fp*24);
                        break;
                }

                return (this.currentCurrency!=2)?fp.toFixed(2):fp.toFixed(0);
            }
        }
    }
</script>

<style scoped>

</style>
