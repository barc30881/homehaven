<?= loadPartial('head') ?>

<?= loadPartial('navbar') ?>








<!-- Form -->
<form class="needs-validation" novalidate="" method="POST" action="<?= url('user/add-property-photos')?>" enctype="multipart/form-data">
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
                <a class="nav-link d-inline-flex position-relative px-0 px-lg-3 active" href="add-property-type.html">
                  <i class="fi-check-circle fs-lg me-2"></i>
                  <span class="hover-effect-underline stretched-link">Property type</span>
                </a>
              </li>
              <li class="nat-item">
                <a class="nav-link d-inline-flex position-relative px-0 px-lg-3 active"
                  href="add-property-location.html">
                  <i class="fi-check-circle fs-lg me-2"></i>
                  <span class="hover-effect-underline stretched-link">Location</span>
                </a>
              </li>
              <li class="nat-item">
                <a class="nav-link d-inline-flex px-0 px-lg-3 pe-none" aria-current="page">
                  <i class="fi-arrow-right-circle d-none d-lg-inline-flex fs-lg me-2"></i>
                  <i class="fi-arrow-down-circle d-lg-none fs-lg me-2"></i>
                 RealCam Photos
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


        <!-- Property photos inputs -->
        <div class="col-lg-9 col-xl-8">
          <h1 class="h2 pb-1 pb-lg-2">RealCam Photos</h1>
            <?= loadPartial('message') ?>
          <p class="fs-sm mb-0">The maximum photo size is 8 MB. Formats: jpeg, jpg, png. Put the main picture first.</p>
          <div class="border rounded p-3">
            <div class="row row-cols-2 row-cols-sm-3 g-2">
           
              <!-- Upload button -->
              <div class="col">
                <div
                  class="d-flex align-items-center justify-content-center position-relative h-100 cursor-pointer bg-body-tertiary border border-2 border-dotted rounded p-3" onclick="document.getElementById('property-photos').click()">
                  <div class="text-center">
                    <i class="fi-plus-circle fs-4 text-secondary-emphasis mb-2"></i>
                    <input type="file" id="property-photos"   name="property_photos[]" accept="image/*" capture="environment" multiple hidden>
                    <div class="hover-effect-underline stretched-link fs-sm fw-medium">Upload RealCam Photos</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


  <!-- Prev / Next navigation (Footer) -->
  <footer class="sticky-bottom bg-body pb-3">
    <div class="progress rounded-0" role="progressbar" aria-label="Dark example" aria-valuenow="42.86" aria-valuemin="0"
      aria-valuemax="100" style="height: 4px">
      <div class="progress-bar bg-dark d-none-dark" style="width: 42.86%"></div>
      <div class="progress-bar bg-light d-none d-block-dark" style="width: 42.86%"></div>
    </div>
    <div class="container d-flex gap-3 pt-3">
      <a class="btn btn-outline-dark animate-slide-start" href="<?= url('user/add-property-location')?>">
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




<script>
const fileInput = document.getElementById('property-photos');
const previewContainer = document.querySelector('.row.row-cols-2'); // grid container
let allFiles = []; // keep all selected files here

// Function to ensure first photo always gets the "Cover" badge
function updateCoverBadge() {
  document.querySelectorAll('.cover-badge').forEach(badge => badge.remove());
  const firstPhoto = previewContainer.querySelector('.col img');
  if (firstPhoto) {
    const wrapper = firstPhoto.closest('.hover-effect-opacity');
    const badge = document.createElement('span');
    badge.className = 'badge text-bg-light position-absolute top-0 start-0 z-3 mt-2 ms-2 cover-badge';
    badge.textContent = 'Cover';
    wrapper.appendChild(badge);
  }
}

// Handle file input change
fileInput.addEventListener('change', function(event) {
  const newFiles = Array.from(event.target.files);

  newFiles.forEach(file => {
    if (!file.type.startsWith("image/")) return;

    // Add file to our global array
    allFiles.push(file);

    const reader = new FileReader();
    reader.onload = function(e) {
      const col = document.createElement("div");
      col.className = "col";

      col.innerHTML = `
        <div class="hover-effect-opacity position-relative overflow-hidden rounded">
          <div class="ratio" style="--fn-aspect-ratio: calc(180 / 268 * 100%)">
            <img src="${e.target.result}" alt="Uploaded image" class="w-100 h-100 object-fit-cover">
          </div>
          <div class="hover-effect-target position-absolute top-0 start-0 d-flex align-items-center justify-content-center w-100 h-100 opacity-0">
            <button type="button" class="btn btn-icon btn-sm btn-light position-relative z-2 remove-photo" aria-label="Remove">
              <i class="fi-trash fs-base"></i>
            </button>
            <span class="position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-25 z-1"></span>
          </div>
        </div>
      `;

      // Remove handler
      col.querySelector(".remove-photo").addEventListener("click", () => {
        const index = allFiles.indexOf(file);
        if (index > -1) {
          allFiles.splice(index, 1); // remove file from array
        }
        col.remove();
        updateCoverBadge();
      });

      // Insert before upload button
      previewContainer.insertBefore(col, previewContainer.lastElementChild);
      updateCoverBadge();
    };

    reader.readAsDataURL(file);
  });

  // Clear input so user can pick same file again later if needed
  fileInput.value = '';
});

// When submitting form: replace normal file input with FormData
document.querySelector("form").addEventListener("submit", function(e) {
 

// before submit, ensure input has the files
  const dataTransfer = new DataTransfer();
  allFiles.forEach(file => dataTransfer.items.add(file));
  fileInput.files = dataTransfer.files;
});

// Run once on load for static images already present in HTML
updateCoverBadge();
</script>


<?= loadPartial('createFooter') ?>