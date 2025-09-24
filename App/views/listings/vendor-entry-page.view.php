<?= loadPartial('head') ?>

<?= loadPartial('navbar') ?>


















<!-- Page content -->
<main class="content-wrapper">

    <!-- Cover image -->
    <section class="position-relative bg-body-tertiary">
        <img src="<?= url('assets/img/listings/real-estate/vendor-cover.jpg') ?>"
            class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" alt="Cover image">
        <div class="d-md-none" style="height: 200px"></div>
        <div class="d-none d-md-block d-lg-none" style="height: 260px"></div>
        <div class="d-none d-lg-block d-xl-none" style="height: 300px"></div>
        <div class="d-none d-xl-block" style="height: 340px"></div>
    </section>


    <!-- Vendor details -->
    <section class="container position-relative z-1">
        <div style="margin-top: -128px"></div>
        <div class="bg-body border rounded p-4 px-lg-5">
            <div class="d-flex flex-column gap-4 py-sm-2 py-lg-3">
                <div class="d-md-flex justify-content-between pb-lg-1 mb-md-2">
                    <div class="d-flex align-items-start align-items-md-center mb-3 mb-md-0">
                        <div class="ratio ratio-1x1 bg-body-tertiary border rounded-circle overflow-hidden"
                            style="width: 124px">
                            <img src="<?= $vendor->profile_picture ? htmlspecialchars($vendor->profile_picture) : '/assets/img/account/avatar-lg.jpg' ?>"
                                alt="Avatar">
                        </div>
                        <div class="ps-3 ps-md-4 ms-lg-2">
                            <span class="badge text-bg-info d-inline-flex align-items-center mb-2">
                                Verified
                                <i class="fi-shield ms-1"></i>
                            </span>
                            <h1 class="h4 py-sm-1 mb-2"><?= htmlspecialchars($vendor->firstname . ' ' . $vendor->lastname) ?></h1>
                            <ul class="nav flex-wrap align-items-center gap-2 fs-sm">
                                <li class="text-body-secondary me-2"><?= htmlspecialchars($vendor->address) ?></li>

                            </ul>
                        </div>
                    </div>
                    <div class="ps-md-3 ps-lg-4">
                        <div class="d-flex flex-column flex-sm-row gap-2 mb-md-3">
                            <a class="btn btn-dark" href="tel:<?= htmlspecialchars($vendor->phonenumber) ?>">
                                <i class="fi-phone fs-base ms-n1 me-2"></i>
                               <?= htmlspecialchars($vendor->phonenumber) ?>
                            </a>
                            <a class="btn btn-outline-secondary" href="mailto:<?= htmlspecialchars($vendor->email) ?>">
                                <i class="fi-mail fs-base ms-n1 me-2"></i>
                                Send email
                            </a>
                        </div>

                    </div>
                </div>
                <p class="mb-0 mb-md-2 mb-lg-3"> <?= nl2br(htmlspecialchars($vendor->information)) ?>.</p>

            </div>
        </div>
    </section>






</main>






<!-- Vendor scripts -->
<script src="<?= url('assets/vendor/glightbox/glightbox.min.js') ?>"></script>
<script src="<?= url('assets/vendor/flatpickr/flatpickr.min.js') ?>"></script>
<script src="<?= url('assets/vendor/cleave.js/cleave.min.js') ?>"></script>

<?= loadPartial('createFooter') ?>

