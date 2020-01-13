<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b><?php echo $MYCFG['GENERAL']['APP_NAME']; ?></b><?php echo $MYCFG['GENERAL']['VERSION']; ?>
	</div>
	<strong>
		&copy;2020 <a href="<?php echo $MYCFG['OFFICE']['URL']; ?>" target="_blank"><?php echo $MYCFG['OFFICE']['NAME'] . ' ' . $MYCFG['OFFICE']['CITY']; ?></a>.
	</strong>
</footer>
<?php echo (isset($js)) ? $js : ''; ?>