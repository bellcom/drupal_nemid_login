<?php

/**
 *
 * Returns SimpleSAML_Auth_Simple object
 * @throws Exception
 */
function getSimpleSamlAuth() {
  $simplesaml_installdir = variable_get('drupal_nemlogin_simplesaml_installdir');

  if (!file_exists($simplesaml_installdir . '/lib/_autoload.php')) {
    throw new Exception ('Simplesaml install directory is not properly configured');
  }
  else {
    require_once($simplesaml_installdir . '/lib/_autoload.php');

    $as = new SimpleSAML_Auth_Simple(variable_get('drupal_nemlogin_simplesaml_default_auth','default-sp'));
    return $as;
  }
}
