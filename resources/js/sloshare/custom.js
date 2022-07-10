// Vibrant For Meta Backdrops
var metaElement = document.getElementById('meta-info');
var metaPoster = document.getElementById('meta-poster');
if (metaElement && metaPoster) {
    if (!metaPoster.src.includes('via.placeholder')) {
        Vibrant.from(metaPoster.src)
            .getPalette()
            .then(function (palette) {
                var rgb = palette.DarkMuted.getRgb();
                rgb.push(0.75);
                var rgba = 'rgba(' + rgb.join(',') + ')';
                $meta = $(metaElement);
                $meta.find('.movie-overlay').css('background-color', rgba);
                $meta.find('.button-overlay').css('opacity', 0);
                $meta
                    .find('.vibrant-overlay')
                    .css({ opacity: 1, background: 'linear-gradient(to bottom, ' + rgba + ', transparent)' });
            });
    }
}

// Scroll To Top/Bottom
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
        if ($(this).scrollTop() + $(window).height() < $(document).height() - 50) {
            $('#back-to-down').fadeIn();
        } else {
            $('#back-to-down').fadeOut();
        }
    });
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({ scrollTop: 0 }, 800);
        return false;
    });
    $('#back-to-down').click(function () {
        $('#back-to-down').tooltip('hide');
        $('body,html').animate({ scrollTop: $('body').height() }, 800);
        return false;
    });
    $('#back-to-top').tooltip('show');
    $('#back-to-down').tooltip('show');
});

// Keen Slider For Featured Torrents
$(document).ready(function () {
    var sliderElement = document.getElementById('myCarousel');
    if (sliderElement) {
        var slides = document.querySelectorAll('.keen-slider__slide');

        var updateClasses = function (instance) {
            var slide = instance.details().relativeSlide;
            var dots = document.querySelectorAll('.dot');

            slides.forEach(function (element, idx) {
                idx === slide ? (element.style.zIndex = 1) : (element.style.zIndex = 0);
            });

            dots.forEach(function (dot, idx) {
                idx === slide ? dot.classList.add('dot--active') : dot.classList.remove('dot--active');
            });
        };

        var interval = 0;

        var autoplay = function (run) {
            clearInterval(interval);
            interval = setInterval(function () {
                if (run && slider) {
                    slider.next();
                }
            }, 8000);
        };

        var slider = new KeenSlider('#myCarousel', {
            slides: slides.length,
            loop: true,
            duration: 600,
            dragStart: function () {
                autoplay(false);
            },
            dragEnd: function () {
                autoplay(true);
            },
            created: function (instance) {
                document.querySelector('.left.carousel-control').addEventListener('click', function () {
                    instance.prev();
                });

                document.querySelector('.right.carousel-control').addEventListener('click', function () {
                    instance.next();
                });

                var dots_wrapper = document.getElementById('dots');
                slides.forEach(function (t, idx) {
                    var dot = document.createElement('button');
                    dot.classList.add('dot');
                    dots_wrapper.appendChild(dot);
                    dot.addEventListener('click', function () {
                        instance.moveToSlide(idx);
                    });
                });

                updateClasses(instance);
            },
            slideChanged(instance) {
                updateClasses(instance);
            },
            move(s) {
                var opacities = s.details().positions.map(function (slide) {
                    return slide.portion;
                });
                slides.forEach(function (element, idx) {
                    element.style.opacity = opacities[idx];
                });
            },
        });

        sliderElement.addEventListener('mouseover', function () {
            autoplay(false);
        });
        sliderElement.addEventListener('mouseout', function () {
            autoplay(true);
        });

        autoplay(true);
    }
});

// Bootstrap Tooltips
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// WYSIBB Editor
$(document).ready(function () {
    $('#editor').wysibb({});
});

// Emoji Picker
/*const input = document.getElementById('editor');
document.querySelector('emoji-picker').addEventListener('emoji-click', (e) => {
    textFieldEdit.insert(input, e.detail.unicode);
});*/

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}