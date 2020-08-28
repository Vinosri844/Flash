<!-- <div class="text-muted large mt-2 mb-4 d-block breadcrumb"> -->
    <ol class="breadcrumb">
        <?php 
            $count = 0; 
            if(isset($breadcrumb) && !empty($breadcrumb)):
            foreach($breadcrumb as $key=>$value) {
                if(!empty($value)) {
            ?>
        <li class="breadcrumb-item"><a href="<?php echo $value; ?>"><?php echo ucfirst($key); ?></a></li>
        <?php } else { ?>
        <li class="breadcrumb-item active"><?php echo ucfirst($key); ?></li>
        <?php } $count++; } endif; ?>
    </ol>
<!-- </div> -->