

<div class="col-10 p-0"  id="content">


  <nav class="navbar navbar-expand-lg  text-light p-1 d-block" id="navbar">



    <div class="row align-items-center">

      <div class="col-3 text-start">
       

        <button type="button" class="btn btn-sm btn-warning ms-3" id="fullScreenBtn"> 
          <i class="bi bi-list fs-5 fw-semibold"></i> تكبير الشاشة
        </button>

      </div>


      <div class="col-5 text-center">
      <p class="text-center mb-0 text-uppercase   fw-bolder fs-4" id="dateTime"></p>
      
      </div>

      <div class="col-4 text-end">
        <div class="dropdown">
          <button class="btn btn-light rounded fw-semibold" type="button" data-bs-toggle="dropdown" fw-semibold aria-expanded="false"><i class="bi bi-person-circle"></i>
           <?php echo $_COOKIE['user_name']; ?>
          </button>
          <ul class="dropdown-menu  dropdown-menu-end">
            <li><a class="dropdown-item text-danger fw-semibold" href="../index.php"><i class="bi bi-box-arrow-right pr-3"></i> تسجيل الخروج</a></li>
          </ul>
        </div>
      </div>
    </div>

  </nav>

<script>

function updateDateTime() {
    var now = new Date();

    // Update time
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    // Update date
    var month = now.getMonth() + 1; // Months are zero-based
    var day = now.getDate();
    var year = now.getFullYear();

    var dateTimeString = hours + ':' + minutes + ':' + seconds + ' - ' + month + '/' + day + '/' + year;
    $('#dateTime').text(dateTimeString);
}

// Update the date and time every second
setInterval(updateDateTime, 1000);

// Initial update
updateDateTime();
</script>
