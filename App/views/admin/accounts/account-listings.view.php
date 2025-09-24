<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>

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













<!-- Page content -->
<main class="content-wrapper">
    <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
        <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">


            <?= loadPartial('nav-profile') ?>


            <!-- Account profile content -->
            <div class="col-lg-9">
                <h1 class="h2 pb-2 pb-lg-3"> Realtors</h1>

                <!-- Wallet + Account progress -->
                <section class="row g-3 g-xl-4 pb-5 mb-md-3">
                    <div class="col-md-6 col-lg-5 col-xl-6">
                        <div class="card bg-success-subtle border-0 h-100">
                            <div class="card-body">
                                <h3 class="fs-sm fw-normal mb-2">No Of Realtors</h3>
                                <div class="h5 mb-0"><?= $totalUsers ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Table with striped rows -->
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $index => $u): ?>
                                        <tr>
                                            <th scope="row"><?= $index + 1 ?></th>
                                            <td>
                                                <div
                                                    class="d-flex flex-row flex-lg-column align-items-center align-items-lg-start">
                                                    <div class="flex-shrink-0 bg-body-secondary border rounded-circle overflow-hidden"
                                                        style="width: 64px; height: 64px">
                                                        <img src="<?= htmlspecialchars($u->profile_picture ?? url('assets/img/account/avatar.jpg')) ?>"
                                                            alt="Avatar" class="w-100 h-100 object-fit-cover">
                                                    </div>
                                                    <div class="pt-lg-3 ps-3 ps-lg-0">
                                                        <h6 class="mb-1">
                                                            <?= htmlspecialchars($u->firstname . ' ' . $u->lastname) ?></h6>
                                                        <p class="fs-sm mb-0"><?= htmlspecialchars($u->email) ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($u->address) ?></td>
                                            <td><?= htmlspecialchars($u->phonenumber) ?></td>
                                            <td>
                                                <form method="POST" action="/admin/delete-user"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                    <input type="hidden" name="id" value="<?= $u->id ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fi-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No users found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>












            </div>
        </div>
    </div>
</main>















<?= loadPartial('createFooter') ?>