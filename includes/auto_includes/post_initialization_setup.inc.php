<?php
		// For Searching using Zend Framework's Lucene Search library
		ini_set('include_path', '.:' . __INCLUDES__);
		require('Zend/Search/Lucene.php');

		// Pull from Session (if applicable)
		if (!QApplication::$CliMode) QApplication::InitializePerson();

		// Other Setup
		QMimeType::$MagicDatabaseFilePath = MIME_MAGIC_PATH;
?>