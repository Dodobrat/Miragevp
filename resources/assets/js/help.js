if (document.body.contains(document.getElementById('help'))){

    'use strict';

    function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

    function ready(fn) {
        document.addEventListener('DOMContentLoaded', fn, false);
    }

    ready(function () {
        var motionQuery = window.matchMedia('(prefers-reduced-motion)');

        var TableOfContents = {
            container: document.querySelector('.js-toc'),
            links: null,
            headings: null,
            intersectionOptions: {
                rootMargin: '0px',
                threshold: 1
            },
            previousSection: null,
            observer: null,

            init: function init() {
                var _this = this;

                this.handleObserver = this.handleObserver.bind(this);

                this.setUpObserver();
                this.findLinksAndHeadings();
                this.observeSections();

                this.links.forEach(function (link) {
                    link.addEventListener('click', _this.handleLinkClick.bind(_this));
                });
            },
            handleLinkClick: function handleLinkClick(evt) {
                evt.preventDefault();
                var id = evt.target.getAttribute('href').replace('#', '');

                var section = this.headings.find(function (heading) {
                    return heading.getAttribute('id') === id;
                });

                section.setAttribute('tabindex', -1);
                section.focus();

                window.scroll({
                    behavior: motionQuery.matches ? 'instant' : 'smooth',
                    top: section.offsetTop - 15,
                    block: 'start'
                });

                if (this.container.classList.contains('is-active')) {
                    this.container.classList.remove('is-active');
                }
            },
            handleObserver: function handleObserver(entries, observer) {
                var _this2 = this;

                entries.forEach(function (entry) {
                    var href = '#' + entry.target.getAttribute('id'),
                        link = _this2.links.find(function (l) {
                            return l.getAttribute('href') === href;
                        });

                    if (entry.isIntersecting && entry.intersectionRatio >= 1) {
                        link.classList.add('is-visible');
                        _this2.previousSection = entry.target.getAttribute('id');
                    } else {
                        link.classList.remove('is-visible');
                    }

                    _this2.highlightFirstActive();
                });
            },
            highlightFirstActive: function highlightFirstActive() {
                var firstVisibleLink = this.container.querySelector('.is-visible');

                this.links.forEach(function (link) {
                    link.classList.remove('is-active');
                });

                if (firstVisibleLink) {
                    firstVisibleLink.classList.add('is-active');
                }

                if (!firstVisibleLink && this.previousSection) {
                    this.container.querySelector('a[href="#' + this.previousSection + '"]').classList.add('is-active');
                }
            },
            observeSections: function observeSections() {
                var _this3 = this;

                this.headings.forEach(function (heading) {
                    _this3.observer.observe(heading);
                });
            },
            setUpObserver: function setUpObserver() {
                this.observer = new IntersectionObserver(this.handleObserver, this.intersectionOptions);
            },
            findLinksAndHeadings: function findLinksAndHeadings() {
                this.links = [].concat(_toConsumableArray(this.container.querySelectorAll('a')));
                this.headings = this.links.map(function (link) {
                    var id = link.getAttribute('href');
                    return document.querySelector(id);
                });
            }
        };

        TableOfContents.init();
    });
}
