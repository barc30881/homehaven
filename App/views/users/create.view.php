<?= loadPartial( 'head') ?>
<?= loadPartial('navbar') ?>





 

    <!-- Page content -->
    <main class="content-wrapper w-100 px-3 ps-lg-5 pe-lg-4 mx-auto" style="max-width: 1920px">
      <div class="d-lg-flex">

        <!-- Login form + Footer -->
        <div class="d-flex flex-column min-vh-100 w-100 py-4 mx-auto me-lg-5" style="max-width: 416px">

   

          <h1 class="h2 mt-auto">Create an account</h1>
          <div class="nav fs-sm mb-3 mb-lg-4">
            I already have an account
            <a class="nav-link text-decoration-underline p-0 ms-2" href="<?= url('auth/login')?>">Sign in</a>
          </div>
          <div class="nav fs-sm mb-4 d-lg-none">
            <span class="me-2">Uncertain about creating an account?</span>
            <a class="nav-link text-decoration-underline p-0" href="#benefits" data-bs-toggle="offcanvas" aria-controls="benefits">Explore the Benefits</a>
          </div>

          <!-- Form -->
          <form class="needs-validation" novalidate="" method="POST" action="<?= url('auth/register')?>">
            <div class="position-relative mb-4">
              <?php loadPartial('errors',[
                'errors'=>$errors ?? []
              ]); ?>
              <label for="register-email" class="form-label">Email</label>
              <input value="<?= $user['email'] ?? ''?>" type="email" class="form-control form-control-lg" id="register-email" required="" name="email">
              <div class="invalid-tooltip bg-transparent py-0">Enter a valid email address!</div>
            </div>
            <div class="mb-4">
              <label for="register-password" class="form-label">Password</label>
              <div class="password-toggle">
                <input type="password" class="form-control form-control-lg" id="register-password" minlength="8" placeholder="Minimum 8 characters" required="" name="password">
                <div class="invalid-tooltip bg-transparent py-0">Password does not meet the required criteria!</div>
                <label class="password-toggle-button fs-lg" aria-label="Show/hide password">
                  <input type="checkbox" class="btn-check">
                </label>
              </div>
            </div>
            <div class="d-flex flex-column gap-2 mb-4">
              
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="privacy" required="" name="privacy">
                <label for="privacy" class="form-check-label">I have read and accept the Privacy Policy</label>
              </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary w-100" name="submit">
              Create an account
              <i class="fi-chevron-right fs-lg ms-1 me-n1"></i>
            </button>
          </form>

      

          <!-- Footer -->
          <footer class="mt-auto">
            
            <p class="fs-xs mb-0">
            © <?= date('Y') ?> All rights reserved. Made by <a class="text-body fw-medium text-decoration-none hover-effect-underline" href="https://myportfolio-jxzz.onrender.com" target="_blank" rel="noreferrer">SoftwareCodehub institute</a>
            </p>
          </footer>
        </div>


        <!-- Benefits section that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
        <div class="offcanvas-lg offcanvas-end w-100 py-lg-4 ms-auto" id="benefits" style="max-width: 1034px">
          <div class="offcanvas-header justify-content-end position-relative z-2 p-3">
            <button type="button" class="btn btn-icon btn-outline-dark text-dark border-dark bg-transparent rounded-circle d-none-dark" data-bs-dismiss="offcanvas" data-bs-target="#benefits" aria-label="Close">
              <i class="fi-close fs-lg"></i>
            </button>
            <button type="button" class="btn btn-icon btn-outline-dark text-light border-light bg-transparent rounded-circle d-none d-inline-flex-dark" data-bs-dismiss="offcanvas" data-bs-target="#benefits" aria-label="Close">
              <i class="fi-close fs-lg"></i>
            </button>
          </div>
          <span class="position-absolute top-0 start-0 w-100 h-100 bg-info-subtle d-lg-none"></span>
          <div class="offcanvas-body position-relative z-2 d-lg-flex flex-column align-items-center justify-content-center h-100 pt-2 px-3 p-lg-0">
            <span class="position-absolute top-0 start-0 w-100 h-100 bg-info-subtle rounded-5 d-none d-lg-block"></span>
            <div class="position-relative z-2 w-100 text-center px-md-2 p-lg-5">
              <h2 class="h4 pb-3">Connect builders account benefits</h2>
              <div class="mx-auto" style="max-width: 790px">
                <div class="row row-cols-1 row-cols-sm-2 g-3 g-md-4 g-lg-3 g-xl-4">
                  <div class="col">
                    <div class="card h-100 bg-transparent border-0">
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border border-white border-opacity-75 rounded-4 d-none-dark" style="--fn-bg-opacity: .3"></span>
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--fn-bg-opacity: .05"></span>
                      <div class="card-body position-relative z-2">
                        <div class="d-inline-flex position-relative text-info p-3">
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                          <i class="fi-mail position-relative z-2 fs-4 m-1"></i>
                        </div>
                        <h3 class="h6 pt-2 my-2">Subscribe to your favorite listings</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card h-100 bg-transparent border-0">
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border border-white border-opacity-75 rounded-4 d-none-dark" style="--fn-bg-opacity: .3"></span>
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--fn-bg-opacity: .05"></span>
                      <div class="card-body position-relative z-2">
                        <div class="d-inline-flex position-relative text-info p-3">
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                          <i class="fi-settings position-relative z-2 fs-4 m-1"></i>
                        </div>
                        <h3 class="h6 pt-2 my-2">Manage your bookings and wishlist</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card h-100 bg-transparent border-0">
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border border-white border-opacity-75 rounded-4 d-none-dark" style="--fn-bg-opacity: .3"></span>
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--fn-bg-opacity: .05"></span>
                      <div class="card-body position-relative z-2">
                        <div class="d-inline-flex position-relative text-info p-3">
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                          <i class="fi-gift position-relative z-2 fs-4 m-1"></i>
                        </div>
                        <h3 class="h6 pt-2 my-2">Earn rewards for future purchases</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card h-100 bg-transparent border-0">
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border border-white border-opacity-75 rounded-4 d-none-dark" style="--fn-bg-opacity: .3"></span>
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--fn-bg-opacity: .05"></span>
                      <div class="card-body position-relative z-2">
                        <div class="d-inline-flex position-relative text-info p-3">
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                          <i class="fi-percent position-relative z-2 fs-4 m-1"></i>
                        </div>
                        <h3 class="h6 pt-2 my-2">Receive exclusive offers and discounts</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card h-100 bg-transparent border-0">
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border border-white border-opacity-75 rounded-4 d-none-dark" style="--fn-bg-opacity: .3"></span>
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--fn-bg-opacity: .05"></span>
                      <div class="card-body position-relative z-2">
                        <div class="d-inline-flex position-relative text-info p-3">
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                          <i class="fi-heart position-relative z-2 fs-4 m-1"></i>
                        </div>
                        <h3 class="h6 pt-2 my-2">Create multiple wishlists</h3>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card h-100 bg-transparent border-0">
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border border-white border-opacity-75 rounded-4 d-none-dark" style="--fn-bg-opacity: .3"></span>
                      <span class="position-absolute top-0 start-0 w-100 h-100 bg-white border rounded-4 d-none d-block-dark" style="--fn-bg-opacity: .05"></span>
                      <div class="card-body position-relative z-2">
                        <div class="d-inline-flex position-relative text-info p-3">
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-white rounded-pill d-none-dark"></span>
                          <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-secondary rounded-pill d-none d-block-dark"></span>
                          <i class="fi-pie-chart position-relative z-2 fs-4 m-1"></i>
                        </div>
                        <h3 class="h6 pt-2 my-2">Pay for purchases by installments</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>


































<?= loadPartial( 'createFooter') ?>