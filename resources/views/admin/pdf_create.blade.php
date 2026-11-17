@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')

<?php
if (count($data) > 0) {
    $uniqueid = $data[0]->uniqueid;
    $pdf = $data[0]->pdf_path ?? '';
    $title = $data[0]->title;
    $pageSlug = $data[0]->page ?? '';
    $created_at = $data[0]->created_at;
    $btnName = "Update";
    $pagetitle = "Update Pdf";
    $status = $data[0]->status;
} else {
    $uniqueid = Request::segment(4);
    $pdf = '';
    $title = '';
    $pageSlug = '';
    $created_at = '';
    $btnName = "Add";
    $pagetitle = "Create Pdf";
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
            <div class="col-md-10">
                <div class="box box-info">
                    <form action="" onsubmit="return updatepdf()">
                        <div class="form-group">
                          <label for="">Title<span class="astric">*</span></label>                              
                          <input type="text" name="title" id="title" placeholder="Enter Your title" class="form-control ckeditor" value="<?php echo $title;?>">                    
                        </div>

                        <div class="form-group">
                            <label for="">PDF</label>
                            <label for="" class="al-uploadfile">
                                <span class="error-msg" id="errorPdfMsg"></span>
                                <input type="file" id="pdfidd" name="pdfidd" onchange="uploadpdf()" accept="application/pdf">
                            </label>
                            <input type="hidden" id="pdf_name" name="pdf_name" value="{{$pdf}}">
                            <input type="hidden" name="pdfPath" id="pdfPath" value="{{$pdf}}">
                            <span id="errorPdf" style="color:red"></span>

                            <div id="edit_pdf">
                                @if($pdf != "")
                                    <a href="{{url('/')}}/assets/upload/pdf/{{$pdf}}" target="_blank">View PDF</a>
                                @endif
                            </div>
                            @if($pdf != "")
                                <button type="button" id="removePdfBtn" class="btn btn-danger btn-sm mt-2">Remove PDF</button>
                            @endif
                            <p class="" id="pdfTest"></p>
                        </div>

                        <div class="form-group">
                            <label for="">Course Type <span class="astric"></span></label>
                            <select class="form-control" id="page" name="page">
                                <option value="">Please select</option>
                                <option value="Full Time Programs Flyer" {{ $pageSlug == 'Full Time Programs Flyer' ? 'selected' : '' }}>Full Time Programs Flyer</option>
                                <option value="Short Intensive Programs Flyer" {{ $pageSlug == 'Short Intensive Programs Flyer' ?'selected' : '' }}>Short Intensive Programs Flyer</option>
                                <option value="Part-Time Weekend Programs Flyer" {{ $pageSlug == 'Part-Time Weekend Programs Flyer' ? 'selected' : '' }}>Part-Time Weekend Programs Flyer</option>
                                <option value="Part-Time Weekend Programs Form" {{ $pageSlug == 'Part-Time Weekend Programs Form' ? 'selected' : '' }}>Part-Time Weekend Programs Form</option>
                                
                            </select>
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
function updatepdf() {
    var pdfidd = $('#pdfidd')[0].files[0];
    var pdf_name = $("#pdf_name").val();
    var pdfPath = $("#pdfPath").val();
    var page = $("#page").val();
    var title = $("#title").val();
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

    if (title === '') {
        $("#wordCnt").html("Please enter title").css("color", "#ff0000");
        $("#title").css("border", "#ff1346 solid 1px");
        return false;
    } else {
        $("#title").css("border", "#d3d3d3 solid 1px");
        $("#wordCnt").html("");
    }

    

    // Validate PDF for home page new entries
    if (page != "home") {
        if (uniqueid === "" && !pdfidd) {
            $("#wordCnt").html("Please choose a PDF.").css("color", "#ff0000");
            $("#pdfidd").css("border", "#ff1346 solid 1px");
            return false;
        } else {
            $("#pdfidd").css("border", "#d3d3d3 solid 1px");
        }
    } else {
        $("#wordCnt").html("");
        $("#pdfidd").css("border", "#d3d3d3 solid 1px");
    }

    $("#wordCnt").html("Please wait...").css("color", "#333333");

    var form = new FormData();
    if (pdfidd) form.append('pdfidd', pdfidd);
    form.append('pdf_name', pdf_name);
    form.append('pdfPath', pdfPath);
    form.append('page', page);
    form.append('title', title);
    form.append('publishingStatus', publishingOption);
    form.append('uniqueid', uniqueid);

    $("#pleasewaitimage").css('display', 'block');
    $.ajax({
        headers: { 'X-CSRF-Token': '{{ csrf_token() }}' },
        type: 'POST',
        url: "{{url('/admin/pdf/addupdate')}}",
        data: form,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#pleasewaitimage").css('display', 'none');
            $("#wordCnt").css("color", data.status === "200" ? "#278428" : "#ff0000").html(data.msg);
            if (data.status === "200") {
                setTimeout(function() { window.location = "/admin/pdf/listing"; }, 2000);
            }
        },
        error: function() {
            $("#pleasewaitimage").css('display', 'none');
            $("#wordCnt").css("color", "#ff0000").html("An error occurred, please try again.");
        }
    });

    return false;
}


function uploadpdf() {
    $("#errorPdfMsg").html("");
    $("#errorPdf").html("");
    var pdf_name = $("#pdf_name").val();

    if (pdf_name) {
        $("#edit_pdf").hide();
    }

    var file = $("#pdfidd")[0].files[0];
    if (!file) return;

    var fileSize = file.size / 1024; // Size in KB
    if (fileSize > 10240) {
        $("#pdf_name").val("");
        $("#pdfidd").val("");
        $("#errorPdfMsg").css("color", "#ff0000").html("PDF size should be less than 10MB");
        return false;
    }

    var extension = file.name.split('.').pop().toLowerCase();
    if (extension !== 'pdf') {
        $("#pdf_name").val("");
        $("#pdfidd").val("");
        $("#errorPdfMsg").css("color", "#ff0000").html("Only PDF files are allowed");
        return false;
    }

    $("#pdfTest").html("Selected PDF: " + file.name);
    $("#pdf_name").val(file.name);
    $("#edit_pdf").hide();
}

function goBack() {
    window.history.back();
}
</script>
<script>
$('#removePdfBtn').click(function () {
    $('#pdf_name').val('');
    $('#pdfPath').val('');
    $('#edit_pdf').hide();
});
</script>