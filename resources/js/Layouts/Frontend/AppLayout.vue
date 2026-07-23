<template>
    <style>
        :root {
            --bs-body-font-family:
                "Inter", system-ui, -apple-system, sans-serif;
            --navy: #14213d;
            --navy-deep: #0c162c;
            --gold: #c9a227;
            --gold-light: #e6c65c;
        }
        body {
            background: #f7f8fa;
            color: #202634;
        }
        .font-display {
            font-family: "Lora", Georgia, serif;
        }

        /* Topbar */
        .topbar {
            background: var(--navy-deep);
            color: #cfd6e4;
            font-size: 0.8rem;
        }
        .topbar a {
            color: #cfd6e4;
            text-decoration: none;
        }

        /* Header / navbar overrides on top of Bootstrap's navbar component */
        .navbar-office {
            background-color: var(--navy);
            border-bottom: 3px solid var(--gold);
        }
        .navbar-office .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #fff;
        }
        .brand-seal {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Lora", serif;
            font-weight: 700;
            color: var(--navy);
            flex-shrink: 0;
        }
        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.25;
        }
        .brand-text strong {
            font-size: 1.05rem;
        }
        .brand-text small {
            color: #a9b3c9;
            font-size: 0.72rem;
        }

        .navbar-office .nav-link {
            color: #dde3ef !important;
            font-weight: 500;
            padding: 0.5rem 0.9rem !important;
            position: relative;
        }
        .navbar-office .nav-link::after {
            content: "";
            position: absolute;
            left: 0.9rem;
            right: 0.9rem;
            bottom: 0;
            height: 2px;
            background: var(--gold);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.2s ease;
        }
        .navbar-office .nav-link:hover,
        .navbar-office .nav-link.active {
            color: #fff !important;
        }
        .navbar-office .nav-link:hover::after,
        .navbar-office .nav-link.active::after {
            transform: scaleX(1);
        }
        .navbar-office .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.4);
        }
        .navbar-office .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.85)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Main placeholder */
        .placeholder-box {
            border: 1px dashed #c7cede;
            border-radius: 6px;
            color: #8b96b0;
        }

        /* Footer */
        .footer-office {
            background: var(--navy-deep);
            color: #cfd6e4;
        }
        .footer-office h6 {
            color: #fff;
        }
        .footer-office .text-muted-light {
            color: #9aa5bd;
            font-size: 0.88rem;
        }
        .footer-office a {
            color: #cfd6e4;
            text-decoration: none;
        }
        .footer-office a:hover {
            color: var(--gold-light);
        }
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #8b96b0;
            font-size: 0.8rem;
        }
    </style>
    <body>
        <!-- Top utility bar -->
        <div class="topbar py-1">
            <div
                class="container d-flex justify-content-between align-items-center flex-wrap"
            >
                <div>
                    <span class="me-3"
                        ><i class="bi bi-telephone-fill"></i> (036)
                        000-0000</span
                    >
                    <span
                        ><i class="bi bi-envelope-fill"></i>
                        oca@roxascity.gov.ph</span
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

        <!-- Main navbar (Bootstrap 5 navbar component) -->
        <nav class="navbar navbar-expand-lg navbar-office py-3">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <div class="brand-seal">O</div>
                    <span class="brand-text">
                        <strong class="font-display"
                            >Office of the City Administrator</strong
                        >
                        <small>City Hall, Roxas City, Capiz</small>
                    </span>
                </a>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNav"
                    aria-controls="mainNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
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

        <!-- Page content -->
        <main class="py-5">
            <div class="container">
                <div class="placeholder-box p-5 text-center">
                    Page content (Home / About / Staff / etc.) renders here
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer-office mt-4">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h6 class="font-display mb-3">
                            Office of the City Administrator
                        </h6>
                        <p class="text-muted-light mb-1">
                            City Hall, Roxas City, Capiz
                        </p>
                        <p class="text-muted-light mb-1">(036) 000-0000</p>
                        <p class="text-muted-light mb-0">
                            oca@roxascity.gov.ph
                        </p>
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
                &copy; 2026 Office of the City Administrator. All rights
                reserved.
            </div>
        </footer>
    </body>
</template>
