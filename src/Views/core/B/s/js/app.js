require('./bootstrap');
import https from "https";
var store = {
    debug: true,
    state: {
        message: 'Hello!'
    },
    setMessageAction(newValue) {
        if (this.debug) console.log('setMessageAction triggered with', newValue)
        this.state.message = newValue
    },
    clearMessageAction() {
        if (this.debug) console.log('clearMessageAction triggered')
        this.state.message = ''
    }
}


var url =window.msBackEnd+'/o3/Mod/forUser';

axios.get(url,{crossDomain: true,withCredentials:true})
    .then(function (response) {
        // console.log(response.data.msData.csrf)

        window.MSclientToken=response.data.msData.csrf;
        window.axios.defaults.headers.common['MS-APP-Token'] = response.data.msData.csrf;
        //    window.axios.defaults.headers.common['X-XSRF-TOKEN'] = response.data.msData.csrf;
        window.msInstance = axios.create({
            httpsAgent: new https.Agent({
                rejectUnauthorized: false,
                crossDomain: true,
                //headers: {'X-CSRF-TOKEN': response.data.msData.csrf},
                withCredentials:false
            })
        });
        //   console.log('appmake');
        const app = new Vue({
            el: '#msapp',
            mixins: [window.MS],
            methods: {
                msShortCut(event, keyCode = false) {
                    var fKeyCode = 0;
                    if (keyCode != false) {
                        fKeyCode = keyCode
                    } else {
                        fKeyCode = event.which;
                    }
                    switch (fKeyCode) {

                        case 67:
                            if (this.msCalc) {
                                this.msCalc = false;
                            } else {
                                this.msCalc = true;
                            }


                            break;
                    }


                }
                ,

                refreshAllTab() {
                    var dashBoard = this.$children[0];
                    var viewPanel = dashBoard.$refs['ms-live-tab'];
                    viewPanel.refreshAllTab();
                },
                clickFromTab(idata){

                    var data={
                        modCode:'MAS',
                        modDView:idata.title,
                        modUrl:idata.url,
                        data:'',

                    };
                    var dashBoard = this.$children[0];
                    var viewPanel = dashBoard.$refs['ms-live-tab'];
                    viewPanel.addActionToTab(data);
                }
                ,
                updateTab(data) {
                    var dashBoard = this.$children[0];
                    var viewPanel = dashBoard.$refs['ms-live-tab'];
                    viewPanel.addActionToTab(data);

                },

                addNewTab(data) {
                    var dashBoard = this.$children[0];
                    var viewPanel = dashBoard.$refs['ms-live-tab'];
                    viewPanel.addNewTabnUpdate(data);
                },
                getModBtn: function (url) {

                    // console.log(this);
                    this.setMsErrorZero();
                    this.getGetLink(url, this);


                },
                setMsError: function (Data) {

                    this.mserror = Data;
                    //  console.log(Data);

                    //  console.log(Data);

                    for (var inputName in Data) {
                        var key = inputName.toString().toLowerCase();
                        //
                        if (this.$refs['msFrom'].$refs.hasOwnProperty(key) && this.$refs['msFrom'].$refs[key].hasOwnProperty(0)) {
                            // console.log(inputName);
                            this.$refs['msFrom'].$refs[key][0].setError();
                            this.$refs['msFrom'].$refs[key][0].inputError = Data[inputName];
                            this.$refs['msFrom'].allErrors.push(
                                {
                                    inputName: inputName,
                                    errors: Data[inputName]
                                }
                            );
                        }


                    }

                    //    this.mserror.forEach(function(value, index) {
                    //        var key=value.name.toString();
                    //        this.$refs[key].setError();
                    //        this.$refs[key].inputError=value.msg;
                    //
                    // //       console.log(this.$refs[key].getValue());
                    //
                    //    },this)
                    this.mserrorCount = true;
                    //   console.log(this.mserror);

                },

                setMsErrorZero: function () {

                    for (var inputName in this.mserror) {
                        var key = inputName.toString().toLowerCase();
                        this.$refs['msFrom'].$refs[key][0].setErrorZero();
                    }

                    this.mserrorCount = false;
                    this.mserror = [];


                },
                setUpGroup: function (data) {
                    // alert("demo");
                    //console.log(data);
                    this.msform = data;
                    //this.msform.push(data);

                },
                checkGroupExist: function (value) {

                    if (this.msform.length > 0) return false;
                    return false;
                    return this.in_array(value, this.msform);
                },


            },
            data: function () {
                return {
                    mserror: [],
                    mstab: [],
                    mserrorCount: false,
                    msform: [],
                    msNavigation: false,
                    msCalc: false,
                    msDarkMode: false,


                }
            },
            mounted: function () {
                // console.log(this.msform);


            },
            sharedState: store.state

        });

        window.vueApp = app;


    })
    .catch(function (error) {

        console.log(error)
    });


