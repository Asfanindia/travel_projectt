<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel & Tours - Explore Indonesia</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <link rel="stylesheet" href="css/index-style.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <div class="brand-icon">
          <i class="fa-solid fa-compass"></i>
        </div>
        <div>
          <span>Travel</span>
          <span class="brand-sub">Explore & Tours</span>
        </div>
      </a>
      
      <button class="navbar-toggler border-0 shadow-none p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#geomap">Interactive Map</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
          <li class="nav-item"><a class="nav-link" href="#destinations">Destinations</a></li>
          <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        </ul>

        <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
          <button class="btn-search-trigger" data-bs-toggle="modal" data-bs-target="#searchModal" title="Search">
            <i class="fa-solid fa-magnifying-glass fs-5"></i>
          </button>
          <button class="btn btn-plan-trip" data-bs-toggle="modal" data-bs-target="#planModal">
            Plan Your Trip <i class="fa-solid fa-arrow-right ms-1"></i>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <header class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
      <div class="row">
        <div class="col-lg-8 col-xl-7">
          <div class="location-badge">
            <i class="fa-solid fa-location-dot text-info"></i> Jakarta, Indonesia
          </div>
          <h1 class="hero-title">
            Discover Indonesia, Create <span>Lasting Memories</span>
          </h1>
          <p class="hero-desc">
            Let us take you to the most beautiful islands in Indonesia. Explore rich cultures, pristine beaches, and experience unforgettable tropical adventures.
          </p>
          <div class="d-flex flex-wrap gap-3">
            <a href="#geomap" class="btn btn-explore">
              Explore Map <i class="fa-solid fa-map-location-dot ms-1"></i>
            </a>
            <button class="btn btn-watch" data-bs-toggle="modal" data-bs-target="#videoModal">
              <i class="fa-solid fa-circle-play fs-5"></i> Watch Video
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="hero-wave">
      <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 60C240 120 480 0 720 60C960 120 1200 20 1440 60V120H0V60Z" fill="#ffffff"/>
      </svg>
    </div>
  </header>

  <section class="section-padding bg-white" id="about">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="collage-container">
            <svg class="flight-path" viewBox="0 0 400 300" fill="none">
              <path d="M30 200 Q 150 50 350 150" stroke="#00b4d8" stroke-width="2" stroke-dasharray="6 6"/>
              <polygon points="345,142 360,152 342,158" fill="#00b4d8" />
            </svg>

            <div class="polaroid polaroid-1">
              <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80" alt="Bali Island">
            </div>
            <div class="polaroid polaroid-2">
              <img src="https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=600&q=80" alt="Raja Ampat">
            </div>
            <div class="polaroid polaroid-3">
              <img src="https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=600&q=80" alt="Komodo Island">
            </div>
            <div class="polaroid polaroid-4">
              <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=600&q=80" alt="Mount Bromo">
            </div>
          </div>
        </div>

        <div class="col-lg-6 ps-lg-5">
          <div class="sub-tag">
            <span style="display:inline-block; width:28px; height:2px; background:var(--primary-blue);"></span> POPULAR DESTINATION
          </div>
          <h2 class="section-heading">
            Bali, <span>Indonesia</span>
          </h2>
          <p class="text-muted mb-4" style="line-height: 1.75;">
            Bali is a tropical paradise known for its stunning beaches, rich culture, and breathtaking landscapes. From the vibrant beach clubs of Seminyak to the serene temples of Ubud, Bali offers the perfect blend of adventure, relaxation, and unforgettable experiences.
          </p>

          <div class="d-flex flex-wrap gap-3 mb-4">
            <div class="feature-badge">
              <div class="feature-icon"><i class="fa-solid fa-tree-city"></i></div>
              <span>Pristine Beaches</span>
            </div>
            <div class="feature-badge">
              <div class="feature-icon"><i class="fa-solid fa-mountain-sun"></i></div>
              <span>Volcanic Scenery</span>
            </div>
            <div class="feature-badge">
              <div class="feature-icon"><i class="fa-solid fa-heart"></i></div>
              <span>Rich Heritage</span>
            </div>
          </div>

          <div class="bali-info-card">
            <div class="fs-4 text-primary"><i class="fa-solid fa-location-dot"></i></div>
            <div>
              <div class="fw-bold text-dark">Bali, Indonesia</div>
              <div class="small text-muted">A paradise island for every traveler</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="geomap-section" id="geomap">
    <div class="container">
      <div class="text-center mb-4">
        <div class="sub-tag justify-content-center text-info">
          <i class="fa-solid fa-earth-americas"></i> GEOGRAPHIC EXPLORER
        </div>
        <h2 class="display-5 fw-bold text-white mb-2">Interactive Map of Indonesia</h2>
        <p class="text-light opacity-75 max-w-600 mx-auto fs-6">
          Explore the beauty of Indonesia’s best islands interactively. Click the filter button or location marker to see an overview of the destination.
        </p>
      </div>

      <div class="d-flex flex-wrap justify-content-center gap-2 mb-4" id="mapFilters">
        <button class="map-filter-btn active" onclick="flyToLocation('indonesia', this)">
          <i class="fa-solid fa-globe me-1"></i> All Islands
        </button>
        <button class="map-filter-btn" onclick="flyToLocation('bali', this)">
          Bali
        </button>
        <button class="map-filter-btn" onclick="flyToLocation('rajaampat', this)">
          Raja Ampat
        </button>
        <button class="map-filter-btn" onclick="flyToLocation('komodo', this)">
          Komodo
        </button>
        <button class="map-filter-btn" onclick="flyToLocation('bromo', this)">
          Bromo
        </button>
        <button class="map-filter-btn" onclick="flyToLocation('laketoba', this)">
          Lake Toba
        </button>
        <button class="map-filter-btn" onclick="flyToLocation('lombok', this)">
          Lombok
        </button>
        <button class="map-filter-btn" onclick="flyToLocation('sumba', this)">
          Sumba
        </button>
      </div>

      <div class="row g-4 align-items-stretch">
        <div class="col-lg-8">
          <div class="geomap-container">
            <div id="map"></div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="h-100 d-flex flex-column justify-content-between p-3 rounded-4" style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255,255,255,0.08);">
            <div>
              <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                <span class="fw-bold text-white fs-6"><i class="fa-solid fa-fire text-warning me-2"></i>Top Destinations</span>
                <span class="badge bg-primary rounded-pill">4 Spots</span>
              </div>
              
              <div class="dest-list-group">
                <div class="dest-list-item" onclick="flyToLocation('bali')">
                  <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=150&q=80" class="dest-list-img" alt="Bali">
                  <div class="flex-grow-1">
                    <div class="fw-bold text-white small mb-1">Bali Island</div>
                    <div class="text-white" style="font-size:0.78rem;"><i class="fa-solid fa-star text-warning me-1"></i>4.9 • Tropical Culture</div>
                  </div>
                  <i class="fa-solid fa-location-arrow text-info"></i>
                </div>

                <div class="dest-list-item" onclick="flyToLocation('rajaampat')">
                  <img src="https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=150&q=80" class="dest-list-img" alt="Raja Ampat">
                  <div class="flex-grow-1">
                    <div class="fw-bold text-white small mb-1">Raja Ampat</div>
                    <div class="text-white" style="font-size:0.78rem;"><i class="fa-solid fa-star text-warning me-1"></i>5.0 • Marine Paradise</div>
                  </div>
                  <i class="fa-solid fa-location-arrow text-info"></i>
                </div>

                <div class="dest-list-item" onclick="flyToLocation('komodo')">
                  <img src="https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=150&q=80" class="dest-list-img" alt="Komodo Island">
                  <div class="flex-grow-1">
                    <div class="fw-bold text-white small mb-1">Komodo Island</div>
                    <div class="text-white" style="font-size:0.78rem;"><i class="fa-solid fa-star text-warning me-1"></i>4.9 • Dragons & Pink Beach</div>
                  </div>
                  <i class="fa-solid fa-location-arrow text-info"></i>
                </div>

                <div class="dest-list-item" onclick="flyToLocation('bromo')">
                  <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=150&q=80" class="dest-list-img" alt="Mount Bromo">
                  <div class="flex-grow-1">
                    <div class="fw-bold text-white small mb-1">Mount Bromo</div>
                    <div class="text-white" style="font-size:0.78rem;"><i class="fa-solid fa-star text-warning me-1"></i>4.8 • Volcanic Sunrise</div>
                  </div>
                  <i class="fa-solid fa-location-arrow text-info"></i>
                </div>
              </div>
            </div>

            <button class="btn btn-primary w-100 rounded-pill mt-3 py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#planModal">
              <i class="fa-solid fa-paper-plane me-1"></i> Plan Tour to Marker
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-padding" style="background-color: var(--light-ice-bg);" id="destinations">
    <div class="container">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
        <div>
          <div class="sub-tag">
            <span style="display:inline-block; width:28px; height:2px; background:var(--primary-blue);"></span> EXPLORE INDONESIA
          </div>
          <h2 class="section-heading mb-0">
            Explore Indonesian <span>Islands</span>
          </h2>
        </div>
        <button class="btn btn-outline-primary rounded-pill px-4 py-2 mt-3 mt-md-0 fw-semibold">
          View All Destinations <i class="fa-solid fa-arrow-right ms-1"></i>
        </button>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="dest-card">
            <div class="dest-img-wrap">
              <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80" alt="Bali">
            </div>
            <div class="dest-body">
              <div>
                <div class="dest-title">
                  <i class="fa-solid fa-location-dot text-primary fs-6"></i> Bali Island
                </div>
                <div class="dest-sub">Culture, beaches & volcanic hills</div>
              </div>
              <div class="btn-arrow" onclick="flyToLocation('bali')"><i class="fa-solid fa-arrow-right"></i></div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="dest-card">
            <div class="dest-img-wrap">
              <img src="https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=600&q=80" alt="Raja Ampat">
            </div>
            <div class="dest-body">
              <div>
                <div class="dest-title">
                  <i class="fa-solid fa-location-dot text-primary fs-6"></i> Raja Ampat
                </div>
                <div class="dest-sub">World-class diving & karst islands</div>
              </div>
              <div class="btn-arrow" onclick="flyToLocation('rajaampat')"><i class="fa-solid fa-arrow-right"></i></div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="dest-card">
            <div class="dest-img-wrap">
              <img src="https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=600&q=80" alt="Komodo Island">
            </div>
            <div class="dest-body">
              <div>
                <div class="dest-title">
                  <i class="fa-solid fa-location-dot text-primary fs-6"></i> Komodo Island
                </div>
                <div class="dest-sub">Komodo dragons & pink sand beach</div>
              </div>
              <div class="btn-arrow" onclick="flyToLocation('komodo')"><i class="fa-solid fa-arrow-right"></i></div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="dest-card">
            <div class="dest-img-wrap">
              <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=600&q=80" alt="Mount Bromo">
            </div>
            <div class="dest-body">
              <div>
                <div class="dest-title">
                  <i class="fa-solid fa-location-dot text-primary fs-6"></i> Mount Bromo
                </div>
                <div class="dest-sub">Sea of sand & volcanic sunrise</div>
              </div>
              <div class="btn-arrow" onclick="flyToLocation('bromo')"><i class="fa-solid fa-arrow-right"></i></div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="dest-card">
            <div class="dest-img-wrap">
              <img src="https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?auto=format&fit=crop&w=600&q=80" alt="Lombok & Gili">
            </div>
            <div class="dest-body">
              <div>
                <div class="dest-title">
                  <i class="fa-solid fa-location-dot text-primary fs-6"></i> Lombok & Gili
                </div>
                <div class="dest-sub">Turquoise waters & Mount Rinjani</div>
              </div>
              <div class="btn-arrow" onclick="flyToLocation('lombok')"><i class="fa-solid fa-arrow-right"></i></div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="dest-card">
            <div class="dest-img-wrap">
              <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=600&q=80" alt="Lake Toba">
            </div>
            <div class="dest-body">
              <div>
                <div class="dest-title">
                  <i class="fa-solid fa-location-dot text-primary fs-6"></i> Lake Toba
                </div>
                <div class="dest-sub">Vast volcanic lake & Batak culture</div>
              </div>
              <div class="btn-arrow" onclick="flyToLocation('laketoba')"><i class="fa-solid fa-arrow-right"></i></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-padding bg-white" id="reviews">
    <div class="container">
      <div class="text-center mb-5">
        <div class="sub-tag justify-content-center text-primary">
          <i class="fa-solid fa-star"></i> REVIEWS
        </div>
        <h2 class="section-heading">
          What Our <span>Travelers Say</span>
        </h2>
      </div>

      <div id="reviewsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row g-4 justify-content-center">
              <div class="col-md-6 col-lg-4">
                <div class="p-4 rounded-4 h-100 bg-light border-0 shadow-sm d-flex flex-column justify-content-between">
                  <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <div class="text-warning small">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </div>
                      <i class="fa-solid fa-quote-right text-primary opacity-25 fs-4"></i>
                    </div>
                    <p class="text-muted small mb-4" style="line-height: 1.6;">
                      "Liburan ke Bali dan Raja Ampat sangat luar biasa! Pelayanan sangat ramah, akomodasi nyaman, dan jadwal perjalanan tersusun dengan sangat baik."
                    </p>
                  </div>
                  <div class="pt-3 border-top">
                    <div class="fw-bold text-dark small">Budi Santoso</div>
                    <div class="text-primary small" style="font-size: 0.75rem;">Tour Bali & Raja Ampat</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-4">
                <div class="p-4 rounded-4 h-100 bg-light border-0 shadow-sm d-flex flex-column justify-content-between">
                  <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <div class="text-warning small">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </div>
                      <i class="fa-solid fa-quote-right text-primary opacity-25 fs-4"></i>
                    </div>
                    <p class="text-muted small mb-4" style="line-height: 1.6;">
                      "Pengalaman menikmati sunrise di Mount Bromo benar-benar tidak terlupakan. Guide sangat membantu dan pelayanan cepat."
                    </p>
                  </div>
                  <div class="pt-3 border-top">
                    <div class="fw-bold text-dark small">Siti Rahma</div>
                    <div class="text-primary small" style="font-size: 0.75rem;">Bromo Sunrise Tour</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-4 d-none d-lg-block">
                <div class="p-4 rounded-4 h-100 bg-light border-0 shadow-sm d-flex flex-column justify-content-between">
                  <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <div class="text-warning small">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </div>
                      <i class="fa-solid fa-quote-right text-primary opacity-25 fs-4"></i>
                    </div>
                    <p class="text-muted small mb-4" style="line-height: 1.6;">
                      "Pemandangan di Pulau Komodo memukau. Sistem booking cepat dan transparan. Sangat direkomendasikan!"
                    </p>
                  </div>
                  <div class="pt-3 border-top">
                    <div class="fw-bold text-dark small">Michael Chen</div>
                    <div class="text-primary small" style="font-size: 0.75rem;">Komodo Island Package</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="row g-4 justify-content-center">
              <div class="col-md-6 col-lg-4">
                <div class="p-4 rounded-4 h-100 bg-light border-0 shadow-sm d-flex flex-column justify-content-between">
                  <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <div class="text-warning small">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </div>
                      <i class="fa-solid fa-quote-right text-primary opacity-25 fs-4"></i>
                    </div>
                    <p class="text-muted small mb-4" style="line-height: 1.6;">
                      "Danau Toba indah sekali. Paket tur yang ditawarkan fleksibel dan bisa disesuaikan dengan kebutuhan keluarga."
                    </p>
                  </div>
                  <div class="pt-3 border-top">
                    <div class="fw-bold text-dark small">Dewi Lestari</div>
                    <div class="text-primary small" style="font-size: 0.75rem;">Lake Toba Family Tour</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-4">
                <div class="p-4 rounded-4 h-100 bg-light border-0 shadow-sm d-flex flex-column justify-content-between">
                  <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <div class="text-warning small">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </div>
                      <i class="fa-solid fa-quote-right text-primary opacity-25 fs-4"></i>
                    </div>
                    <p class="text-muted small mb-4" style="line-height: 1.6;">
                      "Pantai di Lombok sangat bersih dan tidak terlalu ramai. Fasilitas transportasi dan hotel top banget!"
                    </p>
                  </div>
                  <div class="pt-3 border-top">
                    <div class="fw-bold text-dark small">Andi Pratama</div>
                    <div class="text-primary small" style="font-size: 0.75rem;">Lombok & Gili Trip</div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-lg-4 d-none d-lg-block">
                <div class="p-4 rounded-4 h-100 bg-light border-0 shadow-sm d-flex flex-column justify-content-between">
                  <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <div class="text-warning small">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </div>
                      <i class="fa-solid fa-quote-right text-primary opacity-25 fs-4"></i>
                    </div>
                    <p class="text-muted small mb-4" style="line-height: 1.6;">
                      "Sumba punya pemandangan savana yang magis. Terima kasih tim travel sudah mengatur perjalanan dengan lancar."
                    </p>
                  </div>
                  <div class="pt-3 border-top">
                    <div class="fw-bold text-dark small">Rina Wijaya</div>
                    <div class="text-primary small" style="font-size: 0.75rem;">Sumba Island Adventure</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-center gap-2 mt-4">
          <button class="btn btn-outline-primary rounded-circle px-3 py-2" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="prev">
            <i class="fa-solid fa-arrow-left"></i>
          </button>
          <button class="btn btn-outline-primary rounded-circle px-3 py-2" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="next">
            <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer-section" id="contact">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
          <div class="d-flex align-items-center gap-2 mb-3">
            <div class="brand-icon">
              <i class="fa-solid fa-compass"></i>
            </div>
            <div>
              <span class="text-white fw-bold fs-4">Travel</span>
              <span class="brand-sub">Explore & Tours</span>
            </div>
          </div>
          <p class="small text-secondary mb-4" style="line-height: 1.7;">
            Travel Explore & Tours is your premier gateway to unforgettable journeys across Indonesia. We craft personalized travel experiences, island hopping, and cultural tours.
          </p>

          <div class="d-flex gap-2">
            <a href="#" class="social-icon-btn" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="social-icon-btn" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="social-icon-btn" title="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" class="social-icon-btn" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
            <a href="#" class="social-icon-btn" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-6 mb-4 mb-lg-0 ps-lg-4">
          <h5 class="footer-heading">Quick Links</h5>
          <ul class="footer-links">
            <li><a href="#"><i class="fa-solid fa-chevron-right fs-7 text-primary"></i> Home</a></li>
            <li><a href="#geomap"><i class="fa-solid fa-chevron-right fs-7 text-primary"></i> Interactive Map</a></li>
            <li><a href="#about"><i class="fa-solid fa-chevron-right fs-7 text-primary"></i> About Us</a></li>
            <li><a href="#destinations"><i class="fa-solid fa-chevron-right fs-7 text-primary"></i> Destinations</a></li>
            <li><a href="#contact"><i class="fa-solid fa-chevron-right fs-7 text-primary"></i> Contact Us</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 ps-lg-4">
          <h5 class="footer-heading">Indonesian Islands</h5>
          <ul class="footer-links">
            <li><a href="#geomap" onclick="flyToLocation('bali')"><i class="fa-solid fa-location-dot text-info"></i> Bali Island</a></li>
            <li><a href="#geomap" onclick="flyToLocation('rajaampat')"><i class="fa-solid fa-location-dot text-info"></i> Raja Ampat</a></li>
            <li><a href="#geomap" onclick="flyToLocation('komodo')"><i class="fa-solid fa-location-dot text-info"></i> Komodo Island</a></li>
            <li><a href="#geomap" onclick="flyToLocation('bromo')"><i class="fa-solid fa-location-dot text-info"></i> Mount Bromo</a></li>
            <li><a href="#geomap" onclick="flyToLocation('laketoba')"><i class="fa-solid fa-location-dot text-info"></i> Lake Toba</a></li>
            <li><a href="#geomap" onclick="flyToLocation('lombok')"><i class="fa-solid fa-location-dot text-info"></i> Lombok & Gili</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6">
          <h5 class="footer-heading">Contact Info</h5>
          <div class="contact-info-item">
            <i class="fa-solid fa-location-dot"></i>
            <span>123 Ocean Drive, Seminyak, Bali, Indonesia 80361</span>
          </div>
          <div class="contact-info-item">
            <i class="fa-solid fa-phone"></i>
            <span>+62 (361) 890-1234 / +62 812-3456-7890</span>
          </div>
          <div class="contact-info-item">
            <i class="fa-solid fa-envelope"></i>
            <span>hello@wandermore-tours.com</span>
          </div>
          <div class="contact-info-item">
            <i class="fa-solid fa-clock"></i>
            <span>Mon - Sat: 08:00 AM - 08:00 PM</span>
          </div>
        </div>
      </div>

      <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center">
        <p class="mb-2 mb-md-0 text-secondary">
          &copy; 2026 <strong>Travel & Tours</strong>. All Rights Reserved.
        </p>
        <div class="footer-bottom-links">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
          <a href="#">Cookie Policy</a>
        </div>
      </div>

    </div>
  </footer>

  <button id="backToTopBtn" class="btn-back-to-top" title="Back to Top">
    <i class="fa-solid fa-arrow-up fs-5"></i>
  </button>

  <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content bg-dark border-0 rounded-4">
        <div class="modal-header border-0 pb-0">
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4 text-center">
          <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
            <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Travel Preview" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="planModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 rounded-4 p-3">
        <div class="modal-header border-0">
          <h5 class="modal-title fw-bold text-dark">Plan Your Indonesia Vacation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="tripForm" onsubmit="handleTripSubmit(event)">
            <div class="mb-3">
              <label class="form-label small fw-semibold text-muted">Select Destination</label>
              <select class="form-select rounded-3 py-2" id="modalDestSelect">
                <option value="Bali Island" selected>Bali Island</option>
                <option value="Raja Ampat">Raja Ampat</option>
                <option value="Komodo Island">Komodo Island</option>
                <option value="Mount Bromo">Mount Bromo</option>
                <option value="Lake Toba">Lake Toba</option>
                <option value="Lombok & Gili">Lombok & Gili</option>
                <option value="Sumba Island">Sumba Island</option>
              </select>
            </div>
            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label small fw-semibold text-muted">Travel Date</label>
                <input type="date" class="form-control rounded-3 py-2" required>
              </div>
              <div class="col-6">
                <label class="form-label small fw-semibold text-muted">Travelers</label>
                <input type="number" class="form-control rounded-3 py-2" value="2" min="1" max="20" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-semibold text-muted">Your Email</label>
              <input type="email" class="form-control rounded-3 py-2" placeholder="name@example.com" required>
            </div>
            <button type="submit" class="btn btn-plan-trip w-100 py-2.5 mt-2">Find Best Offers</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 rounded-4 p-3">
        <div class="modal-body">
          <div class="input-group">
            <span class="input-group-text bg-white border-0 fs-5"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
            <input type="text" class="form-control border-0 shadow-none fs-5" placeholder="Search Indonesian islands, tours, packages...">
            <button class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal">Search</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="js/leaflet.js"></script>
</body>
</html>