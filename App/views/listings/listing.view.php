<?= loadPartial('head') ?>

<?= loadPartial('navbar') ?>





<!-- Page content -->
<main class="content-wrapper">

    <!-- Hero with search form -->
    <section class="position-relative mt-md-5">
        <div class="container position-relative z-1 pt-5 pt-md-4 pt-xl-5">
            <div class="row pt-lg-3 pt-xl-0 pt-xxl-4 pb-4 pb-md-5 pb-xl-0">
                <div class="col-md-6 col-xxl-5 text-center text-md-start">
                    <h1 class="display-4 pb-sm-1 pb-lg-3">Easy way to find a perfect property</h1>
                    <p class="fs-lg mb-md-0">We provide a complete service for the sale, purchase or rental of real
                        estate.</p>
                </div>
            </div>
            <div class="d-none d-md-block d-lg-none" style="height: 70px"></div>
            <div class="d-none d-lg-block d-xl-none" style="height: 130px"></div>
            <div class="d-none d-xl-block" style="height: 220px"></div>

            <!-- Search form -->
            <div class="row pb-5 pb-md-0">
                <div class="col-xl-10 col-xxl-9">
                    <form method="GET" action="<?= url('listings')?>" class="bg-body border rounded-4 p-2">
                        <div class="row g-0 p-1">
                            <!-- Offer type -->
                            <div class="col-6 col-md-4 d-flex">
                                <select name="offer_type" class="form-select form-select-lg border-0 ps-3">
                                    <option value="">Any</option>
                                    <option value="For rent">For rent</option>
                                    <option value="For sale">For sale</option>
                                </select>
                                <hr class="vr m-0">
                            </div>

                            <!-- Location -->
                            <div class="col-6 col-md-4 d-flex">
                                <select name="location" class="form-select form-select-lg border-0">
                                    <option value="">All locations</option>
                                    <option value="New York">New York</option>
                                    <option value="Los Angeles">Los Angeles</option>
                                    <option value="Chicago">Chicago</option>
                                    <option value="Houston">Houston</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Oyo">Oyo</option>
                                    <option value="Osun">Osun</option>
                                    <option value="Port-hacourt">Port-hacourt</option>
                                    <option value="Kwara">Kwara</option>
                                    <!-- etc -->
                                    <!-- etc -->
                                </select>
                                <hr class="vr d-none d-md-block m-0">
                            </div>

                            <!-- Property type -->
                            <div class="col-md-4 d-flex">
                                <select name="property_type" class="form-select form-select-lg border-0 ps-3">
                                    <option value="">All types</option>
                                    <option value="Houses">Houses</option>
                                    <option value="Apartments">Apartments</option>
                                    <option value="Commercial">Commercial</option>
                                </select>
                                <hr class="vr d-none d-lg-block m-0">
                            </div>
                        </div>

                        <!-- Price range -->
                        <div
                            class="col-lg-5 d-flex flex-column flex-sm-row align-items-sm-center gap-2 gap-sm-3 pt-3 ps-lg-3">
                            <div class="d-flex align-items-center w-100 gap-2 ps-2 ps-lg-0">
                                Price
                                <input type="number" name="price_min" class="form-control" placeholder="Min">
                                <input type="number" name="price_max" class="form-control" placeholder="Max">
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary">
                                Search <i class="fi-search fs-lg ms-2 me-n1"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="d-none d-md-block d-lg-none" style="height: 60px"></div>
            <div class="d-none d-lg-block d-xxl-none" style="height: 90px"></div>
            <div class="d-none d-xxl-block" style="height: 130px"></div>
        </div>

        <!-- Background images -->
        <span class="position-absolute top-0 start-0 w-100 h-100 bg-body-tertiary d-md-none"></span>
        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden mt-xxl-4 d-none d-md-block">
            <div class="position-absolute top-0 start-50 translate-middle-x d-flex gap-4" style="width: 1560px">
                <div style="width: 768px">
                    <div class="d-xl-none" style="height: 295px"></div>
                    <div class="d-none d-xl-block d-xxl-none" style="height: 326px"></div>
                    <div class="d-none d-xxl-block" style="height: 366px"></div>
                    <div class="position-relative overflow-hidden">
                        <div class="position-absolute top-0 z-1 fw-bold"
                            style="right: 0; margin: -75px 96px 0 0; font-size: 128px; color: var(--fn-body-bg)">Buy
                        </div>
                        <div class="ratio bg-body-tertiary rounded overflow-hidden"
                            style="--fn-aspect-ratio: calc(328 / 768 * 100%)">
                            <img src="<?= url('assets/img/home/real-estate/hero/01.jpg')?>" alt="Image">
                        </div>
                    </div>
                </div>
                <div style="width: 306px">
                    <div class="position-relative overflow-hidden">
                        <div class="position-absolute top-0 z-1 fw-bold"
                            style="left: 0; margin: -10px 0 0 -69px; font-size: 128px; color: var(--fn-body-bg); writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(-180deg)">
                            Sell</div>
                        <div class="ratio bg-info rounded overflow-hidden"
                            style="--fn-aspect-ratio: calc(443 / 306 * 100%)">
                            <img src="<?= url('assets/img/home/real-estate/hero/02.png') ?>" alt="Image">
                        </div>
                    </div>
                </div>
                <div style="width: 438px">
                    <div style="height: 117px"></div>
                    <div class="position-relative overflow-hidden">
                        <div class="position-absolute top-0 z-1 fw-bold"
                            style="left: 0; margin: -73px 0 0 -18px; font-size: 128px; color: var(--fn-body-bg)">Rent
                        </div>
                        <div class="ratio bg-body-tertiary rounded overflow-hidden"
                            style="--fn-aspect-ratio: calc(446 / 438 * 100%)">
                            <img src="<?= url('assets/img/home/real-estate/hero/03.jpg') ?>" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


   

   

    <!-- Top offers -->
    <section class="container pt-2 pb-sm-2 pt-sm-3 py-md-4 py-lg-5 mt-xxl-3 mb-xxl-2">
        <div class="d-flex align-items-center justify-content-between gap-4 pb-3 mb-2 mb-sm-3 mb-lg-4">
            <h2 class="h1 mb-0">Top offers</h2>

            <!-- Prev/next buttons -->
            <div class="d-flex gap-2">
                <button type="button"
                    class="btn btn-icon btn-outline-secondary animate-slide-start bg-body rounded-circle me-1"
                    id="offers-prev" aria-label="Prev">
                    <i class="fi-chevron-left fs-lg animate-target"></i>
                </button>
                <button type="button"
                    class="btn btn-icon btn-outline-secondary animate-slide-end bg-body rounded-circle" id="offers-next"
                    aria-label="Next">
                    <i class="fi-chevron-right fs-lg animate-target"></i>
                </button>
            </div>
        </div>

        <!-- Carousel -->
        <div class="swiper pb-5" data-swiper="{
          &quot;slidesPerView&quot;: 1,
          &quot;spaceBetween&quot;: 24,
          &quot;loop&quot;: true,
          &quot;navigation&quot;: {
            &quot;prevEl&quot;: &quot;#offers-prev&quot;,
            &quot;nextEl&quot;: &quot;#offers-next&quot;
          },
          &quot;pagination&quot;: {
            &quot;el&quot;: &quot;.swiper-pagination&quot;,
            &quot;clickable&quot;: true
          },
          &quot;breakpoints&quot;: {
            &quot;460&quot;: {
              &quot;slidesPerView&quot;: 2
            },
            &quot;768&quot;: {
              &quot;slidesPerView&quot;: 3
            },
            &quot;992&quot;: {
              &quot;slidesPerView&quot;: 4
            }
          }
        }">
            
                <div class="swiper-wrapper">
  <?php if (!empty($properties)): ?>
    <?php foreach ($properties as $prop): ?>
      <div class="swiper-slide h-auto">
        <article class="card hover-effect-opacity h-100">
          <div class="card-img-top position-relative bg-body-tertiary overflow-hidden">
            <a class="swiper-wrapper" href="/realEstate/listings/<?= $prop->id ?>">
              <div class="swiper-slide">
                <div class="ratio d-block" style="--fn-aspect-ratio: calc(248 / 362 * 100%)">
                  <img src="<?= htmlspecialchars($prop->cover_photo ?? '/realEstate/assets/img/listings/real-estate/no-image.jpg') ?>" 
                       alt="Image">
                  <span class="position-absolute top-0 start-0 w-100 h-100 z-1"
                        style="background: linear-gradient(180deg, rgba(0,0,0, 0) 0%, rgba(0,0,0, .11) 100%)"></span>
                </div>
              </div>
            </a>
          </div>
          <div class="card-body p-3">
            <div class="pb-1 mb-2">
              <span class="badge text-body-emphasis bg-body-secondary">
                <?= htmlspecialchars($prop->property_type) ?>
              </span>
            </div>
            <div class="h5 mb-2">$<?= number_format($prop->price, 0) ?></div>
            <h3 class="fs-sm fw-normal text-body mb-2">
              <a class="stretched-link text-body" href="/realEstate/listings/<?= $prop->id ?>">
                <?= htmlspecialchars($prop->street_address . ', ' . $prop->city) ?>
              </a>
            </h3>
            <div class="h6 fs-sm mb-0"><?= htmlspecialchars($prop->total_area) ?> sq.m</div>
          </div>
          <div class="card-footer d-flex gap-2 border-0 bg-transparent pt-0 pb-3 px-3 mt-n1">
            <div class="d-flex align-items-center fs-sm gap-1 me-1">
              <?= $prop->bedrooms ?><i class="fi-bed-single fs-base text-secondary-emphasis"></i>
            </div>
            <div class="d-flex align-items-center fs-sm gap-1 me-1">
              <?= $prop->bathrooms ?><i class="fi-shower fs-base text-secondary-emphasis"></i>
            </div>
            <div class="d-flex align-items-center fs-sm gap-1 me-1">
              <?= $prop->parking ?><i class="fi-car-garage fs-base text-secondary-emphasis"></i>
            </div>
          </div>
        </article>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="text-center">No listings available</p>
  <?php endif; ?>



           
            </div>

            <!-- Pagination (Bullets) -->
            <div class="swiper-pagination position-static pt-lg-1 mt-3 mt-sm-4"></div>
        </div>
    </section>


    


   

    


    
</main>






















<!-- Vendor scripts -->
<script src="<?= url('assets/vendor/glightbox/glightbox.min.js') ?>"></script>
<script src="<?= url('assets/vendor/flatpickr/flatpickr.min.js') ?>"></script>
<script src=" <?= url('assets/vendor/cleave.js/cleave.min.js') ?>"></script>

<?= loadPartial('createFooter') ?>

