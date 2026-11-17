<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title blue" id="exampleModalLabel">APPOINTMENT WITH COUNSELLOR</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="modalAjaxForm">
          @csrf
          <div class="row g-4 mb-4">
              <div class="col-md-6">
                  <input type="text" name="full_name" class="form-control custom-input" placeholder="Full Name">
                  <input type="hidden" name="page_name" class="form-control custom-input" value="Apply Now">
              </div>
              <div class="col-md-6">
                  <input type="email" name="email" class="form-control custom-input" placeholder="Email Address">
              </div>
              <div class="col-md-4">
                  <input type="local-date" name="date_time" id="date_time" class="form-control custom-input datepicker" placeholder="Preferred Date and Time">
              </div>
              <div class="col-md-4">
                  <input type="tel" name="mobile" class="form-control custom-input" placeholder="Mobile Number">
              </div>
              <div class="col-md-4">
                  <select name="program" class="form-control custom-input programSelection">
                      <option value="">Interested Program</option>
                      <option value="Advanced Diploma in Pastry & Bakery Arts">Advanced Diploma in Pastry & Bakery Arts</option>
                      <option value="Advanced Diploma in Culinary Arts">Advanced Diploma in Culinary Arts</option>
                      <option value="Bachelor Degree – Full Time Course">Bachelor Degree – Full Time Course</option>
                      <option value="Weekend Part-Time Pastry Program">Weekend Part-Time Pastry Program</option>
                      <option value="Weekend Part-Time Culinary Program">Weekend Part-Time Culinary Program</option>
                  </select>
              </div>
          </div>

          <div class="mb-4">
              <div class="custom-checkbox">
                  <input class="form-check-input" type="checkbox" name="privacy" required="" id="modalPrivacy">
                  <label class="form-check-label" for="modalPrivacy">
                      Please tick this box to indicate that you understand that your personal data will be used in accordance with the Privacy Policy here *
                  </label>
              </div>
          </div>
          <div id="modalSuccessMsg"></div>
          <div class="text-center my-10">
              <button type="submit" class="btn blue-btn modal-submitbtn">Submit</button>
          </div>
        </form>
       
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
    $('#exampleModal').on('shown.bs.modal', function () {
    $('#date_time').datetimepicker({
        format: 'Y-m-d h:i A', // Match validation format
        step: 15,
        minDate: 0,
        ampm: true
    });
});

    $(".modal-submitbtn").click(function (e) {
        e.preventDefault();

        var submitBtnM = $(".modal-submitbtn");
        submitBtnM.prop("disabled", true);

        $(".error-message").remove();
        $("#modalSuccessMsg").html("");

        var formDataM = new FormData($("#modalAjaxForm")[0]);

        $.ajax({
            url: "{{ route('submit.form') }}",
            type: "POST",
            data: formDataM,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#modalSuccessMsg").html('<div class="alert alert-success text-center">✔ ' + response.success + '</div>').fadeIn();
                $("#modalAjaxForm")[0].reset();

                setTimeout(function () {
                    $("#modalSuccessMsg").fadeOut();
                }, 3000);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $("input[name='" + key + "'], select[name='" + key + "']").after('<div class="error-message text-danger">' + value[0] + '</div>');
                    });
                }
            },
            complete: function () {
                submitBtnM.prop("disabled", false);
            }
        });
    });
});
</script>