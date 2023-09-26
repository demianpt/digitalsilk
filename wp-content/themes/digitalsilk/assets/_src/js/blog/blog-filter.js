export default function blogFilter() {

    (function ($) {

        // jQuery(document).on('init_filter', (e, module) => {
        //     DSInitFilter(module);
        // });

        let DSInitFilter = function (module) {
            const filter = {
                module: null,
                action: null,
                form: '',
                moreBtn: $(),
                results: null,
                doing_ajax: null,
                timeout: null,
                query: {
                    post_type: null,
                    per_page: 9,
                    page: 1,
                },
                component_styles: {},
                ajax_url: ds.ajax_url,
                preloader: '<div class="filter-loader loader"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div><div class="loader-bg"></div></div>',
                init(module) {
                    const ajaxModule = $(module);

                    if (ajaxModule) {
                        filter.module = ajaxModule;

                        filter.action = ajaxModule.data('action');
                        filter.query.post_type = ajaxModule.data('post-type');
                        filter.query.posts_per_page = ajaxModule.data('per-page');

                        filter.initElementsActions();
                    }

                },
                initElementsActions() {
                    const results = filter.module.find('div[data-container="ajax-result"]');

                    if (results) {
                        filter.results = results;

                        const moreBtn = filter.module.find('.ajax-load-more');
                        if (moreBtn) {
                            filter.moreBtn = moreBtn;
                            filter.morePosts();
                        }

                        const form = filter.module.find('form[data-form="ajax"]');
                        if (form) {
                            filter.form = form;
                            filter.changeForm();
                        }
                    }

                    const compClass = filter.module.data('class');
                    if (compClass) {
                        filter.component_styles.class = compClass;
                    }

                    const compStyles = filter.module.data('styles');
                    if (compStyles) {
                        filter.component_styles.styles = compStyles;
                    }

                    const compImage = filter.module.data('image');
                    if (compImage) {
                        filter.component_styles.image = compImage;
                    }
                },
                morePosts() {
                    filter.moreBtn.on('click', (e) => {
                        e.preventDefault();

                        filter.sendAjax(filter.query.page);
                    });
                },
                changeForm() {
                    const $input_text = filter.form.find('input[type="text"], textarea');
                    $input_text.unbind('keyup');
                    $input_text.not('[data-ajax="false"]').keyup(() => {
                        if (filter.timeout != null) {
                            clearTimeout(filter.timeout);
                        }
                        filter.timeout = setTimeout(() => {
                            filter.timeout = null;
                            filter.sendAjax();
                            $input_submit.parent().addClass('is-filter-active');
                        }, 500);
                    });

                    let $input_submit = filter.form.find('button[type="submit"]');
                    $input_submit.unbind('click');
                    $input_submit.not('[data-ajax="false"]').click((e) => {
                        e.preventDefault();
                        filter.sendAjax();
                        $input_submit.parent().addClass('is-filter-active');
                    });

                    const $select = filter.form.find('select');
                    $select.unbind('change');
                    $select.not('[data-ajax="false"]').change(() => {
                        filter.sendAjax();
                    });

                    filter.form.unbind('keydown');
                    filter.form.on('keydown', (event) => {
                        if (event.keyCode == 13) {
                            event.preventDefault();
                            filter.sendAjax();
                        }
                    });
                },
                sendAjax(page = 0) {
                    if (filter.doing_ajax != null) {
                        filter.doing_ajax.abort();
                        filter.doing_ajax = null;
                        filter.module.find('.loader').remove();
                    }

                    const data = {
                        action: filter.action,
                        query: {
                            post_type: filter.query.post_type,
                            posts_per_page: filter.query.posts_per_page,
                            paged: page,
                        },
                        component: filter.component_styles,
                        device: $(window).width() <= 768 ? 'mobile' : 'desktop',
                    };

                    if (filter.form.length > 0) {
                        data.form = filter.form.serialize();
                    }

                    filter.doing_ajax = $.ajax({
                        url: filter.ajax_url,
                        type: 'POST',
                        data,
                        beforeSend(xhr) {
                            filter.module.append(filter.preloader);
                        },
                        success(data) {
                            if (data) {

                                if (data.page === 1) filter.results.html('');

                                filter.results.append(data.posts);

                                if (data.max_pages === data.page) {
                                    filter.moreBtn.hide();
                                } else {
                                    filter.moreBtn.show();
                                }

                                if (data.total_posts_showing == 0) {
                                    filter.module.find('.js-blog-counter-wrapper').hide();
                                } else {
                                    filter.module.find('.js-blog-counter-wrapper').show();
                                }

                                if (data.total_posts_showing) {
                                    filter.module.find('.js-blog-counter-showing').text(data.total_posts_showing);
                                }

                                if (data.total_posts) {
                                    filter.module.find('.js-blog-counter-total').text(data.total_posts);
                                }

                                filter.query.page = data.page;
                                filter.module.find('.loader').remove();
                            } else {
                                filter.moreBtn.hide();
                            }

                            filter.doing_ajax = null;
                        },
                    });
                },
            };

            filter.init(module);
        };

        const doInit = () => {

            $('.js-ajax-block').each(function (i) {
                // console.log(i);
                // console.log($('.js-ajax-block')[i]);
                // console.log($(this));
                DSInitFilter($('.js-ajax-block')[i]);
            });

        };

        doInit();

        /* jQuery(document).trigger('init_filter', 'ajax-posts');
        jQuery(document).trigger('init_filter', 'ajax-content-1'); */

    }(jQuery));

}
