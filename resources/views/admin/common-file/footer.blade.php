<script type="text/javascript">
	function gotopage(page)
	{
    window.location.href="{{url('/')}}/admin/"+page;
	}

    function goBack() {
  window.history.back();
}

</script>
<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
    <!--   Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>&copy; {{date('Y')}} <a href="/" target="_blank">Academy of Pastry & Culinary Arts India</a> |</strong> All Rights Reserved
  </footer>


</div>
<script type="text/javascript">
function is_url(str)
{
  regexp =  /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
        if (regexp.test(str))
        {
          return true;
        }
        else
        {
          return false;
        }
}
//console.log(is_url("www.example.com"));

</script>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{url('/')}}/admin_assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('/')}}/admin_assets/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="{{url('/')}}/admin_assets/js/adminlte.min.js"></script>

<script src="{{url('/')}}/admin_assets/ckeditor/ckeditor.js"></script>
    
</body>
</html>
