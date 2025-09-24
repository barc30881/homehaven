<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>









<!-- Page content -->
<main class="content-wrapper">
    <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
        <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">


            <!-- Sidebar navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
            <?= loadPartial('nav-profile') ?>

            <!-- Account listings content -->
            <div class="col-lg-9">
                <h1 class="h2 pb-2 pb-lg-3">My listings</h1>

                <!-- Nav pills -->
                <div class="nav overflow-x-auto mb-2">
                    <ul class="nav nav-pills flex-nowrap gap-2 pb-2 mb-1" role="tablist">
                        <li class="nav-item me-1" role="presentation">
                            <?php if (!empty($properties)): ?>
                                <button type="button" class="nav-link text-nowrap active" id="published-tab"
                                    data-bs-toggle="pill" data-bs-target="#published" role="tab" aria-controls="published"
                                    aria-selected="true">
                                    Published (<?= count($properties) ?>)
                                </button>
                                <?= loadPartial('message') ?>
                            <?php else: ?>
                                <button type="button" class="nav-link text-nowrap active" id="published-tab"
                                    data-bs-toggle="pill" data-bs-target="#published" role="tab" aria-controls="published"
                                    aria-selected="true">
                                    Published (0)
                                </button>
                                <?= loadPartial('message') ?>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">

                    <!-- Published tab -->
                    <div class="tab-pane fade show active" id="published" role="tabpanel"
                        aria-labelledby="published-tab">



                        <!-- my listings -->
                        <div class="vstack gap-4" id="publishedSelection">

                            <?php if (!empty($properties)): ?>
                                <?php foreach ($properties as $property): ?>

                                    <!-- Item -->
                                    <div class="d-sm-flex align-items-center">
                                        <div
                                            class="d-inline-flex position-relative z-2 pt-1 pb-2 ps-2 p-sm-0 ms-2 ms-sm-0 me-sm-2">
                                            <div class="form-check position-relative z-1 fs-lg m-0">

                                            </div>
                                            <span
                                                class="position-absolute top-0 start-0 w-100 h-100 bg-body border rounded d-sm-none"></span>
                                        </div>
                                        <article class="card w-100">
                                            <div class="d-sm-none" style="margin-top: -44px"></div>
                                            <div class="row g-0">
                                                <div class="col-sm-4 col-md-3 rounded overflow-hidden pb-2 pb-sm-0 pe-sm-2">
                                                    <a class="position-relative d-flex h-100 bg-body-tertiary" href="#"
                                                        style="min-height: 174px">
                                                        <?php if (!empty($property->cover_photo)): ?>
                                                            <img src="<?= htmlspecialchars($property->cover_photo) ?>"
                                                                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                                                                alt="<?= htmlspecialchars($property->street_address) ?>">
                                                        <?php else: ?>
                                                            <img src="<?= url('assets/img/listings/real-estate/01.jpg') ?>"
                                                                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                                                                alt="No Image">
                                                        <?php endif; ?>

                                                        <div class="ratio d-none d-sm-block"
                                                            style="--fn-aspect-ratio: calc(180 / 240 * 100%)"></div>
                                                        <div class="ratio ratio-16x9 d-sm-none"></div>
                                                    </a>
                                                </div>
                                                <div class="col-sm-8 col-md-9 align-self-center">
                                                    <div
                                                        class="card-body d-flex justify-content-between p-3 py-sm-4 ps-sm-2 ps-md-3 pe-md-4 mt-n1 mt-sm-0">
                                                        <div class="position-relative pe-3">
                                                            <span
                                                                class="badge text-body-emphasis bg-body-secondary mb-2"><?= htmlspecialchars($property->property_type) ?></span>
                                                            <div class="h5 mb-2">$<?= number_format($property->price, 2) ?>
                                                            </div>
                                                            <a class="stretched-link d-block fs-sm text-body text-decoration-none mb-2"
                                                                href="#!">
                                                                <?= htmlspecialchars($property->street_address . ', ' . $property->city) ?></a>
                                                            <div class="h6 fs-sm mb-0"><?= $property->total_area ?> sq.m</div>
                                                        </div>
                                                        <div class="text-end">
                                                            <div class="fs-xs text-body-secondary mb-3">Created:
                                                                <?= date('d/m/Y', strtotime($property->created_at)) ?>
                                                            </div>
                                                            <div class="d-flex justify-content-end gap-2 mb-3">

                                                                <div class="dropdown">
                                                                    <button type="button"
                                                                        class="btn btn-icon btn-outline-secondary"
                                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                                        aria-label="Settings">
                                                                        <i class="fi-settings fs-base"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <form method="POST" action="<?= url('user/delete-listing')?>"
                                                                                onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                                                                <input type="hidden" name="_method"
                                                                                    value="DELETE">
                                                                                <input type="hidden" name="id"
                                                                                    value="<?= $property->id ?>">
                                                                                <button type="submit"
                                                                                    class="dropdown-item text-danger">
                                                                                    <i class="fi-trash opacity-75 me-2"></i>
                                                                                    Delete
                                                                                </button>
                                                                            </form>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <ul
                                                                class="list-unstyled flex-row flex-wrap justify-content-end fs-sm mb-0">
                                                                <li class="d-flex align-items-center me-2 me-md-3">
                                                                    <i class="fi-eye fs-base me-1"></i>
                                                                    12
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    You don’t have any listings yet.
                                    <a href="<?= url('user/add-property-type')?>" class="btn btn-sm btn-primary ms-2">Add one now</a>.
                                </div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>















<?= loadPartial('createFooter') ?>