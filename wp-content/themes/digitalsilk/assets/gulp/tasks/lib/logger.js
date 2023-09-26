const c = require('ansi-colors');
const PluginError = require('plugin-error');
const logger = require('fancy-log');

const notifier = require('node-notifier');

class Log {
    constructor(taskName, message) {
        this.taskName = taskName;
        this.message = message;
    }

    error() {
        throw new PluginError({
            plugin: this.taskName,
            message: c.red(this.message),
        });
    }

    info() {
        logger(this.taskName, c.magenta(this.message));
    }
}

// function Log(taskName, message) {
//     this.error = function error() {
//         throw new PluginError({
//             plugin: taskName,
//             message: c.red(message),
//         });
//     };
//     this.info = function info() {
//         logger(taskName, c.magenta(message));
//     };
// }

module.exports = Log;
