function getOffset(el) {
    const rect = el.getBoundingClientRect();
    return rect.top + window.scrollY;
}

function handleClassForViewedElements(elements, pageYOffset, links) {
    elements.forEach((el, index) => {
        const link = links[index];
        if (el.top - 300 < pageYOffset) {
            link.classList.add('ez-toc-viewed');
            const siblingUL = link.parentNode.querySelector('ul');
            if (siblingUL) {
                siblingUL.classList.add('ez-list-open');
            }
        } else {
            link.classList.remove('ez-toc-viewed');
            const siblingUL = link.parentNode.querySelector('ul');
            if (siblingUL) {
                siblingUL.classList.remove('ez-list-open');
            }
        }
    });
}

export default function tableOfContents() {
    const toc = document.getElementById('ez-toc-container');
    const tocHeaders = toc.querySelectorAll('li[class*=ez-toc-heading]');
    const tocLinks = toc.querySelectorAll('.ez-toc-list a');
    /**
     * Add height for each UL element inside Table of contents
     */
    tocHeaders.forEach((e) => {
        const subList = e.querySelector('.ez-toc-list-level-3');
        if (subList) {
            subList.style.height = `${subList.scrollHeight}px`;
        }
    });

    /**
     * @type {{top: number, seen: boolean, item: Node & ParentNode}[]}
     * Map trough all the links and find belonging header element
     */
    const headers = [...tocLinks].map((e) => {
        const element = document.getElementById(e.getAttribute('href').substring(1));
        return { item: element, top: getOffset(element) - 100, seen: false };
    });

    handleClassForViewedElements(headers, window.pageYOffset, tocLinks);

    window.onscroll = function () {
        const offset = this.pageYOffset;
        handleClassForViewedElements(headers, offset, tocLinks);
    };
}
