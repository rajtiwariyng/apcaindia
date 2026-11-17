@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')

<?php
if (count($data) > 0) {
    $uniqueid = $data[0]->uniqueid;
    $video = $data[0]->video_path;
    $title  = $data[0]->title;
    $image = $data[0]->image;
    $pages = $data[0]->pages ?? '';
    $content  = $data[0]->content ?? '';
    $created_at = $data[0]->created_at;
    $btnName = "Update";
    $pagetitle = "Update Page";
    $status = $data[0]->status;
} else {
    $uniqueid = Request::segment(4);
    $title  = '';
    $content = '';
    $video = '';
    $image = '';
    $pages='';
    $created_at = '';
    $btnName = "Add";
    $pagetitle = "Create Page";
    $status = "";
}
?>

<style type="text/css">
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
        outline: none;
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
        <h1 class="info-box-text"> {{$pagetitle}} </h1>
    </section>

    <br/><br/>

    <section class="content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-12">
                <div class="box box-info">
                    <form action="" onsubmit="return updatepages()" method="post">
                        <div class="form-group">
                          <label for="">Page Name<span class="astric">*</span></label>                              
                          <input type="text" name="pages" id="pages" placeholder="Enter Your Name" class="form-control" value="<?php echo $pages;?>">                    
                        </div>
                        <div class="form-group">
                          <label for="">Title<span class="astric">*</span></label>                              
                          <input type="text" name="title" id="title" placeholder="Enter Your title" class="form-control" value="<?php echo $title;?>">                    
                        </div>
                        <div class="form-group">
                            <label for="">Image / Thumbnail<span class="astric">*</span></label>
                            <label for="" class="al-uploadfile">
                                <span class="error-msg" id="errorMsg"></span>
                                <input type="file" id="imageidd" name="imageidd" onchange="uploadimg()" accept="image/jpeg,image/png">
                            </label>
                            <input type="hidden" id="image_name" name="image_name" value="{{$image}}">
                            <input type="hidden" name="imagePath" id="imagePath" value="{{$image}}">
                            <span id="error17" style="color:red"></span>

                            <div id="edit_image">
                                @if($image != "")
                                    <img src="{{url('/')}}/assets/upload/pages/{{$image}}" class="img-responsive maxheightclass">
                                @endif
                            </div>
                            <p class="" id="imgTest"></p>
                        </div>

                        <div class="form-group">
                            <label for="">Video</label>
                            <label for="" class="al-uploadfile">
                                <span class="error-msg" id="errorVideoMsg"></span>
                                <input type="file" id="videoidd" name="videoidd" onchange="uploadvideo()" accept="video/mp4,video/mov,video/avi">
                            </label>
                            <input type="hidden" id="video_name" name="video_name" value="{{$video}}">
                            <input type="hidden" name="videoPath" id="videoPath" value="{{$video}}">
                            <span id="errorVideo" style="color:red"></span>

                            <div id="edit_video">
                                @if($video != "")

                                    <video width="320" height="240" controls>
                                        <source src="{{url('/')}}/assets/upload/pages/{{$video}}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>

                                @endif
                            </div>
                             @if($video != "")
                            <button type="button" id="removeVideoBtn" class="btn btn-danger btn-sm mt-2">Remove Video</button>
                            
                            @endif
                            <p class="" id="videoTest"></p>
                        </div>
                        <div class="form-group">
                            <label for="content">Content<span class="astric"></span></label>                    
                             <textarea rows="5" class="form-control ckeditor" id="content" name="content"><?php echo $content;?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Publishing Options <span class="astric"></span></label>
                            <select class="form-control" id="publishingOption" name="publishingOption">
                                <option value="">Please select status</option>
                                <option value="1" <?php if($status == "1") { echo "selected"; } ?>>Published</option>
                                <option value="0" <?php if($status == "0") { echo "selected"; } ?>>Unpublished</option>
                            </select>
                        </div>

                        <div class="clearfix"></div>
                        <div id="wordCnt" style="color:red; text-align:center;"></div>
                        <div class="clearfix"></div>
                        <div class="al-product-btn">
                            <input type="button" onclick="goBack()" class="al-attribute" value="Back">
                            <input type="submit" id="btnSubmit" class="al-attribute" value="{{$btnName}}">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </section>
</div>

@include('Admin::common-file.footer')

