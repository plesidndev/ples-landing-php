const track = (event, params) => {
  if (typeof window.gtag === "function") window.gtag("event", event, params);
};

document.querySelectorAll("[data-dsp]").forEach((link) => {
  link.addEventListener("click", () => track("dsp_click", { platform: link.dataset.dsp }));
});

document.querySelectorAll("[data-video]").forEach((button) => {
  button.addEventListener("click", () => {
    const { video, title } = button.dataset;
    track("video_play", { video_title: title });
    const frame = document.createElement("iframe");
    frame.src = `https://www.youtube-nocookie.com/embed/${encodeURIComponent(video)}?autoplay=1&playsinline=1&rel=0`;
    frame.title = title;
    frame.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
    frame.allowFullscreen = true;
    frame.referrerPolicy = "strict-origin-when-cross-origin";
    frame.className = "absolute inset-0 size-full";
    button.replaceChildren(frame);
  }, { once: true });
});

document.querySelectorAll("[data-video-carousel]").forEach((carousel) => {
  const track = carousel.querySelector("[data-carousel-track]");
  const slides = [...carousel.querySelectorAll("[data-carousel-slide]")];
  const dots = [...carousel.querySelectorAll("[data-carousel-go]")];
  const previous = carousel.querySelector("[data-carousel-previous]");
  const next = carousel.querySelector("[data-carousel-next]");
  let activeIndex = 0;
  let scrollFrame = 0;

  const setActive = (index) => {
    activeIndex = index;
    previous.disabled = index === 0;
    next.disabled = index === slides.length - 1;
    dots.forEach((dot, dotIndex) => {
      if (dotIndex === index) dot.setAttribute("aria-current", "true");
      else dot.removeAttribute("aria-current");
      dot.classList.toggle("opacity-40", dotIndex !== index);
    });
  };

  const goTo = (index) => {
    if (index < 0 || index >= slides.length) return;
    const slide = slides[index];
    const target = slide.getBoundingClientRect().left - track.getBoundingClientRect().left
      + track.scrollLeft - (track.clientWidth - slide.clientWidth) / 2;
    track.scrollTo({ left: target, behavior: matchMedia("(prefers-reduced-motion: reduce)").matches ? "auto" : "smooth" });
    setActive(index);
  };

  previous.addEventListener("click", () => goTo(activeIndex - 1));
  next.addEventListener("click", () => goTo(activeIndex + 1));
  dots.forEach((dot, index) => dot.addEventListener("click", () => goTo(index)));
  track.addEventListener("keydown", (event) => {
    if (event.key !== "ArrowLeft" && event.key !== "ArrowRight") return;
    event.preventDefault();
    goTo(activeIndex + (event.key === "ArrowRight" ? 1 : -1));
  });
  track.addEventListener("scroll", () => {
    cancelAnimationFrame(scrollFrame);
    scrollFrame = requestAnimationFrame(() => {
      const center = track.getBoundingClientRect().left + track.clientWidth / 2;
      const nearest = slides.reduce((best, slide, index) =>
        Math.abs(slide.getBoundingClientRect().left + slide.clientWidth / 2 - center)
          < Math.abs(slides[best].getBoundingClientRect().left + slides[best].clientWidth / 2 - center)
          ? index : best, 0);
      setActive(nearest);
    });
  }, { passive: true });
  setActive(0);
});

const header = document.querySelector("[data-artist-header]");
if (header) {
  const updateHeader = () => header.classList.toggle("-translate-y-full", scrollY > 52 && scrollY <= 200);
  updateHeader();
  addEventListener("scroll", updateHeader, { passive: true });
}

// Each reusable photo gallery owns its Swiper instance and controls.
document.querySelectorAll('[data-photo-carousel]').forEach((carousel) => {
  const stage = carousel.querySelector('[data-photo-stage]');
  const slides = [...carousel.querySelectorAll('[data-photo-slide]')];
  const dots = [...carousel.querySelectorAll('[data-photo-go]')];
  const status = carousel.querySelector('[data-photo-status]');
  if (!stage || slides.length === 0 || typeof Swiper === 'undefined') return;
  const photoCount = Number(carousel.dataset.photoCount);

  const update = (swiper) => {
    const active = swiper.realIndex % photoCount;
    slides.forEach((slide, i) => {
      slide.setAttribute('aria-hidden', i === swiper.realIndex ? 'false' : 'true');
      slide.setAttribute('aria-label', `${i % photoCount + 1} of ${photoCount}`);
    });
    dots.forEach((dot, i) => {
      if (i === active) dot.setAttribute('aria-current', 'true');
      else dot.removeAttribute('aria-current');
    });
    status.textContent = `Photo ${active + 1} of ${photoCount}`;
  };
  const loop = photoCount > 1;
  const swiper = new Swiper(stage, {
    effect: 'coverflow',
    centeredSlides: true,
    slidesPerView: 'auto',
    loop,
    speed: matchMedia('(prefers-reduced-motion: reduce)').matches ? 0 : 350,
    grabCursor: slides.length > 1,
    allowTouchMove: slides.length > 1,
    slideToClickedSlide: true,
    coverflowEffect: {
      rotate: 35,
      stretch: 50,
      depth: 100,
      scale: 0.9,
      modifier: 1,
      slideShadows: false,
    },
    navigation: {
      prevEl: carousel.querySelector('[data-photo-previous]'),
      nextEl: carousel.querySelector('[data-photo-next]'),
    },
    a11y: {
      enabled: true,
      containerMessage: carousel.getAttribute('aria-label'),
      prevSlideMessage: 'Previous photo',
      nextSlideMessage: 'Next photo',
    },
    on: { init: update, afterInit: update, slideChange: update },
  });
  dots.forEach((dot, index) => dot.addEventListener('click', () => {
    if (loop) {
      // Select the nearest repeated copy of this photo around the loop.
      let delta = index - (swiper.realIndex % photoCount);
      if (delta > photoCount / 2) delta -= photoCount;
      if (delta < -photoCount / 2) delta += photoCount;
      const target = (swiper.realIndex + delta + slides.length) % slides.length;
      swiper.slideToLoop(target);
    } else swiper.slideTo(index);
  }));
  stage.addEventListener('keydown', (event) => {
    if (!['ArrowLeft', 'ArrowRight'].includes(event.key)) return;
    event.preventDefault();
    if (event.key === 'ArrowRight') swiper.slideNext();
    else swiper.slidePrev();
  });
});
