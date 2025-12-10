document.addEventListener('DOMContentLoaded', () => {
    const lbModal = document.getElementById("lightbox-modal");
    const lbImg = document.getElementById("lightbox-content");
    const lbCaption = document.getElementById("lightbox-caption");
    const lbClose = document.getElementById("lightbox-close");
    const lbPrev = document.getElementById("lightbox-prev");
    const lbNext = document.getElementById("lightbox-next");

    // Only continue if modal exists
    if (!lbModal) return;

    const lbItems = Array.from(document.querySelectorAll(".lightbox-trigger"));
    let lbIndex = 0;

    function showLightbox(index) {
        const item = lbItems[index];
        lbImg.src = item.dataset.src;
        lbCaption.innerText = (item.dataset.title || '') + (item.dataset.description ? ' - ' + item.dataset.description : '');
        lbModal.style.display = "flex";
        lbIndex = index;
    }

    lbItems.forEach((item, index) => {
        item.addEventListener('click', () => showLightbox(index));
    });

    lbClose?.addEventListener('click', () => lbModal.style.display = "none");
    lbPrev?.addEventListener('click', () => {
        lbIndex = (lbIndex === 0) ? lbItems.length - 1 : lbIndex - 1;
        showLightbox(lbIndex);
    });
    lbNext?.addEventListener('click', () => {
        lbIndex = (lbIndex === lbItems.length - 1) ? 0 : lbIndex + 1;
        showLightbox(lbIndex);
    });

    lbModal.addEventListener('click', e => {
        if (e.target === lbModal) lbModal.style.display = "none";
    });

    document.addEventListener('keydown', (e) => {
        if (lbModal.style.display === "flex") {
            switch (e.key) {
                case "ArrowLeft": lbPrev?.click(); break;
                case "ArrowRight": lbNext?.click(); break;
                case "Escape": lbClose?.click(); break;
            }
        }
    });
});
