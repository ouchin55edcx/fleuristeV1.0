
// Mobile menu toggle
document.getElementById('menuToggle').addEventListener('click', function () {
    document.getElementById('mobileMenu').classList.toggle('hidden');
});

//product details 
let currentZoom = 1;
const zoomStep = 0.1;

function openZoom(element) {
    const modal = document.getElementById('zoomModal');
    const zoomedImage = document.getElementById('zoomedImage');
    const img = element.querySelector('img');

    modal.classList.remove('hidden');
    zoomedImage.src = img.src;
    currentZoom = 1;
    zoomedImage.style.transform = `scale(${currentZoom})`;
}

function closeZoom() {
    document.getElementById('zoomModal').classList.add('hidden');
}

function zoomIn() {
    currentZoom += zoomStep;
    updateZoom();
}

function zoomOut() {
    currentZoom = Math.max(1, currentZoom - zoomStep);
    updateZoom();
}

function updateZoom() {
    const zoomedImage = document.getElementById('zoomedImage');
    zoomedImage.style.transform = `scale(${currentZoom})`;
}

document.getElementById('zoomIn').addEventListener('click', zoomIn);
document.getElementById('zoomOut').addEventListener('click', zoomOut);

document.getElementById('zoomModal').addEventListener('click', function (e) {
    if (e.target === this) {
        closeZoom();
    }
});


