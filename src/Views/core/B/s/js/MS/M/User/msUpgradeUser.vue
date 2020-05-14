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
            </table>     </div>
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
                            <th>Users</th>
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
                                }">{{plan.BaseCurrency}} {{ getPlanCurrentPrice(plan,key)}}<small>/ mon.</small></td>
                        </tr>
                        <tr>
                            <th>Total Amount to Pay </th>
                            <td v-for="(plan,key) in plans" :class="{
                                    'ms-selected-on':selectedPlan==key,
                                    'ms-selected-off':!(selectedPlan==key),
                                }">{{plan.BaseCurrency}} {{ getPlanCurrentPrice(plan,key,true)}}<small class="f_size_15">+GST</small></td>
                        </tr>
                        <tr>
                            <th>  </th>
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
            }
        },
        mounted() {

          this.plans=this.msData.AllPlans;
            for(var i  in this.plans )
            {
                if(this.msData.UserPlans.planId== this.plans[i]['UniqId'])this.selectedPlan=i;
                this.buyOption.push(1);
            }

        },
        methods:{
            getPlanCurrentPrice(plan,key,total=false){
                // console.log(typeof this.buyOption[key]);
                var fp=0;
                switch (this.buyOption[key]) {
                    case 1:
                        fp=plan.PerMonth;
                        break;
                    case 2:
                        fp=plan.PerMonth - (plan.PerMonth* plan.PerMonthFor6Month)/100;
                        if(total)fp=fp*6;
                        break;
                    case 3:
                        fp=plan.PerMonth - (plan.PerMonth* plan.PerMonthFor1Year)/100;
                        if(total)fp=fp*12;
                        break;
                    case 4:
                        fp=plan.PerMonth - (plan.PerMonth* plan.PerMonthFor2Year)/100;
                        if(total)fp=fp*24;
                        break;
                }
                return fp;
            }
        }
    }
</script>

<style scoped>

</style>
