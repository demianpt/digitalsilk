/**
 * https://www.ilearnjavascript.com/plainjs-fadein-fadeout/
 *
 * TODO: there are better fadeIn fadeOut scripts with animation easings
 */

// export const fadeIn = (el, displayStyle = 'block', smooth = true) => {
//     el.style.opacity = 0;
//     el.style.display = displayStyle;
//     if (smooth) {
//         let opacity = 0;
//         let request;
//
//         const animation = () => {
//             el.style.opacity = opacity += 0.04;
//             if (opacity >= 1) {
//                 opacity = 1;
//                 cancelAnimationFrame(request);
//             }
//         };
//
//         const rAf = () => {
//             request = requestAnimationFrame(rAf);
//             animation();
//         };
//         rAf();
//
//     } else {
//         el.style.opacity = 1;
//     }
// };
//
// export const fadeOut = (el, displayStyle = 'none', smooth = true ) => {
//     if (smooth) {
//         let opacity = el.style.opacity;
//         let request;
//
//         const animation = () => {
//             el.style.opacity = opacity -= 0.04;
//             if (opacity <= 0) {
//                 opacity = 0;
//                 el.style.display = displayStyle;
//                 cancelAnimationFrame(request);
//             }
//         };
//
//         const rAf = () => {
//             request = requestAnimationFrame(rAf);
//             animation();
//         };
//         rAf();
//
//     } else {
//         el.style.opacity = 0;
//     }
// };
const defaults = {
    duration: 100,
    complete() {

    }
};

const animateFade = (options) => {
    let start = new Date;
    let id = setInterval(function() {
        let timePassed = new Date - start;
        let progress = timePassed / options.duration;
        if (progress > 1) {
            progress = 1;
        }
        options.progress = progress;
        let delta = options.delta(progress);
        options.step(delta);
        if (progress == 1) {
            clearInterval(id);
            if(typeof options.complete === "function")
            {
                options.complete();
            }
        }
    }, options.delay || 10);
}

export const u_fadeIn = (element, options= {}) => {
    if(typeof options.duration === "undefined") {
        options.duration = defaults.duration;
    }
    let to = 0;
    animateFade({
        duration: options.duration,
        delta(progress) {
            progress = this.progress;
            return easings.swing(progress);
        },
        complete: options.complete,
        step(delta) {
            element.style.opacity = to + delta;
        }
    });
}

export const u_fadeOut = (element, options = {}) => {
    if(typeof options.duration === "undefined") {
        options.duration = defaults.duration;
    }
    let to = 1;
    animateFade({
        duration: options.duration,
        delta(progress) {
            progress = this.progress;
            return easings.swing(progress);
        },
        complete: options.complete,
        step(delta) {
            element.style.opacity = to - delta;
        }
    });
}

const easings = {
    linear: function(progress) {
        return progress;
    },
    quadratic: function(progress) {
        return Math.pow(progress, 2);
    },
    swing: function(progress) {
        return 0.5 - Math.cos(progress * Math.PI) / 2;
    },
    circ: function(progress) {
        return 1 - Math.sin(Math.acos(progress));
    },
    back: function(progress, x) {
        return Math.pow(progress, 2) * ((x + 1) * progress - x);
    },
    bounce: function(progress) {
        for (var a = 0, b = 1, result; 1; a += b, b /= 2) {
            if (progress >= (7 - 4 * a) / 11) {
                return -Math.pow((11 - 6 * a - 11 * progress) / 4, 2) + Math.pow(b, 2);
            }
        }
    },
    elastic: function(progress, x) {
        return Math.pow(2, 10 * (progress - 1)) * Math.cos(20 * Math.PI * x / 3 * progress);
    }
}