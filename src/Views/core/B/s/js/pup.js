const puppeteer = require('puppeteer');


(async () => {
    const browser = await puppeteer.launch({
        headless: false,
        ignoreHTTPSErrors: true,
        args: [
            // "--proxy-server='direct://'",
            // '--proxy-bypass-list=*',
            // '--disable-gpu',
            // '--disable-dev-shm-usage',
            // '--disable-setuid-sandbox',
            // '--no-first-run',
            // '--no-sandbox',
            // '--no-zygote',
            // '--single-process',
            // '--ignore-certificate-errors',
            // '--ignore-certificate-errors-spki-list',
            //  '--enable-features=NetworkService'
        ]
    });

    var links ={
        // web:{
        //         base:'https://web.o3erp.ms',
        //         routes:
        //                 [
        //                     'signup'
        //                 ]
        //         }

        app:{
                base:'https://app.o3erp.ms',
                routes:
                        [
                            '/'
                        ]
                }

};
    var re = new RegExp('/', 'g');
    for(var i in links){
        var baseUrl=links[i].base;
        for (var x in links[i].routes ){

            var Filename =links[i].routes[x].replace(re, '_');

            getScreeShot(browser,baseUrl,links[i].routes[x],Filename);
        }

    }


})();

async function getScreeShot(client,url,para,fileName,wait=2500) {
    var page = await client.newPage();
    if(para=='/'){
        await page.goto(url,{waitUntil: 'domcontentloaded'});
    }else {
        await page.goto(url+"/"+para,{waitUntil: 'domcontentloaded'});
    }

    setTimeout(async ()=>{
        await page.screenshot({path: 'Screenshot/'+fileName+'.png',fullPage: true});
        await client.close();
    },5500)




}
