<?= loadPartial('head') ?>

<?= loadPartial('navbar') ?>





<!-- Tour booking form modal -->
<div class="modal fade" id="tourBooking" tabindex="-1" aria-labelledby="tourBookingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px">
        <form class="modal-content needs-validation" novalidate method="POST" action="<?= url('listings/schedule-tour')?>">
            <input type="hidden" name="property_id" value="<?= $property->id ?>">
            <input type="hidden" name="location"
                value="<?= $property->street_address . ', ' . $property->city . ', ' . $property->zip_code ?>">
            <div class="modal-header border-0">
                <h5 class="modal-title">Schedule a tour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-4 pt-0">
                <div class="vstack gap-3">
                    <div class="position-relative">
                        <i class="fi-calendar position-absolute top-50 start-0 translate-middle-y ms-3"></i>

                        <input type="text" name="date" class="form-control form-icon-start bg-transparent"
                            data-datepicker="{&quot;dateFormat&quot;: &quot;M j, Y&quot;}" placeholder="Choose date *"
                            required>
                    </div>
                    <div class="position-relative">
                        <i class="fi-clock position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                        <input type="text" name="time" class="form-control form-icon-start" id="time-12"
                            data-datepicker="{
                  &quot;enableTime&quot;: true,
                  &quot;noCalendar&quot;: true,
                  &quot;dateFormat&quot;: &quot;h:i K&quot;
                }" placeholder="Choose time *" required>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Name *" required>
                    <input type="email" name="email" class="form-control" placeholder="Email *" required>
                    <input type="tel" name="phone" class="form-control" placeholder="Phone number">
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 pb-4 px-4">
                <button type="submit" class="btn btn-lg btn-primary w-100">Schedule a tour</button>
            </div>
        </form>

    </div>
</div>


<!-- Contact form modal -->
<div class="modal fade" id="contactForm" tabindex="-1" aria-labelledby="contactFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px">
        <form class="modal-content needs-validation" method="POST" action="<?= url('listings/contact-realtor')?>" novalidate>
            <div class="modal-header border-0">
                <h5 class="modal-title" id="contactFormLabel">Learn more about this property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-4 pt-0">
                <p class="fs-sm">Complete this form so we can get in touch</p>
                <div class="vstack gap-3">
                    <input type="text" class="form-control" name="name" placeholder="Name *" required>
                    <input type="email" class="form-control" name="email" placeholder="Email *" required>
                    <input type="tel" class="form-control" name="phone" placeholder="Phone number">
                    <textarea class="form-control" name="message" rows="5" placeholder="Write your message"
                        required></textarea>
                    <!-- Include property/location -->
                    <input type="hidden" name="location" value="<?= htmlspecialchars($property->address ?? '') ?>">
                    <input type="hidden" name="realtor_email" value="<?= htmlspecialchars($realtor->email ?? '') ?>">
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 pb-4 px-4">
                <button type="submit" class="btn btn-lg btn-primary w-100 m-0 mb-3">Send message</button>
            </div>
        </form>

    </div>
</div>



