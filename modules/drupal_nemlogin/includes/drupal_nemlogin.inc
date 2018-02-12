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

/**
 * Function that attempts to fetch CPR from the SimpleAuth attibutes.
 * If CPR is fetch it is returned, otherwise NULL is returned.
 *
 * @param $as
 * @return null
 */
function attemptFetchCpr($as) {
  $attrs = $as->getAttributes();
  $cpr = NULL;
  if (is_array($attrs) && isset($attrs['dk:gov:saml:attribute:CprNumberIdentifier'])) {
    if (is_array($attrs['dk:gov:saml:attribute:CprNumberIdentifier']) && isset($attrs['dk:gov:saml:attribute:CprNumberIdentifier'][0])) {
      $cpr = $attrs['dk:gov:saml:attribute:CprNumberIdentifier'][0];
    }
  }

  return $cpr;
}

/**
 * Function that attempts to fetch CVR from the SimpleAuth attibutes.
 * If CVR is fetch it is returned, otherwise NULL is returned.
 *
 * @param $as
 * @return null
 */
function attemptFetchCvr($as) {
  $attrs = $as->getAttributes();
  $cvr = NULL;
  if (is_array($attrs) && isset($attrs['dk:gov:saml:attribute:CvrNumberIdentifier'])) {
    if (is_array($attrs['dk:gov:saml:attribute:CvrNumberIdentifier']) && isset($attrs['dk:gov:saml:attribute:CvrNumberIdentifier'][0])) {
      $cvr = $attrs['dk:gov:saml:attribute:CvrNumberIdentifier'][0];
    }
  }

  return $cvr;
}

