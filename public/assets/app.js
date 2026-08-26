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

const header = document.querySelector("[data-artist-header]");
if (header) {
  const updateHeader = () => header.classList.toggle("-translate-y-full", scrollY > 52 && scrollY <= 200);
  updateHeader();
  addEventListener("scroll", updateHeader, { passive: true });
}
