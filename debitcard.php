<?php

// Create a contribution page used to buy credits in the system and then
// SET THIS VARIABLE TO THE ID NUMBER OF THAT PAGE:
$GLOBALS['credit_contribution_page_id'] = 9999;

require_once 'debitcard.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function debitcard_civicrm_config(&$config) {
  _debitcard_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function debitcard_civicrm_xmlMenu(&$files) {
  _debitcard_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function debitcard_civicrm_install() {
   _debitcard_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function debitcard_civicrm_uninstall() {
  _debitcard_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function debitcard_civicrm_enable() {
  _debitcard_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function debitcard_civicrm_disable() {
  _debitcard_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function debitcard_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _debitcard_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function debitcard_civicrm_managed(&$entities) {
  return _debitcard_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function debitcard_civicrm_caseTypes(&$caseTypes) {
  _debitcard_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function debitcard_civicrm_angularModules(&$angularModules) {
_debitcard_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function debitcard_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _debitcard_civix_civicrm_alterSettingsFolders($metaDataFolders);
}


/**
 * Implements hook_civicrm_apiWrappers().
 */
function debitcard_civicrm_entityTypes(&$entityTypes) {
  $entityTypes['CRM_Debitcard_DAO_Ledger'] = array(
    'name'  => 'Ledger',
    'class' => 'CRM_Debitcard_DAO_Ledger',
    'table' => 'civicrm_debitcard_ledger',
  );
}

function debitcard_civicrm_pageRun(&$page) {
// dynamically insert a template block in the page
//modifies the users profile page to include credit values
// add:
// {include file='../../org.makerspacetoolkit.debitcard/templates/profilefield.tpl'}
// to:
// /var/www/drupal/sites/all/modules/civicrm/templates/CRM/Profile/Page/Dynamic.tpl
//include 'templates/profilefield.tpl';


  $pageName = $page->getVar('_name');
  if ( $pageName == 'CRM_Profile_Page_Dynamic' ) {
    $session = CRM_Core_Session::singleton();
    $contact_id = $session->get('userID');
   $current_balance = civicrm_api3('Ledger', 'getlast', array(
      'sequential' => 1,
      'contact_id' => $contact_id,
    ));

   list($id,$formated_member_credits, $formated_pocket_credits, $formated_total) = get_current_balance(1,$contact_id,0); 

    $page->assign('my_member_credit', $formated_member_credits );
    $page->assign('my_machine_credit', $formated_pocket_credits );
    $page->assign('my_total_credit', $formated_total );
  }
}
function debitcard_civicrm_buildForm($formName, &$form) {
// modifies contribution page form to include current credit values
// Optionally, modify contribution form to remove other people option
// This is what look for and comment out in the template to remove. 
// you can have seperate templates per page id. 
//<!--
//    <div class="messages status no-popup crm-not-you-message">
//      {ts 1=$display_name}Welcome %1{/ts}. (<a href="{crmURL p='civicrm/contribute/transact' q="cid=0&reset=1&id=`$contributionPageID`"}" title="{ts}Click here to do this for a different person.{/ts}">{ts 1=$display_name}Not %1, or want to do this for a different person{/ts}</a>?)
//    </div>
//--> 
$GLOBALS['credit_contribution_page_id'];

  if ($formName == "CRM_Contribute_Form_Contribution_Main" && ($form->_id == $GLOBALS['credit_contribution_page_id'])) {
     $session = CRM_Core_Session::singleton();
     $contact_id = $session->get('userID');
       $zz = print_r(get_defined_vars(), TRUE);
     //  $zz = print_r($objectRef);
        $debug_code = '<pre>' . $zz . '</pre>';
        watchdog('Buildform-page', $debug_code);
  $is_test = ($form->_mode == "test" ? 1 : 0); //
  list($id, $formated_member_credits, $formated_pocket_credits,$formated_total) = get_current_balance(1,$contact_id,$is_test); 

    $form->addElement('text','my_member_credit', $formated_member_credits );
    $form->addElement('text','my_machine_credit', $formated_pocket_credits );
    $form->addElement('text','my_total_credit', $formated_total );
    $templatePath = realpath(dirname(__FILE__)."/templates");
    CRM_Core_Region::instance('page-body')->add(array(
      'template' => "{$templatePath}/testfield.tpl"
    ));
  }
}


function get_current_balance($formated, $contact_id, $is_test) { 
    try {
      $current_balance = civicrm_api3('Ledger', 'getlast', array(
       'sequential' => 1,
       'contact_id' => $contact_id,
       'is_test' => $is_test,
      ));
    } catch  (Exception $e){
    // api error!
    }
    if (isset($current_balance['id'])) {
      $id = $current_balance['id'];
     } else {
      $id = 0;
     }
    if (!empty($current_balance['values'][0]['member_store'])) {
      $member_credit = $current_balance['values'][0]['member_store'];
      $formated_member_credits = number_format(($member_credit / 100), 2);
    }
    else {
      $member_credit = 0;
      $formated_member_credits = "0.00";
    }  
    if (!empty($current_balance['values'][0]['pocket_store'])) {
      $pocket_credit = $current_balance['values'][0]['pocket_store'];
      $formated_pocket_credits = number_format(($pocket_credit / 100), 2);
    }
    else {
      $pocket_credit = 0;
      $formated_pocket_credits = "0.00";
    }  
    $formated_total = number_format((($member_credit +  $pocket_credit)) / 100, 2);
    $total = $member_credit +  $pocket_credit;
   if ($formated == 1){ 
  return array($id,$formated_member_credits, $formated_pocket_credits,$formated_total);  
   } else if ($formated == 0) {
    
  return array($id, $member_credit, $pocket_credit,$total);  
  } 
}

function debitcard_civicrm_post( $op, $objectName, $objectId, &$objectRef ) {
// updates credit when contribution is made on the one we've chosen.
$GLOBALS['credit_contribution_page_id'];
  if ($objectName == 'Contribution' &&  $op == 'create') {
  // buy extra credit
    if (isset($objectRef->contribution_page_id) && $objectRef->contribution_page_id == $GLOBALS['credit_contribution_page_id'] ) {

      $contact_id = $objectRef->contact_id;
      list($id,$member_store, $pocket_store, $total) = get_current_balance(0,$contact_id,$objectRef->is_test); 

       $datetime = civicrm_api3('Contribution', 'getvalue', array(
        'sequential' => 1,
        'return' => "receive_date",
        'id' => $objectId
       ));
      

      $date = date('Y-m-d', strtotime($datetime));
      
      $contrib_amount_cents = $objectRef->total_amount * 100;
      $new_pocket_store = ($pocket_store + $contrib_amount_cents );

      try {
      $result = civicrm_api3('Ledger', 'create', array(
       'sequential' => 1,
       'date' => $date,
       'datetime' => $datetime,
       'contact_id' => $contact_id,
       'contribution_id' => $objectId,
       'is_debit' => "0",
       'amount' => $contrib_amount_cents,
       'member_store' => $member_store,
       'pocket_store' => $new_pocket_store,
       'prev_ledger_item' => $id,
       'prev_member_store' => $member_store,
       'prev_pocket_store' => $pocket_store,
       'notes' => "Online purchase",
       'is_test' => $objectRef->is_test, 
      ));

      } catch  (Exception $e) {
      // api error!
      }
    }
       $zz = print_r(get_defined_vars(), TRUE);
        $debug_code = '<pre>' . $zz . '</pre>';
        watchdog('credit-purchase', $debug_code);
  }

// Tops off member credit during memebership join and renewal
// It does so by searching strings.

  if ($objectName == 'MembershipPayment' &&  $op == 'create') {
       $membership_result = civicrm_api3('Membership', 'get', array(
        'sequential' => 1,
        'return' => "status_id,is_test,membership_type_id,contact_id", 
        'id' => $objectRef->membership_id,
       ));
       $contact_id = $membership_result['values'][0]['contact_id'];
       $is_test = $membership_result['values'][0]['is_test'];

       $membership_type_result = civicrm_api3('MembershipType', 'get', array(
        'sequential' => 1,
         'return' => "name,duration_unit,duration_interval",
        'id' => $membership_result['values'][0]['membership_type_id'],
       ));

       $datetime = civicrm_api3('Contribution', 'getvalue', array(
        'sequential' => 1,
        'return' => "receive_date",
        'id' => $objectRef->contribution_id
       ));
       $date = date('Y-m-d', strtotime($datetime));

       $membership_entitlement = 0;
       $membership_name = $membership_type_result['values'][0]['name'];    
       $membership_duration_unit = $membership_type_result['values'][0]['duration_unit'];

       if ($membership_duration_unit == 'month' || $membership_duration_unit == 'year') {
           $month_year_test = 1;
         if (preg_match('/standard/i',$membership_name)) {
           $standard_name_test = 1;
           $membership_entitlement = 9000;
         }

         if (preg_match('/commercial/i',$membership_name)) {
           $membership_entitlement = 18000;
         }
       }

     if ($membership_duration_unit == 'year') {
          $membership_entitlement = $membership_entitlement * 12; 
      }  
        $amount = $membership_entitlement * (int)($membership_type_result['values'][0]['duration_interval']);
      
      list($id,$member_store, $pocket_store, $total) = get_current_balance(0,$contact_id,$is_test); 

       try {
      $result = civicrm_api3('Ledger', 'create', array(
       'sequential' => 1,
       'date' => $date,
       'datetime' => $datetime,
       'contact_id' => $membership_result['values'][0]['contact_id'],
       'contribution_id' => $objectRef->contribution_id,
       'is_debit' => "0",
       'amount' => $amount,
       'member_store' => $amount,
       'pocket_store' => $pocket_store,
       'prev_ledger_item' => $id,
       'prev_member_store' => $member_store,
       'prev_pocket_store' => $pocket_store,
       'notes' => "Membership entitlement",
       'is_test' => $membership_result['values'][0]['is_test'], 
      ));

      } catch  (Exception $e) {
      // api error!
      }

       $zz = print_r(get_defined_vars(), TRUE);
        $debug_code = '<pre>' . $zz . '</pre>';
        watchdog('membershippayment-create', $debug_code);

  }
}

