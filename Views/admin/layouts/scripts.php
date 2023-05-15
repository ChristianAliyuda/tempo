<script src="/assets/admin/js/jquery/jquery-2.0.3.min.js"></script>
<!-- JQUERY UI-->
<script src="/assets/admin/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
<!-- BOOTSTRAP -->
<script src="/assets/admin/bootstrap-dist/js/bootstrap.min.js"></script>


<!-- DATE RANGE PICKER -->
<script src="/assets/admin/js/bootstrap-daterangepicker/moment.min.js"></script>

<script src="/assets/admin/js/bootstrap-daterangepicker/daterangepicker.min.js"></script>
<!-- SLIMSCROLL -->
<script type="text/javascript" src="/assets/admin/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js"></script>
<!-- BLOCK UI -->
<script type="text/javascript" src="/assets/admin/js/jQuery-BlockUI/jquery.blockUI.min.js"></script>
<!-- TYPEHEAD -->
<script type="text/javascript" src="/assets/admin/js/typeahead/typeahead.min.js"></script>
<!-- AUTOSIZE -->
<script type="text/javascript" src="/assets/admin/js/autosize/jquery.autosize.min.js"></script>
<!-- COUNTABLE -->
<script type="text/javascript" src="/assets/admin/js/countable/jquery.simplyCountable.min.js"></script>
<!-- INPUT MASK -->
<script type="text/javascript" src="/assets/admin/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<!-- FILE UPLOAD -->
<script type="text/javascript" src="/assets/admin/js/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<!-- SELECT2 -->
<script type="text/javascript" src="/assets/admin/js/select2/select2.min.js"></script>
<!-- UNIFORM -->
<script type="text/javascript" src="/assets/admin/js/uniform/jquery.uniform.min.js"></script>
<!-- JQUERY UPLOAD -->
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="/assets/admin/js/blueimp/javascript-template/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="/assets/admin/js/blueimp/javascript-loadimg/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="/assets/admin/js/blueimp/javascript-canvas-to-blob/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="/assets/admin/js/blueimp/gallery/jquery.blueimp-gallery.min.js"></script>
<!-- The basic File Upload plugin -->
<script src="/assets/admin/js/jquery-upload/js/jquery.fileupload.min.js"></script>
<!-- The File Upload processing plugin -->
<script src="/assets/admin/js/jquery-upload/js/jquery.fileupload-process.min.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="/assets/admin/js/jquery-upload/js/jquery.fileupload-image.min.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="/assets/admin/js/jquery-upload/js/jquery.fileupload-audio.min.js"></script>
<!-- The File Upload video preview plugin -->
<script src="/assets/admin/js/jquery-upload/js/jquery.fileupload-video.min.js"></script>
<!-- The File Upload validation plugin -->
<script src="/assets/admin/js/jquery-upload/js/jquery.fileupload-validate.min.js"></script>
<!-- The File Upload user interface plugin -->
<script src="/assets/admin/js/jquery-upload/js/jquery.fileupload-ui.min.js"></script>
<!-- The main application script -->
<script src="/assets/admin/js/jquery-upload/js/main.js"></script>
<!-- COOKIE -->
<script type="text/javascript" src="/assets/admin/js/jQuery-Cookie/jquery.cookie.min.js"></script>
<script type="text/javascript" src="/assets/admin/js/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/assets/admin/js/datatables/media/js/jquery.datatables.min.js"></script>
<script type="text/javascript" src="/assets/admin/js/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
<script type="text/javascript" src="/assets/admin/js/datatables/extras/TableTools/media/js/ZeroClipboard.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	tinymce.init({
		selector: 'textarea#editor',
		skin: 'bootstrap',
		plugins: 'lists, link, image, media',
		toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
		menubar: false,
	});
</script>
<!-- CUSTOM SCRIPT -->
<script src="/assets/admin/js/script.js"></script>
<script>
	$(document).ready(function() {
		$('#example').DataTable();

	});

	jQuery(document).ready(function() {
		App.setPage("forms"); //Set current page
		App.init(); //Initialise plugins and elements
	});
</script>

<script>
	jQuery(document).ready(function() {

		App.init(); //Initialise plugins and elements
	});
</script>