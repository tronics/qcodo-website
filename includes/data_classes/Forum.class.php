<?php
	require(__DATAGEN_CLASSES__ . '/ForumGen.class.php');

	/**
	 * The Forum class defined here contains any
	 * customized code for the Forum class in the
	 * Object Relational Model.  It represents the "forum" table 
	 * in the database, and extends from the code generated abstract ForumGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package Qcodo Website
	 * @subpackage DataObjects
	 * 
	 */
	class Forum extends ForumGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objForum->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('Forum Object %s',  $this->intId);
		}

		/**
		 * Can the user post to this forum?
		 * @param Person $objPerson
		 * @return boolean
		 */
		public function CanUserPost(Person $objPerson) {
			if ($this->blnAnnounceOnlyFlag)
				return ($objPerson->PersonTypeId == PersonType::Administrator);
			else
				return true;
		}

		/**
		 * This will post a new Topic for this forum along with the topic's first / initial message.
		 * 
		 * @param string $strTitle
		 * @param string $strMessageText
		 * @param Person $objPerson
		 * @param QDateTime $dttPostDate
		 * @return Topic
		 */
		public function PostTopic($strTitle, $strFirstMessageText, Person $objPerson, QDateTime $dttPostDate = null) {
			$objTopic = new Topic();
			$objTopic->TopicLink = $this->TopicLink;
			$objTopic->Name = $strTitle;
			$objTopic->Person = $objPerson;
			$objTopic->Save();
			
			$objTopic->PostMessage($strFirstMessageText, $objPerson, $dttPostDate);
			return $objTopic;
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of Forum objects
			return Forum::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::Forum()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Forum()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single Forum object
			return Forum::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Forum()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Forum()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of Forum objects
			return Forum::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::Forum()->Param1, $strParam1),
					QQ::Equal(QQN::Forum()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = Forum::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`forum`.*
				FROM
					`forum` AS `forum`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return Forum::InstantiateDbResult($objDbResult);
		}
*/




		// Override or Create New Properties and Variables
		// For performance reasons, these variables and __set and __get override methods
		// are commented out.  But if you wish to implement or override any
		// of the data generated properties, please feel free to uncomment them.
/*
		protected $strSomeNewProperty;

		public function __get($strName) {
			switch ($strName) {
				case 'SomeNewProperty': return $this->strSomeNewProperty;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'SomeNewProperty':
					try {
						return ($this->strSomeNewProperty = QType::Cast($mixValue, QType::String));
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						return (parent::__set($strName, $mixValue));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
*/
	}
?>