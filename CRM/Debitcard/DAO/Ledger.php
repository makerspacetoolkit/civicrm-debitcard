<?php
/*
+--------------------------------------------------------------------+
| CiviCRM version 4.6                                                |
+--------------------------------------------------------------------+
| Copyright CiviCRM LLC (c) 2004-2015                                |
+--------------------------------------------------------------------+
| This file is a part of CiviCRM.                                    |
|                                                                    |
| CiviCRM is free software; you can copy, modify, and distribute it  |
| under the terms of the GNU Affero General Public License           |
| Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
|                                                                    |
| CiviCRM is distributed in the hope that it will be useful, but     |
| WITHOUT ANY WARRANTY; without even the implied warranty of         |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
| See the GNU Affero General Public License for more details.        |
|                                                                    |
| You should have received a copy of the GNU Affero General Public   |
| License and the CiviCRM Licensing Exception along                  |
| with this program; if not, contact CiviCRM LLC                     |
| at info[AT]civicrm[DOT]org. If you have questions about the        |
| GNU Affero General Public License or the licensing of CiviCRM,     |
| see the CiviCRM license FAQ at http://civicrm.org/licensing        |
+--------------------------------------------------------------------+
*/
/**
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2015
 *
 * Generated from xml/schema/CRM/Debitcard/Ledger.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 */
