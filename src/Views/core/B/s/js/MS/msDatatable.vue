<template>
    <div>

        <div>
            <div  class="flex flex-wrap border  border-blue-400 p-1" >


                <div class="flex-1 p-2 border-blue-300  border-l border-t border-b ">
                    <div class="flex flex-wrap">
                    <div class ="flex-1 pr-5">Search </div>
                    <input type="text" class="flex-1  border focus:outline-none focus:shadow-outline shadow" v-model="msSearch">
                    <select   v-model="msSearchBy" class="flex-1  border focus:outline-none focus:shadow-outline shadow">
                        <option value="ms0" disabled selected>Please Select Column to search</option>
                        <option :value="index"  v-for="column,index,key in msAllData.fromV.tableColumns"  >{{  column.vName }}</option>
                    </select>

                    </div>
                </div>



                <div class="flex-1 border-blue-300 border p-2">


                        <div class="flex flex-wrap  ">
                            <div class ="flex-1 text-right pr-5">Per page rows </div>
                            <select   v-model="msPerPage" class="flex-1   border focus:outline-none focus:shadow-outline shadow">

                                <option :value="column"  v-for="column,index,key in msPerPageData"  >{{  column }}</option>
                            </select>

                            <div class ="flex-1 ">to display </div>
                        </div>


                </div>



            </div>

            <table class="table-auto">

                <tr class="border border-blue-500 border-t-2">
                    <th v-for="column in msAllData.fromV.tableColumns" class="border bg-blue-200"> {{  column.vName }}</th>
                </tr>

                <tr v-for="row in msAllData.fromV.tableData.data" class="border">

                    <td    v-for="column,index in msAllData.fromV.tableColumns"  class="border p-1 text-center cursor-wait" :title="column.vName" >


                        <span v-if="(column.type =='text') || (column.type =='number') || (column.type =='email') || (column.type =='textarea') || (column.type =='password') || (column.type =='auto')  ">

                            {{ column.type }}
                        {{ row[index] }}

                        </span>

                        <span v-if="column.type =='date' && (true)"  >
                            {{ getOutDate(row[index]) }}

                        </span>

                        <span v-if="column.type =='time' && (true)"  >
                            {{ getOutTime(row[index]) }}

                        </span>


                        <span v-if="column.type =='file' && (true)"  ></span>

                        <span v-if="column.type =='option' && (true)" ></span>
                        <span v-if="column.type =='checkbox' && (true)"  ></span>
                        <span v-if="column.type =='radio' && (true)"  >
                             <span v-if="msData.fromV.tableFromOther.hasOwnProperty(index)" class=" select-none" >

                            <i class="fas "
                            :class="{
                            'fa-chevron-right':!(row[index]==1||(row[index]== 0)),
                            'text-blue-500':!(row[index]==1||(row[index]== 0)),
                            'text-green-500':(row[index]==1) ||(row[index]=='1'),
                            'text-red-500':row[index]==0,
                            'fa-power-off':row[index]==1||(row[index]== 0),


                            }"
                            ></i>
                            {{ getVnameFromDataForRadio(row[index],msData.fromV.tableFromOther[index])}}

                        </span>

                        </span>


                    </td>


                </tr>

            </table>
            <div  class="flex flex-wrap " >
                <div class="w-8/12">Showing {{ msAllData.fromV.tableData.from }} to {{ msAllData.fromV.tableData.to }} of {{msAllData.fromV.tableData.total}} total entries</div>
                <div class="w-4/12text-right">Page: {{msAllData.fromV.tableData.current_page }} / {{ msAllData.fromV.tableData.last_page }}</div>

            </div>
            <div  class="flex flex-wrap text-center cursor-pointer" >
                <div class="ms-btn flex-1" :class="{
                'cursor-not-allowed':(msAllData.fromV.tableData.prev_page_url == null)}" v-on:click="getDataFromSerevr(msAllData.fromV.tableData.prev_page_url)" >
                    <i class="fas fa-angle-left"></i>
                </div>

                <div class="ms-btn flex-1" :class="{
                'bg-blue-200':(msAllData.fromV.tableData.current_page == n),
                'bg-blue-400':(msAllData.fromV.tableData.current_page != n),
                'text-white':(msAllData.fromV.tableData.current_page != n),
                'cursor-not-allowed':(msAllData.fromV.tableData.current_page == n)
                }" v-for="n in msAllData.fromV.tableData.last_page"
                     v-on:click="getPage(n)"
                > {{ n }} {{(msAllData.fromV.tableData.current_page == n)  }}</div>

                <div class="ms-btn  flex-1"  :class="{
                'cursor-not-allowed':(msAllData.fromV.tableData.next_page_url == null)}" v-on:click="getDataFromSerevr(msAllData.fromV.tableData.next_page_url)" >
                    <i class="fas fa-angle-right"></i> </div>
                <div class="ms-btn  flex-1"  :class="{
                'cursor-not-allowed':(msAllData.fromV.tableData.next_page_url == null)}" v-on:click="getDataFromSerevr(msAllData.fromV.tableData.next_page_url)" >
                    <i class="fas fa-angle-double-right"></i> </div>
            </div>


        </div>

    </div>

