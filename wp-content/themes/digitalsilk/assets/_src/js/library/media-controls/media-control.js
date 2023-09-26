import { u_extendObject } from "../../utils/u_object_extend";

class DSMPMediaControls {
    constructor(options) {
        this.defaults = {
            selector:   '.js-video-init',
            wrapper:    'js-video-wrap',
            buttons: {
                play:   '.btn-play',
                mute:   '.btn-mute',
                close:  '.btn-close'
            },
            classes: {
                pause:           'is-pause',
                playing:         'is-playing',
                sound:           'is-sound',
                mute:            'is-muted',
                parentPlay:      'is-video-playing',
                parentPause:     'is-video-paused',
                triggerAutoplay: 'js-trigger-autoplay'
            },
            controls:       false
        }

        this.config = u_extendObject(this.defaults, options );
        this.items =  document.querySelectorAll(this.config.selector);

        this.init();
    }

    init() {
        let self = this;

        self.bindTogglePlay = this.togglePlay.bind(this);
        self.bindToggleMute = this.toggleMute.bind(this);
        self.bindEndedVideo = this.endedVideo.bind(this);

        [...self.items].forEach((video) => {

            if(!self.config.controls)
            {
                video.controls = false;
            }

            let videoContainer = video.parentElement;
            videoContainer.classList.add(self.config.wrapper);
            let btnPlay = videoContainer.querySelector(self.config.buttons.play);
            let btnMute = videoContainer.querySelector(self.config.buttons.mute);

            // bind events to buttons

            if(btnPlay) {
                btnPlay.addEventListener('click', self.bindTogglePlay);
            }

            if(btnMute) {
                btnMute.addEventListener('click', self.bindToggleMute);
            }

            // bind event to video itself
            video.addEventListener('ended', self.bindEndedVideo, false);

            if (video.classList.contains(self.config.classes.triggerAutoplay)) {
                self.startPlay(video);
            }
        })
    }

    endedVideo(ev) {
        let self = this;
        let video = ev.currentTarget;
        let parentWrap = video.closest('.'+self.config.wrapper);
        let btnPlay = parentWrap.querySelector(self.config.buttons.play);

        video.pause();
        video.currentTime = 0;
        btnPlay.classList.add(self.config.classes.pause);
        btnPlay.classList.remove(self.config.classes.playing);
        parentWrap.classList.remove(self.config.classes.parentPlay);
    }

    togglePlay(ev) {
        let self = this;
        let elem = ev.currentTarget;
        let parentWrap = elem.closest('.'+self.config.wrapper);
        let video = parentWrap.querySelector(self.config.selector);

        if (video.paused || video.ended) {
            elem.classList.add(self.config.classes.playing);
            parentWrap.classList.add(self.config.classes.parentPlay);
            parentWrap.classList.remove(self.config.classes.parentPause);
            elem.classList.remove(self.config.classes.pause);
            video.play();
        } else {
            elem.classList.add(self.config.classes.pause);
            parentWrap.classList.add(self.config.classes.parentPause);
            parentWrap.classList.remove(self.config.classes.parentPlay);
            elem.classList.remove(self.config.classes.playing);
            video.pause();
        }
    }

    toggleMute(ev) {
        let self = this;
        let elem = ev.currentTarget;
        let parentWrap = elem.closest('.'+self.config.wrapper);
        let video = parentWrap.querySelector(self.config.selector);

        video.muted = !video.muted;
        if (video.muted) {
            elem.classList.add(self.config.classes.mute);
            elem.classList.remove(self.config.classes.sound);
        } else {
            elem.classList.add(self.config.classes.sound);
            elem.classList.remove(self.config.classes.mute);
        }
    }

    stopPlay(elem) {
        let self = this;
        let video = elem;
        let videoContainer = video.parentElement;
        let btnPlay = videoContainer.querySelector(self.config.buttons.play);

        if (!video.paused || !video.ended) {
            btnPlay.classList.add(self.config.classes.pause);
            // vTag.parentElement.classList.add('is-video-paused');
            btnPlay.classList.remove(self.config.classes.playing);
            video.pause();
        }
    }

    startPlay(elem) {
        let self = this;
        let video = elem;
        let videoContainer = video.parentElement;
        let btnPlay = videoContainer.querySelector(self.config.buttons.play);

        if (video.paused || video.ended) {
            btnPlay.classList.add(self.config.classes.playing);
            /*vTag.parentElement.classList.add('is-video-playing');
            vTag.parentElement.classList.remove('is-video-paused');*/
            btnPlay.classList.remove(self.config.classes.pause);
            video.play();
        }
    }
}

export default DSMPMediaControls;