const locations = {
  indonesia: { lat: -2.548926, lng: 118.014863, zoom: 5 },
  bali: { lat: -8.409518, lng: 115.188916, zoom: 10, title: "Bali Island", desc: "Tropical beaches, culture & volcanic mountains.", img: "https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=400&q=80" },
  rajaampat: { lat: -0.2333, lng: 130.5167, zoom: 9, title: "Raja Ampat", desc: "World-class diving & limestone karst islands.", img: "https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=400&q=80" },
  komodo: { lat: -8.5583, lng: 119.4886, zoom: 10, title: "Komodo Island", desc: "Home of dragons & iconic pink beach.", img: "https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=400&q=80" },
  bromo: { lat: -7.9425, lng: 112.9530, zoom: 11, title: "Mount Bromo", desc: "Breathtaking volcano sunrise & sea of sand.", img: "https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=400&q=80" },
  laketoba: { lat: 2.6845, lng: 98.8756, zoom: 10, title: "Lake Toba", desc: "Vast volcanic lake with Samosir Island.", img: "https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=400&q=80" },
  lombok: { lat: -8.6509, lng: 116.3249, zoom: 10, title: "Lombok & Gili", desc: "Pristine white beaches & Mount Rinjani.", img: "https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?auto=format&fit=crop&w=400&q=80" },
  sumba: { lat: -9.6556, lng: 120.2642, zoom: 10, title: "Sumba Island", desc: "Exotic savannas, waterfalls & culture.", img: "https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=400&q=80" }
};

let map, mapMarkers = {};

window.addEventListener('load', () => {
  map = L.map('map', {
    zoomControl: true,
    scrollWheelZoom: false
  }).setView([locations.indonesia.lat, locations.indonesia.lng], locations.indonesia.zoom);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 19
  }).addTo(map);

  function createCustomIcon() {
    return L.divIcon({
      className: 'custom-map-marker',
      html: `<div class="marker-pin"><i class="fa-solid fa-location-dot"></i></div>`,
      iconSize: [36, 36],
      iconAnchor: [18, 36],
      popupAnchor: [0, -32]
    });
  }

  Object.keys(locations).forEach(key => {
    if (key === 'indonesia') return;
    const spot = locations[key];

    const popupContent = `
      <div class="popup-card">
        <img src="${spot.img}" alt="${spot.title}">
        <div class="popup-card-body">
          <div class="fw-bold text-dark small mb-1">${spot.title}</div>
          <p class="text-muted mb-2" style="font-size:0.75rem; line-height:1.4;">${spot.desc}</p>
          <button onclick="triggerBookModal('${spot.title}')" class="btn btn-primary btn-sm rounded-pill w-100 fw-semibold" style="font-size:0.75rem;">
            Book Package <i class="fa-solid fa-arrow-right ms-1"></i>
          </button>
        </div>
      </div>
    `;

    const marker = L.marker([spot.lat, spot.lng], { icon: createCustomIcon() })
      .addTo(map)
      .bindPopup(popupContent);

    mapMarkers[key] = marker;
  });
});

function flyToLocation(locKey, btnElement = null) {
  if (!locations[locKey] || !map) return;

  const loc = locations[locKey];
  map.flyTo([loc.lat, loc.lng], loc.zoom, {
    animate: true,
    duration: 1.8
  });

  if (mapMarkers[locKey]) {
    setTimeout(() => {
      mapMarkers[locKey].openPopup();
    }, 1800);
  }

  if (btnElement) {
    document.querySelectorAll('.map-filter-btn').forEach(b => b.classList.remove('active'));
    btnElement.classList.add('active');
  }

  const geomapSection = document.getElementById('geomap');
  if (window.scrollY < geomapSection.offsetTop - 200) {
    geomapSection.scrollIntoView({ behavior: 'smooth' });
  }
}

function triggerBookModal(destName) {
  const selectEl = document.getElementById('modalDestSelect');
  if (selectEl) {
    for (let i = 0; i < selectEl.options.length; i++) {
      if (selectEl.options[i].value.toLowerCase().includes(destName.split(' ')[0].toLowerCase())) {
        selectEl.selectedIndex = i;
        break;
      }
    }
  }
  const planModal = new bootstrap.Modal(document.getElementById('planModal'));
  planModal.show();
}

const backToTopBtn = document.getElementById('backToTopBtn');
window.addEventListener('scroll', () => {
  if (window.scrollY > 300) {
    backToTopBtn.classList.add('show');
  } else {
    backToTopBtn.classList.remove('show');
  }
});

backToTopBtn.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

function handleTripSubmit(e) {
  e.preventDefault();
  const modalEl = document.getElementById('planModal');
  const modal = bootstrap.Modal.getInstance(modalEl);
  if (modal) modal.hide();
  showToast('Trip request received! Our travel advisor will reach out shortly.');
}

function showToast(message) {
  const toastContainer = document.createElement('div');
  toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
  toastContainer.style.zIndex = '9999';
  toastContainer.innerHTML = `
    <div class="toast show bg-success text-white border-0 rounded-3 p-2 shadow-lg" role="alert">
      <div class="d-flex align-items-center">
        <div class="toast-body"><i class="fa-solid fa-circle-check me-2 fs-5"></i> ${message}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  `;
  document.body.appendChild(toastContainer);
  setTimeout(() => toastContainer.remove(), 4000);
}