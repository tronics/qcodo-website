<?php
	/**
	 * An abstract utility class to handle string manipulation.  All methods
	 * are statically available.
	 */
	abstract class QString {
		/**
		 * This faux constructor method throws a caller exception.
		 * The String object should never be instantiated, and this constructor
		 * override simply guarantees it.
		 *
		 * @return void
		 */
		public final function __construct() {
			throw new CallerException('String should never be instantiated.  All methods and variables are publically statically accessible.');
		}

		/**
		 * Returns the first character of a given string, or null if the given
		 * string is null.
		 * @param string $strString 
		 * @return string the first character, or null
		 */
		public final static function FirstCharacter($strString) {
			if (strlen($strString) > 0)
				return substr($strString, 0 , 1);
			else
				return null;
		}

		/**
		 * Returns the last character of a given string, or null if the given
		 * string is null.
		 * @param string $strString 
		 * @return string the last character, or null
		 */
		public final static function LastCharacter($strString) {
			$intLength = strlen($strString);
			if ($intLength > 0)
				return substr($strString, $intLength - 1);
			else
				return null;
		}

		/**
		 * Returns whether or not the given string starts with another string
		 * @param $strString
		 * @param $strStartsWith
		 * @return boolean
		 */
		public final static function IsStartsWith($strString, $strStartsWith) {
			if (substr($strString, 0, strlen($strStartsWith)) == $strStartsWith)
				return true;
			else
				return false;
		}

		/**
		 * Truncates the string to a given length, adding elipses (if needed).
		 * @param string $strString string to truncate
		 * @param integer $intMaxLength the maximum possible length of the string to return (including length of the elipse)
		 * @param bololean $blnHtmlEntities whether or not to escape the text with htmlentities first
		 * @return string the full string or the truncated string with eplise
		 */
		public final static function Truncate($strText, $intMaxLength, $blnHtmlEntities = true) {
			if (strlen($strText) > $intMaxLength) {
				$strText = substr($strText, 0, $intMaxLength - 1);
				if ($blnHtmlEntities) $strText = QApplication::HtmlEntities($strText);
				$strText .= '&hellip;';
				return $strText;
			} else {
				if ($blnHtmlEntities)
					return QApplication::HtmlEntities($strText);
				else
					return $strText;
			}
		}

		/**
		 * Escapes the string so that it can be safely used in as an Xml Node (basically, adding CDATA if needed)
		 * @param string $strString string to escape
		 * @return string the XML Node-safe String
		 */
		public final static function XmlEscape($strString) {
			if ((strpos($strString, '<') !== false) ||
				(strpos($strString, '&') !== false)) {
				$strString = str_replace(']]>', ']]]]><![CDATA[>', $strString);
				$strString = sprintf('<![CDATA[%s]]>', $strString);
			}

			return $strString;
		}

		/**
		 * Obfuscates an email so that it can be outputted as HTML to the page.
		 * @param string $strEmail the email address to obfuscate
		 * @return string the HTML of the obfuscated Email address
		 */
		public static function ObfuscateEmail($strEmail) {
			$strEmail = QApplication::HtmlEntities($strEmail);
			$strEmail = str_replace('@', '<strong style="display: none;">' . md5(microtime()) . '</strong>&#064;<strong style="display: none;">' . md5(microtime()) . '</strong>', $strEmail);
			$strEmail = str_replace('.', '<strong style="display: none;">' . md5(microtime()) . '</strong>&#046;<strong style="display: none;">' . md5(microtime()) . '</strong>', $strEmail);
			return $strEmail;
		}

		/**
		 * Similar to strpos(haystack, needle, [offset]) except "needle" can be a regular expression as well.
		 * Will only work if both the first and last character of "needle" is "/", signifying a regexp-based search.
		 *
		 * NOTE: If a regexp was used, needle WILL be modified to reflect the actual string literal found/used in the search.
		 * 
		 * @param string $strHaystack the contents to search through
		 * @param string $strNeedle the search term itself (either a literal string OR a regexp value)
		 * @param integer $intOffset optional offset value
		 * @return mixed the position number OR false if not found
		 */
		public static function StringPosition($strHaystack, &$strNeedle, $intOffset = null) {
			if ((strlen($strNeedle) >= 3) &&
				(QString::FirstCharacter($strNeedle) == '/') &&
				(QString::LastCharacter($strNeedle) == '/')) {
				$arrMatches = array();
				preg_match_all($strNeedle, $strHaystack, $arrMatches, null, $intOffset);
				if (is_array($arrMatches) && array_key_exists(0, $arrMatches)) {
					$arrMatches = $arrMatches[0];
				} else
					return false;
				if (array_key_exists(0, $arrMatches)) {
					$strNeedle = $arrMatches[0];
				} else
					return false;
			}

			if (is_null($intOffset)) {
				return strpos($strHaystack, $strNeedle);
			} else {
				return strpos($strHaystack, $strNeedle, $intOffset);
			}
		}

		/**
		 * A better version of strrpos which also allows for the use of RegExp-based matching
		 * @param $strHaystack the text content to search through
		 * @param $strNeedle either a plain-text item or a regexp pattern item to search for - if regexp used, this will update as the actual string of the content found
		 * @param $intOffset optional position offset
		 * @return mixed the position number OR false if not found
		 */
		public static function StringReversePosition($strHaystack, &$strNeedle, $intOffset = null) {
			if ((strlen($strNeedle) >= 3) &&
				(QString::FirstCharacter($strNeedle) == '/') &&
				(QString::LastCharacter($strNeedle) == '/')) {
				$arrMatches = array();
				preg_match_all($strNeedle, $strHaystack, $arrMatches);
				$arrMatches = $arrMatches[0];
				if (count($arrMatches)) {
					$strNeedle = $arrMatches[count($arrMatches) - 1];
				} else
					return false;
			}
			
			if (is_null($intOffset)) {
				return strrpos($strHaystack, $strNeedle);
			} else {
				return strrpos($strHaystack, $strNeedle, $intOffset);
			}
		}
	}
?>