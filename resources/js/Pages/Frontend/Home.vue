<template>
    <body>
        <!-- Topbar -->
        <div class="topbar py-1">
            <div
                class="container d-flex justify-content-between align-items-center flex-wrap"
            >
                <div>
                    <span class="me-3"
                        ><i class="fa-solid fa-phone"></i>(036) 000-0000</span
                    >
                    <span
                        ><i class="fa-solid fa-envelope"></i>
                        oca@example.gov.ph</span
                    >
                </div>
                <div
                    class="small text-uppercase"
                    style="letter-spacing: 0.04em; opacity: 0.8"
                >
                    Republic of the Philippines
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-office py-3">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <div class="brand-seal">O</div>
                    <span class="brand-text">
                        <strong class="font-display text-white"
                            >Provincial Budget Office</strong
                        >
                        <small>Provincial Capitol, Roxas City, Capiz</small>
                    </span>
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNav"
                >
                    <i class="fa-solid fa-bars text-white"></i>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Staff</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- 1. HERO -->
        <section class="hero">
            <div class="container position-relative">
                <h1 class="font-display fw-bold">Provincial Budget Office</h1>
                <p class="lead mb-4">
                    Ensuring efficient, transparent, and responsive local
                    governance for every resident of Roxas City.
                </p>
            </div>
        </section>
        <section class="py-5">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-bullseye mb-2 d-block"></i>
                                <h5 class="font-display">Our Mission</h5>
                                <p class="text-secondary small mb-0">
                                    To deliver efficient administrative support
                                    and public service that upholds integrity
                                    and accountability in local governance.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-eye-fill mb-2 d-block"></i>
                                <h5 class="font-display">Our Vision</h5>
                                <p class="text-secondary small mb-0">
                                    A model administrative office recognized for
                                    excellence, transparency, and responsiveness
                                    to the needs of the community.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-shield-check mb-2 d-block"></i>
                                <h5 class="font-display">Our Mandate</h5>
                                <p class="text-secondary small mb-0">
                                    Established under the Local Government Code
                                    to oversee daily administrative operations
                                    of the provincial government.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="#" class="text-decoration-none fw-semibold"
                        >Read more about our office
                        <i class="bi bi-arrow-right"></i
                    ></a>
                </div>
            </div>
        </section>
        <section class="stats-strip py-5">
            <div class="container">
                <div class="row text-center g-4">
                    <div class="col-6 col-md-4">
                        <div class="stat-number">30+</div>
                        <div class="stat-label">Years of Service</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-number">24</div>
                        <div class="stat-label">Staff Members</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Services Offered</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="section-eyebrow">What We Offer</div>
                    <h2 class="font-display section-title">Our Services</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <h6 class="fw-bold">Permits & Clearances</h6>
                            <p class="text-secondary small mb-0">
                                Processing of business permits, clearances, and
                                administrative documents.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <h6 class="fw-bold">Public Assistance</h6>
                            <p class="text-secondary small mb-0">
                                Front-line assistance desk for resident concerns
                                and inquiries.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-clipboard-data"></i>
                            </div>
                            <h6 class="fw-bold">Records Management</h6>
                            <p class="text-secondary small mb-0">
                                Maintenance and release of official
                                administrative records.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5" style="background: #eef0f5">
            <div class="container">
                <div
                    class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-2"
                >
                    <div>
                        <div class="section-eyebrow">Stay Updated</div>
                        <h2 class="font-display section-title mb-0">
                            Latest News & Announcements
                        </h2>
                    </div>
                    <a
                        href="#"
                        class="text-decoration-none fw-semibold"
                        style="color: var(--navy)"
                        >View all <i class="bi bi-arrow-right"></i
                    ></a>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="news-card">
                            <div class="news-thumb"></div>
                            <div class="p-3">
                                <div class="news-date">July 20, 2026</div>
                                <h6 class="fw-bold mt-1">
                                    New Online Permit Application Now Live
                                </h6>
                                <p class="text-secondary small mb-0">
                                    Residents can now file business permit
                                    applications online through the new portal.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="news-card">
                            <div class="news-thumb"></div>
                            <div class="p-3">
                                <div class="news-date">July 12, 2026</div>
                                <h6 class="fw-bold mt-1">
                                    Office Hours Update for August
                                </h6>
                                <p class="text-secondary small mb-0">
                                    Adjusted hours during the city's founding
                                    anniversary celebration.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="news-card">
                            <div class="news-thumb"></div>
                            <div class="p-3">
                                <div class="news-date">July 3, 2026</div>
                                <h6 class="fw-bold mt-1">
                                    Public Consultation on Barangay Services
                                </h6>
                                <p class="text-secondary small mb-0">
                                    An open forum for residents to voice
                                    concerns on administrative services.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <div
                    class="spotlight d-flex flex-column flex-md-row align-items-center gap-4"
                >
                    <div class="spotlight-photo flex-shrink-0">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="text-center">
                        <blockquote class="mb-2">
                            "Our commitment is to serve every resident with
                            transparency, efficiency, and genuine care for our
                            community."
                        </blockquote>
                        <div class="fw-bold">ATTY. KAREN L. LIPARDO</div>
                        <div class="text-secondary small">
                            ACTING PROVINCIAL BUDGET OFFICER
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="cta-strip py-4">
            <div
                class="container d-flex justify-content-between align-items-center flex-wrap gap-3"
            >
                <div>
                    <h5 class="fw-bold mb-0">
                        Need assistance from our office?
                    </h5>
                    <div class="small">
                        We're here Monday to Friday, 8:00 AM – 5:00 PM.
                    </div>
                </div>
                <a href="#" class="btn btn-dark px-4">Get in Touch</a>
            </div>
        </section>
        <footer class="footer-office">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h6 class="font-display mb-3">
                            Provincial Budget Office
                        </h6>
                        <p class="text-muted-light mb-1">
                            Provincial Capitol, Roxas City, Capiz
                        </p>
                        <p class="text-muted-light mb-1">(036) 000-0000</p>
                        <p class="text-muted-light mb-0">oca@example.gov.ph</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="font-display mb-3">Quick Links</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#">Home</a></li>
                            <li class="mb-2"><a href="#">About</a></li>
                            <li class="mb-2"><a href="#">Staff</a></li>
                            <li class="mb-2"><a href="#">Services</a></li>
                            <li class="mb-2"><a href="#">News</a></li>
                            <li class="mb-0"><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="font-display mb-3">Office Hours</h6>
                        <p class="text-muted-light mb-1">Monday – Friday</p>
                        <p class="text-muted-light mb-0">8:00 AM – 5:00 PM</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom text-center py-3">
                &copy; 2026 Provincial Budget Office. All rights reserved.
            </div>
        </footer>
    </body>
</template>
