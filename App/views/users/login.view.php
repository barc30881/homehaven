
<?= loadPartial( 'head') ?>
<?= loadPartial('navbar') ?>


 <!-- Page content -->
    <main class="content-wrapper w-100 px-3 ps-lg-5 pe-lg-4 mx-auto" style="max-width: 1920px">
      <div class="d-lg-flex">

        <!-- Login form + Footer -->
        <div class="d-flex flex-column min-vh-100 w-100 py-4 mx-auto me-lg-5" style="max-width: 416px">

      

          <h1 class="h2 mt-auto">Welcome back</h1>
          <div class="nav fs-sm mb-4">
            Don't have an account?
            <a class="nav-link text-decoration-underline p-0 ms-2" href="<?= url('auth/register')?>">Create an account</a>
          </div>

          <!-- Form -->
          <form class="needs-validation" novalidate="" method="POST" action="<?= url('auth/login')?>">
            <?php loadPartial('errors',[
                'errors'=>$errors ?? []
              ]); ?>
            <div class="position-relative mb-4">
              <input name="email"    value="<?= $user['email'] ?? ''?>" type="email" class="form-control form-control-lg" placeholder="Email" required="">
              <div class="invalid-tooltip bg-transparent py-0">Enter a valid email address!</div>
            </div>
            <div class="mb-4">
              <div class="password-toggle">
                <input name="password" type="password" class="form-control form-control-lg" placeholder="Password" required="">
                <div class="invalid-tooltip bg-transparent py-0">Password is incorrect!</div>
                <label class="password-toggle-button fs-lg" aria-label="Show/hide password">
                  <input type="checkbox" class="btn-check">
                </label>
              </div>
            </div>
            
            <button type="submit" class="btn btn-lg btn-primary w-100">Sign In</button>
          </form>

      

          <!-- Footer -->
          <footer class="mt-auto">
            
            <p class="fs-xs mb-0">
             © <?= date('Y') ?> All rights reserved. Made by <a class="text-body fw-medium text-decoration-none hover-effect-underline" href="https://myportfolio-jxzz.onrender.com" target="_blank" rel="noreferrer">SoftwareCodehub institute</a>
            </p>
          </footer>
        </div>


        <!-- Cover image visible on screens > 992px wide (lg breakpoint) -->
        <div class="d-none d-lg-block w-100 py-4 ms-auto" style="max-width: 1034px">
          <div class="d-flex flex-column justify-content-end h-100 bg-info-subtle rounded-5">
            <div class="ratio" style="--fn-aspect-ratio: calc(1030 / 1032 * 100%)">
              <img src="<?= url('assets/img/account/account-cover.png')?>" alt="Girl">
            </div>
          </div>
        </div>
      </div>
    </main>
<?= loadPartial( 'createFooter') ?>