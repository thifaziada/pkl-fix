@extends('layouts.navigation')
@section('content')
@vite(['resources/css/app.css','resources/js/app.js'])

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard Alumni</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php 
      use App\Models\Testimony;
      $testimonies = Testimony::with('alumni')->get();
    @endphp

    <!-- Testimonials Section -->
    <section id="alumni" class="alumni">
        <div class="container bg-white pb-1">
          <div class="section-title" data-aos="fade-up">
              <h2>Testimonials</h2>
          </div>
  
          <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper-wrapper">
                  @foreach($testimonies as $testimony)
                      <div class="swiper-slide">
                        <div class="testimonial-item">
                          <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            {{ $testimony->content }}
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                          </p>
                          <img src="{{asset('/storage/photos/'.$testimony->alumni->photo)}}" class="testimonial-img" alt="">
                          <h3>{{ $testimony->alumni->first_name }} {{ $testimony->alumni->last_name }}</h3>
                          <h4>{{ $testimony->alumni->current_job }}</h4>
                        </div>
                      </div><!-- End testimonial item -->
                  @endforeach
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
          </div>
        </div>
      </section><!-- End Testimonials Section -->

 <!-- ======= Agenda Section ======= -->
 <section id="agenda" class="agenda">
  <div class="container" style="display: flex; text-align: center;">
    <div class="section-title" data-aos="fade-up" style="margin-top: 50px; width: 100%;">
        {{-- <h2 style="margin: 0 auto;">Agenda</h2> --}}
            <!-- ======= Agenda Section ======= -->
        <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
        <div class="elfsight-app-a8a23565-b70e-4b1b-b458-d76849f29843" data-elfsight-app-lazy></div>
    </div>
  </div>
</section>

<!-- End Agenda Section -->

    <section id="alumni" class="alumni">
        <div class="container">
            <div class="section-title">
                <h2>Your Career at Elitery</h2>
            </div>
            <div class="grid grid-cols-2 gap-3">
            <div>
                <a href="https://www.elitery.com/career/" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="https://images.unsplash.com/photo-1600880292089-90a7e086ee0c?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-black">Reentry</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Are you interested in working for Elitery again? We’d love to see your speculative application.</p>
                    </div>
                </a>
            </div>
                <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="https://images.unsplash.com/photo-1552960394-c81add8de6b8?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-black">Referral</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Recommend elitery as an employer and benefit from an attractive referral reward.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>