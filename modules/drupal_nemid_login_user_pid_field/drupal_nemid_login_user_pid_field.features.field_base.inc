<?php
/**
 * @file
 * drupal_nemid_login_user_pid_field.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function drupal_nemid_login_user_pid_field_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_nemid_pid'
  $field_bases['field_nemid_pid'] = array(
    'active' => 1,
    'cardinality' => 1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_nemid_pid',
    'foreign keys' => array(
      'format' => array(
        'columns' => array(
          'format' => 'format',
        ),
        'table' => 'filter_format',
      ),
    ),
    'indexes' => array(
      'format' => array(
        0 => 'format',
      ),
    ),
    'locked' => 0,
    'module' => 'text',
    'settings' => array(
      'max_length' => 255,
    ),
    'translatable' => 0,
    'type' => 'text',
  );

  return $field_bases;
}
