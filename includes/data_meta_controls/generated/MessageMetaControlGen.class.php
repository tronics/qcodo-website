<?php
	/**
	 * This is a MetaControl class, providing a QForm or QPanel access to event handlers
	 * and QControls to perform the Create, Edit, and Delete functionality
	 * of the Message class.  This code-generated class
	 * contains all the basic elements to help a QPanel or QForm display an HTML form that can
	 * manipulate a single Message object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QForm or QPanel which instantiates a MessageMetaControl
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent
	 * code re-generation.
	 * 
	 * @package Qcodo Website
	 * @subpackage MetaControls
	 * property-read Message $Message the actual Message data class being edited
	 * property QLabel $IdControl
	 * property-read QLabel $IdLabel
	 * property QListBox $TopicIdControl
	 * property-read QLabel $TopicIdLabel
	 * property QListBox $TopicLinkIdControl
	 * property-read QLabel $TopicLinkIdLabel
	 * property QListBox $PersonIdControl
	 * property-read QLabel $PersonIdLabel
	 * property QTextBox $MessageControl
	 * property-read QLabel $MessageLabel
	 * property QTextBox $CompiledHtmlControl
	 * property-read QLabel $CompiledHtmlLabel
	 * property QIntegerTextBox $ReplyNumberControl
	 * property-read QLabel $ReplyNumberLabel
	 * property QDateTimePicker $PostDateControl
	 * property-read QLabel $PostDateLabel
	 * property-read string $TitleVerb a verb indicating whether or not this is being edited or created
	 * property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
	 */

	class MessageMetaControlGen extends QBaseClass {
		// General Variables
		protected $objMessage;
		protected $objParentObject;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls that allow the editing of Message's individual data fields
		protected $lblId;
		protected $lstTopic;
		protected $lstTopicLink;
		protected $lstPerson;
		protected $txtMessage;
		protected $txtCompiledHtml;
		protected $txtReplyNumber;
		protected $calPostDate;

		// Controls that allow the viewing of Message's individual data fields
		protected $lblTopicId;
		protected $lblTopicLinkId;
		protected $lblPersonId;
		protected $lblMessage;
		protected $lblCompiledHtml;
		protected $lblReplyNumber;
		protected $lblPostDate;

		// QListBox Controls (if applicable) to edit Unique ReverseReferences and ManyToMany References

		// QLabel Controls (if applicable) to view Unique ReverseReferences and ManyToMany References


		/**
		 * Main constructor.  Constructor OR static create methods are designed to be called in either
		 * a parent QPanel or the main QForm when wanting to create a
		 * MessageMetaControl to edit a single Message object within the
		 * QPanel or QForm.
		 *
		 * This constructor takes in a single Message object, while any of the static
		 * create methods below can be used to construct based off of individual PK ID(s).
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this MessageMetaControl
		 * @param Message $objMessage new or existing Message object
		 */
		 public function __construct($objParentObject, Message $objMessage) {
			// Setup Parent Object (e.g. QForm or QPanel which will be using this MessageMetaControl)
			$this->objParentObject = $objParentObject;

			// Setup linked Message object
			$this->objMessage = $objMessage;

			// Figure out if we're Editing or Creating New
			if ($this->objMessage->__Restored) {
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		 }

		/**
		 * Static Helper Method to Create using PK arguments
		 * You must pass in the PK arguments on an object to load, or leave it blank to create a new one.
		 * If you want to load via QueryString or PathInfo, use the CreateFromQueryString or CreateFromPathInfo
		 * static helper methods.  Finally, specify a CreateType to define whether or not we are only allowed to 
		 * edit, or if we are also allowed to create a new one, etc.
		 * 
		 * @param mixed $objParentObject QForm or QPanel which will be using this MessageMetaControl
		 * @param integer $intId primary key value
		 * @param QMetaControlCreateType $intCreateType rules governing Message object creation - defaults to CreateOrEdit
 		 * @return MessageMetaControl
		 */
		public static function Create($objParentObject, $intId = null, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			// Attempt to Load from PK Arguments
			if (strlen($intId)) {
				$objMessage = Message::Load($intId);

				// Message was found -- return it!
				if ($objMessage)
					return new MessageMetaControl($objParentObject, $objMessage);

				// If CreateOnRecordNotFound not specified, throw an exception
				else if ($intCreateType != QMetaControlCreateType::CreateOnRecordNotFound)
					throw new QCallerException('Could not find a Message object with PK arguments: ' . $intId);

			// If EditOnly is specified, throw an exception
			} else if ($intCreateType == QMetaControlCreateType::EditOnly)
				throw new QCallerException('No PK arguments specified');

			// If we are here, then we need to create a new record
			return new MessageMetaControl($objParentObject, new Message());
		}

		/**
		 * Static Helper Method to Create using PathInfo arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this MessageMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing Message object creation - defaults to CreateOrEdit
		 * @return MessageMetaControl
		 */
		public static function CreateFromPathInfo($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::PathInfo(0);
			return MessageMetaControl::Create($objParentObject, $intId, $intCreateType);
		}

		/**
		 * Static Helper Method to Create using QueryString arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this MessageMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing Message object creation - defaults to CreateOrEdit
		 * @return MessageMetaControl
		 */
		public static function CreateFromQueryString($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::QueryString('intId');
			return MessageMetaControl::Create($objParentObject, $intId, $intCreateType);
		}



		///////////////////////////////////////////////
		// PUBLIC CREATE and REFRESH METHODS
		///////////////////////////////////////////////

		/**
		 * Create and setup QLabel lblId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblId_Create($strControlId = null) {
			$this->lblId = new QLabel($this->objParentObject, $strControlId);
			$this->lblId->Name = QApplication::Translate('Id');
			if ($this->blnEditMode)
				$this->lblId->Text = $this->objMessage->Id;
			else
				$this->lblId->Text = 'N/A';
			return $this->lblId;
		}

		/**
		 * Create and setup QListBox lstTopic
		 * @param string $strControlId optional ControlId to use
		 * @return QListBox
		 */
		public function lstTopic_Create($strControlId = null) {
			$this->lstTopic = new QListBox($this->objParentObject, $strControlId);
			$this->lstTopic->Name = QApplication::Translate('Topic');
			$this->lstTopic->Required = true;
			if (!$this->blnEditMode)
				$this->lstTopic->AddItem(QApplication::Translate('- Select One -'), null);
			$objTopicArray = Topic::LoadAll();
			if ($objTopicArray) foreach ($objTopicArray as $objTopic) {
				$objListItem = new QListItem($objTopic->__toString(), $objTopic->Id);
				if (($this->objMessage->Topic) && ($this->objMessage->Topic->Id == $objTopic->Id))
					$objListItem->Selected = true;
				$this->lstTopic->AddItem($objListItem);
			}
			return $this->lstTopic;
		}

		/**
		 * Create and setup QLabel lblTopicId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblTopicId_Create($strControlId = null) {
			$this->lblTopicId = new QLabel($this->objParentObject, $strControlId);
			$this->lblTopicId->Name = QApplication::Translate('Topic');
			$this->lblTopicId->Text = ($this->objMessage->Topic) ? $this->objMessage->Topic->__toString() : null;
			$this->lblTopicId->Required = true;
			return $this->lblTopicId;
		}

		/**
		 * Create and setup QListBox lstTopicLink
		 * @param string $strControlId optional ControlId to use
		 * @return QListBox
		 */
		public function lstTopicLink_Create($strControlId = null) {
			$this->lstTopicLink = new QListBox($this->objParentObject, $strControlId);
			$this->lstTopicLink->Name = QApplication::Translate('Topic Link');
			$this->lstTopicLink->Required = true;
			if (!$this->blnEditMode)
				$this->lstTopicLink->AddItem(QApplication::Translate('- Select One -'), null);
			$objTopicLinkArray = TopicLink::LoadAll();
			if ($objTopicLinkArray) foreach ($objTopicLinkArray as $objTopicLink) {
				$objListItem = new QListItem($objTopicLink->__toString(), $objTopicLink->Id);
				if (($this->objMessage->TopicLink) && ($this->objMessage->TopicLink->Id == $objTopicLink->Id))
					$objListItem->Selected = true;
				$this->lstTopicLink->AddItem($objListItem);
			}
			return $this->lstTopicLink;
		}

		/**
		 * Create and setup QLabel lblTopicLinkId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblTopicLinkId_Create($strControlId = null) {
			$this->lblTopicLinkId = new QLabel($this->objParentObject, $strControlId);
			$this->lblTopicLinkId->Name = QApplication::Translate('Topic Link');
			$this->lblTopicLinkId->Text = ($this->objMessage->TopicLink) ? $this->objMessage->TopicLink->__toString() : null;
			$this->lblTopicLinkId->Required = true;
			return $this->lblTopicLinkId;
		}

		/**
		 * Create and setup QListBox lstPerson
		 * @param string $strControlId optional ControlId to use
		 * @return QListBox
		 */
		public function lstPerson_Create($strControlId = null) {
			$this->lstPerson = new QListBox($this->objParentObject, $strControlId);
			$this->lstPerson->Name = QApplication::Translate('Person');
			$this->lstPerson->AddItem(QApplication::Translate('- Select One -'), null);
			$objPersonArray = Person::LoadAll();
			if ($objPersonArray) foreach ($objPersonArray as $objPerson) {
				$objListItem = new QListItem($objPerson->__toString(), $objPerson->Id);
				if (($this->objMessage->Person) && ($this->objMessage->Person->Id == $objPerson->Id))
					$objListItem->Selected = true;
				$this->lstPerson->AddItem($objListItem);
			}
			return $this->lstPerson;
		}

		/**
		 * Create and setup QLabel lblPersonId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblPersonId_Create($strControlId = null) {
			$this->lblPersonId = new QLabel($this->objParentObject, $strControlId);
			$this->lblPersonId->Name = QApplication::Translate('Person');
			$this->lblPersonId->Text = ($this->objMessage->Person) ? $this->objMessage->Person->__toString() : null;
			return $this->lblPersonId;
		}

		/**
		 * Create and setup QTextBox txtMessage
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtMessage_Create($strControlId = null) {
			$this->txtMessage = new QTextBox($this->objParentObject, $strControlId);
			$this->txtMessage->Name = QApplication::Translate('Message');
			$this->txtMessage->Text = $this->objMessage->Message;
			$this->txtMessage->TextMode = QTextMode::MultiLine;
			return $this->txtMessage;
		}

		/**
		 * Create and setup QLabel lblMessage
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblMessage_Create($strControlId = null) {
			$this->lblMessage = new QLabel($this->objParentObject, $strControlId);
			$this->lblMessage->Name = QApplication::Translate('Message');
			$this->lblMessage->Text = $this->objMessage->Message;
			return $this->lblMessage;
		}

		/**
		 * Create and setup QTextBox txtCompiledHtml
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtCompiledHtml_Create($strControlId = null) {
			$this->txtCompiledHtml = new QTextBox($this->objParentObject, $strControlId);
			$this->txtCompiledHtml->Name = QApplication::Translate('Compiled Html');
			$this->txtCompiledHtml->Text = $this->objMessage->CompiledHtml;
			$this->txtCompiledHtml->TextMode = QTextMode::MultiLine;
			return $this->txtCompiledHtml;
		}

		/**
		 * Create and setup QLabel lblCompiledHtml
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblCompiledHtml_Create($strControlId = null) {
			$this->lblCompiledHtml = new QLabel($this->objParentObject, $strControlId);
			$this->lblCompiledHtml->Name = QApplication::Translate('Compiled Html');
			$this->lblCompiledHtml->Text = $this->objMessage->CompiledHtml;
			return $this->lblCompiledHtml;
		}

		/**
		 * Create and setup QIntegerTextBox txtReplyNumber
		 * @param string $strControlId optional ControlId to use
		 * @return QIntegerTextBox
		 */
		public function txtReplyNumber_Create($strControlId = null) {
			$this->txtReplyNumber = new QIntegerTextBox($this->objParentObject, $strControlId);
			$this->txtReplyNumber->Name = QApplication::Translate('Reply Number');
			$this->txtReplyNumber->Text = $this->objMessage->ReplyNumber;
			$this->txtReplyNumber->Required = true;
			return $this->txtReplyNumber;
		}

		/**
		 * Create and setup QLabel lblReplyNumber
		 * @param string $strControlId optional ControlId to use
		 * @param string $strFormat optional sprintf format to use
		 * @return QLabel
		 */
		public function lblReplyNumber_Create($strControlId = null, $strFormat = null) {
			$this->lblReplyNumber = new QLabel($this->objParentObject, $strControlId);
			$this->lblReplyNumber->Name = QApplication::Translate('Reply Number');
			$this->lblReplyNumber->Text = $this->objMessage->ReplyNumber;
			$this->lblReplyNumber->Required = true;
			$this->lblReplyNumber->Format = $strFormat;
			return $this->lblReplyNumber;
		}

		/**
		 * Create and setup QDateTimePicker calPostDate
		 * @param string $strControlId optional ControlId to use
		 * @return QDateTimePicker
		 */
		public function calPostDate_Create($strControlId = null) {
			$this->calPostDate = new QDateTimePicker($this->objParentObject, $strControlId);
			$this->calPostDate->Name = QApplication::Translate('Post Date');
			$this->calPostDate->DateTime = $this->objMessage->PostDate;
			$this->calPostDate->DateTimePickerType = QDateTimePickerType::DateTime;
			$this->calPostDate->Required = true;
			return $this->calPostDate;
		}

		/**
		 * Create and setup QLabel lblPostDate
		 * @param string $strControlId optional ControlId to use
		 * @param string $strDateTimeFormat optional DateTimeFormat to use
		 * @return QLabel
		 */
		public function lblPostDate_Create($strControlId = null, $strDateTimeFormat = null) {
			$this->lblPostDate = new QLabel($this->objParentObject, $strControlId);
			$this->lblPostDate->Name = QApplication::Translate('Post Date');
			$this->strPostDateDateTimeFormat = $strDateTimeFormat;
			$this->lblPostDate->Text = sprintf($this->objMessage->PostDate) ? $this->objMessage->PostDate->__toString($this->strPostDateDateTimeFormat) : null;
			$this->lblPostDate->Required = true;
			return $this->lblPostDate;
		}

		protected $strPostDateDateTimeFormat;



		/**
		 * Refresh this MetaControl with Data from the local Message object.
		 * @param boolean $blnReload reload Message from the database
		 * @return void
		 */
		public function Refresh($blnReload = false) {
			if ($blnReload)
				$this->objMessage->Reload();

			if ($this->lblId) if ($this->blnEditMode) $this->lblId->Text = $this->objMessage->Id;

			if ($this->lstTopic) {
					$this->lstTopic->RemoveAllItems();
				if (!$this->blnEditMode)
					$this->lstTopic->AddItem(QApplication::Translate('- Select One -'), null);
				$objTopicArray = Topic::LoadAll();
				if ($objTopicArray) foreach ($objTopicArray as $objTopic) {
					$objListItem = new QListItem($objTopic->__toString(), $objTopic->Id);
					if (($this->objMessage->Topic) && ($this->objMessage->Topic->Id == $objTopic->Id))
						$objListItem->Selected = true;
					$this->lstTopic->AddItem($objListItem);
				}
			}
			if ($this->lblTopicId) $this->lblTopicId->Text = ($this->objMessage->Topic) ? $this->objMessage->Topic->__toString() : null;

			if ($this->lstTopicLink) {
					$this->lstTopicLink->RemoveAllItems();
				if (!$this->blnEditMode)
					$this->lstTopicLink->AddItem(QApplication::Translate('- Select One -'), null);
				$objTopicLinkArray = TopicLink::LoadAll();
				if ($objTopicLinkArray) foreach ($objTopicLinkArray as $objTopicLink) {
					$objListItem = new QListItem($objTopicLink->__toString(), $objTopicLink->Id);
					if (($this->objMessage->TopicLink) && ($this->objMessage->TopicLink->Id == $objTopicLink->Id))
						$objListItem->Selected = true;
					$this->lstTopicLink->AddItem($objListItem);
				}
			}
			if ($this->lblTopicLinkId) $this->lblTopicLinkId->Text = ($this->objMessage->TopicLink) ? $this->objMessage->TopicLink->__toString() : null;

			if ($this->lstPerson) {
					$this->lstPerson->RemoveAllItems();
				$this->lstPerson->AddItem(QApplication::Translate('- Select One -'), null);
				$objPersonArray = Person::LoadAll();
				if ($objPersonArray) foreach ($objPersonArray as $objPerson) {
					$objListItem = new QListItem($objPerson->__toString(), $objPerson->Id);
					if (($this->objMessage->Person) && ($this->objMessage->Person->Id == $objPerson->Id))
						$objListItem->Selected = true;
					$this->lstPerson->AddItem($objListItem);
				}
			}
			if ($this->lblPersonId) $this->lblPersonId->Text = ($this->objMessage->Person) ? $this->objMessage->Person->__toString() : null;

			if ($this->txtMessage) $this->txtMessage->Text = $this->objMessage->Message;
			if ($this->lblMessage) $this->lblMessage->Text = $this->objMessage->Message;

			if ($this->txtCompiledHtml) $this->txtCompiledHtml->Text = $this->objMessage->CompiledHtml;
			if ($this->lblCompiledHtml) $this->lblCompiledHtml->Text = $this->objMessage->CompiledHtml;

			if ($this->txtReplyNumber) $this->txtReplyNumber->Text = $this->objMessage->ReplyNumber;
			if ($this->lblReplyNumber) $this->lblReplyNumber->Text = $this->objMessage->ReplyNumber;

			if ($this->calPostDate) $this->calPostDate->DateTime = $this->objMessage->PostDate;
			if ($this->lblPostDate) $this->lblPostDate->Text = sprintf($this->objMessage->PostDate) ? $this->objMessage->__toString($this->strPostDateDateTimeFormat) : null;

		}



		///////////////////////////////////////////////
		// PROTECTED UPDATE METHODS for ManyToManyReferences (if any)
		///////////////////////////////////////////////





		///////////////////////////////////////////////
		// PUBLIC MESSAGE OBJECT MANIPULATORS
		///////////////////////////////////////////////

		/**
		 * This will save this object's Message instance,
		 * updating only the fields which have had a control created for it.
		 */
		public function SaveMessage() {
			try {
				// Update any fields for controls that have been created
				if ($this->lstTopic) $this->objMessage->TopicId = $this->lstTopic->SelectedValue;
				if ($this->lstTopicLink) $this->objMessage->TopicLinkId = $this->lstTopicLink->SelectedValue;
				if ($this->lstPerson) $this->objMessage->PersonId = $this->lstPerson->SelectedValue;
				if ($this->txtMessage) $this->objMessage->Message = $this->txtMessage->Text;
				if ($this->txtCompiledHtml) $this->objMessage->CompiledHtml = $this->txtCompiledHtml->Text;
				if ($this->txtReplyNumber) $this->objMessage->ReplyNumber = $this->txtReplyNumber->Text;
				if ($this->calPostDate) $this->objMessage->PostDate = $this->calPostDate->DateTime;

				// Update any UniqueReverseReferences (if any) for controls that have been created for it

				// Save the Message object
				$this->objMessage->Save();

				// Finally, update any ManyToManyReferences (if any)
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * This will DELETE this object's Message instance from the database.
		 * It will also unassociate itself from any ManyToManyReferences.
		 */
		public function DeleteMessage() {
			$this->objMessage->Delete();
		}		



		///////////////////////////////////////////////
		// PUBLIC GETTERS and SETTERS
		///////////////////////////////////////////////

		/**
		 * Override method to perform a property "Get"
		 * This will get the value of $strName
		 *
		 * @param string $strName Name of the property to get
		 * @return mixed
		 */
		public function __get($strName) {
			switch ($strName) {
				// General MetaControlVariables
				case 'Message': return $this->objMessage;
				case 'TitleVerb': return $this->strTitleVerb;
				case 'EditMode': return $this->blnEditMode;

				// Controls that point to Message fields -- will be created dynamically if not yet created
				case 'IdControl':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'IdLabel':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'TopicIdControl':
					if (!$this->lstTopic) return $this->lstTopic_Create();
					return $this->lstTopic;
				case 'TopicIdLabel':
					if (!$this->lblTopicId) return $this->lblTopicId_Create();
					return $this->lblTopicId;
				case 'TopicLinkIdControl':
					if (!$this->lstTopicLink) return $this->lstTopicLink_Create();
					return $this->lstTopicLink;
				case 'TopicLinkIdLabel':
					if (!$this->lblTopicLinkId) return $this->lblTopicLinkId_Create();
					return $this->lblTopicLinkId;
				case 'PersonIdControl':
					if (!$this->lstPerson) return $this->lstPerson_Create();
					return $this->lstPerson;
				case 'PersonIdLabel':
					if (!$this->lblPersonId) return $this->lblPersonId_Create();
					return $this->lblPersonId;
				case 'MessageControl':
					if (!$this->txtMessage) return $this->txtMessage_Create();
					return $this->txtMessage;
				case 'MessageLabel':
					if (!$this->lblMessage) return $this->lblMessage_Create();
					return $this->lblMessage;
				case 'CompiledHtmlControl':
					if (!$this->txtCompiledHtml) return $this->txtCompiledHtml_Create();
					return $this->txtCompiledHtml;
				case 'CompiledHtmlLabel':
					if (!$this->lblCompiledHtml) return $this->lblCompiledHtml_Create();
					return $this->lblCompiledHtml;
				case 'ReplyNumberControl':
					if (!$this->txtReplyNumber) return $this->txtReplyNumber_Create();
					return $this->txtReplyNumber;
				case 'ReplyNumberLabel':
					if (!$this->lblReplyNumber) return $this->lblReplyNumber_Create();
					return $this->lblReplyNumber;
				case 'PostDateControl':
					if (!$this->calPostDate) return $this->calPostDate_Create();
					return $this->calPostDate;
				case 'PostDateLabel':
					if (!$this->lblPostDate) return $this->lblPostDate_Create();
					return $this->lblPostDate;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/**
		 * Override method to perform a property "Set"
		 * This will set the property $strName to be $mixValue
		 *
		 * @param string $strName Name of the property to set
		 * @param string $mixValue New value of the property
		 * @return mixed
		 */
		public function __set($strName, $mixValue) {
			try {
				switch ($strName) {
					// Controls that point to Message fields
					case 'IdControl':
						return ($this->lblId = QType::Cast($mixValue, 'QControl'));
					case 'TopicIdControl':
						return ($this->lstTopic = QType::Cast($mixValue, 'QControl'));
					case 'TopicLinkIdControl':
						return ($this->lstTopicLink = QType::Cast($mixValue, 'QControl'));
					case 'PersonIdControl':
						return ($this->lstPerson = QType::Cast($mixValue, 'QControl'));
					case 'MessageControl':
						return ($this->txtMessage = QType::Cast($mixValue, 'QControl'));
					case 'CompiledHtmlControl':
						return ($this->txtCompiledHtml = QType::Cast($mixValue, 'QControl'));
					case 'ReplyNumberControl':
						return ($this->txtReplyNumber = QType::Cast($mixValue, 'QControl'));
					case 'PostDateControl':
						return ($this->calPostDate = QType::Cast($mixValue, 'QControl'));
					default:
						return parent::__set($strName, $mixValue);
				}
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
	}
?>