<?php
use Framework\Session;
$user = [];

// 🚫 Block if user is logged in (regular account session)
if (Session::get('user')) {
  $user = Session::get('user');
  // or show "Forbidden"
}

// 🚫 Block if admin is already logged in
if (Session::get('admin')) {
  $user = Session::get('admin');
}


?>




<!-- Sidebar navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
<aside class="col-lg-3" style="margin-top: -105px">
  <div class="offcanvas-lg offcanvas-start sticky-lg-top pe-lg-3 pe-xl-4" id="accountSidebar">
    <div class="d-none d-lg-block" style="height: 105px"></div>

    <!-- Header -->
    <div class="offcanvas-header d-lg-block py-3 p-lg-0">
      <div class="d-flex flex-row flex-lg-column align-items-center align-items-lg-start">
        <div class="flex-shrink-0 bg-body-secondary border rounded-circle overflow-hidden"
          style="width: 64px; height: 64px">
          <img src="<?= htmlspecialchars($user['profile_picture']) ?? 'Avatar' ?>" alt="Avatar">
        </div>
        <div class="pt-lg-3 ps-3 ps-lg-0">
          <h6 class="mb-1"><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?? 'Name' ?></h6>
          <p class="fs-sm mb-0"> <?= htmlspecialchars($user['email']) ?? 'email' ?></p>
        </div>
      </div>
      <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#accountSidebar"
        aria-label="Close"></button>
    </div>

    <!-- Body (Navigation) -->
    <div class="offcanvas-body d-block pt-2 pt-lg-4 pb-lg-0">
      <nav class="list-group list-group-borderless">
        <!--My  Profile -->
        <?php if (Session::has('admin')): ?>
          <a aria-current="page" href="<?= url('admin/account-profile')?>"
            class="list-group-item list-group-item-action d-flex align-items-center <?= $_SERVER['REQUEST_URI'] === '/admin/account-profile' ? 'active' : '' ?>">
            <i class="fi-user fs-base opacity-75 me-2"></i>
            Admin Profile
          </a>
        <?php elseif (Session::has('user')): ?>
          <a aria-current="page" href="<?= url('user/account-profile') ?>"
            class="list-group-item list-group-item-action d-flex align-items-center <?= $_SERVER['REQUEST_URI'] === '/user/account-profile' ? 'active' : '' ?>">
            <i class="fi-user fs-base opacity-75 me-2"></i>
            User Profile
          </a>
        <?php endif; ?>


        <!--My listings -->
        <?php if (Session::has('admin')): ?>
          <a aria-current="page" href="<?= url('admin/account-listings') ?>"
            class="list-group-item list-group-item-action d-flex align-items-center <?= $_SERVER['REQUEST_URI'] === '/admin/account-listings' ? 'active' : '' ?>">
            <i class="fi-user fs-base opacity-75 me-2"></i>
            Realtors
          </a>
        <?php elseif (Session::has('user')): ?>
          <a aria-current="page" href="<?= url('user/account-listings')?>"
            class="list-group-item list-group-item-action d-flex align-items-center <?= $_SERVER['REQUEST_URI'] === '/user/account-listings' ? 'active' : '' ?>">
            <i class="fi-user fs-base opacity-75 me-2"></i>
            My listings
          </a>
        <?php endif; ?>

        <?php if (Session::has('user')): ?>
          <a class="list-group-item list-group-item-action d-flex align-items-center <?= $_SERVER['REQUEST_URI'] === '/user/account-payment' ? 'active' : '' ?>"
            href="<?= url('user/account-payment')?>">
            <i class="fi-credit-card fs-base opacity-75 me-2"></i>
            Payment details
          </a>
        <?php endif; ?>


        <!--Account settings -->

        <?php if (Session::has('user')): ?>
          <a aria-current="page" href="<?= url('user/account-settings')?>"
            class="list-group-item list-group-item-action d-flex align-items-center <?= $_SERVER['REQUEST_URI'] === '/user/account-settings' ? 'active' : '' ?>">
            <i class="fi-user fs-base opacity-75 me-2"></i>
            Account settings
          </a>
        <?php endif; ?>
                <?php if (Session::has('admin')): ?>
          <a aria-current="page" href="<?= url('admin/account-settings')?>"
            class="list-group-item list-group-item-action d-flex align-items-center <?= $_SERVER['REQUEST_URI'] === '/admin/account-settings' ? 'active' : '' ?>">
            <i class="fi-user fs-base opacity-75 me-2"></i>
            Account settings
          </a>
        <?php endif; ?>



        <?php if (Session::has('user')): ?>
          <a class="list-group-item list-group-item-action d-flex align-items-center <?= $_SERVER['REQUEST_URI'] === '/user/account-helpCenter' ? 'active' : '' ?>"
            href="<?= url('user/account-helpCenter')?>">
            <i class="fi-help-circle fs-base opacity-75 me-2"></i>
            Help center
          </a>
        <?php elseif (Session::has('admin')): ?>
          <a class="list-group-item list-group-item-action d-flex align-items-center <?= $_SERVER['REQUEST_URI'] === '/admin/account-helpCenter' ? 'active' : '' ?>"
            href="<?= url('admin/account-helpCenter')?>">
            <i class="fi-help-circle fs-base opacity-75 me-2"></i>
            Help center
          </a>
        <?php endif ?>
      </nav>
      <nav class="list-group list-group-borderless pt-3">
  <?php if (Session::has('user')): ?>
        <a class="list-group-item list-group-item-action d-flex align-items-center" href="<?= url('auth/signout')?>">
          <i class="fi-log-out fs-base opacity-75 me-2"></i>
          Sign out
        </a>
      <?php elseif (Session::has('admin')): ?>
        <a class="list-group-item list-group-item-action d-flex align-items-center" href="<?= url('admin/auth/signout')?>">
          <i class="fi-log-out fs-base opacity-75 me-2"></i>
          Sign out 
        </a>
       <?php endif ?>
       
      </nav>
    </div>
  </div>
</aside>