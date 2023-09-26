<?php
/**
 * Template Name: Styleguide and Modules
 */

get_header(); ?>

<?php get_template_part('templates/parts/subheader'); ?>

    <aside class="sg-nav">
        <ul>
            <li><a href="#colors">Colors</a></li>
            <li><a href="#buttons">Buttons</a></li>
            <li><a href="#headings">Headings</a></li>
            <li><a href="#banner">Banner</a></li>
            <li><a href="#wysiwyg">WYSIWYG</a></li>
            <li><a href="#forms">Forms</a></li>
            <li><a href="#posts">Posts</a></li>
            <li><a href="#simple1">Simple1</a></li>
            <li><a href="#simple2">Simple2</a></li>
            <li><a href="#simple3">Simple3</a></li>
            <li><a href="#sliders">Sliders</a></li>
            <li><a href="#acc">Accordion</a></li>
            <li><a href="#counter">Counter</a></li>
            <li><a href="#tabs">Tabs</a></li>
        </ul>
    </aside>

    <div>
        <!-- Buttons -->

        <section class="container sg-section gap-top gap-bottom" id="colors">

            <h3 class="c-heading -h2 sg-title">Colors</h3>

            <ul class="color-grid row">
                <li class="color-grid__item col">
                    <div class="color-grid__preview" style="--preview-color: var(--primary-color1)"></div>
                    <div class="color-grid__caption">--primary-color1</div>
                </li>
                <li class="color-grid__item col">
                    <div class="color-grid__preview" style="--preview-color: var(--primary-color2)"></div>
                    <div class="color-grid__caption">--primary-color2</div>
                </li>
                <li class="color-grid__item col">
                    <div class="color-grid__preview" style="--preview-color: var(--primary-color3)"></div>
                    <div class="color-grid__caption">--primary-color3</div>
                </li>
                <li class="color-grid__item col">
                    <div class="color-grid__preview" style="--preview-color: var(--secondary-color1)"></div>
                    <div class="color-grid__caption">--secondary-color1</div>
                </li>
                <li class="color-grid__item col">
                    <div class="color-grid__preview" style="--preview-color: var(--secondary-color2)"></div>
                    <div class="color-grid__caption">--secondary-color2</div>
                </li>
                <li class="color-grid__item col">
                    <div class="color-grid__preview" style="--preview-color: var(--secondary-color3)"></div>
                    <div class="color-grid__caption">--secondary-color3</div>
                </li>
            </ul>

        </section>

        <section class="container sg-section gap-top gap-bot" id="buttons">

            <h3 class="c-heading -h2 sg-title">Buttons</h3>

            <div class="c-block__btn">
                <a href="/" class="c-btn -primary -small">
                    Small Button Primary
                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
                <a href="/" class="c-btn -small -secondary">
                    Small Button Secondary
                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
                <a href="/" class="c-btn -small -link ">
                    Small Button Link Style
                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
            </div>
            <div class="c-block__btn">
                <a href="/" class="c-btn -primary">
                    Button Primary
                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
                <a href="/" class="c-btn -secondary">
                    Button Secondary
                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
                <a href="/" class="c-btn -link ">
                    Button Link Style
                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
            </div>
            <div class="c-block__btn">
                <a href="/" class="c-btn -primary -large">
                    Large Button Primary
                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
                <a href="/" class="c-btn -large -secondary">
                    Large Button Secondary
                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
                <a href="/" class="c-btn -large -link">
                    Large Link Style
                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
            </div>
            <div class="c-block__btn">
                <a href="/" class="c-btn -primary icon-left">
                    Button Back
                    <span class="c-btn__ico icon-reversed"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
                <a href="/" class="c-btn -link icon-left">
                    Icon to left
                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                </a>
            </div>
        </section>

        <section class="container gap-top gap-bot" id="headings">
            <h3 class="c-heading -h2 sg-title">Headings</h3>

            <div class="titles-preview row text-center">
                <div class="titles-preview__item col">
                    <div class="c-heading -h1">
                        <div class="c-heading__pre">Pretitle Text Content</div>
                        <h1 class="c-heading__title">H1 Heading <span>Item</span></h1>
                        <div class="c-heading__sub">Subtitle Text Content</div>
                    </div>
                    <hr>
                    <div class="c-heading -h2">
                        <div class="c-heading__pre">Pretitle Text Content</div>
                        <h2 class="c-heading__title">H2 Section Heading <span>Item</span></h2>
                        <div class="c-heading__sub">Subtitle Text Content</div>
                    </div>
                    <hr>
                    <div class="c-heading -h3">
                        <h3 class="c-heading__title">H3 Heading Item</h3>
                    </div>
                    <hr>
                    <div class="c-heading -h4">
                        <h4 class="c-heading__title">H3 Heading Item</h4>
                    </div>
                    <hr>
                    <div class="l-heading-v2">
                        <div class="c-heading -h2">
                            <h2 class="c-heading__title">Custom Example ".l-heading-v2"</h2>
                            <div class="c-heading__sub">Subtitle Text Content</div>
                        </div>
                    </div>
                </div>
                <div class="titles-preview__item col colors-inverted" style="background: var(--body-bg-alt)">
                    <div class="c-heading -h1">
                        <div class="c-heading__pre">Pretitle Text Content</div>
                        <h1 class="c-heading__title">H1 Heading <span>Item</span></h1>
                        <div class="c-heading__sub">Subtitle Text Content</div>
                    </div>
                    <hr>
                    <div class="c-heading -h2">
                        <div class="c-heading__pre">Pretitle Text Content</div>
                        <h2 class="c-heading__title">H2 Section Heading <span>Item</span></h2>
                        <div class="c-heading__sub">Subtitle Text Content</div>
                    </div>
                    <hr>
                    <div class="c-heading -h3">
                        <h3 class="c-heading__title">H3 Heading Item</h3>
                    </div>
                    <hr>
                    <div class="c-heading -h4">
                        <h4 class="c-heading__title">H4 Heading Item</h4>
                    </div>
                    <hr>
                    <div class="l-heading-v2">
                        <div class="c-heading -h2">
                            <h2 class="c-heading__title">Custom Example ".l-heading-v2"</h2>
                            <div class="c-heading__sub">Subtitle Text Content</div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="container gap-top gap-bot" id="banner">
            <h3 class="c-heading -h2 sg-title">Banner Mid Size + overlay</h3>
        </section>
        <div class="m-banner m-banner--medium has-overlay colors-inverted">
            <div class="scroll-down sd-left">Scroll Down</div>
            <div class="m-banner__media">
                <picture class="m-banner__picture">
                    <source media="(min-width: 1500px)" srcset="https://placehold.co/1920x500">
                    <source media="(min-width: 768px)" srcset="https://placehold.co/1024x400">
                    <source media="(min-width: 300px)" srcset="https://placehold.co/560x200">
                    <img src="https://placehold.co/1920x500" alt="" />
                </picture>
            </div>
            <div class="m-banner__container container">
                <div class="l-banner">
                    <div class="c-heading -h1">
                        <h1 class="c-heading__title">Medium Height Banner Title</h1>
                        <div class="c-heading__sub">Medium Height Banner Subtitle</div>
                    </div>
                    <div class="l-banner__text is-wysiwyg">
                        <ul>.has-overlay class for image overlay.</ul>
                        <ul>.header-lap class for the fixed header overlap.</ul>
                        <ul>.m-banner--small, .m-banner--medium, .m-banner--full for banner height</ul>
                        <ul>banner settings: /_modules/banners/__banners-settings.scss</ul>
                    </div>
                </div>
            </div>
        </div>

        <section class="container gap-top gap-bot" id="wysiwyg">
            <h3 class="c-heading -h2 sg-title">WYSIWYG Content</h3>
            <div class="is-wysiwyg content-single">
                <h1>H1 Heading Level</h1>
                <h2>H2 Heading Level</h2>
                <h3>H3 Heading Level</h3>
                <h4>H4 Heading Level</h4>
                <p>Lorem ipsum dolor <a href="/">sit amet</a>, <strong>consectetur</strong> <i>adipisicing elit</i>. Architecto fugiat mollitia nihil praesentium ut! Culpa enim error excepturi, harum hic ipsam maxime quibusdam quidem sequi voluptas. Enim maxime recusandae velit.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur beatae doloribus harum ipsum nemo neque, odit reiciendis repudiandae sed tenetur. Consequatur enim esse exercitationem magnam maxime quibusdam, quis repellat sequi?</p>
                <ul>
                    <li>List item</li>
                    <li>List item</li>
                    <li>List item</li>
                </ul>
            </div>
        </section>

        <section class="container gap-top gap-bot" id="forms">
            <h3 class="c-heading -h2 sg-title">Forms</h3>
            <form class="l-form c-form">
                <div class="c-form__row">
                    <div class="c-form__item">
                        <label>Label</label>
                        <span class="wpcf7-form-control-wrap">
                            <input type="email" class="wpcf7-form-control" placeholder="Placeholder">
                            <span class="wpcf7-not-valid-tip">The field is required.</span>
                        </span>
                    </div>
                    <div class="c-form__item">
                        <label>Label</label>
                        <span class="wpcf7-form-control-wrap">
                            <input type="email" class="wpcf7-form-control" placeholder="Placeholder">
                            <span class="wpcf7-not-valid-tip">The field is required.</span>
                        </span>
                    </div>
                </div>
                <div class="c-form__row">
                    <div class="c-form__item">
                        <select>
                            <option>Select Placeholder</option>
                            <option>Select Placeholder</option>
                        </select>
                    </div>
                </div>
                <div class="c-form__row">
                    <div class="c-form__item">
                        <textarea cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="wpcf7-response-output" aria-hidden="true">Thank you for your message. It has been sent.</div>
                <input type="submit" value="Submit" class="wpcf7-form-control wpcf7-submit">
            </form>
        </section>

        <!-- Post Cards Layout -->

        <section class="container gap-top gap-bot" id="posts">
            <h3 class="c-heading -h2 sg-title">Posts Cards (.l-posts)</h3>

            <div class="l-rcbl l-posts">
                <div class="l-posts__col">
                    <div class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <a class="c-block__media-link" href="/">
                                    <img class="c-image__src" loading="lazy" src="https://placehold.co/400x400" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="c-block__body">
                            <div class="c-block__cats">
                                <a class="c-block__tag" href="/">Events</a>
                                <a class="c-block__tag" href="/">Opinions</a>
                            </div>
                            <h4 class="c-block__title">
                                <a href="/">Test Post 1</a>
                            </h4>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="l-posts__col">
                    <div class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <a class="c-block__media-link" href="/">
                                    <img class="c-image__src" loading="lazy" src="https://placehold.co/400x400" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="c-block__body">
                            <div class="c-block__cats">
                                <a class="c-block__tag" href="/">Events</a>
                                <a class="c-block__tag" href="/">Opinions</a>
                            </div>
                            <h4 class="c-block__title">
                                <a href="/">Test Post 1</a>
                            </h4>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="l-posts__col">
                    <div class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <a class="c-block__media-link" href="/">
                                    <img class="c-image__src" loading="lazy" src="https://placehold.co/400x400" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="c-block__body">
                            <div class="c-block__cats">
                                <a class="c-block__tag" href="/">Events</a>
                                <a class="c-block__tag" href="/">Opinions</a>
                            </div>
                            <h4 class="c-block__title">
                                <a href="/">Test Post 1</a>
                            </h4>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="container gap-top gap-bot" id="simple1">
            <h3 class="c-heading -h2 sg-title">Repeatable Content Blocks v1 (.l-rcbl .l-rcbl-v1)</h3>

            <div class="l-rcbl l-rcbl-v1 align-center">
                <div class="l-rcbl__col">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/150x150" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">

                            <h4 class="c-block__title">This is a title</h4>
                            <div class="c-block__text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="l-rcbl__col">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/150x150" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">

                            <h4 class="c-block__title">This is a title</h4>
                            <div class="c-block__text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="l-rcbl__col">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/150x150" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">

                            <h4 class="c-block__title">This is a title</h4>
                            <div class="c-block__text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="l-rcbl__col">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/150x150" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">

                            <h4 class="c-block__title">This is a title</h4>
                            <div class="c-block__text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
            </div>

        </section>

        <section class="container gap-top gap-bot">
            <h3 class="c-heading -h2 sg-title">Repeatable Content Blocks v2 (.l-rcbl .l-rcbl-v2)</h3>

            <div class="l-rcbl l-rcbl-v2 align-bottom">
                <div class="l-rcbl__col">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/150x150" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">

                            <h4 class="c-block__title">This is a title</h4>
                            <div class="c-block__text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="l-rcbl__col">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/150x150" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">

                            <h4 class="c-block__title">This is a title</h4>
                            <div class="c-block__text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="l-rcbl__col">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/150x150" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">

                            <h4 class="c-block__title">This is a title</h4>
                            <div class="c-block__text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
                <div class="l-rcbl__col">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/150x150" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">

                            <h4 class="c-block__title">This is a title</h4>
                            <div class="c-block__text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -link">
                                    Link Button
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
            </div>

        </section>

        <section class="container gap-top gap-bot" id="simple2">
            <h3 class="c-heading -h2 sg-title">Double Content Blocks (.l-dcbl)</h3>

            <div class="l-dcbl">
                <div class="c-block">
                    <div class="c-block__col c-block__content align-center">
                        <div class="c-block__inner">
                            <div class="c-heading -h2">
                                <div class="c-heading__pre">This is a pre-title</div>
                                <h2 class="c-heading__title">This is a title</h2>
                                <div class="c-heading__sub">This is a sub-title</div>
                            </div>
                            <div class="c-block__text is-wysiwyg">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -primary">
                                    Button Primary
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="c-block__col c-block__media">
                        <div class="c-image">
                            <div class="c-image__primary">
                                <img class="c-image__src" src="https://placehold.co/600x400" loading="lazy" alt="">
                            </div>
                            <div class="c-image__secondary">
                                <img class="c-image__src" src="https://placehold.co/150x150" loading="lazy" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="l-dcbl order-reverse">
                <div class="c-block">
                    <div class="c-block__col c-block__content align-center">
                        <div class="c-block__inner">
                            <div class="c-heading -h3">
                                <div class="c-heading__pre">This is a pre-title</div>
                                <h3 class="c-heading__title">This is a title</h3>
                                <div class="c-heading__sub">This is a sub-title</div>
                            </div>
                            <div class="c-block__text is-wysiwyg">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="c-block__btn">
                                <a href="/" class="c-btn -primary">
                                    Button Primary
                                    <span class="c-btn__ico"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="c-block__col c-block__media">
                        <div class="c-image">
                            <div class="c-image__primary">
                                <img class="c-image__src" src="https://placehold.co/600x400" loading="lazy" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="l-dcbl l-dcbl-full">
                <div class="c-block">
                    <div class="c-block__col c-block__content align-center">
                        <div class="c-block__inner">
                            <div class="c-heading -h2">
                                <div class="c-heading__pre">This is a pre-title</div>
                                <h2 class="c-heading__title">This is a title</h2>
                                <div class="c-heading__sub">This is a sub-title</div>
                            </div>
                            <div class="c-block__text is-wysiwyg">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                    <div class="c-block__col c-block__media">
                        <div class="c-image">
                            <div class="c-image__primary">
                                <img class="c-image__src" src="https://placehold.co/600x300" loading="lazy" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="l-dcbl l-dcbl-full order-reverse">
                <div class="c-block">
                    <div class="c-block__col c-block__content align-center">
                        <div class="c-block__inner">
                            <div class="c-heading -h2">
                                <div class="c-heading__pre">This is a pre-title</div>
                                <h2 class="c-heading__title">This is a title</h2>
                                <div class="c-heading__sub">This is a sub-title</div>
                            </div>
                            <div class="c-block__text is-wysiwyg">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                    <div class="c-block__col c-block__media">
                        <div class="c-image">
                            <div class="c-image__primary">
                                <img class="c-image__src" src="https://placehold.co/600x300" loading="lazy" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container gap-top gap-bot" id="simple3">
            <h3 class="c-heading -h2 sg-title">3 Col Content Blocks (.l-ccbl)</h3>
            <div class="l-ccbl l-ccbl-v1">
                <div class="l-ccbl__img">
                    <div class="c-image">
                        <img class="c-image__src" loading="lazy" src="https://placehold.co/300x400" alt="">
                    </div>
                </div>
                <div class="l-ccbl__item">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <h3 class="c-block__title">Lorem ipsum dolor sit amet</h3>
                            <div class="c-block__description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="l-ccbl__item">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <h3 class="c-block__title">Lorem ipsum dolor sit amet</h3>
                            <div class="c-block__description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="l-ccbl__item">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <h3 class="c-block__title">Lorem ipsum dolor sit amet</h3>
                            <div class="c-block__description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="l-ccbl__item">
                    <article class="c-block">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <h3 class="c-block__title">Lorem ipsum dolor sit amet</h3>
                            <div class="c-block__description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="" id="sliders">

            <div class="container">

                <h3 class="c-heading -h2 sg-title">Sliders: Simple Logo Carousel + Outer Arrows</h3>

                <!-- Simple Logo Slider -->

                <div class="m-slider l-slider-images gap-top gap-bot">
                <div class="m-slider__container swiper js-slider-simple"
                     data-slider-columns="6"
                     data-slider-columns-gap="20"
                     data-slider-navigation="outer-arrows"
                >
                    <div class="m-slider__wrapper swiper-wrapper">
                        <div class="m-slider__slide swiper-slide">
                            <div class="m-slider__media">
                                <img src="https://placehold.co/100x50" alt="">
                            </div>
                         </div>
                        <div class="m-slider__slide swiper-slide">
                            <div class="m-slider__media">
                                <img src="https://placehold.co/200x50" alt="">
                            </div>
                         </div>
                        <div class="m-slider__slide swiper-slide">
                            <div class="m-slider__media">
                                <img src="https://placehold.co/60x100" alt="">
                            </div>
                         </div>
                        <div class="m-slider__slide swiper-slide">
                            <div class="m-slider__media">
                                <img src="https://placehold.co/50x50" alt="">
                            </div>
                         </div>
                        <div class="m-slider__slide swiper-slide">
                            <div class="m-slider__media">
                                <img src="https://placehold.co/100x100" alt="">
                            </div>
                         </div>
                        <div class="m-slider__slide swiper-slide">
                            <div class="m-slider__media">
                                <img src="https://placehold.co/100x50" alt="">
                            </div>
                         </div>
                        <div class="m-slider__slide swiper-slide">
                            <div class="m-slider__media">
                                <img src="https://placehold.co/100x50" alt="">
                            </div>
                         </div>
                    </div>
