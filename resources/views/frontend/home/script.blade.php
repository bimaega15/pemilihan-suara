<script>
    $(document).ready(function() {
        setScroll();

        function setScroll() {
            var lastScrollPosition = 0;

            // Fungsi untuk mendeteksi pergerakan scroll
            function handleScroll() {
                $('.nav__item #link_home').removeClass('text-success');
                $('.nav__item #link_about').removeClass('text-success');
                $('.nav__item #link_timSukses').removeClass('text-success');
                $('.nav__item #link_contactUs').removeClass('text-success');
                $('.nav__item #link_statusPendaftaran').removeClass('text-success');
                $('.nav__item #link_gallery').removeClass('text-success');


                var currentScrollPosition = $(window).scrollTop();

                if (currentScrollPosition <= lastScrollPosition) {
                    // Scroll ke atas
                    $('.nav__item a').removeClass('text-dark').addClass('text-header');
                }
                if (currentScrollPosition > lastScrollPosition) {
                    $('.nav__item a').removeClass('text-header').addClass('text-dark');
                }

                var home = $('#home');
                if (home.length) {
                    var top = home.offset().top - 100;
                    var bottom = top + $('#home').height();

                    if (currentScrollPosition >= top && currentScrollPosition < bottom) {
                        $('.nav__item #link_home').removeClass('text-dark text-header');
                        $('.nav__item #link_home').addClass('text-success');
                    }
                }

                var about = $('#about');
                if (about.length) {
                    var top = about.offset().top - 100;
                    var bottom = top + $('#about').height();

                    if (currentScrollPosition >= top && currentScrollPosition < bottom) {
                        $('.nav__item #link_about').removeClass('text-dark text-header');
                        $('.nav__item #link_about').addClass('text-success');
                    }
                }

                var timSukses = $('#timSukses');
                if (timSukses.length) {
                    var top = timSukses.offset().top - 100;
                    var bottom = top + $('#timSukses').height();

                    if (currentScrollPosition >= top && currentScrollPosition < bottom) {

                        $('.nav__item #link_timSukses').removeClass('text-dark text-header');
                        $('.nav__item #link_timSukses').addClass('text-success');
                    }
                }

                var contactUs = $('#contactUs');
                if (contactUs.length) {
                    var top = contactUs.offset().top - 90;
                    var bottom = top + $('#contactUs').height();

                    if (currentScrollPosition >= top && currentScrollPosition < bottom) {

                        $('.nav__item #link_contactUs').removeClass('text-dark text-header');
                        $('.nav__item #link_contactUs').addClass('text-success');
                    }
                }

                var statusPendaftaran = $('#statusPendaftaran');
                if (statusPendaftaran.length) {
                    var top = statusPendaftaran.offset().top - 110;
                    var bottom = top + $('#statusPendaftaran').height();


                    if (currentScrollPosition >= top && currentScrollPosition < bottom) {
                        $('.nav__item #link_statusPendaftaran').removeClass('text-dark text-header');
                        $('.nav__item #link_statusPendaftaran').addClass('text-success');
                    }
                }

                var gallery = $('#gallery');
                if (gallery.length) {
                    var top = gallery.offset().top - 100;
                    var bottom = top + $('#gallery').height();


                    if (currentScrollPosition >= top && currentScrollPosition < bottom) {
                        $('.nav__item #link_gallery').removeClass('text-dark text-header');
                        $('.nav__item #link_gallery').addClass('text-success');
                    }
                }
            }

            // Menambahkan event listener untuk event scroll
            $(window).scroll(handleScroll);
        }

        function scrollSectionHome() {
            var target = $('#home');
            if (target.length) {
                var top = target.offset().top - 100;
                $('html,body').animate({
                    scrollTop: top
                }, 1500);
            }
        }

        $(document).on('click', '#link_home', function(e) {
            e.preventDefault();
            scrollSectionHome();
        })

        function scrollSectionAbout() {
            var target = $('#about');
            if (target.length) {
                var top = target.offset().top - 100;
                $('html,body').animate({
                    scrollTop: top
                }, 1500);
            }
        }

        $(document).on('click', '#link_about', function(e) {
            e.preventDefault();
            scrollSectionAbout();
        })

        function scrollSectionTimSukses() {
            var target = $('#timSukses');
            if (target.length) {
                var top = target.offset().top - 80;
                $('html,body').animate({
                    scrollTop: top
                }, 1500);
            }
        }

        $(document).on('click', '#link_timSukses', function(e) {
            e.preventDefault();
            scrollSectionTimSukses();
        })

        function scrollSectionContactUs() {
            var target = $('#contactUs');
            if (target.length) {
                var top = target.offset().top - 80;
                $('html,body').animate({
                    scrollTop: top
                }, 1500);
            }
        }

        $(document).on('click', '#link_contactUs', function(e) {
            e.preventDefault();
            scrollSectionContactUs();
        })

        function scrollSectionStatusPendaftaran() {
            var target = $('#statusPendaftaran');
            if (target.length) {
                var top = target.offset().top - 100;
                $('html,body').animate({
                    scrollTop: top
                }, 1500);
            }
        }

        $(document).on('click', '#link_statusPendaftaran', function(e) {
            e.preventDefault();
            scrollSectionStatusPendaftaran();
        })

        function scrollSectionGallery() {
            var target = $('#gallery');
            if (target.length) {
                var top = target.offset().top - 80;
                $('html,body').animate({
                    scrollTop: top
                }, 1500);
            }
        }

        $(document).on('click', '#link_gallery', function(e) {
            e.preventDefault();
            scrollSectionGallery();
        })
    })
</script>