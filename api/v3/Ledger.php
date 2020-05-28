<?php

/**
 * Ledger.create API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_ledger_create_spec(&$spec) {
  $spec['date']['api.required'] = 1;
  $spec['datetime']['api.required'] = 1;
  $spec['contact_id']['api.required'] = 1;
  $spec['machine_id']['api.required'] = 0;
  $spec['is_debit']['api.required'] = 1;
  $spec['contribution_id']['api.required'] = 0;
  $spec['jobtime']['api.required'] = 0;
  $spec['rate']['api.required'] = 0;
  $spec['amount']['api.required'] = 1;
  $spec['member_store']['api.required'] = 1;
  $spec['pocket_store']['api.required'] = 1;
  $spec['prev_ledger_item']['api.required'] = 1;
  $spec['prev_member_store']['api.required'] = 1;
  $spec['prev_pocket_store']['api.required'] = 1;
  $spec['is_test']['api.default'] = 0;
}
/**
 * Ledger.get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_ledger_get_spec(&$spec) {
  $spec['is_test']['api.default'] = 0;
}
/**
 * Ledger.getlast API specification
*/
function _civicrm_api3_ledger_getlast_spec(&$spec) {
  $spec['contact_id']['api.required'] = 1;
}

/**
 * Ledger.create API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_ledger_create($params) {
  return _civicrm_api3_basic_create(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * Ledger.delete API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
function civicrm_api3_ledger_delete($params) {
  return _civicrm_api3_basic_delete(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}
 */

/**
 * Ledger.get API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_ledger_get($params) {
  $params['options'] = array('sort' => "id DESC");
  return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * Ledger.getlast API
 *  Because python-civicrm can't sort. We're overriding the params array.
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_ledger_getlast($params) {
  
  $params['options'] = array('limit' => 1, 'sort' => "id DESC");
  return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}
