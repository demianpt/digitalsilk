const del = require('del');

const config = require('../../config');
const Log = require('./lib/logger');

/**
 * haven't changed this one much from original gulp 3 task,
 * loops through list of task and cleans each folder destination
 */

const cleaner = (light = false) => {
    let folderArray;
    if (light) {
        folderArray = ['js', 'css', 'fonts'];
    } else {
        folderArray = ['js', 'css', 'images', 'sprite', 'fonts'];
    }

    const tasksFoldersToDelete = folderArray.map((task) => {
        if (!config[task] || !config[task].dist) {
            return new Log(
                'clear',
                `Task "${task}" does NOT exist or dist folder was not specified properly.`
            ).error();
        }

        return `${config.root.dist}/${config[task].dist}`;
    });

    tasksFoldersToDelete.push(`${config.root.dist}/${config.critical.destdir}`);

    if (config.html.run) {
        tasksFoldersToDelete.push(`${config.root.dist}/${config.html.dist}/*.html`);
    }

    del.sync(tasksFoldersToDelete, {
        force: config.cleanFilesOutsideWorkingDir,
    });
};

const clean = (done) => {
    cleaner();
    done();
};
const cleanLight = (done) => {
    cleaner(true);
    done();
};

module.exports = {
    clean,
    cleanLight,
};
