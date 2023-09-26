/**
 * Task to get criticals from main.css
 * https://github.com/pocketjoso/penthouse
 */

const penthouse = require("penthouse");
const path = require("path");
const fs = require('fs-extra');
const c = require('ansi-colors');
const config = require('../../config');


// assing all paths here
const jsonSource = `../../${config.critical.jsondir}/${config.critical.jsonfile}`;
const critDir = `${config.root.dist}/${config.critical.destdir}`;
const screenshotDir = `${critDir}/screenshots/`;
const cssSourceFile = `${config.root.dist}/${config.css.dist}/${config.critical.srcfile}`;
const cssDestDir = `${config.root.dist}/${config.critical.destdir}/`;

// path where json file with url list is
const pathToJson = path.resolve(jsonSource);

// check if crit-pagelist exists, if so load it
let urlList;
try {
    if (fs.existsSync(pathToJson)) {
        urlList = require(path.resolve(jsonSource));
    }
} catch(err) {
    console.error(err)
}

/**
 * if we want to have screenshots of processed criticals, check if screenshot folder exists
 * create one if it doesn't, but first we need to check if critical folder exists
 */

if (!fs.existsSync(critDir)){
    fs.mkdirSync(critDir);
}

if ((!fs.existsSync(screenshotDir) && config.critical.screenshots)) {
    fs.mkdirSync(screenshotDir);
}

/**
 * loop through all urls and assign options for each or specific ones
 * in this case we assign different options for home page only,
 * use force-include to add styles that are not visible on fcp or manipulated by js but
 * you want to include them as critical
 */

let items = [];

if(urlList){
    urlList.urls.forEach(function(item){

        if (!('link' in item)) {
            let comment = c.red("missing LINK") + ' for 1 or more items';
            console.log(comment);
            return;
        }
        if (!('name' in item)) {
            let comment = c.red("missing NAME") + ' for 1 or more items';
            console.log(comment);
            return;
        }

        let options;
        let screenshots = {};
        let customHeaders = {};

        // if we want screenshots of before and after parsing css from main
        if(config.critical.screenshots)
        {
            screenshots = {
                    basePath: screenshotDir + item.name, // absolute or relative; excluding file extension
                    type: 'jpeg', // jpeg or png, png default
                    quality: 20 // only applies for jpeg type
            }
        }

        // custom headers if we need to authenticate ex for staing site
        if(config.critical.aut)
        {
            let username = config.critical.autUser;
            let password = config.critical.autPass;
            customHeaders = {
                Authorization: 'Basic ' + Buffer.from(username + ':' + password, 'binary').toString('base64')
            }
        }

        if(item.name == 'home') {
            options = {
                url: item.link,
                css: cssSourceFile,
                width: config.critical.width,
                height: config.critical.height,
                screenshots: screenshots,
                keepLargerMediaQueries: false,
                // renderWaitTime: 500,
                // blockJSRequests: false,
                forceInclude: [],
                userAgent: 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                customPageHeaders: customHeaders
            }
        } else {
            options = {
                url: item.link,
                css: cssSourceFile,
                width: config.critical.width,
                height: config.critical.height,
                screenshots: screenshots,
                keepLargerMediaQueries: false,
                // renderWaitTime: 500,
                // blockJSRequests: false,
                forceInclude: [],
                userAgent: 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                customPageHeaders: customHeaders
            }
        }

        items.push( {
            url: item.link,
            name: item.name,
            params: options
        });
    })
}

/**
 * process each url as promise
 */

const processURL = () => {
    // remove item from queue
    const item = items.pop()
    if (!item) {
        // no more new jobs to process (might still be jobs currently in process)
        return Promise.resolve()
    }
    return penthouse({
        item,
        ...item.params
    })
        .then(criticalCss => {

            // location of files where criticals should be stored

            let file = cssDestDir + item.name + '.css';

            // removes font face from critical
            if(config.critical.fontface)
            {
                let wholefont = /@font-face({(.*?)})/g;
                criticalCss = criticalCss.replace(wholefont, '');
            }

            criticalCss = '/* start '+item.name+'*/' + criticalCss + '/* end '+item.name+'*/';

            fs.outputFile(file, criticalCss, function (err) {
                if(!!err) {
                    console.log('Try error:', err); // => null
                }
            });
            let commentItem = item.name
            let comment = c.green("\t Finished Critical");
            commentItem = commentItem.padEnd(30);
            console.log(commentItem, comment);

            return processURL()
        })
}

/**
 * function to execute critical task
 * calls processURL as promise
 */

criticals = (done) => {

    if(!urlList){
        console.log('Missing ' + config.critical.jsonfile + ' or List is empty');
        done();
        return;
    }

    // how many jobs do we want to handle in paralell?
    // Below, 5:
    Promise.all([
        processURL(),
        processURL(),
        processURL(),
        processURL(),
        processURL()
    ])
        .then(() => {
            console.log('all done!')
            done();
        })
}

module.exports = criticals;
