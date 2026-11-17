<section class="contact-us" id="how-to-apply">
                <div class="container">
                  <!-- Header -->
                  <h2 class="title orange fw-medium mb-10">
            Request A Call Back
            </h2>
                  
                
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
                        <div class="col-md-6">
                            <input type="text" name="residence" class="form-control custom-input" placeholder="City of Residence">
                        </div>
                        <div class="col-md-6">
                            <input type="tel" name="mobile" class="form-control custom-input" placeholder="Mobile Number">
                        </div>
                        <div class="col-md-4">
                            <select name="program" class="form-control custom-input programSelection">
                                <option value="">Center Preferred</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Gurgaon">Gurgaon</option>
                                <option value="Bangalore">Bangalore</option>
                            </select>
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

                </div>
              </section>