<?php
include('../header.php');
?>
<div class="row show-grid">
  <!-- Customer ROW -->
  <div class="col-md-4">
    <!-- students records -->
    <div class="col-md-12 mb-3">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-0">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">No. of Accepted Organizations</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                <?php
                   $query = "SELECT COUNT(*) FROM tbl_organization WHERE status = '1'";
                   $result = mysqli_query($db, $query) or die(mysqli_error($db));
                   while ($row = mysqli_fetch_array($result)) {
                     echo "$row[0]";
                   }
                // ?> Record(s)
              </div>
            </div>
            <div class="col-auto">
              <h2 class="fa fa-campground"></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col-md-4">
    <!-- Request record -->
    <div class="col-md-12 mb-3">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-0">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">No. of Pending Organization Applications</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                <?php
                  $query = "SELECT COUNT(*) FROM tbl_organization WHERE status = '0'";
                  $result = mysqli_query($db, $query) or die(mysqli_error($db));
                  while ($row = mysqli_fetch_array($result)) {
                    echo "$row[0]";
                  }
                ?> Record(s)
              </div>
            </div>
            <div class="col-auto">
              <h2 class="fa fa-spinner"></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    <div class="col-md-4">
      <!-- Approved record -->
      <div class="col-md-12 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-0">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">No. of Rejected Organization Applications</div>
                <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                  <?php
                  $query = "SELECT COUNT(*) FROM tbl_organization WHERE status = '2'";
                  $result = mysqli_query($db, $query) or die(mysqli_error($db));
                  while ($row = mysqli_fetch_array($result)) {
                    echo "$row[0]";
                  }
                  ?> Record(s)
                </div>
              </div>
              <div class="col-auto">
                <h2 class="fa fa-times"></h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
include('../footer.php');
?>

