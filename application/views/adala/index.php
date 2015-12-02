<?php $this->view('header'); ?>

    <!-- Page Content -->
    <div class="container bcontainer" style="min-height:308px;">
	

        <div class="row">
            <!--div class="col-lg-12 text-center" -->
                <!--h1>اختر</h1-->
			<div class="col-md-6 sel1Div">
				<div class="form-group sel1">
					<label for="sel1">تصنيف رئيسي  :</label>
					<select class="form-control" id="sel1">

					</select>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group sel2">
					<label for="sel2">تصنيف فرعي</label>
					<select class="form-control" id="sel2">

					</select>
				</div>
			</div>

                <div class="dd"></div>
				<input type="hidden" id="hiddeninput" value="">
            <!--/div-->
        </div>
        <!-- /.row -->

		<br>
		<!-- row -->
		<div class="col-md-12 documentsTable">

		</div>

		<div class="col-md-6 documentdisplay">

		</div>
		<!-- /.row -->

		<!-- Trigger the modal with a button -->
		<!--button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button-->

		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button style="float: left" type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">االمواد</h4>
					</div>
					<div class="modal-body">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>

		

    </div>
	
<?php $this->view('footer'); ?>

<script type="text/javascript">
	$( document ).ready(function() {
		$( ".documenttype" ).on("click", function(e) {
			e.preventDefault();
			$("#sel1").html('');
			$("#sel2").html('');
			$(".sel2").css("display", "none");
			var sel="";
			sel += '<option value="">اختر تصنيف رئيسي: </option>';
			var id = $(this).attr("id");
			$("#hiddeninput").val(id);
			$(".documentsTable").html('');

			$.ajax({
				type : "POST",
				url : "<?php echo base_url('index.php/adala/getTypes'); ?>",    //Get Primary topics
				data : "id="+id,
				cache: false,
				dataType:'JSON',
				success : function(response) {

					$.each(response, function (i, item) {
							sel += '<option value="' + item.topicID + '">' + item.name + '</option>';
					});

					$("#sel1").append(sel);
					$(".sel1").css("display", "block");

				}
			});


			var documentTypeId= $(this).data("value");
			var dnld_status = $("#dnld_status").val();
			var table ="";

			if(dnld_status == 0){
				 table +='<table id="example" class="display" cellspacing="0" width="100%">'+
					'<thead><tr><th>المادة</th><th>الرقم</th><th>السنة</th></tr></thead><tbody>';
			}else{
				table +='<table id="example" class="display" cellspacing="0" width="100%">'+
					'<thead><tr><th>المادة</th><th>الرقم</th><th>السنة</th><th>تحميل</th></tr></thead><tbody>';
			}

			$.ajax({    // To Display documents in table
				type : "POST",
				url : "<?php echo base_url('index.php/adala/getDocuments'); ?>",    //Get Primary topics
				data : "documentTypeId="+documentTypeId,
				cache: false,
				dataType:'JSON',
				success : function(response) {
					$.each(response, function (i, item) {
						if(dnld_status == 0){
							table += '<tr><td><a data-toggle="modal" data-target="#myModal" class="tddocument" id="'+item.documentId+'" href="#">"'+item.title+'"</a></td>'+
								'<td>"'+item.number+'"</td>'+
								'<td>"'+item.year+'"</td></tr>';
						}else{
							table += '<tr><td><a data-toggle="modal" data-target="#myModal" class="tddocument" id="'+item.documentId+'" href="#">"'+item.title+'"</a></td>'+
								'<td>"'+item.number+'"</td>'+
								'<td>"'+item.year+'"</td>'+
						     	'<td><button value="'+item.documentId+'" type="button" class="btn btn-warning dnld">تحميل</button></td></tr>';
						}

					});
					table += '</tbody></table>';
					$(".documentsTable").append(table);
					$('#example').DataTable( {
						language:{
						"sProcessing":   "جاري التحميل...",
						"sLengthMenu":   "أظهر مُدخلات _MENU_",
						"sZeroRecords":  "لم يُعثر على أية سجلات",
						"sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مُدخل",
						"sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجلّ",
						"sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
						"sInfoPostFix":  "",
						"sSearch":       "ابحث:",
						"sUrl":          "",
						"oPaginate": {
						"sFirst":    "الأول",
							"sPrevious": "السابق",
							"sNext":     "التالي",
							"sLast":     "الأخير"
					}
					}
					});

				}
			});

		});


		$("#sel1").change(function(){
			var topicId = $(this).val();
			var primaryId = $("#hiddeninput").val();
			var dataString = 'topicId='+ topicId + '&primaryId='+ primaryId;
			$("#sel2").html('');
			var sel2="";
			sel2 += '<option value="">اختر تصنيف فرعي: </option>';

			$.ajax({
				type : "POST",
				url : "<?php echo base_url('index.php/adala/getSecondTypes'); ?>",         //Get Secondary topics
				data : dataString,
				cache: false,
				dataType:'JSON',
				success : function(response) {

					$.each(response, function (i, item) {
						sel2 += '<option value="' + item.topicID + '">' + item.name + '</option>';
					});
					$("#sel2").append(sel2);
					$(".sel2").css("display", "block");

				}
			});

		});


		$(document).on("click",'.tddocument', function(e){
			e.preventDefault();
			var documentId = $(this).attr("id");
			$(".modal-body").html('');
			var string="";

			$.ajax({
				type : "POST",
				url : "<?php echo base_url('index.php/adala/getDocumentDisplay'); ?>",    //Get Primary topics
				data : "documentId="+documentId,
				cache: false,
				dataType:'JSON',
				success : function(response) {
					$.each(response, function (i, item) {
						if(item.title != " " || item.text != " "){
							string += '<h4>"'+item.title+'"</h4><br>' +
							'<p>"'+item.text+'"</p><br>';
						}

					});
					$(".modal-body").append(string);
				}
			});

		});

		$(document).on("click",'.dnld', function(e){
			var documentId = $(this).val();
			$.ajax({
				type : "POST",
				url : "<?php echo base_url('index.php/adala/downloadDocumentFile'); ?>",    //Get Primary topics
				data : "documentId="+documentId,
				cache: false,
				dataType:'JSON',
				success : function(response) {

					$.each(response, function (i, item) {
						var file = item.fileName;
						var name = "asd.txt";
						window.location = file;
					});


				}
			});
		});


	});
</script>