@include('Admin::common-file.header')
@include('Admin::common-file.sidebar')

<?php 

if(count($data)>0)
{
 $uniqueid=$data[0]->uniqueid;
 $category_name=$data[0]->category_name;
 $image=$data[0]->image_name;
 $img_alt=$data[0]->alt_tag;  
 $btnName="Update";
 $pagetitle="Update Category information";
 $status=$data[0]->status;
}
else
{
$uniqueid =  "";//Request::segment(3);
$category_name='';
$image='';
$img_alt='';

$created_at='';
$btnName="Add";
$pagetitle="Create category information";
$status="";
}

//metaTitle metaKeywords metaDesc
?>

<style type="text/css">
  .adminUploadbtn input {
    position: absolute;
    top: 0;
    /* opacity: 0; */
    cursor: pointer;
    text-indent: -9999px;
    height: 100%;
    max-width: 113px;
}
 .content-wrapper .btn {
    /* background: #b61d22; */
    padding: 7px 15px;
    border: 0;
    box-shadow: none;
    outline: none;
    color: #fff;
    border-radius: 0px;
    font-size: 14px;
}
</style>
  <div class="content-wrapper">
   
    <section class="content-header">
      <h1 class="info-box-text"> {{$pagetitle}}   
      </h1>
   
    </section>

    <br/><br/>

     <section class="content">
      <div class="row">
          <div class="col-md-1"></div>
            <div class="col-md-12">       
          <div class="box box-info">
            <form action="" onsubmit="return upatecmsdata()">    
             <div class="form-group">
                    <label for="">Category Image<span class="astric">*</span></label>
                    <label for="" class="al-uploadfile">
                    <span class="error-msg" id="errorMessage"></span>
                    <span class="error-msg" id="errorMsg"></span>
                    <span class="">
                      <input type="file" id="imageidd" name="imageidd" onchange="uploadimg()" value="{{$image}}">
                    </span>                 
                 
                    <input type="hidden" id="image_name" name="image_name" value="{{$image}}">     
                    <input type="hidden" name="imagePath" id="imagePath" value="{{$image}}" >
                    <span id="error17" style="color:red"></span>
                    </label>

                    <div id="edit_image">
                    @if($image!="")
                      <img src="{{url('/')}}/assets/upload/category/{{$image}}" class="img-responsive maxheightclass">
                    @endif
                    </div>
                    <p class="" id="imgTest"> </p>
                </div> 
                <div class="form-group">
                    <label for="">Img Alt <span class="astric">*</span></label>
                    <input type="text" class="form-control" id="img_alt" name="img_alt" value="<?php echo $img_alt;?>" maxlength="300">
                </div>
                                         
                <div class="form-group">
                    <label for="">Category Name <span class="astric">*</span></label>
                    <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo $category_name;?>">
                </div>   
                <div class="form-group">
                  <label for="">Status <span class="astric"></span></label>                  
                      
                      <select class="form-control" id="status" name="status">                 
                            <option value="">Please select</option>
                            <option value="1" <?php if($status=="1"){echo "selected";}?> >Active</option>
                            <option value="0" <?php if($status=="0"){echo "selected";} ?> >Not Active</option>
                      
                      </select>
                    </div> 

                          <div class="clearfix"></div>
                          <div id="wordCnt" style="color:red"></div>
                          <div class="clearfix"></div>
                          <div class="al-product-btn">                   
                      <input type="button" onclick="goBack()" class="al-attribute" value="Back">
                      <input type="submit" id="btnSubmit" class="al-attribute" value="{{$btnName}}">
                  </div>
        </form>
        
          <div class="col-md-1"></div>
      </div>
    </section>
    
  </div>
  <style type="text/css">
    .maxheightclass{
      height:300px;
    }
  </style>
 @include('Admin::common-file.footer') 

   <script type="text/javascript">
  function upatecmsdata()
  {
    var catgoryName = $("#category_name").val();
    var imageidd =document.getElementById("imageidd").value.trim();
    var imageidd = $('#imageidd')[0].files[0];
    var image_name = $("#image_name").val();
    var imagePath = $("#imagePath").val();
    var img_alt = $("#img_alt").val();
    var status = $("#status").val();
          

  if(imageidd =='')
        {
        document.getElementById("wordCnt").innerHTML="Please choose category image." ;
        $("#imageidd").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#imageidd").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        }
         
         if('{{$uniqueid}}' ==""){
         if(imageidd ==undefined)
        {
        document.getElementById("wordCnt").innerHTML="Please choose category image." ;
        $("#imageidd").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#imageidd").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        }
        }
        
        if(catgoryName =='')
        {
        document.getElementById("wordCnt").innerHTML="Please enter category name." ;
        $("#category_name").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#category_name").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        } 

      if(status =='')
        {
        document.getElementById("wordCnt").innerHTML="Please select status" ;
        $("#status").css("border","#ff1346 solid 1px"); 
           $("#wordCnt").css("text-align", "center");
        return false;
        }
        else
        {
          $("#status").css("border","#d3d3d3 solid 1px"); 
          document.getElementById("wordCnt").innerHTML="";
        } 



        $("#wordCnt").css("text-align", "center");
        document.getElementById("wordCnt").style.color = "#333333";
        document.getElementById("wordCnt").innerHTML="Please wait..." ;

        var form = new FormData();
        form.append('category_name', catgoryName);
        form.append('imageidd', imageidd);      
        form.append('image_name', image_name);  
        form.append('imagePath', imagePath);   
        form.append('img_alt', img_alt);   
        form.append('status', status);      

        form.append('uniqueid', '{{$uniqueid}}');     
      $("#pleasewaitimage").css('display','block'); 
  
        $.ajax({
          headers: {'X-CSRF-Token':'{{ csrf_token() }}'},
          type:'POST',
          url: "{{url('/admin/addcategoryinfo')}}",
          data:form, 
          contentType: false,
          processData: false,
          success:function(data){
           console.log(data);
         $("#pleasewaitimage").css('display','none'); 
       //   $("#btnSubmit").attr("disabled", true);
            
             document.getElementById("wordCnt").innerHTML="" ; 
             document.getElementById("wordCnt").style.color = "#ff0000";
             var status = data.status;
             var msg = data.msg;            
          
            if(status=="200"){
              document.getElementById("wordCnt").style.color = "#278428";
              document.getElementById("wordCnt").innerHTML=msg;           
              setTimeout(function() { window.location="/admin/category/categorylisting" }, 2000);
            } else {
              document.getElementById("wordCnt").style.color = "#ff0000";
                  document.getElementById("wordCnt").innerHTML=msg ;
            } 
          }
          }); 

      return false; 
  }
    
   
 var Image_64byte="";
  var filesSelected ="";
  function uploadimg() 
  {
     document.getElementById('error17').innerHTML="";
     var image_name =document.getElementById("image_name").value;
		
     if(image_name!="")
     {
		
       document.getElementById('edit_image').style.display='none';
     }
     
    //$("#hidetxt").css("display", "none");
      var e = document.getElementById("imageidd"),
          t = e.value,
          n = $("#imageidd")[0].files[0].size / 1024;
          if (n > 2048) return document.getElementById("image_name").value = " ", document.getElementById("imageidd").value = "", document.getElementById("errorMsg").style.color = "#ff0000", document.getElementById("errorMsg").innerHTML = "Image size should be less than 2mb", !1;
         var m = document.getElementById("imageidd").value,
          m = m.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, "_");
          m = m.replace(/[^a-zA-Z0-9]/g, "_");
         var l = m.split("_"),
        d = t.substring(t.lastIndexOf(".") + 1).toLowerCase(),
        r = l[3] + "." + d;
    if ("png" != d && "jpeg" != d && "jpg" != d) return document.getElementById("image_name").value = "", document.getElementById("errorMsg").style.color = "#ff0000", document.getElementById("errorMsg").innerHTML = "Image only allows file types of PNG,JPG,JPEG", !1;
    if (document.getElementById("errorMsg").style.color = "", document.getElementById("errorMsg").innerHTML = "", filesSelected = document.getElementById("imageidd").files, filesSelected.length > 0) {
        var g = filesSelected[0],
            a = new FileReader;
        a.onload = function(e) {
            var t = e.target.result,
                n = t.split(",");
            document.getElementById("imagePath").value = n[1];
            var m = document.createElement("img");

            m.src = t, m.className = "img-responsive maxheightclass", document.getElementById("imgTest").innerHTML = m.outerHTML, document.getElementById("image_name").value = r, Image_64byte = document.getElementById("imgTest").innerHTML
						document.getElementById('edit_image').style.display='none';
          
        }, a.readAsDataURL(g)
    }	
}
  </script>

