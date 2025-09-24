


<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>





 <!-- Page content -->
    <main class="content-wrapper">
      <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
        <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">


        <?= loadPartial('nav-profile') ?>
       

          <!-- Account profile content -->
          <div class="col-lg-9">
            <h1 class="h2 pb-2 pb-lg-3">My profile</h1>

            <!-- Wallet + Account progress -->
            <section class="row g-3 g-xl-4 pb-5 mb-md-3">
              <div class="col-md-6 col-lg-5 col-xl-6">
                <div class="card bg-success-subtle border-0 h-100">
                  <div class="card-body">
                    <h3 class="fs-sm fw-normal mb-2">Wallet</h3>
                    <div class="h5 mb-0">$0.00</div>
                  </div>
             
                </div>
              </div>
       
            </section>


            <!-- User info -->
            <section class="pb-5 mb-md-3">
              <div class="ratio ratio-1x1 bg-body-tertiary border rounded-circle overflow-hidden mb-3 mb-md-4" style="width: 124px">
                <img src="<?= htmlspecialchars($user['profile_picture']) ?>" alt="Avatar">
              </div>
              <h2 class="h5 pb-1 pb-sm-0 mb-2 mb-sm-3"> <?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></h2>
              <ul class="list-unstyled flex-row flex-wrap gap-sm-3 fs-sm mb-3">
                <li class="d-flex align-items-center me-2">
                  <i class="fi-mail fs-base me-2"></i>
                 <?= htmlspecialchars($user['email']) ?>
                </li>
                <li class="d-flex align-items-center me-2">
                  <i class="fi-phone fs-base me-2"></i>
                 <?= htmlspecialchars($user['phonenumber']) ?>
                </li>
                <li class="d-flex align-items-center">
                  <i class="fi-map-pin fs-base me-2"></i>
                  <?= htmlspecialchars($user['address']) ?>
                </li>
              </ul>
              <p class="fs-sm pb-sm-1 pb-md-0 mb-md-4"><?= nl2br(htmlspecialchars($user['information'])) ?></p>
               <input type="submit" class="btn btn-outline-secondary" disabled value="Edit profile">
            </section>


          
           

         

       
          </div>
        </div>
      </div>
    </main>

<?= loadPartial('createFooter') ?>