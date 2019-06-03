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
        }
    }
}
