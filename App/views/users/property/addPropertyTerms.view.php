<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>




<!-- Form -->
<form class="needs-validation" novalidate="" method="POST" action="<?= url('user/add-property-accept-terms')?>">
  <input type="hidden" name="_method" value="PUT">


 <!-- Page content -->
    <main class="content-wrapper">
      <div class="container pt-4 pt-md-5 pb-5 my-1 mt-sm-3 mt-md-0 mb-sm-2 mb-md-3 mb-lg-4 mb-xl-5">
        <?= loadPartial('message') ?>
        <h1 class="pt-lg-2 pt-xl-3 mb-lg-4">Terms And Condition</h1>
        <p class="mb-2 mb-sm-3">Please read and accept the Terms and condition .</p>


        <!-- Pricing plans -->
       

        <!-- Other services -->
        <h2 class="pt-5 mt-n3 mt-sm-n2 mt-lg-1 mb-xl-4">T/C</h2>

        <!-- Switch -->
        <div class="border-bottom py-4">
          <div class="row py-md-1 py-lg-2 py-xl-3">
            <div class="col-12 col-md-5">
              <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" role="switch" id="certify" name="termsandcondition">
                <label for="certify" class="form-check-label h6 fs-6 ms-md-2 mb-0">Check to accept terms and condition</label>
              </div>
            </div>
            <div class="col-8 col-md-5">
              <p class="fs-sm mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut possimus voluptas provident consequatur eius! Asperiores itaque iure, vitae dolorum earum cum laudantium maxime, quas soluta velit excepturi et sapiente placeat! </p>
            </div>
            <div class="col-4 col-md-2">
              <div class="h5 text-end text-nowrap mb-0"></div>
            </div>
          </div>
        </div>

    
       
      </div>
    </main>


    <!-- Prev / Next navigation (Footer) -->
    <footer class="sticky-bottom bg-body pb-3">
      <div class="progress rounded-0" role="progressbar" aria-label="Dark example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
        <div class="progress-bar bg-dark d-none-dark" style="width: 100%"></div>
        <div class="progress-bar bg-light d-none d-block-dark" style="width: 100%"></div>
      </div>
      <div class="container d-flex align-items-center gap-3 pt-3">
        <div class="h5 mb-0"></div>
        <button type="submit" class="btn btn-primary animate-slide-end ms-auto">Submit and publish</button>
      </div>
    </footer>














  </form>





<?= loadPartial('createFooter') ?>