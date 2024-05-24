let autoSlideIndex = 0;
let slideIndex = 1;
let timeOutId = null;

// Thumbnail image controls
function currentSlide(n) {
    showSlides((slideIndex = n));
    autoSlideIndex = n - 1;
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName('mySlides');
    let dots = document.getElementsByClassName('dot');
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(' active', '');
    }
    slides[slideIndex - 1].style.display = 'block';
    dots[slideIndex - 1].className += ' active';
}

// Show slider automatically
autoShowSlides();

function autoShowSlides() {
    let i;
    let slides = document.getElementsByClassName('mySlides');
    let dots = document.getElementsByClassName('dot');
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
    }
    autoSlideIndex++;
    if (autoSlideIndex > slides.length) {
        autoSlideIndex = 1;
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(' active', '');
    }
    slides[autoSlideIndex - 1].style.display = 'block';
    dots[autoSlideIndex - 1].className += ' active';
    timeOutId = setTimeout(autoShowSlides, 2000); // Change image every 2 seconds
    // console.log(autoSlideIndex);
}

// Next/previous controls
function plusSlides(n) {
    slideIndex = autoSlideIndex;
    slideIndex = slideIndex + n;
    showSlides(slideIndex);
    clearTimeout(timeOutId);
    autoSlideIndex = slideIndex - 1;
    autoShowSlides();
}
