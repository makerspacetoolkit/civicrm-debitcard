<?php

class CRM_Debitcard_BAO_Ledger extends CRM_Debitcard_DAO_Ledger {

  /**
   * Create a new Ledger based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Debitcard_DAO_Ledger|NULL
   *
  */
  public static function create($params) {
    $className = 'CRM_Debitcard_DAO_Ledger';
    $entityName = 'Ledger';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } 
}
