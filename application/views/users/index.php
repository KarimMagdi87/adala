<?php $this->view('header'); ?>

<!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-8"></div>

            <table id="example" class="display" cellspacing="0" width="100%">
              <thead>
              <tr>
                  <th>اسم المستخدم</th>
                  <th>تاريخ البدء</th>
                  <th>تاريخ الانتهاء</th>
                  <th>التصنيف</th>
                  <th>صلاحية النسخ</th>
                  <th>صلاحية التحميل</th>
                  <th>صلاحية المستخدم</th>
                  <th>صلاحيات</th>
              </tr>
              </thead>
              <tbody>

              <?php foreach($rowUsers as $ru): ?>
              <tr>
                  <td><?php echo $ru->username; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($ru->start_date)); ?></td>
                  <td><?php echo date('d-m-Y', strtotime($ru->end_date)); ?></td>
                  <td><?php echo $ru->tag; ?></td>
                  <td><?php if($ru->cpy_status == 0){echo "لا";}  else{echo "نعم";} ?></td>
                  <td><?php if($ru->dnld_status == 0) {echo "لا";}  else{echo "نعم";} ?></td>
                  <td><?php if($ru->user_status == 0) {echo "لا";}  else{echo "نعم";}  ?></td>
                  <td>
                      <button id="<?php echo $ru->id; ?>" type="button" data-toggle="tooltip" data-original-title="تفعيل النسخ والتحميل" class="btn btn-success allperm">تفعيل الكل</button>
                      <button id="<?php echo $ru->id; ?>" value="<?php echo $ru->cpy_status; ?>" type="button" data-toggle="tooltip" data-original-title="تفعيل النسخ"  class="btn btn-primary cpyperm">تفعيل النسخ</button>
                      <button id="<?php echo $ru->id; ?>" value="<?php echo $ru->dnld_status; ?>" type="button" data-toggle="tooltip" data-original-title="تفعيل التحميل"  class="btn btn-warning dnldperm">تفعيل التحميل</button>
                      <button id="<?php echo $ru->id; ?>" value="<?php echo $ru->user_status; ?>" type="button" data-toggle="tooltip" data-original-title="تفعيل المستخدم"  class="btn btn-secondary userperm">تعطيل المستخدم</button>
                      <button id="<?php echo $ru->id; ?>" type="button" data-toggle="tooltip" data-original-title="أعاادة كلمة المرور"  class="btn btn-info resetpass">اعادة كلمة المرور</button>
                      <button id="<?php echo $ru->id; ?>" type="button" data-toggle="tooltip" data-original-title="حذف المستخدم"  class="btn btn-danger deluser">حذف</button>
                  </td>
              </tr>
              <?php endforeach; ?>

              </tbody>
            </table>
        </div>
    </div>

<?php $this->view('footer'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $(".allperm").on("click",function(){
            var id = $(this).attr("id");
            //var val = $(this).val();
            $.ajax({
                type : "POST",
                url : "<?php echo base_url('index.php/users/enablAll'); ?>",
                data : 'id='+ id,
                cache: false,
                //dataType:'JSON',
                success : function(response) {
                    window.location.reload(true);
                    $(".msgsuccess").css('display', 'block');
                    $('.msgsuccess').delay(4000).fadeOut(300);
                }
            });
        });


        $(".cpyperm").on("click", function(){
            var id = $(this).attr("id");
            var val = $(this).val();
            var dataString = 'id='+ id + '&val='+ val;
            $.ajax({
                type : "POST",
                url : "<?php echo base_url('index.php/users/enablCopy'); ?>",
                data : dataString,
                cache: false,
                //dataType:'JSON',
                success : function(response) {
                    window.location.reload(true);
                    $(".msgsuccess").css('display', 'block');
                    $('.msgsuccess').delay(4000).fadeOut(300);
                }
            });
        });

        $(".dnldperm").on("click", function(){
            var id = $(this).attr("id");
            var val = $(this).val();
            var dataString = 'id='+ id + '&val='+ val;
            $.ajax({
                type : "POST",
                url : "<?php echo base_url('index.php/users/enablDownload'); ?>",
                data : dataString,
                cache: false,
                //dataType:'JSON',
                success : function(response) {
                    window.location.reload(true);
                    $(".msgsuccess").css('display', 'block');
                    $('.msgsuccess').delay(4000).fadeOut(300);
                }
            });
        });

        $(".userperm").on("click", function(){
            var id = $(this).attr("id");
            var val = $(this).val();
            var dataString = 'id='+ id + '&val='+ val;
            $.ajax({
                type : "POST",
                url : "<?php echo base_url('index.php/users/enablUser'); ?>",
                data : dataString,
                cache: false,
                //dataType:'JSON',
                success : function(response) {
                    // window.location.reload(true);
                    $(".msgsuccess").css('display', 'block');
                    $('.msgsuccess').delay(4000).fadeOut(300);
                    window.location.reload(true);
                }
            });
        });

        $(".resetpass").on("click", function(){
            var id = $(this).attr("id");
            var dataString = 'id='+ id;
            $.ajax({
                type : "POST",
                url : "<?php echo base_url('index.php/users/resetPassword'); ?>",
                data : dataString,
                cache: false,
                //dataType:'JSON',
                success : function(response) {
                    // window.location.reload(true);
                    $(".msgsuccess").css('display', 'block');
                    $('.msgsuccess').delay(4000).fadeOut(300);
                    window.location.reload(true);
                }
            });
        });


        $(".deluser").on("click", function(){
            var id = $(this).attr("id");
            var dataString = 'id='+ id;
            $.ajax({
                type : "POST",
                url : "<?php echo base_url('index.php/users/deleteUser'); ?>",
                data : dataString,
                cache: false,
                //dataType:'JSON',
                success : function(response) {
                    // window.location.reload(true);
                    $(".msgsuccess").css('display', 'block');
                    $('.msgsuccess').delay(4000).fadeOut(300);
                    window.location.reload(true);
                }
            });
        });
    });
</script>
