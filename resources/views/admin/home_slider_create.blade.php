@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')

<?php 
if(count($data)>0) {
    $uniqueid   = $data[0]->uniqueid; 
    $category   = $data[0]->category;
    $caption    = $data[0]->caption;
    $order_by   = $data[0]->order_by;
    $image      = $data[0]->image;
    $created_at = $data[0]->created_at;
    $status     = $data[0]->status;

    $btnName    = "Update";
    $pagetitle  = "Update Home Slider";
} else {
    $uniqueid   = Request::segment(4);
    $category   = '';
    $order_by   = '';
    $caption    = '';
    $image      = '';
    $created_at = '';
    $status     = '';

    $btnName    = "Add";
    $pagetitle  = "Create Home Slider";
}
?>

<style>
  .adminUploadbtn input {
    position: absolute;
    top: 0;
    cursor: pointer;
    text-indent: -9999px;
    height: 100%;
    max-width: 113px;
  }
  .content-wrapper .btn {
    padding: 7px 15px;
    border: 0;
    box-shadow: none;
    color: #fff;
    border-radius: 0px;
    font-size: 14px;
  }
  .maxheightclass {
    height: 300px;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1 class="info-box-text"> {{$pagetitle}}</h1>
  </section>

  <br/><br/>

  <section class="content">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-12">
        <div class="box box-info">
          <form action="" onsubmit="return updatehomeslider()" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="">Caption <span class="astric">*</span></label>
              <input type="text" name="caption" id="caption" placeholder="caption" class="form-control" value="{{ $caption }}">
            </div>

            <div class="form-group">
              <label for="">Image <span class="astric">*</span></label>
              <label for="" class="al-uploadfile">
                <span class="error-msg" id="errorMsg"></span>
                <span class="error-msg" id="errorMessage"></span>
                <input type="file" id="imageidd" name="imageidd" onchange="uploadimg()">
                <input type="hidden" id="image_name" name="image_name" value="{{ $image }}">
                <input type="hidden" name="imagePath" id="imagePath" value="{{ $image }}">
                <span id="error17" style="color:red"></span>
              </label>

              <div id="edit_image">
                @if($image!="")
                  <img src="{{ url('/') }}/assets/upload/homeslider/{{ $image }}" class="img-responsive maxheightclass">
                @endif
              </div>
              <p id="imgTest"></p>
            </div>

            <div class="form-group">
              <label for="">Slider for Section</label>
              <select class="form-control" id="category" name="category">
                <option value="">Select Section</option>
                <option value="section 1" {{ $category == 'section 1' ? 'selected' : '' }}>Section 1</option>
                <option value="section 2" {{ $category == 'section 2' ? 'selected' : '' }}>Section 2</option>
              </select>
            </div>

            <div class="form-group">
              <label for="order_by">Order <span class="astric">*</span></label>
              <input type="text" name="order_by" id="order_by" placeholder="Slider Order" class="form-control" value="{{ $order_by }}" maxlength="2">
            </div>

            <div class="form-group">
              <label for="">Publishing options</label>
              <select class="form-control" id="publishingOption" name="publishingOption">
                <option value="">Please select status</option>
                <option value="1" {{ $status=="1" ? 'selected' : '' }}>Published</option>
                <option value="0" {{ $status=="0" ? 'selected' : '' }}>Unpublished</option>
              </select>
            </div>

            <div class="clearfix"></div>
            <div id="wordCnt" style="color:red"></div>
            <div class="al-product-btn">
              <input type="button" onclick="goBack()" class="al-attribute" value="Back">
              <input type="submit" id="btnSubmit" class="al-attribute" value="{{ $btnName }}">
            </div>
          </form>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>
  </section>
</div>

@include('Admin::common-file.footer')

<script>
function updatehomeslider() {
  let caption = $("#caption").val().trim();
  let category = $("#category").val();
  let order_by = $("#order_by").val();
  let publishingOption = $("#publishingOption").val();
  let imageidd = $('#imageidd')[0].files[0];
  let image_name = $("#image_name").val();
  let imagePath = $("#imagePath").val();

  if (!caption) {
    showError("Please enter caption.", "#caption");
    return false;
  }

  if (!imageidd && !image_name) {
    showError("Please choose image.", "#imageidd");
    return false;
  }

  if (!category) {
    showError("Please select category.", "#category");
    return false;
  }

  if (!order_by) {
    showError("Please enter order.", "#order_by");
    return false;
  }

  if (!publishingOption) {
    showError("Please select publishing options.", "#publishingOption");
    return false;
  }

  $("#wordCnt").css("text-align", "center").css("color", "#333").html("Please wait...");

  let form = new FormData();
  form.append('caption', caption);
  form.append('category', category);
  form.append('order_by', order_by);
  form.append('publishingStatus', publishingOption);
  form.append('image_name', image_name);
  form.append('imagePath', imagePath);
  form.append('uniqueid', '{{ $uniqueid }}');

  if (imageidd) {
    form.append('imageidd', imageidd);
  }

  $.ajax({
    headers: { 'X-CSRF-Token': '{{ csrf_token() }}' },
    type: 'POST',
    url: "{{ url('/admin/homeslider/addupdate') }}",
    data: form,
    contentType: false,
    processData: false,
    success: function(data) {
      let msgColor = data.status == "200" ? "#278428" : "#ff0000";
      $("#wordCnt").css("color", msgColor).html(data.msg);

      if (data.status == "200") {
        setTimeout(() => window.location.href = "/admin/homeslider/listing", 2000);
      }
    }
  });

  return false;
}

function showError(message, selector) {
  $("#wordCnt").html(message).css("text-align", "center");
  $(selector).css("border", "#ff1346 solid 1px");
}

function uploadimg() {
  $('#error17').html('');
  const fileInput = document.getElementById("imageidd");
  const file = fileInput.files[0];
  const ext = file.name.split('.').pop().toLowerCase();

  if (file.size > 2048 * 1024) {
    resetImageInput("Image size should be less than 2mb");
    return false;
  }

  if (!['jpg', 'jpeg', 'png'].includes(ext)) {
    resetImageInput("Only PNG, JPG, JPEG allowed.");
    return false;
  }

  const reader = new FileReader();
  reader.onload = function (e) {
    const img = `<img src="${e.target.result}" class="img-responsive maxheightclass">`;
    $("#imgTest").html(img);
    $("#imagePath").val(e.target.result.split(",")[1]);
    $("#edit_image").hide();
  };
  reader.readAsDataURL(file);
}

function resetImageInput(msg) {
  $("#imageidd").val("");
  $("#image_name").val("");
  $("#errorMsg").css("color", "#ff0000").html(msg);
}
</script>
