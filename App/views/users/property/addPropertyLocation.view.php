<?= loadPartial('head') ?>

<?= loadPartial('navbar') ?>
  <!-- Vendor styles -->
    <link rel="stylesheet" href="<?= url('assets/vendor/leaflet/leaflet.css')?>">
    <link rel="stylesheet" href="<?= url('assets/vendor/choices.js/choices.min.css')?>">   




<!-- Form -->
<form class="needs-validation" novalidate="" method="POST" action="<?= url('user/add-property-location')?>">
    <input type="hidden" name="_method" value="PUT">
    <!-- Page content -->
    <main class="content-wrapper">
        <div class="container pt-3 pt-sm-4 pt-md-5 pb-5">
            <div class="row pt-lg-2 pt-xl-3 pb-1 pb-sm-2 pb-md-3 pb-lg-4 pb-xl-5">

                <!-- Sidebar navigation -->
                <aside class="col-lg-3 col-xl-4 mb-3" style="margin-top: -100px">
                    <div class="sticky-top overflow-y-auto" style="padding-top: 100px">
                        <ul class="nav flex-lg-column flex-nowrap gap-4 gap-lg-0 text-nowrap pb-2 pb-lg-0">
                            <li class="nat-item">
                                <a class="nav-link d-inline-flex position-relative px-0 px-lg-3 active"
                                    href="add-property-type.html">
                                    <i class="fi-check-circle fs-lg me-2"></i>
                                    <span class="hover-effect-underline stretched-link">Property type</span>
                                </a>
                            </li>
                            <li class="nat-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 pe-none" aria-current="page">
                                    <i class="fi-arrow-right-circle d-none d-lg-inline-flex fs-lg me-2"></i>
                                    <i class="fi-arrow-down-circle d-lg-none fs-lg me-2"></i>
                                    Location
                                </a>
                            </li>
                            <li class="nat-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 disabled">
                                    <i class="fi-circle fs-lg me-2"></i>
                                    Photos and videos
                                </a>
                            </li>
                            <li class="nat-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 disabled">
                                    <i class="fi-circle fs-lg me-2"></i>
                                    Property details
                                </a>
                            </li>
                            <li class="nat-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 disabled">
                                    <i class="fi-circle fs-lg me-2"></i>
                                    Price
                                </a>
                            </li>
                            <li class="nat-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 disabled">
                                    <i class="fi-circle fs-lg me-2"></i>
                                    Contact info
                                </a>
                            </li>
                            <li class="nat-item">
                                <a class="nav-link d-inline-flex px-0 px-lg-3 disabled">
                                    <i class="fi-circle fs-lg me-2"></i>
                                    Ad promotion
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>


                <!-- Property location inputs -->
                <div class="col-lg-9 col-xl-8">
                    <h1 class="h2 pb-1 pb-lg-2">Location</h1>
                        <?= loadPartial('message') ?>
                    <div class="row row-cols-1 row-cols-sm-2 g-3 g-sm-4 pb-3 pb-sm-4 mb-xl-2">
                        <div class="col">
                            <label class="form-label">Country *</label>
                            <select class="form-select form-select-lg" data-select="{
                  &quot;classNames&quot;: {
                    &quot;containerInner&quot;: [&quot;form-select&quot;, &quot;form-select-lg&quot;]
                  },
                  &quot;searchEnabled&quot;: true
                }" aria-label="Country select" required="" name="country">
                                <option value="">Select country</option>
                                <optgroup label="Africa">
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                </optgroup>
                                <optgroup label="Asia">
                                    <option value="China">China</option>
                                    <option value="India">India</option>
                                    <option value="Japan">Japan</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                </optgroup>
                                <optgroup label="Europe">
                                    <option value="Germany">Germany</option>
                                    <option value="France">France</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Spain">Spain</option>
                                </optgroup>
                                <optgroup label="North America">
                                    <option value="United States" selected="">United States</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                </optgroup>
                                <optgroup label="South America">
                                    <option value="Brazil">Brazil</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Chile">Chile</option>
                                    <option value="Peru">Peru</option>
                                </optgroup>
                                <optgroup label="Oceania">
                                    <option value="Australia">Australia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">City *</label>
                            <select class="form-select form-select-lg" data-select="{
                  &quot;classNames&quot;: {
                    &quot;containerInner&quot;: [&quot;form-select&quot;, &quot;form-select-lg&quot;]
                  },
                  &quot;searchEnabled&quot;: true
                }" aria-label="City select" required="" name="city">
                                <option value="">Select city</option>
                                <option value="New York" selected="">New York</option>
                                <option value="Los Angeles">Los Angeles</option>
                                <option value="Chicago">Chicago</option>
                                <option value="Houston">Houston</option>
                                <option value="Phoenix">Phoenix</option>
                                <option value="Philadelphia">Philadelphia</option>
                                <option value="San Antonio">San Antonio</option>
                                <option value="San Diego">San Diego</option>
                                <option value="Dallas">Dallas</option>
                                <option value="San Jose">San Jose</option>
                                <option value="Austin">Austin</option>
                                <option value="Jacksonville">Jacksonville</option>
                            </select>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 g-3 g-sm-4 pb-3 pb-sm-4 mb-xl-2">
                        <div class="col">
                            <label class="form-label">District *</label>
                            <select class="form-select form-select-lg" data-select="{
                  &quot;classNames&quot;: {
                    &quot;containerInner&quot;: [&quot;form-select&quot;, &quot;form-select-lg&quot;]
                  }
                }" aria-label="District select" required="" name="district">
                                <option value="">Select district</option>
                                <option value="Manhattan">Manhattan</option>
                                <option value="Brooklyn" selected="">Brooklyn</option>
                                <option value="The Bronx">The Bronx</option>
                                <option value="Staten Island">Staten Island</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="zip" class="form-label">Zip code *</label>
                            <input type="text" class="form-control form-control-lg" id="zip"  value="11237"
                                placeholder="Enter zip code" required="" name="zip_code">
                        </div>
                    </div>
                    <div class="pb-4 mb-2">
                        <label for="address" class="form-label">Street address *</label>
                        <input type="text" class="form-control form-control-lg" id="address" value="929 Hart Street"
                            placeholder="Enter address" required="" name="street_address">
                    </div>

                    <!-- Map -->
                    <h2 class="h6 mb-2">Display on the map</h2>
                    <p class="fs-sm">You can change the position of the mark on the map.</p>
                    <div class="ratio ratio-21x9 bg-body-tertiary border rounded overflow-hidden" data-map="{
                &quot;tileLayer&quot;: &quot;https://api.maptiler.com/maps/pastel/{z}/{x}/{y}.png?key=rqrCHwDtUZCUA2fCt3vV&quot;,
                &quot;attribution&quot;: &quot;© Maptiler © OpenStreetMap contributors&quot;,
                &quot;zoom&quot;: 14,
                &quot;tileSize&quot;: 512,
                &quot;zoomOffset&quot;: -1,
                &quot;templates&quot;: {
                  &quot;marker&quot;: &quot;<div class=\&quot;map-marker\&quot;><i class=\&quot;fi-map-pin-filled text-primary fs-4\&quot;></i></div>&quot;,
                  &quot;popup&quot;: &quot;<div class=\&quot;p-3\&quot; data-bs-theme=\&quot;light\&quot;><h6 class=\&quot;pb-1 mb-2\&quot;>Property location</h6><p class=\&quot;fs-sm text-body m-0\&quot;>929 Hart Street, Brooklyn, NY, 11237</p></div>&quot;
                }
              }" data-map-markers="[{&quot;coordinates&quot;: {&quot;lat&quot;: 40.719, &quot;lng&quot;: -73.994 }}]">
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Prev / Next navigation (Footer) -->
    <footer class="sticky-bottom bg-body pb-3">
        <div class="progress rounded-0" role="progressbar" aria-label="Dark example" aria-valuenow="28.57"
            aria-valuemin="0" aria-valuemax="100" style="height: 4px">
            <div class="progress-bar bg-dark d-none-dark" style="width: 28.57%"></div>
            <div class="progress-bar bg-light d-none d-block-dark" style="width: 28.57%"></div>
        </div>
        <div class="container d-flex gap-3 pt-3">
            <a class="btn btn-outline-dark animate-slide-start" href="<?= url('user/add-property-type')?>">
                <i class="fi-arrow-left animate-target fs-base ms-n1 me-2"></i>
                Back
            </a>
            <button type="submit" class="btn btn-dark animate-slide-end ms-auto" name="submit">
                Next
                <i class="fi-arrow-right animate-target fs-base ms-2 me-n1"></i>
            </button>

        </div>
    </footer>





</form>












<!-- Vendor scripts -->
<script src="<?= url('assets/vendor/leaflet/leaflet.js')?>"></script>
<script src="<?= url('assets/vendor/choices.js/choices.min.js')?>"></script>

<?= loadPartial('createFooter') ?>