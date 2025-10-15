<!DOCTYPE html>
<!-- <html lang="ar" dir="rtl"> -->
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' || app()->getLocale() == 'ur' ? 'rtl' : 'ltr' }}">

<head>
  <meta name="description" content="شركة الجواب للنقل البري، أفضل عروض النقل في السعودية، أجرة عامة ونقل متخصص.">
  <meta name="keywords" content="نقل بري, تاكسي, أجرة عامة, النقل المتخصص, السعودية">
  <meta name="author" content="شركة الجواب للنقل البري">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>شركة الجواب للنقل البري | أفضل العروض</title>
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <!-- AOS Animation -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
  <style>
    :root {
      --secondary: rgb(142, 199, 211);
      --primary: rgb(14, 141, 157);
      --dark: #0d1b2a;
      --darker: #090f1a;
      --light: #f8f9fa;
      --muted: #adb5bd;
    }

    body {
      font-family: 'Tajawal', Tahoma, Arial, sans-serif;
      background: var(--dark);
      color: var(--light);
      scroll-behavior: smooth;
    }

    /* Navbar */
    .navbar {
      background: var(--darker) !important;
      box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
    }

    .navbar-brand,
    .navbar-nav .nav-link {
      color: var(--light) !important;
      font-weight: 600;
      transition: color .3s;
    }

    .navbar-nav .nav-link:hover {
      color: var(--primary) !important;
    }

    .btn-pill {
      border-radius: 50px;
      padding: .6rem 1.5rem;
      font-weight: 600;
      transition: all .3s ease;
    }

    .btn-pill:hover {
      background-color: #009fe3;
      transform: scale(1.05);
    }

    /* Hero */
    .hero {
      position: relative;
      min-height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      background: linear-gradient(rgba(9, 15, 26, .85), rgba(9, 15, 26, .85)),
        url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
      border-bottom-left-radius: 2rem;
      border-bottom-right-radius: 2rem;
    }

    .hero h1 {
      font-weight: 900;
      font-size: 3.5rem;
      color: var(--primary);
    }

    .hero h2 {
      font-weight: 700;
      font-size: 2.7rem;
      color: var(--secondary);
    }

    .hero p {
      font-size: 1.2rem;
      color: #e0e0e0;
    }

    /* Sections */
    .section {
      padding: 5rem 0;
      background: var(--dark);
      color: var(--light);
    }

    .section-title {
      font-weight: 800;
      font-size: 2rem;
      margin-bottom: 2.5rem;
      color: var(--primary);
    }

    /* Cards & Services */
    .card-car,
    .testimonial,
    .contact {
      background: #1b263b;
      color: var(--light);
      border: none;
      border-radius: 1rem;
    }

    .card-car:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, .4);
    }

    .service-card img {
      border-radius: 1rem;
      height: 200px;
      object-fit: cover;
      transition: transform .3s;
    }

    .card-car img {
      height: 220px;
    }

    .service-card img:hover {
      transform: scale(1.05);
    }

    #services .service-box {
      background: rgba(255, 255, 255, 0.05);
      transition: all .4s ease;
      border-radius: 1rem;
    }

    #services .service-box:hover {
      transform: translateY(-8px);
      background: rgba(255, 255, 255, 0.1);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    }

    #services .feature-icon {
      width: 80px;
      height: 80px;
      font-size: 2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 20px;
      transition: transform .3s;
    }

    #services .feature-icon:hover {
      transform: rotate(10deg) scale(1.1);
    }

    /* Footer */
    .footer {
      background: linear-gradient(135deg, var(--darker), var(--dark));
      color: var(--light);
      border-top-left-radius: 2rem;
      border-top-right-radius: 2rem;
      padding: 3rem 1rem;
    }

    .footer h5 {
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 1rem;
    }

    .footer a {
      color: var(--light);
      text-decoration: none;
      transition: .3s;
    }

    .footer a:hover {
      color: var(--primary);
    }

    .footer .social a {
      font-size: 1.5rem;
      margin-right: 1rem;
      color: var(--light);
      transition: transform .3s, color .3s;
    }

    .footer .social a:hover {
      color: var(--primary);
      transform: scale(1.2);
    }

    .footer .footer-links a {
      display: block;
      margin-bottom: .5rem;
      color: var(--light);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .footer .d-flex.flex-wrap {
        flex-direction: column;
        align-items: flex-start;
      }

      .footer .social,
      .footer .app-links {
        margin-top: 1rem;
      }
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top shadow-sm" data-aos="fade-down">
    <div class="container">

      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center fw-bold text-white" href="#">
        <!-- أيقونة تاكسي -->
        <i class="fas fa-taxi fa-2x me-2" style="color:rgb(16, 130, 54); text-shadow: 1px 1px 2px rgba(0,0,0,0.5);"></i>


      </a>


      <!-- Toggler -->
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="#about">{{ __('navbar.home') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="#services">{{ __('navbar.services') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="#cars">{{ __('navbar.cars') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="#testimonials">{{ __('navbar.testimonials') }}</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">{{ __('navbar.contact') }}</a></li>
        </ul>
        <a href="#contact" class="btn btn-primary btn-pill ms-lg-3">{{ __('navbar.book_now') }}</a>

        <!-- Change Language -->
        <div class="dropdown ms-lg-3 mt-3 mt-lg-0 text-center w-lg-auto">
          <button
            class="btn btn-outline-light btn-sm dropdown-toggle px-3 py-2 rounded-pill shadow-sm d-flex align-items-center justify-content-center gap-2"
            type="button"
            id="languageDropdown"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            🌐
            @if(app()->getLocale() === 'ar')
            العربية
            @elseif(app()->getLocale() === 'en')
            English
            @else
            اردو
            @endif
          </button>

          <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 text-center mt-2" aria-labelledby="languageDropdown">
            <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('lang/ar') }}">🇸🇦 <span>العربية</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('lang/en') }}">🇬🇧 <span>English</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('lang/ur') }}">🇵🇰 <span>اردو</span></a></li>
          </ul>
        </div>


      </div>

    </div>
  </nav>


  <!-- Hero -->
  <header class="hero" data-aos="fade-up">
    <div class="container text-center">
      <h1>{{ __('navbar.brand') }}</h1>
      <h2>{{ __('navbar.hero_title') }}</h2>
      <p>{{ __('navbar.hero_subtitle') }}</p>
      <div class="d-flex justify-content-center flex-wrap">
        <a href="#services" class="btn btn-light btn-pill mx-2 mb-2" data-aos="fade-right">
          {{ __('navbar.hero_services') }}
        </a>
        <a href="#contact" class="btn btn-outline-light btn-pill mx-2 mb-2" data-aos="fade-left">
          {{ __('navbar.hero_contact') }}
        </a>
      </div>
    </div>
  </header>


  <!-- About Section -->
  <!-- About Section -->
  <section id="about" class="section" style="background: linear-gradient(135deg, #0d1b2a, #1b263b);">
    <div class="container">
      <div class="row align-items-center g-4">

        <!-- Text -->
        <div class="col-lg-6" data-aos="fade-right">
          <h2 class="section-title">{{ __('navbar.home') }}</h2>
          <ul class="fs-5" style="color:#fff; line-height:1.8;">
            <li>{!! __('navbar.about_1') !!}</li>
            <li>{{ __('navbar.about_2') }}</li>
            <li>{{ __('navbar.about_3') }}</li>
            <li>{{ __('navbar.about_4') }}</li>
          </ul>
          <a href="#contact" class="btn btn-primary btn-pill mt-3">{{ __('navbar.about_cta') }}</a>
        </div>

        <!-- Image -->
        <div class="col-lg-6 text-center" data-aos="fade-left">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Green_Taxi_Riyadh_2024.jpg/2383px-Green_Taxi_Riyadh_2024.jpg"
            alt="تاكسي أخضر"
            class="img-fluid rounded-4 shadow-lg"
            style="max-height:400px; object-fit:cover;">
        </div>

      </div>
    </div>
  </section>






  <!-- Services -->
  <section id="services" class="section text-center">
    <div class="container">
      <h2 class="section-title" data-aos="fade-up">{{ __('navbar.services_title') }}</h2>
      <div class="row g-4 justify-content-center">

        <!-- General Taxi -->
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
          <div class="service-box shadow-lg h-100 p-3 rounded-4">
            <div class="feature-icon bg-success text-white fs-2">🚕</div>
            <h5 class="fw-bold mb-2">{{ __('navbar.service_1_title') }}</h5>
            <p>{{ __('navbar.service_1_desc') }}</p>
          </div>
        </div>

        <!-- Specialized Transport -->
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
          <div class="service-box shadow-lg h-100 p-3 rounded-4">
            <div class="feature-icon bg-warning text-white fs-2">🕌</div>
            <h5 class="fw-bold mb-2">{{ __('navbar.service_2_title') }}</h5>
            <p>{{ __('navbar.service_2_desc') }}</p>
          </div>
        </div>

        <!-- Taxi Guidance -->
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
          <div class="service-box shadow-lg h-100 p-3 rounded-4">
            <div class="feature-icon bg-danger text-white fs-2">📲</div>
            <h5 class="fw-bold mb-2">{{ __('navbar.service_3_title') }}</h5>
            <p>{{ __('navbar.service_3_desc') }}</p>
          </div>
        </div>

      </div>
    </div>
  </section>



  <!-- Cars -->
  <section id="cars" class="section">
    <div class="container">
      <h2 class="section-title text-center" data-aos="fade-up">{{ __('navbar.cars_title') }}</h2>
      <div class="row g-4 justify-content-center">

        <!-- Car 1 -->
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
          <div class="card card-car">
            <div class="image-zoom-container" style="overflow: hidden; width: 100%; height: auto;">
              <img src="https://taxa.sa/wp-content/uploads/2023/07/left-icon-1.png"
                class="card-img-top zoom-img"
                alt="{{ __('navbar.car_1_title') }}"
                style="transform: scale(1.25); transform-origin: center; transition: transform 0.3s;">
            </div>
            <div class="card-body text-center">
              <h5 class="fw-bold">{{ __('navbar.car_1_title') }}</h5>
              <p>{{ __('navbar.car_1_desc') }}</p>
              <a href="#contact" class="btn btn-outline-primary btn-sm btn-pill">{{ __('navbar.book_now') }}</a>
            </div>
          </div>
        </div>

        <!-- Car 2 -->
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
          <div class="card card-car">
            <img src="https://files.toyota.com.bh/s3fs-public/2019-09/Beige-Metallic_1.png"
              class="card-img-top"
              alt="{{ __('navbar.car_2_title') }}">
            <div class="card-body text-center">
              <h5 class="fw-bold">{{ __('navbar.car_2_title') }}</h5>
              <p>{{ __('navbar.car_2_desc') }}</p>
              <a href="#contact" class="btn btn-outline-primary btn-sm btn-pill">{{ __('navbar.book_now') }}</a>
            </div>
          </div>
        </div>

        <!-- Car 3 -->
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
          <div class="card card-car">
            <div class="image-zoom-container" style="overflow: hidden; width: 100%; height: auto;">
              <img src="https://static.icartea.com/cc/modelImage/20250513142710_Group%201321318758%20-%202025-05-13T142703.420.png?imageMogr2/format/webp/interlace/1/quality/70/thumbnail/750x"
                class="card-img-top zoom-img"
                alt="{{ __('navbar.car_3_title') }}"
                style="transform: scale(1.4); transform-origin: center; transition: transform 0.3s;">
            </div>
            <div class="card-body text-center">
              <h5 class="fw-bold">{{ __('navbar.car_3_title') }}</h5>
              <p>{{ __('navbar.car_3_desc') }}</p>
              <a href="#contact" class="btn btn-outline-primary btn-sm btn-pill">{{ __('navbar.book_now') }}</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- Testimonials -->
  <section id="testimonials" class="section">
    <div class="container">
      <h2 class="section-title text-center" data-aos="fade-up">{{ __('navbar.testimonials_title') }}</h2>
      <div id="carouselTestimonials" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner text-center">
          <div class="carousel-item active">
            <div class="testimonial mx-auto col-md-8">
              <p class="mb-2">{{ __('navbar.testimonial_1') }}</p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="testimonial mx-auto col-md-8">
              <p class="mb-2">{{ __('navbar.testimonial_2') }}</p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="testimonial mx-auto col-md-8">
              <p class="mb-2">{{ __('navbar.testimonial_3') }}</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimonials" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimonials" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </section>
  <!-- Contact -->
  <section id="contact" class="section">
    <div class="container">
      <div class="row g-4 align-items-stretch">
        <div class="col-lg-6" data-aos="fade-right">
          <div class="contact p-4 h-100 rounded-4 shadow-sm bg-dark">
            <h3 class="mb-3">{{ __('navbar.contact_title') }}</h3>
            <form action="{{ route('contact.store') }}" method="POST">
              @csrf
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label">{{ __('navbar.contact_name') }}</label>
                  <input type="text" name="name" class="form-control" placeholder="{{ __('navbar.contact_name_placeholder') }}" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">{{ __('navbar.contact_phone') }}</label>
                  <input type="tel" name="phone" class="form-control" placeholder="{{ __('navbar.contact_phone_placeholder') }}" />
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">{{ __('navbar.contact_email') }}</label>
                <input type="email" name="email" class="form-control" placeholder="{{ __('navbar.contact_email_placeholder') }}" />
              </div>
              <div class="mb-3">
                <label class="form-label">{{ __('navbar.contact_message') }}</label>
                <textarea name="message" class="form-control" rows="4" placeholder="{{ __('navbar.contact_message_placeholder') }}"></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-pill">{{ __('navbar.contact_send_btn') }}</button>
            </form>
          </div>
        </div>

       <div class="col-lg-6" data-aos="fade-left">
  <div class="d-flex justify-content-between align-items-center mb-3">

    {{-- زر الديسكتوب (يمين العنوان) --}}
    <a href="https://maps.google.com/?q=24.398407984274,39.60681458500615"
       target="_blank"
       class="btn btn-warning btn-sm rounded-pill shadow-sm d-none d-lg-inline-flex align-items-center">
      <i class="fas fa-map-marker-alt me-2"></i>
      {{ __('navbar.view_on_map') }}
    </a>
  </div>

  <div class="rounded-4 overflow-hidden shadow-sm" style="height:100%; min-height:400px;">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3633.5081495889813!2d39.60681458500615!3d24.398407984274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjTCsDIzJzU0LjMiTiAzOcKwMzYnMTYuNyJF!5e0!3m2!1sar!2ssa!4v1756577144619!5m2!1sar!2ssa"
      width="100%"
      height="100%"
      style="border:0;"
      allowfullscreen
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>

  {{-- زر الموبايل (تحت الخريطة بعرض كامل) --}}
  <a href="https://maps.google.com/?q=24.398407984274,39.60681458500615"
     target="_blank"
     class="btn btn-warning rounded-pill shadow-sm w-100 mt-3 d-lg-none">
    <i class="fas fa-map-marker-alt me-2"></i>
    {{ __('navbar.view_on_map') }}
  </a>
</div>


      </div>
    </div>
  </section>
  <footer class="footer mt-5 bg-dark text-white py-4">
    <div class="container d-flex flex-wrap justify-content-between align-items-start">

      <div class="footer-links mb-3">
        <h5>{{ __('navbar.footer_quick_links') }}</h5>
        <a href="#about" class="text-white">{{ __('navbar.home') }}</a>
        <a href="#services" class="text-white">{{ __('navbar.services_title') }}</a>
        <a href="#cars" class="text-white">{{ __('navbar.cars_title') }}</a>
        <a href="#testimonials" class="text-white">{{ __('navbar.testimonials_title') }}</a>
        <a href="#contact" class="text-white">{{ __('navbar.contact_title') }}</a>
      </div>

      <div class="social mb-3">
        <h5>{{ __('navbar.footer_follow_us') }}</h5>
        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
        <a href="#" class="text-white me-2"><i class="fab fa-linkedin-in"></i></a>
      </div>

      <div class="app-links mb-3">
        <h5>{{ __('navbar.footer_download_app') }}</h5>
        <a href="https://play.google.com/store/apps/details?id=app.aljawab.rosecapptian" target="_blank" class="btn btn-outline-light btn-sm me-2">
          <i class="fab fa-google-play me-1"></i> Google Play
        </a>
        <span class="btn btn-outline-light btn-sm disabled"><i class="fab fa-apple me-1"></i> App Store </span>
      </div>

      <div class="contact mb-3 p-3 rounded-3 bg-secondary text-white text-center">
        <h5 class="mb-2 fw-bold">{{ __('navbar.footer_contact_us') }}</h5>
        <p class="mb-1"><i class="fas fa-phone-alt me-2"></i><a href="tel:0551796056" class="text-white text-decoration-none">0551796056</a></p>
        <p class="mb-0">
          <i class="fab fa-whatsapp me-2"></i>
          <a href="https://wa.me/966551796056" target="_blank" class="text-white text-decoration-none">
            {{ __('navbar.footer_whatsapp') }}
          </a>
        </p>
      </div>

      <div class="mt-3 w-100 text-center">
        © <span id="year"></span> {{ __('navbar.footer_copyright') }}
      </div>

    </div>
  </footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
    AOS.init({
      duration: 1000,
      once: true
    });
  </script>

</body>

</html>