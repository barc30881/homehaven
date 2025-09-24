    <!-- Page footer -->
    <footer class="footer bg-body border-top pt-5" data-bs-theme="dark">
      <div class="container pt-sm-2 pt-md-3 pt-lg-4 pb-4">
        <div class="accordion row pb-4 pb-md-3 pb-lg-4 mb-2 mb-sm-3 mb-md-2" id="footerLinks">
        <!-- Copyright -->
        <div class="text-center pt-4 pb-md-2">
          <p class="text-body-secondary fs-sm mb-0"> © <?= date('Y') ?> All rights reserved. Made by <a class="text-body fw-medium text-decoration-none hover-effect-underline" href="https://myportfolio-jxzz.onrender.com" target="_blank" rel="noreferrer">SoftwareCodehub institute</a></p>
        </div>
      </div>
    </footer>


    <!-- Back to top button -->
    <div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4">
      <a class="btn-scroll-top btn btn-sm bg-body border-0 rounded-pill shadow animate-slide-end" href="#top">
        Top
        <i class="fi-arrow-right fs-base ms-1 me-n1 animate-target"></i>
        <span class="position-absolute top-0 start-0 w-100 h-100 border rounded-pill z-0"></span>
        <svg class="position-absolute top-0 start-0 w-100 h-100 z-1" viewBox="0 0 62 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x=".75" y=".75" width="60.5" height="30.5" rx="15.25" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"></rect>
        </svg>
      </a>
      
    </div>



<!-- Vendor scripts -->
    <script src="<?= url('assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
    <script src="<?= url('assets/vendor/choices.js/choices.min.js') ?>"></script>
    <script src="<?= url('assets/vendor/nouislider/nouislider.min.js') ?>"></script>

    <!-- Bootstrap + Theme scripts -->
    <script src="<?= url('assets/js/theme.min.js') ?>"></script>
  

</body>
</html>