</template>

<script>
    import MS from './C/MS';

    export default {
        name: "msDatatable",
        mixins:[MS],
        props:{
            'msData':{
                type: Object,
                required: true
            }

        },
        data:function () {
            return {


                msAllData:null,
                msPath:null,
                msSearchBy:'ms0',
                msSearch:"",
                msPerPage:10,
                msPerPageData:['5','10','20','30','50','100']

            }
        },
        beforeMount() {
            this.msAllData=this.msData;
            this.msPath=this.msData.fromV.tableData.path;
            this.msPerPage= this.msData.fromV.tableData.per_page;
          //  msSearch=this.msAllData.fromV.tableData.columns

        },

        methods:{
            setHtml(data){
               // console.log(data);

                this.msAllData.fromV.tableData=data.fromV.tableData;
                //this.msAllData.fromV.tableColumns=this.msData.fromV.tableColumns;
                //this.msAllData.fromV.tableTitle=this.msData.fromV.tableColumns;
            },
            getDataFromSerevr(link){
                var data = this.getGetLink(link,this);

            },
            getPage(page){
                var data=[
                {
                    name:'page',
                    value:page
                }, {
                        name:'perpage',
                        value:this.msPerPage
                    },
                ];


                var link=this.makeLink(data);
                this.getDataFromSerevr(link)
                //console.log(link);

            },
            getSearch(str){

                var data=[
                    {
                        name:'page',
                        value:1
                    },
                    {
                        name:'q',
                        value:str
                    },
                    {
                        name:'by',
                        value:this.msSearchBy
                    },
                    {
                        name:'perpage',
                        value:this.msPerPage
                    },
                ];


                var link=this.makeLink(data);
                this.getDataFromSerevr(link);
              //  console.log(link);

            }

            ,makeLink(parameter){
                var q=[];
               //let para ;
                for(var para in parameter){
                    q.push(parameter[para].name+'='+parameter[para].value);
                }

                return this.msPath+"?"+q.join('&');
            },
            getVnameFromDataForRadio(value,data){
               // console.log(data);
               // console.log(value);

                var outname="";

              data.msdata.filter(function(element){
                    if(element[data.value] == value){
                        //return element[data.text];
                        outname=element[data.text];
                    }
                    return element;

                });

                    return outname;
            },
            getOutDate(data){
                var d = new Date(data)
                return [d .getDate(),d .getMonth(),d.getFullYear()].join('/');
                //console.log([d .getDate(),d .getMonth(),d.getFullYear()].join('/'));

            },
            getOutTime(data){
                var d = new Date(data);

                return data;

            },
            changePerPage(val){

                var data=[
                    {
                        name:'page',
                        value:1
                    },

                    {
                        name:'perpage',
                        value:val
                    },
                ];


                var link=this.makeLink(data);
                this.getDataFromSerevr(link);
            }


        },
        watch:{
            msSearch(newVal,oldVal){

                if((newVal.length > 2) && (this.msSearchBy !="ms0")){
                    this.getSearch(newVal);

                }
                if((newVal.length == 0 ))this.getPage(1);
            },msPerPage(newVal,oldVal){

                this.changePerPage(newVal);

            }
        }
    }
</script>

<style scoped>

</style>
