// toggle dark mode

export function toggleDarkMode(el) {

    if (document.querySelector(el)) {

        const mode = localStorage.getItem('dark-mode');
        const btnSwitch = document.querySelector(el);

        if (mode === 'on') {
            btnSwitch.setAttribute('aria-pressed', true);
            document.documentElement.setAttribute("color-mode", "dark");
        }
        btnSwitch.addEventListener('click', event => {
            if (document.documentElement.hasAttribute("color-mode")) {

                localStorage.setItem('dark-mode', 'off');
                btnSwitch.setAttribute('aria-pressed', false);
                document.documentElement.removeAttribute("color-mode");

            } else {
                localStorage.setItem('dark-mode', 'on');
                btnSwitch.setAttribute('aria-pressed', true);
                document.documentElement.setAttribute("color-mode", "dark");
            }
        })
    }
}