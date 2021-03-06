<?php
	require(__DATAGEN_CLASSES__ . '/TopicLinkGen.class.php');

	/**
	 * The TopicLink class defined here contains any
	 * customized code for the TopicLink class in the
	 * Object Relational Model.  It represents the "topic_link" table 
	 * in the database, and extends from the code generated abstract TopicLinkGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package Qcodo Website
	 * @subpackage DataObjects
	 * 
	 */
	class TopicLink extends TopicLinkGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objTopicLink->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('TopicLink Object %s',  $this->intId);
		}

		/**
		 * This will refresh all the stats (last post date, message/topic counts) and save the record to the database
		 * @return void
		 */
		public function RefreshStats() {
			$objMessage = Message::QuerySingle(QQ::Equal(QQN::Message()->TopicLinkId, $this->intId), QQ::Clause(QQ::OrderBy(QQN::Message()->PostDate, false), QQ::LimitInfo(1)));
			if ($objMessage)
				$this->dttLastPostDate = $objMessage->PostDate;
			else
				$this->dttLastPostDate = null;

			$this->intMessageCount = Message::CountByTopicLinkId($this->intId);
			$this->intTopicCount = Topic::CountByTopicLinkId($this->intId);

			$this->Save();
		}

		/**
		 * Intended to be used for Single-Topic TopicLink objects (e.g. not really useful for "Forum"-based TopicLinks)
		 * @return Topic
		 */
		public function GetTopic() {
			$objTopicArray = $this->GetTopicArray();
			return $objTopicArray[0];
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of TopicLink objects
			return TopicLink::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::TopicLink()->Param1, $strParam1),
					QQ::GreaterThan(QQN::TopicLink()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single TopicLink object
			return TopicLink::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::TopicLink()->Param1, $strParam1),
					QQ::GreaterThan(QQN::TopicLink()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of TopicLink objects
			return TopicLink::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::TopicLink()->Param1, $strParam1),
					QQ::Equal(QQN::TopicLink()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = TopicLink::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`topic_link`.*
				FROM
					`topic_link` AS `topic_link`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return TopicLink::InstantiateDbResult($objDbResult);
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