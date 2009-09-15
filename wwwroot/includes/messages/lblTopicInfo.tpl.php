<?php
	$strRelative = QDateTime::Now()->Difference($_CONTROL->ParentControl->objTopic->LastPostDate)->SimpleDisplay();
	if ($strRelative == 'a day')
		$strRelative = 'yesterday';
	else if (!$strRelative)
		$strRelative = 'just now';
	else
		$strRelative .= ' ago';
?>

	<h1><?php _p($_CONTROL->ParentControl->objTopic->Name); ?></h1>
	<h3>
		thread:
		<strong><?php _p($_CONTROL->ParentControl->objTopic->ReplyCount); ?></strong>
		
		&nbsp;|&nbsp;
	
		last: <strong><?php _p($strRelative); ?></strong>
	
		&nbsp;|&nbsp;
	
		started: <strong><?php _p($_CONTROL->ParentControl->strPostStartedLinkText, false)?></strong>
	</h3>