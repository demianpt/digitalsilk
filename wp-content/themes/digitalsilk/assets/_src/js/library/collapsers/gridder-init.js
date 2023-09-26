export default function gridderInit() {

    const gridder = document.querySelector('.js-gridder');
    const gridders = document.querySelectorAll('.js-gridder');

    if (gridder) {
        if (jQuery().gridderExpander) {
            $(() => {
                gridders.forEach((grid, i) => {

                    // Call Gridder
                    $(grid).gridderExpander({
                        scroll: true,
                        scrollOffset: 80,
                        scrollTo: 'panel', // panel or listitem
                        animationSpeed: 400,
                        animationEasing: 'easeInOutExpo',
                        showNav: true, // Show Navigation
                        nextText: '', // Next button text
                        prevText: '', // Previous button text
                        closeText: 'Close', // Close button text
                        onStart() {
                            // Gridder Inititialized
                        },
                        onContent() {
                            // Gridder Content Loaded
                        },
                        onClosed() {
                            // Gridder Closed
                        },
                    });
                });
            });
        } else {
            console.log('DSMP Error: Please include gridder library');
        }

    }
}
