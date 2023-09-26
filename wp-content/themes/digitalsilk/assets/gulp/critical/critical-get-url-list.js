const gulp = require('gulp');
const parseString = require('xml2js').parseString;
const https = require('https');
const http = require('http');
const fs = require('fs');

const config = require('../../config');

/**
 * TODO: need to find better way to set these urls from where to gather the list, either from .env or webconfig,
 * target: manualy add url, or use config browsersync target
 *
 */
//const target = 'https://digital:silk@fdi.dsstaging1.com/';
//const targetReplace = 'https://fdi.dsstaging1.com/';
//const target = 'https://digital:silk@hpoa.dsstaging1.com/';

const target = config.browserSync.proxy.target;
const staging = 'https://digital:silk@fdi.dsstaging1.com/';
const xmlfile = 'page-sitemap.xml';

/**
 * function to parse url xml and returns it as object
 * TODO: could be done better to avoid duplicate code and having same call for https and http
 */

const xmlToJson = (url, callback) => {
    let req;
    let httpson = validateURL(url);
    if(httpson == 'https') {
        req = https.get(url, function(res) {
            let xml = '';

            res.on('data', function(chunk) {
                xml += chunk;
            });

            res.on('error', function(e) {
                callback(e, null);
            });

            res.on('timeout', function(e) {
                callback(e, null);
            });

            res.on('end', function() {
                parseString(xml, function(err, result) {
                    callback(null, result);
                });
            });
        });
    }
    else {
        req = http.get(url, function(res) {
            let xml = '';

            res.on('data', function(chunk) {
                xml += chunk;
            });

            res.on('error', function(e) {
                callback(e, null);
            });

            res.on('timeout', function(e) {
                callback(e, null);
            });

            res.on('end', function() {
                parseString(xml, function(err, result) {
                    callback(null, result);
                });
            });
        });
    }

}
/**
 * check whether link is https or http
 */

const validateURL = (link) => {
    if (link.indexOf("http://") == 0) {
        return 'http';
    }
    else if (link.indexOf("https://") == 0){
        return 'https';
    }
    else {
        return false;
    }
}

// define url we going to parse xml from
let url = target + xmlfile;
let urlhttp = validateURL(url);

const criticalGetList = (done) => {
    if(urlhttp) {
        xmlToJson(url,  (err, data) =>  {
            if (err) {
                // Handle this however you like
                return console.err(err);
            }

            let urlz = data.urlset.url;

            let obj = {
                urls: []
            }

            // loop through each url we found, and create json array
            /** TODO: might need to discuss structure of urls, folders etc,
             *  currently, output looks like this
             *  {
             *      "link": "_TARGET-URL_/customer-support/",
             *      "name": "customer-support",
             *      "staging": "_STAGING-URL_/home-demo/"
             *  },
             */
            urlz.forEach( element => {
                // get current url without domain
                let currentUrl = element.loc[0].replace(target, '');
                // staging url + current url
                let stagingUrl = staging + currentUrl;
                // remove trailing '/' from page-name
                let pageName = currentUrl.substring(0, currentUrl.length-1);

                let name;
                if(pageName == '') {
                    name = 'home';
                }
                else {
                    name = pageName;
                }
                let mod = {
                    link: element.loc[0],
                    name: name,
                    staging: stagingUrl
                }
                obj.urls.push(mod);
            });

            let results = JSON.stringify(obj, null, 2);

            // TODO: move this to config
            let dir = './assets/gulp/critical/list/';

            // check if dir exists, if not create it
            if (!fs.existsSync(dir)){
                fs.mkdirSync(dir);
            }
            // write file with json obj
            fs.writeFileSync(dir + 'crit-pagelist.json', results);
        });
    }
    done();
}


module.exports = criticalGetList;

