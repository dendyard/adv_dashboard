
</body>


<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/TweenMax.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/DrawSVGPlugin.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/moment.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/js/bootstrap-notify.js"></script>    

<script src="<?php echo base_url() ?>/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="<?php echo base_url() ?>/assets/js/bootstrap-datetimepicker.min.js"></script>

 
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script> 
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js" type="text/javascript"></script> 

<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/xaxis_main.js"></script>  
<script src="<?php echo base_url() ?>/assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/js/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/css/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/css/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/js/toastr.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/js/table-datatables-managed.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function($){
        $('.svg-container').remove();
        $('#bg-wth-full').remove();

        $('#progress_anim').css("display","none");

        <?php if($this->session->flashdata('msg') != ''){ ?>
		toastr["<?php echo $this->session->flashdata('type') ?>"]("<?php echo $this->session->flashdata('msg') ?>", "Notification");
		<?php } ?>
    });
</script>

</body>
</html>