
<form id="ajaxForm">
    @csrf
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <input type="text" name="full_name" class="form-control custom-input" placeholder="Full Name">
            <input type="hidden" name="page_name" class="form-control custom-input" value="{{ request()->path() }}">
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
        <div class="custom-checkbox pb-3">
            <input class="form-check-input" type="checkbox" name="privacy" required="" id="privacy">
            <label class="form-check-label" for="privacy">
            By submitting this form, you agree to receive WhatsApp communications related to programs and events at APCA India. I have read and acknowledge APCA India's <a href="{{url('/')}}/privacy-policy">Privacy Policy</a> and <a href="{{url('/')}}/terms-and-conditions">Terms of Service</a>
            </label>
        </div>
        <div class="custom-checkbox">
            <input class="form-check-input" type="checkbox" name="privacy1" required="" id="privacy1">
            <label class="form-check-label" for="privacy1">
            Keep me in the loop for marketing newsletters and promotions. 
            </label>
        </div>
    </div>
    <div id="apsuccessmsg"></div>
    <div class="text-center my-10">
        <button type="submit" class="btn blue-btn submitbtn">Submit</button>
    </div>
</form>

<script>
$(document).ready(function () {
    $('#date_time').datetimepicker({
        format: 'Y-m-d h:i A', // Match validation format
        step: 15,
        minDate: 0,
        ampm: true
    });

    $(".submitbtn").click(function (e) {
        e.preventDefault();

        var submitBtn = $(".submitbtn");
        submitBtn.prop("disabled", true);

        $(".error-message").remove();
        $("#apsuccessmsg").html("");

        var formData = new FormData($("#ajaxForm")[0]);

        $.ajax({
            url: "{{ route('submit.form') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#apsuccessmsg").html('<div class="alert alert-success text-center">✔ ' + response.success + '</div>').fadeIn();
                $("#ajaxForm")[0].reset();

                setTimeout(function () {
                    $("#apsuccessmsg").fadeOut();
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
                submitBtn.prop("disabled", false);
            }
        });
    });
});
</script>
