<?php use Framework\Session ;?>

<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>





<!-- Page content -->
<main class="content-wrapper">
  <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
    <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">


      <!-- Sidebar navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
           <?= loadPartial('nav-profile') ?>


      <!-- Account settings content -->
      <div class="col-lg-9">
        <h1 class="h2 pb-2 pb-lg-3">Account settings</h1>

        <!-- Nav pills -->
        <div class="nav overflow-x-auto mb-3">
          <ul class="nav nav-pills flex-nowrap gap-2 pb-2 mb-1" role="tablist">
            <li class="nav-item me-1" role="presentation">
              <button type="button" class="nav-link text-nowrap active" id="personal-info-tab" data-bs-toggle="pill"
                data-bs-target="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">
                Personal info
              </button>
            </li>

          </ul>
        </div>

        <div class="tab-content">

          <!-- Personal info tab -->
          <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
            <div class="vstack gap-4">

          
 

              <!-- Settings form -->
              <form class="needs-validation" novalidate="" method="POST" action="<?= url('user/account-settings')?>" enctype="multipart/form-data">
                <?php loadPartial('errors',[
                'errors'=>$errors ?? []
              ]); ?>
              <?= loadPartial('message') ?>
                  <!-- Profile picture (Avatar) -->
              <div class="d-flex align-items-start align-items-sm-center mb-2">
                <div class="ratio ratio-1x1 hover-effect-opacity bg-body-tertiary border rounded-circle overflow-hidden"
                  style="width: 124px">
                  <!--Preview Image-->
                
                  <img id="profile-preview" src=<?= htmlspecialchars(Session::get('user')['profile_picture'] ?? '') ?? 'Micheal' ?> alt="Avatar">
                  <div
                    class="hover-effect-target position-absolute top-0 start-0 d-flex align-items-center justify-content-center w-100 h-100 opacity-0">
                   <?php if(empty(Session::get('user')['profile_picture'])) : ?>
                    <button  type="button" class="btn btn-icon btn-sm btn-light position-relative z-2"
                      aria-label="Remove"  onclick="document.getElementById('profile-input').value = '';document.getElementById('profile-preview').src = ''">
                      <i class="fi-trash fs-base"></i>
                    </button>
                  <?php endif ; ?>
                    <span class="position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-25 z-1"></span>
                  </div>
                </div>
                <div class="ps-3 ps-sm-4">
                  <p class="fs-sm" style="max-width: 440px">Your profile photo will appear on your profile and directory
                    listing. PNG or JPG no bigger than 1000px wide and tall.</p>

                    <!--File input (hidden but clickable through button) -->
                  
                    <input type="file" class="d-none btn btn-sm btn-outline-secondary" id="profile-input" name="profilepicture" accept="image/png, image/jpeg" onchange="previewProfile(event)"  <?= !empty(Session::get('user')['profile_picture']) ? 'disabled' : ''?> > 
                   <?php if(empty(Session::get('user')['profile_picture'])) : ?>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('profile-input').click()">
                    <i class="fi-refresh-ccw fs-sm ms-n1 me-2"></i>
                    Update photo
                  </button>
                  <?php endif ;?>
                </div>
              </div>


                <div class="row row-cols-1 row-cols-sm-2 g-4 mb-4">
                  <div class="col position-relative">
                    <label for="fn" class="form-label fs-base">First name *</label>
                    <input type="text" class="form-control form-control-lg" id="fn" value="<?= htmlspecialchars(Session::get('user')['firstname'] ?? '') ?? 'Micheal' ?>" required="" name="firstname"   <?= !empty(Session::get('user')['firstname']) ? 'disabled' : ''?>>
                    <div class="invalid-tooltip bg-transparent p-0">Enter your first name!</div>
                  </div>
                  <div class="col position-relative">
                    <label for="ln" class="form-label fs-base">Last name *</label>
                    <input type="text" class="form-control form-control-lg" id="ln" value="<?= htmlspecialchars( Session::get('user')['lastname'] ?? '') ?? 'Williams' ?>" required="" name="lastname" <?= !empty(Session::get('user')['firstname']) ? 'disabled' : ''?>>
                    <div class="invalid-tooltip bg-transparent p-0">Enter your last name!</div>
                  </div>
                  <div class="col position-relative">
                    <label for="email" class="form-label d-flex align-items-center fs-base">Email address *</label>
                    <input type="email" class="form-control form-control-lg" id="email" value="<?= htmlspecialchars( Session::get('user')['email'] ?? 'example@gmail.com') ?? 'example@gmail.com' ?>"
                      required="" disabled >
                    <div class="invalid-tooltip bg-transparent p-0">Enter a valid email address!</div>
                  </div>
                  <div class="col position-relative">
                    <label for="phone" class="form-label d-flex align-items-center fs-base">Phone number *</label>
                    <input type="tel" class="form-control form-control-lg" id="phone"
                      data-input-format="{&quot;numericOnly&quot;: true, &quot;delimiters&quot;: [&quot;(&quot;, &quot;)&quot;, &quot; &quot;, &quot;-&quot;, &quot; &quot;], &quot;blocks&quot;: [0, 3, 0, 3, 4]}"
                    value="<?= htmlspecialchars( Session::get('user')['phonenumber'] ?? '(212) 555-78900') ?? '(212) 555-78900' ?>" placeholder="(___) ___-____" required="" name="phonenumber"  <?= !empty(Session::get('user')['phonenumber']) ? 'disabled' : ''?> >
                    <div class="invalid-tooltip bg-transparent p-0">Enter a valid phone number!</div>
                  </div>

                  <div class="col">
                    <label class="form-label fs-base">Languages you speak</label>
                    <select name="languages[]" class="form-select form-select-lg" multiple
                      aria-label="Languages select">
                      <option value="" disabled>Select language</option>
                      <option value="English" selected>English</option>
                      <option value="Spanish">Spanish</option>
                      <option value="French">French</option>
                      <option value="German">German</option>
                      <option value="Italian">Italian</option>
                    </select>
                  </div>

                  <div class="col">
                    <label for="birth-date" class="form-label fs-base">Date of birth</label>
                    <div class="position-relative">
                      <input type="date" class="form-control form-control-lg form-icon-end" id="birth-date"
                        data-datepicker="{&quot;dateFormat&quot;: &quot;F j, Y&quot;}" placeholder="Choose date" name="dob" value="<?= htmlspecialchars( Session::get('user')['dob'] ?? 'yyyy/mm/dd') ?? 'yyyy/mm/dd' ?>"   <?= !empty(Session::get('user')['dob']) ? 'disabled' : ''?>>
                    </div>
                  </div>
                </div>
                <div class="position-relative mb-4">
                  <label for="address" class="form-label fs-base">Address *</label>
                  <input type="text" class="form-control form-control-lg" id="address"  value="<?= htmlspecialchars( Session::get('user')['address'] ?? 'New York, Brooklyn') ?? 'New York, Brooklyn' ?>"
                    required="" name="address"  <?= !empty(Session::get('user')['address']) ? 'disabled' : ''?>>
                  <div class="invalid-tooltip bg-transparent p-0">Enter your address!</div>
                </div>
                <div class="pb-2 mb-4">
                  <label for="user-info" class="form-label fs-base">Information about you</label>
                  <textarea class="form-control form-control-lg bg-transparent" id="user-info"
                    rows="6" name="Information" <?= !empty(Session::get('user')['information']) ? 'disabled' : ''?>>  <?= htmlspecialchars( Session::get('user')['information'] ?? 'Write a bio about') ?? 'Write a bio about' ?>   </textarea>
                </div>
                <div class="d-flex gap-3">
                  <a class="btn btn-lg btn-secondary" href="#">Cancel</a>
                  <button type="submit" class="btn btn-lg btn-dark" <?= !empty(Session::get('user')['address']) ? 'disabled' : ''?>>Save changes</button>
                </div>
              </form>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</main>








<script>
function previewProfile(event) {
  const reader = new FileReader();
  reader.onload = function(){
    document.getElementById('profile-preview').src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}
</script>


<?= loadPartial('createFooter') ?>