<?php
$framework = wp_is_writable( framework_path() );
$assets = wp_is_writable( template_path() . 'assets/css/' );

$status = ( $framework && $assets ) ? '<span class="badge-success">OK</span>' : '<span class="badge-error">ERROR</span>';
$writable_msg = '<span class="badge-success">Writable</span>';
$not_writable_msg = '<span class="badge-error">Not Writable</span>';
?>
<h3>
	<?php _e( 'System Status! ', 'spyropress' ); echo $status; ?>
</h3>
<br />
<div class="row-fluid">
    <div class="span2"><strong>Framework Directory:</strong></div>
    <div class="span6"><?php echo framework_path(); ?></div>
    <div class="span2"><?php echo ( $framework ) ? $writable_msg : $not_writable_msg; ?></div>
</div>
<div class="row-fluid">
    <div class="span2"><strong>CSS Directory:</strong></div>
    <div class="span6"><?php echo template_path() . 'assets/css/'; ?></div>
    <div class="span2"><?php echo ( $assets ) ? $writable_msg : $not_writable_msg; ?></div>
</div>
<br />