<?php 
include "../header.php";
include 'resolutions/resolution_view.php';
?>

<div class="page-content ttable">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-dark" id="myTable" width="100%" cellspacing="0">
                    <thead>
                      
                        <tr>
                            <th class="text-center">File</th>
                            <th class="text-center">Event Name</th>

                        </tr>
                     
                    </thead>
                    <tbody>
                    <?php if($resolution) {
                                foreach($resolution as $reso){
                            ?>
                        <tr>
                          <td class="text-center"><a href="../../admin_organization/modules/payments/uploads/<?php echo $reso['filename']; ?>"><?php echo $reso['filename']; ?></a></td>
                          <td class="text-center"><?php echo $reso['event_desc']; ?></td>
                        
                        </tr>

                        <?php } }else{  ?>

                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
include "../footer.php";
?>