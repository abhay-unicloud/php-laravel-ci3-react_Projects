<?php
$mydata = $this->session->userdata('imported');
$encodedData = json_encode($mydata);
?>

<style>
    .content {
        padding-top: 20px; 
        padding-bottom: 20px; 
    }
</style>

<div class="content">
    <div class="container">
        <form method="post" action="<?php echo base_url('excel_ctrl/saveData'); ?>" >
          <input type="hidden" name="myData" value="<?php echo htmlspecialchars($encodedData); ?>" />
        <h2>Our Data From File</h2>
        <?php if ($mydata): ?>
            <h3>Imported Data:</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <!-- Displaying heading -->
                    <?php $heading = array_shift($mydata); ?>
                    <thead>
                        <tr>
                            <?php foreach ($heading as $values): ?>
                                <th scope="col"><?php echo htmlspecialchars($values) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mydata as $row): ?>
                            <tr>
                                <?php foreach ($row as $rowvalues): ?>
                                    <td><?php echo htmlspecialchars($rowvalues); ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- we decode the data here of json -->
            <?php
    // Decode and print JSON data for debugging
    $decodedData = json_decode($encodedData, true);
    echo "<pre>";
    print_r($decodedData);
    echo "</pre>";
    ?>
      
            <button type="submit" class="btn btn-primary" onclick="">Save To Database</button>
        <?php endif; ?>
        </form>
    </div>
</div>

<!-- Add Bootstrap JS and Popper.js -->
<script>
    function saveToDataBase() {
        var encodedData = "<?php echo htmlspecialchars($encodedData); ?>";
        var redirectUrl = "<?php echo base_url('excel_ctrl/saveData'); ?>?myData=" + encodeURIComponent(encodedData);

        //window.location.href = "php// echo base_url('excel_ctrl/saveData'); ?>";
    }
</script>
