<div class="row center counters">
<?php
foreach( $stats as $item ) {
    echo '<div class="col-md-3"><strong data-to="' . $item['count'] . '">0</strong><label>' . $item['title'] . '</label></div>';
}
?>
</div>