require_once 'CRM/Core/DAO.php';
require_once 'CRM/Utils/Type.php';
class CRM_Debitcard_DAO_Ledger extends CRM_Core_DAO {
  /**
   * static instance to hold the table name
   *
   * @var string
   */
  static $_tableName = 'civicrm_debitcard_ledger';
  /**
   * static instance to hold the field values
   *
   * @var array
   */
  static $_fields = null;
  /**
   * static instance to hold the keys used in $_fields for each field.
   *
   * @var array
   */
  static $_fieldKeys = null;
  /**
   * static instance to hold the FK relationships
   *
   * @var string
   */
  static $_links = null;
  /**
   * static instance to hold the values that can
   * be imported
   *
   * @var array
   */
  static $_import = null;
  /**
   * static instance to hold the values that can
   * be exported
   *
   * @var array
   */
  static $_export = null;
  /**
   * static value to see if we should log any modifications to
   * this table in the civicrm_log table
   *
   * @var boolean
   */
  static $_log = true;
  /**
   * Unique Ledger ID
   *
   * @var int unsigned
   */
  public $id;
  /**
   * Ledger date stamp
   *
   * @var date
   */
  public $date;
  /**
   * Ledger time stamp
   *
   * @var datetime
   */
  public $datetime;
  /**
   * FK to Contact
   *
   * @var int unsigned
   */
  public $contact_id;
  /**
   * Machine serial, maps to permissions in custom data
   *
   * @var int unsigned
   */
  public $machine_id;
  /**
   * Debit or Credit, used to determine operator
   *
   * @var boolean
   */
  public $is_debit;
  /**
   * FK to Contribution
   *
   * @var int unsigned
   */
  public $contribution_id;
  /**
   * Job time in seconds
   *
   * @var int unsigned
   */
  public $job_time;
  /**
   * Rate in cents
   *
   * @var int unsigned
   */
  public $rate;
  /**
   * Amount in cents
   *
   * @var int
   */
  public $amount;
  /**
   * Container for recurring, non-accruing member credits in cents, consumed first by client
   *
   * @var int unsigned
   */
  public $member_store;
  /**
   * Container for out-of-pocket purchased credit in cents, consumed last by client
   *
   * @var int
   */
  public $pocket_store;
  /**
   * Previous ledger id of contact, used for auditing
   *
   * @var int unsigned
   */
  public $prev_ledger_item;
  /**
   * Previous amount used for auditing
   *
   * @var int unsigned
   */
  public $prev_member_store;
  /**
   * Previous amount used for auditing
   *
   * @var int
   */
  public $prev_pocket_store;
  /**
   * Used for test mode
   *
   * @var boolean
   */
  public $is_test;
  /**
   * Used for documentation
   *
   * @var string
   */
  public $notes;
  /**
   * class constructor
   *
   * @return civicrm_debitcard_ledger
   */
  function __construct() {
    $this->__table = 'civicrm_debitcard_ledger';
    parent::__construct();
  }
  /**
   * Returns foreign keys and entity references
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  static function getReferenceColumns() {
    if (!self::$_links) {
      self::$_links = static ::createReferenceColumns(__CLASS__);
      self::$_links[] = new CRM_Core_Reference_Basic(self::getTableName() , 'contact_id', 'civicrm_contact', 'id');
      self::$_links[] = new CRM_Core_Reference_Basic(self::getTableName() , 'contribution_id', 'civicrm_contribution', 'id');
    }
    return self::$_links;
  }
  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  static function &fields() {
    if (!(self::$_fields)) {
      self::$_fields = array(
        'id' => array(
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => 'Unique Ledger ID',
          'required' => true,
        ) ,
        'date' => array(
          'name' => 'date',
          'type' => CRM_Utils_Type::T_DATE,
          'title' => ts('Date') ,
          'description' => 'Ledger date stamp',
          'required' => true,
        ) ,
        'datetime' => array(
          'name' => 'datetime',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('Datetime') ,
          'description' => 'Ledger time stamp',
          'required' => true,
        ) ,
        'contact_id' => array(
          'name' => 'contact_id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => 'FK to Contact',
          'default' => 'null',
          'FKClassName' => 'CRM_Contact_DAO_Contact',
        ) ,
        'machine_id' => array(
          'name' => 'machine_id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => 'Machine serial, maps to permissions in custom data',
        ) ,
        'is_debit' => array(
          'name' => 'is_debit',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'description' => 'Debit or Credit, used to determine operator',
          'required' => true,
        ) ,
        'contribution_id' => array(
          'name' => 'contribution_id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => 'FK to Contribution',
          'default' => 'null',
          'FKClassName' => 'CRM_Contribute_DAO_Contribution',
        ) ,
        'job_time' => array(
          'name' => 'job_time',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Job Time') ,
          'description' => 'Job time in seconds',
          'required' => true,
        ) ,
        'rate' => array(
          'name' => 'rate',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Rate') ,
          'description' => 'Rate in cents',
        ) ,
        'amount' => array(
          'name' => 'amount',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Amount') ,
          'description' => 'Amount in cents',
        ) ,
        'member_store' => array(
          'name' => 'member_store',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Member Store') ,
          'description' => 'Container for recurring, non-accruing member credits in cents, consumed first by client',
        ) ,
        'pocket_store' => array(
          'name' => 'pocket_store',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Pocket Store') ,
          'description' => 'Container for out-of-pocket purchased credit in cents, consumed last by client',
        ) ,
        'prev_ledger_item' => array(
          'name' => 'prev_ledger_item',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Prev Ledger Item') ,
          'description' => 'Previous ledger id of contact, used for auditing',
        ) ,
        'prev_member_store' => array(
          'name' => 'prev_member_store',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Prev Member Store') ,
          'description' => 'Previous amount used for auditing',
        ) ,
        'prev_pocket_store' => array(
          'name' => 'prev_pocket_store',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Prev Pocket Store') ,
          'description' => 'Previous amount used for auditing',
        ) ,
        'is_test' => array(
          'name' => 'is_test',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'description' => 'Used for test mode',
          'required' => true,
        ) ,
        'notes' => array(
          'name' => 'notes',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Notes') ,
          'description' => 'Used for documentation',
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
        ) ,
      );
    }
    return self::$_fields;
  }
  /**
   * Returns an array containing, for each field, the arary key used for that
   * field in self::$_fields.
   *
   * @return array
   */
  static function &fieldKeys() {
    if (!(self::$_fieldKeys)) {
      self::$_fieldKeys = array(
        'id' => 'id',
        'date' => 'date',
        'datetime' => 'datetime',
        'contact_id' => 'contact_id',
        'machine_id' => 'machine_id',
        'is_debit' => 'is_debit',
        'contribution_id' => 'contribution_id',
        'job_time' => 'job_time',
        'rate' => 'rate',
        'amount' => 'amount',
        'member_store' => 'member_store',
        'pocket_store' => 'pocket_store',
        'prev_ledger_item' => 'prev_ledger_item',
        'prev_member_store' => 'prev_member_store',
        'prev_pocket_store' => 'prev_pocket_store',
        'is_test' => 'is_test',
        'notes' => 'notes',
      );
    }
    return self::$_fieldKeys;
  }
  /**
   * Returns the names of this table
   *
   * @return string
   */
  static function getTableName() {
    return self::$_tableName;
  }
  /**
   * Returns if this table needs to be logged
   *
   * @return boolean
   */
  function getLog() {
    return self::$_log;
  }
  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &import($prefix = false) {
    if (!(self::$_import)) {
      self::$_import = array();
      $fields = self::fields();
      foreach($fields as $name => $field) {
        if (CRM_Utils_Array::value('import', $field)) {
          if ($prefix) {
            self::$_import['debitcard_ledger'] = & $fields[$name];
          } else {
            self::$_import[$name] = & $fields[$name];
          }
        }
      }
    }
    return self::$_import;
  }
  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &export($prefix = false) {
    if (!(self::$_export)) {
      self::$_export = array();
      $fields = self::fields();
      foreach($fields as $name => $field) {
        if (CRM_Utils_Array::value('export', $field)) {
          if ($prefix) {
            self::$_export['debitcard_ledger'] = & $fields[$name];
          } else {
            self::$_export[$name] = & $fields[$name];
          }
        }
      }
    }
    return self::$_export;
  }
}
