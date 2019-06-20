export default {
    methods: {

        validatePassword (pass,length=8,strenth=3) {

            switch (strenth) {
                case 1:
                    var re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{"+length+",})");
                    break;

                case 2:
                    var re = new RegExp("^(?=.*[a-z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{"+length+",})");
                    break;

                case 3:
                    var re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{"+length+",})");
                    break;

                default:
                    var re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{"+length+",})");
                    break;
            }
        return re.test(pass);
        },

        validateLen(str,size=1){

            var re = new RegExp("^(?=.{"+size+",})");
            return  re.test(str);
        },

        getGetLink(url,classFor){
            url=url+"?dataLink=true"
           var returnX="";
            var self = classFor ;

            let re= axios.get(url)
                .then(
                    function(response){
                        returnX=response.data;
                        self.setHtml(returnX);

                    }
                    )
                .catch(function (error) {
                    // handle error
                    self.setMsError(error.response.data);
                  //  console.log(error.response.data);
                })
                .finally( response => {
                  });



        },
        makeArrayForInput(base){
            var self = base ;

            var id= base.inputName;
            var vName=base.inputVname;
            var re = {
                id: id,
                label: 'Enter ' + vName,
                baseValue: base
            };
            if(base.inputMultiple) {
                re.id = id + "[]";
                re.label = 'Enter ' + vName;

            }
        //    console.log(re);
         //   base.setFinalInput(re);
            return re;
           // console.log(re);
           // return [re];
        },
        makeArrayForInputGroup(base,id,index){
            var self=base;
            var idfor=id+"_"+index;
            var Inputindex=1
          //  console.log(self.msFormData[id])

            Inputindex =base.msCount[id] -1 ;
            var fordata={
                rootId:id,
                id:index,
               groupDynamic:true,
                gruoupHeading:self.msFormData[id].gruoupHeading+" No of: " + Inputindex ,
                inputs:self.msFormData[id].inputs

            }
            return fordata;
        }
        ,
        in_array(value,array){
            return array.includes(value);
        },
        get_time_diff( datetime )
{
    var datetime = typeof datetime !== 'undefined' ? datetime : "2014-01-01 01:02:03.123456";

    var datetime = new Date( datetime ).getTime();
    var now = new Date().getTime();

    if( isNaN(datetime) )
    {
        return "";
    }

    //console.log( datetime + " " + now);

    if (datetime < now) {
        var milisec_diff = now - datetime;
    }else{
        var milisec_diff = datetime - now;
    }

    var days = Math.floor(milisec_diff / 1000 / 60 / (60 * 24));

    var date_diff = new Date( milisec_diff );

    return date_diff.getMilliseconds();
},
        roundToTwo(num) {
        //    console.log(num);
          //  console.log(Math.round(num)     );
            return Math.round(num);
        },
        calc_get_prapotion(totalValue,secondValue ){
            var returnValue=0;


            returnValue =   (secondValue*100)   / totalValue ;


            return this.roundToTwo(returnValue) ;
        },
        check_uniq(setArray,baseArray){
            for ( var i = 0 ; i < baseArray.length; i++ ){
                if(this.in_array(baseArray[i],setArray))return false;
            }
            return true;
        }
    }


}
