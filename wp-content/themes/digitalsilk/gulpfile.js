/**
 * include separated functions amd exports them as specific tasks
 * if you want to have specific task, import function and export as task
 *
 * ex: (in description, not actual code)
 * import clean from ./assets/gulp/tasks/clean then use
 * exports.taskname = css --> replace taskname with task name you want
 * ex: exports.clean = clean; will create clean task
 *
 */

const criticalTask = require('./assets/gulp/critical/critical');
const criticalGetUrl = require('./assets/gulp/critical/critical-get-url-list');

const defaultTask = require('./assets/gulp/default');
const { watchTask } = require('./assets/gulp/watch');
const woocommerceTask = require('./assets/gulp/woocommerce');
const lightTask = require('./assets/gulp/light');

exports.criticallist = criticalGetUrl;
exports.critical = criticalTask;
exports.watch = watchTask;
exports.default = defaultTask;
exports.woocommerce = woocommerceTask;
exports.light = lightTask;
