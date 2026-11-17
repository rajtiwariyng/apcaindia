@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')

<?php
if (count($data) > 0) {
    $uniqueid = $data[0]->uniqueid;
    $content = $data[0]->content ?? '';
    $program_title = $data[0]->program_title;
    $students_title = $data[0]->students_title;
    $description = $data[0]->description ?? '';
    $url = $data[0]->url ?? '';
    $created_at = $data[0]->created_at;
    $btnName = "Update";
    $pagetitle = "Update Pdf";
} else {
    $uniqueid = Request::segment(4);
    $content ='';
    $program_title = '';
    $students_title = '';
    $description = '';
    $url = '';
    $created_at = '';
    $btnName = "Add";
    $pagetitle = "Create Pdf";

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
            <div class="col-md-10">
                <div class="box box-info">
                    <form action="" onsubmit="return updateintakecalender()" method="post">
                        <div class="form-group">
                          <label for="">Seaction 1<span class="astric">*</span></label>
                          <textarea rows="5" class="form-control ckeditor" id="content" name="content"><?php echo $content;?></textarea> 
                        </div>

                        <div class="form-group">
                          <label for="">Program Title<span class="astric">*</span></label>                              
                          <input type="text" name="program_title" id="program_title" placeholder="Enter Your program_title" class="form-control ckeditor" value="<?php echo $program_title;?>">                    
                        </div>
                        <div class="form-group">
                          <label for="">Student Title<span class="astric">*</span></label>                              
                          <input type="text" name="students_title" id="students_title" placeholder="Enter Your students_title" class="form-control ckeditor" value="<?php echo $students_title;?>">                    
                        </div>
                        <div class="form-group">
                          <label for="">Description <span class="astric">*</span></label>
                          <textarea rows="5" class="form-control ckeditor" id="description" name="description"><?php echo $description;?></textarea> 
                        </div>

                        <div class="form-group">
                          <label for="">Youtube Video ID (vSnjVGTW8D4)<span class="astric">*</span></label>                              
                          <input type="text" name="url" id="url" placeholder="Enter Your url" class="form-control" value="<?php echo $url;?>">                    
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
function updateintakecalender() {


    var program_title = $("#program_title").val();
    var students_title = $("#students_title").val();
    var url = $("#url").val();
    var content = CKEDITOR.instances['content'].getData();
    var description = CKEDITOR.instances['description'].getData();
    var uniqueid = '{{$uniqueid}}';

    // Validate publishing option
    if (program_title === '') {
        $("#wordCnt").html("Please enter program_title").css("color", "#ff0000");
        $("#program_title").css("border", "#ff1346 solid 1px");
        return false;
    } else {
        $("#program_title").css("border", "#d3d3d3 solid 1px");
        $("#wordCnt").html("");
    }

    if (students_title === '') {
        $("#wordCnt").html("Please enter students_title").css("color", "#ff0000");
        $("#students_title").css("border", "#ff1346 solid 1px");
        return false;
    } else {
        $("#students_title").css("border", "#d3d3d3 solid 1px");
        $("#wordCnt").html("");
    }
    if (url === '') {
        $("#wordCnt").html("Please enter url").css("color", "#ff0000");
        $("#url").css("border", "#ff1346 solid 1px");
        return false;
    } else {
        $("#url").css("border", "#d3d3d3 solid 1px");
        $("#wordCnt").html("");
    }
    if (content === '') {
        $("#wordCnt").html("Please enter content").css("color", "#ff0000");
        $("#content").css("border", "#ff1346 solid 1px");
        return false;
    } else {
        $("#content").css("border", "#d3d3d3 solid 1px");
        $("#wordCnt").html("");
    }
    if (description === '') {
        $("#wordCnt").html("Please enter description").css("color", "#ff0000");
        $("#description").css("border", "#ff1346 solid 1px");
        return false;
    } else {
        $("#description").css("border", "#d3d3d3 solid 1px");
        $("#wordCnt").html("");
    }


    

    // Validate PDF for home page new entries

    $("#wordCnt").html("Please wait...").css("color", "#333333");

    var form = new FormData();
    form.append('content', content);
    form.append('program_title', program_title);
    form.append('students_title', students_title);
    form.append('description', description);
    form.append('url', url);
    form.append('uniqueid', uniqueid);

    $("#pleasewaitimage").css('display', 'block');
    $.ajax({
        headers: { 'X-CSRF-Token': '{{ csrf_token() }}' },
        type: 'POST',
        url: "{{url('/admin/intcontent/addupdate')}}",
        data: form,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#pleasewaitimage").css('display', 'none');
            $("#wordCnt").css("color", data.status === "200" ? "#278428" : "#ff0000").html(data.msg);
            if (data.status === "200") {
              setTimeout(function() {
                  $("#wordCnt").html(""); // Clear the message after 5 seconds
              }, 5000);
          }
        },
        error: function() {
            $("#pleasewaitimage").css('display', 'none');
            $("#wordCnt").css("color", "#ff0000").html("An error occurred, please try again.");
        }
    });

    return false;
}




function goBack() {
    window.history.back();
}
</script>