<!-- Page content -->
<main class="content-wrapper">
    <div class="container pt-4 pb-5 mb-xxl-3">

        <!-- Breadcrumb -->
        <nav class="pb-2 pb-md-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url('/') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Property for rent</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= htmlspecialchars($property->street_address . ', ' . $property->city . ', ' . $property->zip_code) ?>
                </li>
            </ol>
        </nav>
        <?= loadPartial('message') ?>

        <!-- Image gallery -->
        <div class="row g-3 g-lg-4">
            <div class="col-md-8">
                <?php if (!empty($photos)): ?>
                    <a class="hover-effect-scale hover-effect-opacity position-relative d-flex rounded overflow-hidden"
                        href="<?= $photos[0]->path ?>" data-glightbox="" data-gallery="image-gallery">
                        <i
                            class="fi-zoom-in hover-effect-target fs-3 text-white position-absolute top-50 start-50 translate-middle opacity-0 z-2"></i>
                        <span
                            class="hover-effect-target position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-25 opacity-0 z-1"></span>
                        <div class="ratio hover-effect-target bg-body-tertiary rounded"
                            style="--fn-aspect-ratio: calc(450 / 856 * 100%)">
                            <img src="<?= $photos[0]->path ?>" alt="Image">
                        </div>
                    </a>
                <?php else: ?>
                    <img src="<?= url('assets/img/no-image.jpg')?>" class="rounded" alt="No image">
                <?php endif; ?>
            </div>
            <div class="col-md-4 vstack gap-3 gap-lg-4">
                <?php foreach (array_slice($photos, 1, 2) as $photo): ?>
                    <a class="hover-effect-scale hover-effect-opacity position-relative d-flex rounded overflow-hidden"
                        href="<?= $photo->path ?>" data-glightbox="" data-gallery="image-gallery">
                        <i
                            class="fi-zoom-in hover-effect-target fs-3 text-white position-absolute top-50 start-50 translate-middle opacity-0 z-2"></i>
                        <span
                            class="hover-effect-target position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-25 opacity-0 z-1"></span>
                        <div class="ratio hover-effect-target bg-body-tertiary rounded"
                            style="--fn-aspect-ratio: calc(213 / 416 * 100%)">
                            <img src="<?= $photo->path ?>" alt="Image">
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        </div>



        <!-- Listing details -->
        <div class="row pt-4 pb-2 pb-sm-3 pb-md-4 py-lg-5 mt-sm-2 mt-lg-0">

            <!-- Content sections -->
            <div class="col-lg-8 col-xl-7 pb-3 pb-sm-0 mb-4 mb-sm-5 mb-lg-0">

                <!-- Badges + Sharing and wishlist buttons -->
                <div class="d-flex align-items-center justify-content-between gap-4 mb-3">
                    <div class="d-flex gap-2">
                        <span class="badge text-bg-info d-inline-flex align-items-center">
                            Verified
                            <i class="fi-shield ms-1"></i>
                        </span>
                        <span class="badge text-bg-primary">New</span>
                    </div>

                </div>

                <!-- Price + Address + Facilities -->
                <div class="h3 pb-1 mb-2">$<?= number_format($property->price, 0) ?></div>
                <p class="fs-sm pb-1 mb-2">
                    <?= htmlspecialchars($property->street_address . ', ' . $property->city . ', ' . $property->district . ' ' . $property->zip_code) ?>
                </p>
                <div class="d-flex gap-2 mb-4">
                    <div class="d-flex align-items-center fs-sm gap-1 me-2">
                        <?= $property->bedrooms ?><i class="fi-bed-single fs-base text-secondary-emphasis"></i>
                    </div>
                    <div class="d-flex align-items-center fs-sm gap-1 me-2">
                        <?= $property->bathrooms ?><i class="fi-shower fs-base text-secondary-emphasis"></i>
                    </div>
                    <div class="d-flex align-items-center fs-sm gap-1 me-2">
                        <?= $property->parking ?><i class="fi-car-garage fs-base text-secondary-emphasis"></i>
                    </div>
                    <div class="fs-sm"><?= $property->total_area ?> sq.m</div>
                </div>

                <!-- Info message (Alert) -->
                <div class="alert d-flex alert-secondary fs-sm m-0" role="alert">
                    <i class="fi-info fs-lg pe-1 me-2"></i>
                    <div>We estimate this home will sell faster than 94% nearby.</div>
                </div>

                <!-- About -->
                <h2 class="h5 pt-4 pt-sm-5 mt-3 mt-sm-0">About</h2>
                <p class="fs-sm">
                    <?= nl2br(htmlspecialchars($property->description ?? 'No description available.')) ?>
                </p>

                <!-- General info -->
                <h2 class="h5 pt-4 pt-sm-5 mt-3 mt-sm-0">General information</h2>
                <table class="table table-borderless w-auto fs-sm">
                    <tbody>
                        <tr>
                            <th scope="row">Property type</th>
                            <td><?= $property->property_type ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Year built</th>
                            <td><?= $property->year_built ?? 'N/A' ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Living area</th>
                            <td><?= $property->total_area ?> sq.m</td>
                        </tr>
                        <tr>
                            <th scope="row">Bedrooms</th>
                            <td><?= $property->bedrooms ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Bathrooms</th>
                            <td><?= $property->bathrooms ?></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Amenities -->
                <h2 class="h5 pt-4 pt-sm-5 mt-3 mt-sm-0">Amenities</h2>
                <?php if (!empty($amenities)): ?>
                    <div class="row row-cols-2 row-cols-sm-3 fs-sm gy-3">
                        <?php foreach ($amenities as $am): ?>
                            <div class="col d-flex align-items-center">
                                <i class="fi-check-circle fs-lg me-2 text-success"></i>
                                <?= htmlspecialchars($am->name) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No amenities listed.</p>
                <?php endif; ?>


                <!-- Transportation -->
                <h2 class="h5 pt-4 pt-sm-5 mt-3 mt-sm-0">Transportation</h2>
                <div class="row row-cols-2 row-cols-sm-3 fs-sm gy-3">
                    <div class="col d-flex align-items-center">
                        <i class="fi-footprints fs-lg me-2"></i>
                        <span><span class="fw-semibold">90/100</span> Walkable</span>
                    </div>
                    <div class="col d-flex align-items-center">
                        <i class="fi-car fs-lg me-2"></i>
                        <span><span class="fw-semibold">97%</span> Driveable</span>
                    </div>
                    <div class="col d-flex align-items-center">
                        <i class="fi-bicycle fs-lg me-2"></i>
                        <span><span class="fw-semibold">80/100%</span> Bikeable</span>
                    </div>
                </div>

                <!-- Location -->
                <h2 class="h5 pt-4 pt-sm-5 mt-3 mt-sm-0">Location</h2>


                <!-- Google map -->

                <iframe id="property-map" class="border rounded"
                    src="https://www.google.com/maps?q=<?= urlencode($property->address) ?>&output=embed" width="600"
                    height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" title="Map">
                </iframe>


                <!-- Meta + Sharing and wishlist buttons -->
                <div class="d-flex align-items-center justify-content-between gap-3 pt-4">
                    <div class="d-flex gap-3 fs-sm">
                        <div>Published: <span class="fw-medium text-dark-emphasis">
                                <?= date('M j, Y', strtotime($property->created_at)) ?></span></div>

                    </div>

                </div>
            </div>


            <!-- Sidebar with contact form that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
            <aside class="col-lg-4 offset-xl-1">
                <div class="d-none d-lg-block" style="margin-top: -105px"></div>
                <div class="sticky-lg-top">
                    <div class="d-none d-lg-block" style="height: 105px"></div>
                    <div class="bg-body-tertiary rounded p-4">
                        <div class="p-sm-2 p-lg-0 p-xl-2">
                            <div class="d-flex align-items-center position-relative mb-4">
                                <div class="ratio ratio-1x1 flex-shrink-0 bg-body-secondary rounded-circle overflow-hidden"
                                    style="width: 80px">
                                    <img src="<?= !empty($property->profile_picture)
                                        ? htmlspecialchars($property->profile_picture)
                                        : '/realEstate/assets/img/avatars/default.png' ?>" alt="Avatar">
                                </div>
                                <div class="ps-4">
                                    <h5 class="mb-1">
                                        <a class="hover-effect-underline stretched-link"
                                            href="/realEstate/listings/vendor/<?= $property->user_id ?>">
                                            <?= htmlspecialchars($property->firstname . ' ' . $property->lastname) ?>
                                        </a>

                                    </h5>
                                    <p class="fs-sm mb-0">Realtor</p>
                                </div>
                            </div>
                            <ul class="nav flex-column gap-2 mb-4">
                                <li class="nav-item d-flex align-items-center position-relative">
                                    <i class="fi-mail me-2"></i>
                                    <a class="nav-link hover-effect-underline stretched-link fw-normal text-body p-0"
                                        href="mailto:<?= htmlspecialchars($property->email) ?>"><?= htmlspecialchars($property->email) ?></a>
                                </li>
                                <li class="nav-item d-flex align-items-center position-relative">
                                    <i class="fi-phone me-2"></i>
                                    <a class="nav-link hover-effect-underline stretched-link fw-normal text-body p-0"
                                        href="tel:<?= htmlspecialchars($property->phonenumber) ?>"><?= htmlspecialchars($property->phonenumber) ?></a>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#tourBooking">Schedule a tour</button>
                            <div class="fs-xs text-center pt-1 pb-2 my-2">It's free</div>
                            <div class="d-flex align-items-center mb-3">
                                <hr class="w-100 m-0">
                                <div class="mt-n1 px-3">or</div>
                                <hr class="w-100 m-0">
                            </div>
                            <button type="button" class="btn btn-lg btn-outline-dark w-100" data-bs-toggle="modal"
                                data-bs-target="#contactForm">Send message</button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>


