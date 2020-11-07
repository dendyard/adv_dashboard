
</body>


<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/TweenMax.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>

<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/js/bootstrap-notify.js"></script>    


<script src="<?php echo base_url() ?>/assets/js/light-bootstrap-dashboard.js"></script>
<script src="<?php echo base_url() ?>/assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script> 
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js" type="text/javascript"></script> 

<script src="<?php echo base_url() ?>/assets/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/js/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/css/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/css/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/js/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets/js/toastr.js" type="text/javascript"></script>


<script src="<?php echo base_url() ?>/assets/js/bootstrap-select.min.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/adv_main.js"></script> 

<script type="text/javascript">

    $(document).ready(function($){
        
        $('#progress_anim').css("display","none");
        
    
    });
    
    function createDateFormat(val){
        
        var mymm;
        var mydd;
        
        mymm = (((val.getMonth()+1) > 9) ? (val.getMonth()+1) : "0" + (val.getMonth()+1) )
        mydd = ((val.getDate() > 9) ? val.getDate() : "0" + val.getDate() )
        
        mydate = mydd + '-' + mymm + '-' + val.getFullYear()
        return mydate;
    }
    
    function createDateFormatName(val){
        
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July',
             'August', 'September', 'October', 'November', 'December'
          ];
        
        var mymm;
        var mydd;
        
        mymm = monthNames[val.getMonth()];
        mydd = ((val.getDate() > 9) ? val.getDate() : "0" + val.getDate() )
        
        mydate = mydd + '-' + mymm + '-' + val.getFullYear()
        
        console.log(mydate);
        return mydate;
    }

    function checkFile(idSelect,idSelectttd, idInput){
    	var success = true;

        if($(idInput).val() == ""){
        	document.getElementById('progress_anim').style.display = 'none';
            toastr["warning"]("Please choose file.", "Notification");
            success = false;
        }
        else{

        	var maxSizeMb = 20;
            var file = $(idInput)[0].files[0];
            var totalSize = file['size'];
            var totalSizeMb = totalSize  / Math.pow(1024,2);
            // console.log(totalSizeMb);
            var extension = $(idInput).val().split('.').pop().toLowerCase();

        	if(totalSizeMb > maxSizeMb){
                document.getElementById('progress_anim').style.display = 'none';
                toastr["warning"]("Size too large. Make sure to upload less than 20 MB.", "Notification");
                success = false;
            }

            if(extension != 'csv'){
            	document.getElementById('progress_anim').style.display = 'none';
                toastr["warning"]("Incorrect file format selected. Make sure to upload .csv file.", "Notification");
                success = false;
            }
        }

        if(success){
            $(idSelect).attr("disabled",false);
            $(idSelectttd).attr("disabled",false);
        }
                
    }
   
</script>

</body>
</html>