<!--                    <div class="m-slider__pagination swiper-pagination"></div>-->
                </div>
                <div class="m-slider__nav is-round">
                    <div class="m-slider__arrows -prev swiper-button-prev"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></div>
                    <div class="m-slider__arrows -next swiper-button-next"><?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?></div>
                </div>
            </div>

            </div>

            <div class="container">
                <h3 class="c-heading -h2 sg-title">Sliders: Banner Image Slider + Inner Arrows + Pagination</h3>
            </div>

            <!-- Default Banners Slider -->

            <div class="m-slider has-overlay colors-inverted header-lap">
                <div class="m-slider__container swiper js-slider-advanced" data-slider-navigation="inner-arrows">
                    <div class="m-slider__wrapper swiper-wrapper">
                        <div class="m-slider__slide swiper-slide">
                            <!-- Module Banner -->
                            <div class="m-banner m-banner--small">
                                <div class="m-banner__media">
                                    <picture class="m-banner__picture">
                                        <source media="(min-width: 1500px)" srcset="https://placehold.co/1920x450">
                                        <source media="(min-width: 1024px)" srcset="https://placehold.co/1200x350">
                                        <source media="(min-width: 768px)" srcset="https://placehold.co/1024x400">
                                        <source media="(min-width: 300px)" srcset="https://placehold.co/560x200">
                                        <img src="https://placehold.co/1920x450" alt="" />
                                    </picture>
                                </div>
                                <div class="m-banner__container container">
                                    <div class="l-banner">
                                        <div class="c-heading -h2">
                                            <h2 class="c-heading__title">Ultricies tristique nulla aliquet enim</h2>
                                        </div>
                                        <div class="is-wysiwyg">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis enim ut tellus elementum sagittis vitae et leo duis.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-slider__slide swiper-slide">
                            <!-- Module Banner -->
                            <div class="m-banner m-banner--small">
                                <div class="m-banner__media">
                                    <picture class="m-banner__picture">
                                        <source media="(min-width: 1500px)" srcset="https://placehold.co/1920x450">
                                        <source media="(min-width: 1024px)" srcset="https://placehold.co/1200x350">
                                        <source media="(min-width: 768px)" srcset="https://placehold.co/1024x400">
                                        <source media="(min-width: 300px)" srcset="https://placehold.co/560x200">
                                        <img src="https://placehold.co/1920x450" alt="" />
                                    </picture>
                                </div>
                                <div class="m-banner__container container">
                                    <div class="l-banner">
                                        <div class="c-heading -h2">
                                            <h2 class="c-heading__title">Ultricies tristique nulla aliquet enim</h2>
                                        </div>
                                        <div class="is-wysiwyg">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis enim ut tellus elementum sagittis vitae et leo duis.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-slider__slide swiper-slide">
                            <!-- Module Banner -->
                            <div class="m-banner m-banner--small">
                                <div class="m-banner__media">
                                    <picture class="m-banner__picture">
                                        <source media="(min-width: 1500px)" srcset="https://placehold.co/1920x450">
                                        <source media="(min-width: 1024px)" srcset="https://placehold.co/1200x350">
                                        <source media="(min-width: 768px)" srcset="https://placehold.co/1024x400">
                                        <source media="(min-width: 300px)" srcset="https://placehold.co/560x200">
                                        <img src="https://placehold.co/1920x450" alt="" />
                                    </picture>
                                </div>
                                <div class="m-banner__container container">
                                    <div class="l-banner">
                                        <div class="c-heading -h2">
                                            <h2 class="c-heading__title">Ultricies tristique nulla aliquet enim</h2>
                                        </div>
                                        <div class="is-wysiwyg">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis enim ut tellus elementum sagittis vitae et leo duis.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-slider__pagination swiper-pagination"></div>
                </div>
                <div class="m-slider__nav is-round">
                    <div class="m-slider__arrows -prev swiper-button-prev">
                        <?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?>
                    </div>
                    <div class="m-slider__arrows -next swiper-button-next">
                        <?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?>
                    </div>
                </div>
            </div>

            <div class="container gap-top gap-bottom container">
                <h3 class="c-heading -h2 sg-title">Sliders: Testimonials Slider + Thumbs + Bottom Arrows + Pagination</h3>

                <div class="m-slider m-testimonials has-overlay">
                    <div class="swiper js-slider--with-nav js-slider-advanced"
                         data-slider-thumbs="true"
                         data-slider-navigation="outer-arrows"
                    >
                        <div class="swiper-wrapper">
                            <div class="m-slider__slide swiper-slide">
                                <!-- Testimonials Layout -->
                                <div class="l-testimonials">
                                    <figure class="c-quote">
                                        <blockquote class="c-quote__content">
                                            <p class="c-quote__text">This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, </p>
                                            <a class="c-btn -link naked floatbox" href="#testimonial" data-fb-options="width:800 height:auto colorTheme:white outerBorderRadius:8 padding:25">Read Full Story</a>
                                         </blockquote>
                                        <!--popup start-->
                                        <div class="popup" data-popup="testimonial" id="testimonial" style="display: none">
                                            This is a Full Quote Content This is a Full Quote Content This is a Full Quote Content This is a Full Quote Content This is a Full Quote Content This is a Full Quote Content This is a Full Quote Content This is a Full Quote Content
                                        </div>
                                        <figcaption class="c-quote__profile">
                                            <div class="c-quote__photo">
                                                <img src="https://placehold.co/100x100" alt="">
                                            </div>
                                            <div class="c-quote__info">
                                                <div class="c-quote__name">John Doe</div>
                                                <span class="c-quote__company">The Company</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="m-slider__slide swiper-slide">
                                <!-- Testimonials Layout -->
                                <div class="l-testimonials colors-inverted">
                                    <div class="m-banner__media">
                                        <picture class="m-banner__picture">
                                            <source media="(min-width: 1500px)" srcset="https://placehold.co/1920x450">
                                            <source media="(min-width: 1024px)" srcset="https://placehold.co/1200x350">
                                            <source media="(min-width: 768px)" srcset="https://placehold.co/1024x400">
                                            <source media="(min-width: 300px)" srcset="https://placehold.co/560x200">
                                            <img src="https://placehold.co/1920x450" alt="">
                                        </picture>
                                    </div>
                                    <figure class="c-quote">
                                        <blockquote class="c-quote__content">
                                            <p class="c-quote__text">This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, </p>
                                        </blockquote>
                                        <figcaption class="c-quote__profile">
                                            <div class="c-quote__photo">
                                                <img src="https://placehold.co/100x100" alt="">
                                            </div>
                                            <div class="c-quote__info">
                                                <div class="c-quote__name">John Doe</div>
                                                <span class="c-quote__company">The Company</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="m-slider__slide swiper-slide">
                                <!-- Testimonials Layout -->
                                <div class="l-testimonials">
                                    <figure class="c-quote">
                                        <blockquote class="c-quote__content">
                                            <p class="c-quote__text">This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, This is a Quote. Yes, </p>
                                        </blockquote>
                                        <figcaption class="c-quote__profile">
                                            <div class="c-quote__photo">
                                                <img src="https://placehold.co/100x100" alt="">
                                            </div>
                                            <div class="c-quote__info">
                                                <div class="c-quote__name">John Doe</div>
                                                <span class="c-quote__company">The Company</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="l-slider-nav">
                            <div class="c-slider-nav">
                                <div class="c-slider-nav__thumb js-nav__item swiper-slide">
                                    <div class="c-slider-nav__img">
                                        <img src="https://placehold.co/120x120" alt="" loading="lazy">
                                    </div>
                                </div>
                                <div class="c-slider-nav__thumb js-nav__item swiper-slide">
                                    <div class="c-slider-nav__img">
                                        <img src="https://placehold.co/120x120" alt="" loading="lazy">
                                    </div>
                                </div>
                                <div class="c-slider-nav__thumb js-nav__item swiper-slide">
                                    <div class="c-slider-nav__img">
                                        <img src="https://placehold.co/120x120" alt="" loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-slider__pagination swiper-pagination"></div>
                    </div>
                    <div class="m-slider__nav is-round">
                        <div class="m-slider__arrows -prev swiper-button-prev">
                            <?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?>
                        </div>
                        <div class="m-slider__arrows -next swiper-button-next">
                            <?php echo get_svg(array('icon' => 'lib-icon-arrow1')); ?>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <div class="container gap-top gap-bottom container" id="acc">
            <h3 class="c-heading -h2 sg-title">Accordions: Simple FAQ</h3>

            <div class="m-accordion">
                <div class="l-accordion js-acc-wrapper icons-plus-minus" data-animation="js" data-close="true">
                    <div class="c-accordion">
                        <div class="c-accordion__item js-acc-item is-active">
                            <div class="c-accordion__title-wrap -h4">
                                <button class="js-acc-button c-accordion__title">
                                    FAQ Question 1
                                </button>
                            </div>
                            <div class="js-acc-content">
                                <div class="c-accordion__content is-wysiwyg">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam cumque dolorum labore libero ut? Ab adipisci amet culpa ea eligendi harum labore laboriosam molestias praesentium quasi, quos, ratione recusandae, vitae.
                                </div>
                            </div>
                        </div>
                        <div class="c-accordion__item js-acc-item">
                            <div class="c-accordion__title-wrap -h4">
                                <button class="js-acc-button c-accordion__title">
                                    FAQ Question 2
                                </button>
                            </div>
                            <div class="js-acc-content">
                                <div class="c-accordion__content is-wysiwyg">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam cumque dolorum labore libero ut? Ab adipisci amet culpa ea eligendi harum labore laboriosam molestias praesentium quasi, quos, ratione recusandae, vitae.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <div class="container gap-top gap-bottom container">
            <h3 class="c-heading -h2 sg-title">Accordions: FAQ + Dynamic Media Item + FAQ v2 style</h3>

            <div class="m-accordion">
                <div class="l-accordion js-acc-wrapper icons-arrows"
                     data-animation="js"
                     data-close="true"
                     data-gallery-animation="js"
                     data-gallery="true"
                >
                    <div class="l-accordion__col l-accordion__content">
                        <div class="c-accordion c-accordion-v2">
                        <div class="c-accordion__item js-acc-item is-active">
                            <div class="c-accordion__title-wrap -h4">
                                <button class="js-acc-button c-accordion__title">
                                    FAQ Question 1
                                </button>
                            </div>
                            <div class="js-acc-content">
                                <div class="c-accordion__content is-wysiwyg">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam cumque dolorum labore libero ut? Ab adipisci amet culpa ea eligendi harum labore laboriosam molestias praesentium quasi, quos, ratione recusandae, vitae.
                                </div>
                            </div>
                        </div>
                        <div class="c-accordion__item js-acc-item">
                            <div class="c-accordion__title-wrap -h4">
                                <button class="js-acc-button c-accordion__title">
                                    FAQ Question 2
                                </button>
                            </div>
                            <div class="js-acc-content">
                                <div class="c-accordion__content is-wysiwyg">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam cumque dolorum labore libero ut? Ab adipisci amet culpa ea eligendi harum labore laboriosam molestias praesentium quasi, quos, ratione recusandae, vitae.
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="l-accordion__col l-accordion__media">
                        <div class="l-accordion__imgs js-acc-media is-active" data-actab-id="acc-tab-id-0">
                            <div class="c-image__media c-image__primary">
                                <img class="c-image__src" src="https://placehold.co/250x300" loading="lazy" alt="">
                            </div>
                        </div>
                        <div class="l-accordion__imgs js-acc-media" data-actab-id="acc-tab-id-1">
                            <div class="c-image__media c-image__primary">
                                <img class="c-image__src" src="https://placehold.co/400x250" loading="lazy" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container gap-top gap-bottom container" id="counter">
            <h3 class="c-heading -h2 sg-title">Counter Cards (vertical)</h3>

            <div class="m-counter">
                <div class="l-counter l-rcbl">
                    <div class="c-counter is-vertical text-center">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <div class="c-counter__data">
                                <span class="c-counter__number" data-purecounter-start="0" data-purecounter-end="100">100</span>
                                <span class="c-counter__symbol">%</span>
                            </div>
                            <h4 class="c-block__title">Title</h4>
                            <div class="c-block__text">Some Description Goes Here</div>
                        </div>
                    </div>
                    <div class="c-counter is-vertical text-center">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <div class="c-counter__data">
                                <span class="c-counter__number" data-purecounter-start="0" data-purecounter-end="100">100</span>
                                <span class="c-counter__symbol">%</span>
                            </div>
                            <h4 class="c-block__title">Title</h4>
                            <div class="c-block__text">Some Description Goes Here</div>
                        </div>
                    </div>
                    <div class="c-counter is-vertical text-center">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <div class="c-counter__data">
                                <span class="c-counter__number" data-purecounter-start="0" data-purecounter-end="100">100</span>
                                <span class="c-counter__symbol">%</span>
                            </div>
                            <h4 class="c-block__title">Title</h4>
                            <div class="c-block__text">Some Description Goes Here</div>
                        </div>
                    </div>
                    <div class="c-counter is-vertical text-center">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <div class="c-counter__data">
                                <span class="c-counter__number" data-purecounter-start="0" data-purecounter-end="100">100</span>
                                <span class="c-counter__symbol">%</span>
                            </div>
                            <h4 class="c-block__title">Title</h4>
                            <div class="c-block__text">Some Description Goes Here</div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h3 class="c-heading -h2 sg-title">Counter Cards (Horizontal)</h3>
            <div class="m-counter">
                <div class="l-counter l-rcbl" style="--l-block-col: 3">
                    <div class="c-counter is-horizontal">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <div class="c-counter__data">
                                <span class="c-counter__number" data-purecounter-start="0" data-purecounter-end="100">100</span>
                                <span class="c-counter__symbol">%</span>
                            </div>
                            <h4 class="c-block__title">Title</h4>
                            <div class="c-block__text">Some Description Goes Here</div>
                        </div>
                    </div>
                    <div class="c-counter is-horizontal">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <div class="c-counter__data">
                                <span class="c-counter__number" data-purecounter-start="0" data-purecounter-end="100">100</span>
                                <span class="c-counter__symbol">%</span>
                            </div>
                            <h4 class="c-block__title">Title</h4>
                            <div class="c-block__text">Some Description Goes Here</div>
                        </div>
                    </div>
                    <div class="c-counter is-horizontal">
                        <div class="c-block__media">
                            <div class="c-image">
                                <img class="c-image__src" loading="lazy" src="https://placehold.co/100x100" alt="">
                            </div>
                        </div>
                        <div class="c-block__body">
                            <div class="c-counter__data">
                                <span class="c-counter__number" data-purecounter-start="0" data-purecounter-end="100">100</span>
                                <span class="c-counter__symbol">%</span>
                            </div>
                            <h4 class="c-block__title">Title</h4>
                            <div class="c-block__text">Some Description Goes Here</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container gap-top gap-bottom container" id="tabs">
            <h3 class="c-heading -h2 sg-title">Tabs (transforms into accordion on mobile)</h3>

            <div class="m-tabs js-tabs-to-acc-wrapper">
                <div class="l-tbnav l-tbnav-v1" role="tablist">
                    <div class="l-tbnav__item c-tbnav  is-active js-tabs-nav-item" data-tab="item-0" role="tab" aria-selected="true" aria-controls="data-tab-item-0">
                        <div class="c-tbnav__media">
                            <img class="c-tbnav__img" loading="lazy" src="https://placehold.co/65x65" alt="">
                        </div>
                        <div class="c-tbnav__label">Tab Name 1</div>
                    </div>
                    <div class="l-tbnav__item c-tbnav  js-tabs-nav-item" data-tab="item-1" role="tab" aria-selected="false" aria-controls="data-tab-item-1">
                        <div class="c-tbnav__media">
                            <img class="c-tbnav__img" loading="lazy" src="https://placehold.co/65x65" alt="">
                        </div>
                        <div class="c-tbnav__label">Tab Name 2</div>
                    </div>
                    <div class="l-tbnav__item c-tbnav  js-tabs-nav-item" data-tab="item-2" role="tab" aria-selected="false" aria-controls="data-tab-item-2">
                        <div class="c-tbnav__media">
                            <img class="c-tbnav__img" loading="lazy" src="https://placehold.co/65x65" alt="">
                        </div>
                        <div class="c-tbnav__label">Tab Name 3</div>
                    </div>
                </div>

                <div class="l-tbpanel l-tbpanel-v1">
                    <div class="l-tbpanel__item js-tabs-panel l-dcbl is-active" aria-hidden="false" aria-labelledby="data-tab-item-0" id="data-tab-item-0" role="tabpanel">
                        <div class="l-tbpanel__label js-tabs-label">Tab Name 1</div> <!-- Mobile Title -->
                        <div class="c-block js-ta-content is-active">
                            <div class="c-block__col c-block__content">
                                <div class="c-block__inner">
                                    <div class="c-heading -h2">
                                        <h2 class="c-heading__title">Ultricies tristique nulla aliquet enim</h2>
                                    </div>
                                    <div class="c-heading__description is-wysiwyg">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis enim ut tellus elementum sagittis vitae et leo duis.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="c-block__col c-block__media">
                                <div class="c-image">
                                    <div class="c-image__media c-image__primary">
                                        <img class="c-image__src" src="https://placehold.co/400x300" loading="lazy" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="l-tbpanel__item js-tabs-panel l-dcbl" aria-hidden="true" aria-labelledby="data-tab-item-1" id="data-tab-item-1" role="tabpanel">
                        <div class="l-tbpanel__label js-tabs-label">Tab Name 2</div> <!-- Mobile Title -->
                        <div class="c-block js-ta-content">
                            <div class="c-block__col c-block__content">
                                <div class="c-block__inner">
                                    <div class="c-heading -h2">
                                        <h2 class="c-heading__title">Ultricies tristique nulla aliquet enim</h2>
                                    </div>
                                    <div class="c-heading__description is-wysiwyg">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis enim ut tellus elementum sagittis vitae et leo duis.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="c-block__col c-block__media">
                                <div class="c-image">
                                    <div class="c-image__media c-image__primary">
                                        <img class="c-image__src" src="https://placehold.co/400x300" loading="lazy" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="l-tbpanel__item js-tabs-panel l-dcbl" aria-hidden="true" aria-labelledby="data-tab-item-2" id="data-tab-item-2" role="tabpanel">
                        <div class="l-tbpanel__label js-tabs-label">Tab Name 3</div> <!-- Mobile Title -->
                        <div class="c-block js-ta-content">
                            <div class="c-block__col c-block__content">
                                <div class="c-block__inner">
                                    <div class="c-heading -h2">
                                        <h2 class="c-heading__title">Ultricies tristique nulla aliquet enim</h2>
                                    </div>
                                    <div class="c-heading__description is-wysiwyg">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis enim ut tellus elementum sagittis vitae et leo duis.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="c-block__col c-block__media">
                                <div class="c-image">
                                    <div class="c-image__media c-image__primary">
                                        <img class="c-image__src" src="https://placehold.co/400x300" loading="lazy" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container gap-top gap-bottom container">
            <h3 class="c-heading -h2 sg-title">Tabs (transforms into select dropdown on mobile)</h3>

            <div class="m-tabs js-tabsTabDrop-wrapper">
                <div class="l-tbnav l-tbnav-v2" role="tablist">
                    <div class="l-tbnav__item c-tbnav is-active js-tabs-nav-item" data-tab="item2-0" role="tab" aria-selected="true" aria-controls="data-tab-item2-0">
                        <div class="c-tbnav__label">Tab Name 1</div>
                    </div>
                    <div class="l-tbnav__item c-tbnav js-tabs-nav-item" data-tab="item2-1" role="tab" aria-selected="false" aria-controls="data-tab-item2-1">
                        <div class="c-tbnav__label">Tab Name 2</div>
                    </div>
                    <div class="l-tbnav__item c-tbnav js-tabs-nav-item" data-tab="item2-2" role="tab" aria-selected="false" aria-controls="data-tab-item2-2">
                        <div class="c-tbnav__label">Tab Name 3</div>
                    </div>
                    <select class="js-tabs-dropdown">
                        <option value="item2-0" selected="selected">Tabs1</option>
                        <option value="item2-1">Tabs2</option>
                        <option value="item2-2">Tabs3</option>
                    </select>
                </div>
                <div class="l-tbpanel l-tbpanel-v1">
                    <div class="l-tbpanel__item js-tabs-panel l-dcbl is-active" aria-hidden="false" aria-labelledby="data-tab-item2-0" id="data-tab-item2-0" role="tabpanel">
                        <div class="c-block is-active">
                            <div class="is-wysiwyg">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis enim ut tellus elementum sagittis vitae et leo duis.</p>
                            </div>
                        </div>
                    </div>
                    <div class="l-tbpanel__item js-tabs-panel l-dcbl" aria-hidden="true" aria-labelledby="data-tab-item2-1" id="data-tab-item2-1" role="tabpanel">
                        <div class="l-tbpanel__label js-tabs-label">Tab Name 2</div> <!-- Mobile Title -->
                        <div class="c-block">
                            <div class="is-wysiwyg">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis enim ut tellus elementum sagittis vitae et leo duis.</p>
                            </div>
                        </div>
                    </div>
                    <div class="l-tbpanel__item js-tabs-panel l-dcbl" aria-hidden="true" aria-labelledby="data-tab-item2-2" id="data-tab-item2-2" role="tabpanel">
                        <div class="l-tbpanel__label js-tabs-label">Tab Name 3</div> <!-- Mobile Title -->
                        <div class="c-block">
                            <div class="is-wysiwyg">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis enim ut tellus elementum sagittis vitae et leo duis.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
    </div>

    <style>
        .sg-title {
            --h2-margin-bottom: 1em;
            background-color: rgba(0,0,0,.05);
            border-bottom: 1px solid rgba(0,0,0,.3);
            padding-left: 30px;
        }
        .color-grid {
            display: flex;
        }
        .color-grid__preview {
            height: 40px;
            background-color: var(--preview-color);
        }
        .titles-preview__item {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .titles-preview__item.colors-inverted {
            position: relative;
        }
        .titles-preview__item.colors-inverted:before {
            content: '.colors-inverted for alternative colors';
            position: absolute;
            left: 0;
            top: 0;
            transform: translateY(-100%);
            text-align: center;
            font-size: 15px;
        }
        .sg-nav {
            position: sticky;
            top: 100px;
            z-index: 10;
        }
        .sg-nav ul {
            position: absolute;
            left: 0;
        }
        .sg-nav a {
            display: block;
            padding: 3px 6px;
            background-color: rgba(255,255,255,.8);
        }
        .sg-nav a:hover {
            background-color: var(--primary-color2);
        }
    </style>

<?php get_footer(); ?>
