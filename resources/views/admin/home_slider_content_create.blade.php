@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')

<?php 
if(count($data)>0) {
    $uniqueid   = $data[0]->uniqueid; 
    $title      = $data[0]->title;
    $title2      = $data[0]->title2;
    $content    = $data[0]->content;
    $content2    = $data[0]->content2;
  
    $created_at = $data[0]->created_at;
    $status     = $data[0]->status;

    $btnName    = "Update";
    $pagetitle  = "Update Home Slider";
} else {
    $uniqueid   = Request::segment(4);
    $title      = '';
    $title2     = '';
    $content    = '';
    $content2   = '';

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
          <form action="" onsubmit="return updatecontent()" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="">Section 1 Title <span class="astric">*</span></label>
              <input type="text" name="title" id="title" placeholder="title" class="form-control" value="{{ $title }}">
            </div>
            <div class="form-group">
              <label for="">Content <span class="astric">*</span></label>
              <textarea rows="5" class="form-control ckeditor" id="content" name="content"><?php echo $content;?></textarea> 
            </div>

            <div class="form-group">
              <label for="">Section  2 Title <span class="astric">*</span></label>
              <input type="text" name="title2" id="title2" placeholder="title" class="form-control" value="{{ $title2 }}">
            </div>
            <div class="form-group">
              <label for="">Content <span class="astric">*</span></label>
              <textarea rows="5" class="form-control ckeditor" id="content2" name="content2"><?php echo $content2;?></textarea> 
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
function updatecontent() {
  let title = $("#title").val().trim();
  let title2 = $("#title2").val().trim();
  var content = CKEDITOR.instances['content'].getData();
  var content2 = CKEDITOR.instances['content2'].getData();


  if (!title) {
    showError("Please enter caption.", "#title");
    return false;
  }
  if (!title2) {
    showError("Please enter caption.", "#title2");
    return false;
  }



  $("#wordCnt").css("text-align", "center").css("color", "#333").html("Please wait...");

  let form = new FormData();
  form.append('title', title);
  form.append('title2', title2);
  form.append('content', content);
  form.append('content2', content2);
  form.append('content2', content2);
  form.append('uniqueid', '{{$uniqueid}}');

  $.ajax({
    headers: { 'X-CSRF-Token': '{{ csrf_token() }}' },
    type: 'POST',
    url: "{{ url('/admin/homeslidercontent/addupdate') }}",
    data: form,
    contentType: false,
    processData: false,
    success: function(data) {
      let msgColor = data.status == "200" ? "#278428" : "#ff0000";
      $("#wordCnt").css("color", msgColor).html(data.msg);

      
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