<script type="text/javascript">
function updatepages() {
    var imageidd = $('#imageidd')[0].files[0];
    var videoidd = $('#videoidd')[0].files[0];
    var image_name = $("#image_name").val();
    var imagePath = $("#imagePath").val();
    var video_name = $("#video_name").val();
    var videoPath = $("#videoPath").val();
    var pages = $("#pages").val();
    var title = $("#title").val();
    var content = CKEDITOR.instances['content'].getData();
    var publishingOption = $("#publishingOption").val();
    var uniqueid = '{{$uniqueid}}';


    // Validate publishing option
    if (publishingOption === '') {
        $("#wordCnt").html("Please select publishing options").css("color", "#ff0000");
        $("#publishingOption").css("border", "#ff1346 solid 1px");
        return false;
    } else {
        $("#publishingOption").css("border", "#d3d3d3 solid 1px");
        $("#wordCnt").html("");
    }

    // Validate image for new entries
    // if (uniqueid === "" && !imageidd) {
    //     $("#wordCnt").html("Please choose an image.").css("color", "#ff0000");
    //     $("#imageidd").css("border", "#ff1346 solid 1px");
    //     return false;
    // } else {
    //     $("#imageidd").css("border", "#d3d3d3 solid 1px");
    // }

    // Validate video for new entries
    

    $("#wordCnt").html("Please wait...").css("color", "#333333");

    var form = new FormData();
    if (imageidd) form.append('imageidd', imageidd);
    form.append('image_name', image_name);
    form.append('imagePath', imagePath);
    if (videoidd) form.append('videoidd', videoidd);
    form.append('video_name', video_name);
    form.append('videoPath', videoPath);
    form.append('pages', pages);
    form.append('title', title);
    form.append('content', content);
    form.append('publishingStatus', publishingOption);
    form.append('uniqueid', uniqueid);

    $("#pleasewaitimage").css('display', 'block');
    $.ajax({
        headers: { 'X-CSRF-Token': '{{ csrf_token() }}' },
        type: 'POST',
        url: "{{url('/admin/pages/addupdate')}}",
        data: form,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#pleasewaitimage").css('display', 'none');
            $("#wordCnt").css("color", data.status === "200" ? "#278428" : "#ff0000").html(data.msg);
            if (data.status === "200") {
                setTimeout(function() { window.location = "/admin/pages/listing"; }, 2000);
            }
        },
        error: function() {
            $("#pleasewaitimage").css('display', 'none');
            $("#wordCnt").css("color", "#ff0000").html("An error occurred, please try again.");
        }
    });

    return false;
}

function uploadimg() {
    $("#errorMsg").html("");
    $("#error17").html("");
    var image_name = $("#image_name").val();

    if (image_name) {
        $("#edit_image").hide();
    }

    var file = $("#imageidd")[0].files[0];
    if (!file) return;

    var fileSize = file.size / 1024; // Size in KB
    if (fileSize > 2048) {
        $("#image_name").val("");
        $("#imageidd").val("");
        $("#errorMsg").css("color", "#ff0000").html("Image size should be less than 2MB");
        return false;
    }

    var extension = file.name.split('.').pop().toLowerCase();
    if (!['png', 'jpeg', 'jpg'].includes(extension)) {
        $("#image_name").val("");
        $("#imageidd").val("");
        $("#errorMsg").css("color", "#ff0000").html("Image only allows file types of PNG, JPG, JPEG");
        return false;
    }

    var reader = new FileReader();
    reader.onload = function(e) {
        var img = document.createElement("img");
        img.src = e.target.result;
        img.className = "img-responsive maxheightclass";
        $("#imgTest").html(img.outerHTML);
        $("#image_name").val(file.name);
        $("#edit_image").hide();
    };
    reader.readAsDataURL(file);
}

function uploadvideo() {
    $("#errorVideoMsg").html("");
    $("#errorVideo").html("");
    var video_name = $("#video_name").val();

    if (video_name) {
        $("#edit_video").hide();
    }

    var file = $("#videoidd")[0].files[0];
    if (!file) return;

    var fileSize = file.size / 1024; // Size in KB
    if (fileSize > 307200) {
        $("#video_name").val("");
        $("#videoidd").val("");
        $("#errorVideoMsg").css("color", "#ff0000").html("Video size should be less than 300MB");
        return false;
    }

    var extension = file.name.split('.').pop().toLowerCase();
    if (!['mp4', 'mov', 'avi'].includes(extension)) {
        $("#video_name").val("");
        $("#videoidd").val("");
        $("#errorVideoMsg").css("color", "#ff0000").html("Video only allows file types of MP4, MOV, AVI");
        return false;
    }

    var reader = new FileReader();
    reader.onload = function(e) {
        var video = document.createElement("video");
        video.src = e.target.result;
        video.width = 320;
        video.height = 240;
        video.controls = true;
        $("#videoTest").html(video.outerHTML);
        $("#video_name").val(file.name);
        $("#edit_video").hide();
    };
    reader.readAsDataURL(file);
}

function goBack() {
    window.history.back();
}
</script>
<script>
  $('#removeVideoBtn').click(function () {
    $('#video_name').val('');
    $('#videoPath').val('');
    $('#edit_video').hide();
  });
</script>