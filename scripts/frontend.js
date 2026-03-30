document.addEventListener('DOMContentLoaded', function () {

    /* ================================
     * Inject Spinner Style (run once)
     * ================================ */
    function injectSpinnerStyle() {
        if (document.getElementById('cc-ajax-spinner-style')) return;

        const style = document.createElement('style');
        style.id = 'cc-ajax-spinner-style';

        style.innerHTML = `
            .canhcam-ajax-spinner {
                position: absolute;
                inset: 0;
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 100;
                background: rgba(255,255,255,0.6);
                backdrop-filter: blur(2px);
            }

            .cc-spinner {
                width: 48px;
                height: 48px;
            }

            .cc-spinner-svg {
                width: 100%;
                height: 100%;
                animation: cc-rotate 1.2s linear infinite;
            }

            .cc-spinner-circle {
                fill: none;
                stroke: #ff6300;
                stroke-width: 3;
                stroke-linecap: round;
                stroke-dasharray: 120;
                stroke-dashoffset: 90;
                animation: cc-dash 1.5s ease-in-out infinite;
            }

            @keyframes cc-rotate {
                100% { transform: rotate(360deg); }
            }

            @keyframes cc-dash {
                0% { stroke-dashoffset: 120; }
                50% { stroke-dashoffset: 30; }
                100% { stroke-dashoffset: 120; }
            }

            .canhcam-ajax-wrapper {
                transition: opacity .3s ease;
            }

            .canhcam-ajax-wrapper.is-loading {
                opacity: 0.6;
                pointer-events: none;
            }
        `;

        document.head.appendChild(style);
    }

    function scrollToWrapper(wrapper) {
        const header = document.querySelector('.canhcam-ajax-wrapper');
        const headerHeight = header ? header.offsetHeight : 0;

        const rect = wrapper.getBoundingClientRect();
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        const targetY = rect.top + scrollTop - headerHeight - 100;

        window.scrollTo({
            top: targetY,
            behavior: 'smooth'
        });
    }

    function updateURL(page) {
        let currentUrl = window.location.href;
        const urlStr = window.location.href;
        const url = new URL(urlStr);
        let baseUrl = url.origin + url.pathname;
        const pagePattern = /\/page\/\d+\/?/;

        if (parseInt(page) > 1) {
            if (pagePattern.test(baseUrl)) {
                baseUrl = baseUrl.replace(pagePattern, '/page/' + page + '/');
            } else {
                baseUrl = baseUrl.replace(/\/+$/, '') + '/page/' + page + '/';
            }
        } else {
            baseUrl = baseUrl.replace(pagePattern, '/');
            baseUrl = baseUrl.replace(/\/+$/, '/');
        }

        // Sync layout Param
        const activeTabLi = document.querySelector('.tabslet-tab li.active');
        if (activeTabLi) {
            const link = activeTabLi.querySelector('a');
            const layout = (link && link.getAttribute('href') === '#tab-2') ? 'grid' : 'swiper';
            url.searchParams.set('layout', layout);
        }

        const finalUrl = baseUrl + url.search + url.hash;
        if (finalUrl !== currentUrl) {
            window.history.pushState({ path: finalUrl }, '', finalUrl);
        }
    }

    injectSpinnerStyle();


    /* ================================
     * Re-init Lozad
     * ================================ */
    function reinitSwiper(wrapper) {
        const swiperContainers = wrapper.querySelectorAll('.swiper');
        swiperContainers.forEach(container => {
            if (container.swiper) {
                const swp = container.swiper;
                // If loop mode is enabled, we need a more thorough update
                if (swp.params && swp.params.loop) {
                    swp.loopDestroy();
                    swp.update();
                    swp.loopCreate();
                } else {
                    swp.update();
                }
                swp.slideTo(0, 0); // Back to first slide of new set
            }
        });
    }

    function reinitLozad(container) {
        const images = Array.from(container.querySelectorAll('.lozad'));
        if (!images.length) return;

        if (typeof window.lozad === 'function' || typeof lozad === 'function') {
            const lozadFn = typeof window.lozad === 'function' ? window.lozad : lozad;

            const observer = lozadFn(images, {
                loaded: function (el) {
                    if (el.dataset.src) el.src = el.dataset.src;
                    el.setAttribute('data-loaded', 'true');
                    el.classList.add('loaded');
                }
            });

            observer.observe();

            images.forEach(img => {
                if (img.getBoundingClientRect().top < window.innerHeight) {
                    if (typeof observer.triggerLoad === 'function') {
                        observer.triggerLoad(img);
                    } else if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.setAttribute('data-loaded', 'true');
                    }
                }
            });
        }
        else if ('IntersectionObserver' in window) {
            const fallbackObserver = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        if (el.dataset.src) {
                            el.src = el.dataset.src;
                            el.setAttribute('data-loaded', 'true');
                            el.classList.add('loaded');
                        }
                        obs.unobserve(el);
                    }
                });
            }, { rootMargin: '100px 0px', threshold: 0.1 });

            images.forEach(img => {
                if (img.getBoundingClientRect().top < window.innerHeight) {
                    if (img.dataset.src) img.src = img.dataset.src;
                    img.setAttribute('data-loaded', 'true');
                    img.classList.add('loaded');
                } else {
                    fallbackObserver.observe(img);
                }
            });
        } else {
            images.forEach(img => {
                if (img.dataset.src) img.src = img.dataset.src;
                img.setAttribute('data-loaded', 'true');
                img.classList.add('loaded');
            });
        }
    }

    // Function to sync tabs with URL layout param
    function syncTabsWithURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const layout = urlParams.get('layout');
        
        if (layout === 'grid') {
            const gridTab = document.querySelector('.tabslet-tab a[href="#tab-2"]');
            if (gridTab) gridTab.click();
        } else if (layout === 'swiper') {
            const swiperTab = document.querySelector('.tabslet-tab a[href="#tab-1"]');
            if (swiperTab) swiperTab.click();
        }
    }

    // Run on initial load
    $(document).ready(function() {
        // Delay a bit to let theme's tabslet initialize
        setTimeout(syncTabsWithURL, 100);
    });

    document.addEventListener('canhcamAjaxLoaded', function (e) {
        if (e.detail && e.detail.listContainer) {
            reinitLozad(e.detail.listContainer);
        }
        if (e.detail && e.detail.wrapper) {
            reinitSwiper(e.detail.wrapper);
        }
    });

    // Listen for tab clicks to update URL layout state
    $(document).on('click', '.tabslet-tab a', function() {
        const href = $(this).attr('href');
        const layout = (href === '#tab-2') ? 'grid' : 'swiper';
        
        const url = new URL(window.location.href);
        url.searchParams.set('layout', layout);
        window.history.replaceState({}, '', url.toString());
    });


    /* ================================
     * AJAX Pagination
     * ================================ */
    const ajaxWrappers = document.querySelectorAll('.canhcam-ajax-wrapper');

    ajaxWrappers.forEach(wrapper => {

        wrapper.addEventListener('click', function (e) {
            const target = e.target.closest('.ajax-pagination a, .modulepager a, .navigation a, .btn-navigation');

            if (target && target.hasAttribute('data-page')) {
                e.preventDefault();

                const page = target.getAttribute('data-page');
                const postType = wrapper.getAttribute('data-post-type');
                const postsPerPage = wrapper.getAttribute('data-posts-per-page');
                const templatePart = wrapper.getAttribute('data-template-part');
                const taxonomy = wrapper.getAttribute('data-taxonomy');
                const term = wrapper.getAttribute('data-term');
                const emptyMsg = wrapper.getAttribute('data-empty-msg');

                const listContainer = wrapper.querySelector('.ajax-list-container');
                const paginationContainer = wrapper.querySelector('.ajax-pagination-container');

                if (!listContainer || !postType || !templatePart) return;

                /* ================================
                 * Spinner Init
                 * ================================ */
                let spinner = wrapper.querySelector('.canhcam-ajax-spinner');

                if (!spinner) {
                    spinner = document.createElement('div');
                    spinner.className = 'canhcam-ajax-spinner';

                    spinner.innerHTML = `
                        <div class="cc-spinner">
                            <svg class="cc-spinner-svg" viewBox="0 0 50 50">
                                <circle class="cc-spinner-circle" cx="25" cy="25" r="20"></circle>
                            </svg>
                        </div>
                    `;

                    wrapper.style.position = 'relative';
                    wrapper.appendChild(spinner);
                }

                /* Delay spinner tránh flicker */
                let spinnerTimeout = setTimeout(() => {
                    spinner.style.display = 'flex';
                }, 120);

                wrapper.classList.add('is-loading');


                /* ================================
                 * AJAX Request
                 * ================================ */
                const formData = new FormData();
                formData.append('action', 'canhcam_ajax_pagination');
                formData.append('page', page);
                formData.append('post_type', postType);
                formData.append('posts_per_page', postsPerPage);
                formData.append('template_part', templatePart);

                if (taxonomy) formData.append('taxonomy', taxonomy);
                if (term) formData.append('term', term);
                if (emptyMsg) formData.append('empty_msg', emptyMsg);

                const ajaxUrl = (typeof canhcam_ajax !== 'undefined' && canhcam_ajax.ajax_url)
                    ? canhcam_ajax.ajax_url
                    : '/wp-admin/admin-ajax.php';

                fetch(ajaxUrl, {
                    method: 'POST',
                    body: formData
                })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            listContainer.innerHTML = res.data.html;

                            if (paginationContainer) {
                                paginationContainer.innerHTML = res.data.pagination;
                            }

                            document.dispatchEvent(new CustomEvent('canhcamAjaxLoaded', {
                                detail: {
                                    wrapper: wrapper,
                                    listContainer: listContainer
                                }
                            }));    

                            updateURL(page);

                            requestAnimationFrame(() => {
                                scrollToWrapper(wrapper);
                            });
                        }
                    })
                    .finally(() => {
                        clearTimeout(spinnerTimeout);
                        spinner.style.display = 'none';
                        wrapper.classList.remove('is-loading');
                    });
            }
        });

    });

});