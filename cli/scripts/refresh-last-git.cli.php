<?php
	function RefreshGitData($strRepository, $strRegistryName) {
		$strXml = file_get_contents('http://github.com/api/v2/xml/commits/list/qcodo/' . $strRepository . '/master');
		$objXml = new SimpleXMLElement($strXml);
		$objMostRecentCommit = $objXml->commit[0];
		$strNodeName = 'committed-date';
		$dttCommit = new QDateTime((string) $objMostRecentCommit->$strNodeName);
		
		$strMessage = (string) $objMostRecentCommit->message;
		$strDate = $dttCommit->__toString('DDDD, MMMM D, YYYY');
		$strUrl = (string)  $objMostRecentCommit->url;
		
		Registry::SetValue('gitinfo_' . $strRegistryName . '_message', $strMessage);
		Registry::SetValue('gitinfo_' . $strRegistryName . '_date', $strDate);
		Registry::SetValue('gitinfo_' . $strRegistryName . '_url', $strUrl);
	}

	RefreshGitData('qcodo-website', 'qcodo-website');
	RefreshGitData('qcodo', 'qcodo');
?>