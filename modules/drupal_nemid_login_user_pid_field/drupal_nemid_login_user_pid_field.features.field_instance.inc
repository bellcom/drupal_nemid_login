<?php
/**
 * @file
 * drupal_nemid_login_user_pid_field.features.field_instance.inc
 */

/**
 * Implements hook_field_default_field_instances().
 */
function drupal_nemid_login_user_pid_field_field_default_field_instances() {
  $field_instances = array();

  // Exported field_instance: 'user-user-field_nemid_pid'.
  $field_instances['user-user-field_nemid_pid'] = array(
    'bundle' => 'user',
    'default_value' => NULL,
    'deleted' => 0,
    'description' => '',
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'text',
        'settings' => array(),
        'type' => 'text_default',
        'weight' => 0,
      ),
    ),
    'entity_type' => 'user',
    'field_name' => 'field_nemid_pid',
    'label' => 'Nemid pid',
    'required' => 0,
    'settings' => array(
      'text_processing' => 0,
      'user_register_form' => 0,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'text',
      'settings' => array(
        'size' => 60,
      ),
      'type' => 'text_textfield',
      'weight' => 7,
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Nemid pid');

  return $field_instances;
}
