<template>
<div>
    <div class="flex flex-wrap select-none">
        <div class="w-full">

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/3 p-3" v-for="b in badgesRow" v-on:click="clickOnBadge(b)">
                <!--Metric Card-->
                <div :class="{
                    ['bg-'+b.color+'-100']:true,
                    ['border-'+b.color+'-600']:true,
                    ['hover:bg-'+b.color+'-200']:true,
                    ['hover:border-'+b.color+'-700']:true,
                    'cursor-pointer':b.hasOwnProperty('action'),
                    'cursor-not-allowed':!b.hasOwnProperty('action')
                }" class=" border-b-4  rounded-lg shadow-lg p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5" :class="{ ['bg-'+b.color+'-600']:true }"><i :class="{[b.icon]:true }" class=" fa-2x fa-inverse"></i></div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h5 class="font-bold uppercase text-gray-600">{{b.title}}</h5>
                            <h3 class="font-bold text-3xl"><span v-if="b.hasOwnProperty('currency')">{{b.currency}}</span> {{b.subtitle}}</h3>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            </div>
        </div>
        <div class="w-full">

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/2 p-3" v-for="b in Charts">
                <!--Metric Card-->
                <div :class="{
                    ['bg-'+b.color+'-100']:true,
                    ['border-'+b.color+'-600']:true,
                    ['hover:bg-'+b.color+'-200']:true,
                    ['hover:border-'+b.color+'-700']:true,
                    'cursor-pointer':b.hasOwnProperty('action'),
                    'cursor-not-allowed':!b.hasOwnProperty('action')
                }" class=" border-b-4  rounded-lg shadow-lg p-5">
                    <div class="flex flex-row items-center">

                        <div class="flex-1 ">

                            <canvas :id="b.id" :ref="b.id"></canvas>

                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            </div>
        </div>

    </div>
</div>


</template>

<script>
    import  MS from '../C/MS';



        export default {
        name: "allinone",
        mixins:[MS],
        props:{
            'msData':{
                type: Object,
                required: true
            }
        },
        data(){
            return{
                company:{},
                cr:this.msData.currency,
                bankBalance:0,
                cashBalance:0,
                badgesRow:[],
                Charts:[],
                compoiledCharts:[]

            }
        },
        created() {

          //  this.company=this.getCompany();
        }
        ,
        mounted() {


                    this.getCompany();
                    this.getCashBalance();
                    this.getBankBalance();
                    this.badgesRow=this.getRow();
                    this.getAllCharts();
                    this.setCharts();

        },
        methods:{
            setCharts(){
                var c=this.Charts;
                var cc=this.compoiledCharts;
              for (var i in c){
                  var id=c[i].id

                  var currentChart=this.makeChart(c[i]);
                  cc.push()

              }
            },
            getRationFromValues(ar){
                var total=0;
                for (var i in ar ){
                    total=total+parseInt(ar[i].toString().replace(',',''));
                }
                var ration=Array();
                for (var i in ar){
                    var part=parseInt(ar[i].toString().replace(',',''));
                    var r= (part*100)/total;
                    ration.push(r.toFixed(0));
                }

                return ration;

            },
            getAllCharts(){
              this.Charts=[
                  {
                        id:'bankVscash',
                        color:'blue',
                        labels:['Bank','Cash'],
                        data:this.getRationFromValues([this.bankBalance,this.cashBalacne]),
                        type:'doughnut',
                        partColor:[
                            'rgba(56,161,105,0.8)',
                            'rgba(221,107,32,0.8)'

                        ],
                      options:{
                          title: {
                              display: true,
                              text: 'Current Revenue Status',
                              position:'bottom',
                              padding:15,
                              fontSize:18,
                              fontFamily:'"IBM Plex Sans", sans-serif'
                          },
                          animation: {animateScale:true }
                        }
                  },
                  {
                        id:'bankVscash2',
                        color:'orange',
                        labels:['Income','Expense'],
                        data:this.getRationFromValues([10723,8273]),
                        type:'doughnut',
                        partColor:[
                            'rgba(56,161,105,0.8)',
                            'rgba(221,107,32,0.8)'

                        ],
                      options:{
                          title: {
                              display: true,
                              text: 'Profit Loss Status',
                              position:'bottom',
                              padding:15,
                              fontSize:18,
                              fontFamily:'"IBM Plex Sans", sans-serif'
                          },
                          animation: {animateScale:true }
                        }
                  }
              ];
            },


            makeChart(data){


                this.$nextTick(function () {
                        var el=this.$refs[data.id][0];

                    var chartnew= new msChart(el, {
                        type: data.type,
                        data: {
                            labels:data.labels,
                            datasets: [{
                                data: data.data,
                                backgroundColor: data.partColor,
                                borderColor: data.partColor,
                                borderWidth: 1
                            }]
                        },
                        options:(data.hasOwnProperty('options'))? data.options:{}
                    })

                  //  console.log(chartnew);


                });


            },
            clickOnBadge(b){
              if(b.hasOwnProperty('action')){
                  var mod={
                       //tabCode:01,
                       modCode:(b.action.hasOwnProperty('mod'))?b.action.mod:'Panel',
                       modDView:b.action.title,
                       modUrl:b.action.url,
                  };
                  vueApp.updateTab(mod);
                  //vueApp.up
              }
            },
            getCashBalance(){
                this.cashBalacne= this.msData.totalCash;
            },
            getBankBalance(){
                this.bankBalance= this.forIndianFormat(this.msData.totalBank);
            },
            getCompany(){
                if(this.msData.hasOwnProperty('company')){
                    //console.log(this.msData);

                    this.company=this.msData.company;

                }else{
                    this.company =vueApp.getCompany();
                }

            },

            getRow(){
                return [
                    {
                        title:'Active Company',
                        subtitle:this.company.CompanyShortName,
                        color:'blue',
                        icon:'fas fa-store',
                        action: {
                            url:'/o3/Company/setup/account',
                            title:'View Company'
                        }

                    },
                    {
                        title:'Total Cash',
                        subtitle:this.cashBalance,
                        currency:this.cr,
                        color:'orange',
                        icon:'fas fa-rupee-sign'
                    },
                    {
                        title:'Bank Balance',
                        subtitle:this.bankBalance,
                        currency:this.cr,
                        color:'green',
                        icon:'fas fa-city'

                    }
                ]
            }

        }

    }
</script>

<style scoped>

</style>