<!-- Back to top button -->
<div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4">
    <a class="btn-scroll-top btn btn-sm bg-body border-0 rounded-pill shadow animate-slide-end" href="#top">
        Top
        <i class="fi-arrow-right fs-base ms-1 me-n1 animate-target"></i>
        <span class="position-absolute top-0 start-0 w-100 h-100 border rounded-pill z-0"></span>
        <svg class="position-absolute top-0 start-0 w-100 h-100 z-1" viewBox="0 0 62 32" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <rect x=".75" y=".75" width="60.5" height="30.5" rx="15.25" stroke="currentColor" stroke-width="1.5"
                stroke-miterlimit="10"></rect>
        </svg>
    </a>
    <a class="btn btn-sm btn-outline-secondary text-uppercase bg-body rounded-pill shadow animate-rotate ms-2 me-n5"
        href="#customizer" style="font-size: .625rem; letter-spacing: .05rem;" data-bs-toggle="offcanvas" role="button"
        aria-controls="customizer">
        Customize<i class="fi-settings fs-base ms-1 me-n2 animate-target"></i>
    </a>
</div>




<!-- Vendor scripts -->
<script src="<?= url('assets/vendor/glightbox/glightbox.min.js')?>"></script>
<script src="<?= url('assets/vendor/flatpickr/flatpickr.min.js') ?>"></script>
<script src="<?= url('assets/vendor/cleave.js/cleave.min.js')?>"></script>

<?= loadPartial('createFooter') ?>

<?= loadPartial('footer') ?>