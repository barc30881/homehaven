<?php use Framework\Session ?>
<!-- Navigation bar (Page header) -->
<header class="navbar navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0" data-sticky-element="">
  <div class="container">

    <!-- Mobile offcanvas menu toggler (Hamburger) -->
    <button type="button" class="navbar-toggler me-3 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar brand (Logo) -->
    <a class="navbar-brand py-1 py-md-2 py-xl-1 me-2 me-sm-n4 me-md-n5 me-lg-0" href="<?= url('/')?>">
      <span class="d-none d-sm-flex flex-shrink-0 text-primary rtl-flip me-2">

        <div class="flex-shrink-0 bg-body-secondary border rounded-circle overflow-hidden"
          style="width: 70px; height: 76px">
         
          <img src="<?= url('assets/img/home/logo.png')?>" alt="Avatar">
        </div>

      </span>
      ConnectBuilders
    </a>

    <!-- Main navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
    <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1" aria-labelledby="navbarNavLabel">
      <div class="offcanvas-header py-3">
        <h5 class="offcanvas-title" id="navbarNavLabel">Browse ConnectBuilders</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body pt-2 pb-4 py-lg-0 mx-lg-auto">
        <ul class="navbar-nav position-relative">
          <li class="nav-item dropdown py-lg-2 me-lg-n1 me-xl-0">
            <a class="nav-link dropdown-toggle active" aria-current="page" href="<?= url('/')?>" role="button"
              data-bs-toggle="dropdown" data-bs-trigger="hover" aria-expanded="false">Home</a>
          </li>
          <?php if (Session::has('user') === false || Session::has('admin') === false): ?>
            <li class="nav-item dropdown position-static py-lg-2 me-lg-n1 me-xl-0">
              <a class="nav-link dropdown-toggle" href="<?= url('listings')?>" role="button" data-bs-toggle="dropdown"
                data-bs-trigger="hover" aria-expanded="false">Listings</a>
              <div class="dropdown-menu rounded-4 p-4">
                <div class="d-flex flex-column flex-lg-row gap-4">
                  <div style="min-width: 190px">
                    <div class="h6 mb-2">Real Estate</div>
                    <ul class="nav flex-column gap-2 mt-0">
                      <li class="pt-1">
                        <a class="nav-link hover-effect-underline d-inline fw-normal p-0" href="<?= url('listings')?>">listings</a>
                      </li>
                    </ul>
                  </div>
                </div>
            </li>
          <?php endif; ?>
          <li class="nav-item dropdown py-lg-2 me-lg-n1 me-xl-0">
            <?php if (Session::has('user')): ?>
              <a class="nav-link dropdown-toggle" href="<?= url('user/account-settings') ?>" role="button" data-bs-toggle="dropdown"
                data-bs-trigger="hover" data-bs-auto-close="outside" aria-expanded="false">Account</a>
            <?php elseif (Session::has('admin')): ?>
              <a class="nav-link dropdown-toggle" href="<?= url('admin/account-settings')?>" role="button" data-bs-toggle="dropdown"
                data-bs-trigger="hover" data-bs-auto-close="outside" aria-expanded="false">Account</a>
            <?php endif; ?>
            <?php if (Session::has('user')): ?>
              <ul class="dropdown-menu">

                <li><a class="dropdown-item" href="<?= url('user/account-profile')?>">My Profile</a></li>
                <li><a class="dropdown-item" href="<?= url('user/account-listings')?>">My Listings</a></li>
                <li><a class="dropdown-item" href="<?= url('user/account-payment')?>">Payment Details</a></li>
                <li><a class="dropdown-item" href="<?= url('user/account-settings')?>">Account Settings</a></li>
                <li><a class="dropdown-item" href="<?= url('user/account-helpCenter')?>">Help Center</a></li>
                <li><a class="dropdown-item" href="<?= url('auth/signout')?>">Sign Out</a></li>
              </ul>
            <?php endif ?>
            <?php if (Session::has('admin')): ?>
              <ul class="dropdown-menu">

                <li><a class="dropdown-item" href="<?= url('admin/account-profile')?>">My Profile</a></li>
                <li><a class="dropdown-item" href="<?= url('admin/account-listings')?>">Realtors</a></li>

                <li><a class="dropdown-item" href="<?= url('admin/account-settings')?>">Account Settings</a></li>
                <li><a class="dropdown-item" href="<?= url('admin/account-helpCenter')?>">Help Center</a></li>
                <li><a class="dropdown-item" href="<?= url('admin/auth/signout')?>">Sign Out</a></li>
              </ul>
            <?php endif ?>
          </li>

          <?php if (Session::has('user')): ?>
            <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
              <a class="nav-link" href="<?= url('user/account-settings')?>">
                <?= "Welcome " . Session::get('user')['email'] ?>
              </a>
            </li>
          <?php elseif (Session::has('admin')): ?>
            <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
              <a class="nav-link" href="<?= url('admin/account-settings')?>">
                <?= "Welcome " . Session::get('admin')['email'] ?>
              </a>
            </li>
          <?php endif; ?>

        </ul>
      </div>
    </nav>

    <!-- Button group -->
    <div class="d-flex gap-sm-4">

      <!-- Theme switcher (light/dark/auto) -->
      <div class="dropdown">
        <button type="button" class="theme-switcher btn btn-icon btn-outline-secondary fs-lg border-0 animate-scale"
          data-bs-toggle="dropdown" data-bs-display="dynamic" aria-expanded="false" aria-label="Toggle theme (light)">
          <span class="theme-icon-active d-flex animate-target">
            <i class="fi-sun"></i>
          </span>
        </button>
        <ul class="dropdown-menu start-50 translate-middle-x"
          style="--fn-dropdown-min-width: 9rem; --fn-dropdown-spacer: .5rem">
          <li>
            <button type="button" class="dropdown-item active" data-bs-theme-value="light" aria-pressed="true">
              <span class="theme-icon d-flex fs-base me-2">
                <i class="fi-sun"></i>
              </span>
              <span class="theme-label">Light</span>
              <i class="item-active-indicator fi-check ms-auto"></i>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item" data-bs-theme-value="dark" aria-pressed="false">
              <span class="theme-icon d-flex fs-base me-2">
                <i class="fi-moon"></i>
              </span>
              <span class="theme-label">Dark</span>
              <i class="item-active-indicator fi-check ms-auto"></i>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item" data-bs-theme-value="auto" aria-pressed="false">
              <span class="theme-icon d-flex fs-base me-2">
                <i class="fi-auto"></i>
              </span>
              <span class="theme-label">Auto</span>
              <i class="item-active-indicator fi-check ms-auto"></i>
            </button>
          </li>
        </ul>
      </div>


      <?php if (Session::has('admin')): ?>
        <!-- Admin account button -->
        <a class="btn btn-icon btn-outline-secondary fs-lg border-0 animate-shake me-2" href="<?= url('admin/account-settings')?>"
          aria-label="Admin Dashboard">
          <i class="fi-user animate-target me-sm-2 me-1 ms-n2 fs-lg"></i>
        </a>

      <?php elseif (Session::has('user')): ?>
        <!-- User account button -->
        <a class="btn btn-icon btn-outline-secondary fs-lg border-0 animate-shake me-2" href="<?= url('user/account-settings')?>"
          aria-label="User Account">
          <i class="fi-user animate-target me-sm-2 me-1 ms-n2 fs-lg"></i>
        </a>

      <?php else: ?>
        <!-- Login button -->
        <a class="btn btn-icon btn-outline-secondary fs-lg border-0 animate-shake me-2" href="<?= url('auth/login')?>"
          aria-label="Sign in to account">
          <i class="animate-target me-sm-2 me-1 ms-n2 fs-lg">Login</i>
        </a>
      <?php endif; ?>





      <!-- Add property button  -->
      <?php if (Session::has('user')): ?>
        <a class="btn btn-primary animate-scale" href="<?= url('user/add-property-location')?>">
          <i class="fi-plus fs-lg animate-target ms-n2 me-1 me-sm-2"></i>
          Add<span class="d-none d-xl-inline ms-1">property</span>
        </a>
      <?php elseif (Session::has('admin')): ?>
        <a class="btn btn-primary animate-scale" href="<?= url('admin/account-profile')?>">
          <i class="fi-plus fs-lg animate-target ms-n2 me-1 me-sm-2"></i>
          <span class="d-none d-xl-inline ms-1">Dashboard</span>
        </a>
      <?php else: ?>
        <a class="btn btn-primary animate-scale" href="<?= url('user/add-property-location')?>">
          <i class="fi-plus fs-lg animate-target ms-n2 me-1 me-sm-2"></i>
          Add<span class="d-none d-xl-inline ms-1">property</span>
        </a>
      <?php endif; ?>
    </div>
  </div>
</header>