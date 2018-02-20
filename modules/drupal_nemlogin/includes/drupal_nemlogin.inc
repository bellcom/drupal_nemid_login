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
 * Function that attempts to fetch field from the SimpleAuth attibutes.with specific name, suffix with NumberIdentifier.
 * E.g. if field name is "CPR", method will attempt to fetch dk:gov:saml:attribute:CprNumberIdentifier.
 *
 * If field value is fetch it is returned, otherwise NULL is returned.
 *
 * @param mixed $as
 *   SimpleAuth valid object.
 * @param string $field_name
 *   Name of the field.
 *
 * @return string
 *   Field value.
 */
function attemptFetchNumberIdentifier($as, $field_name = 'cpr') {
  // Make first char uppercase and suffixing with NumberIdentifier.
  $field_name = ucfirst(strtolower($field_name));
  $field_name .= 'NumberIdentifier';

  $attrs = $as->getAttributes();
  $field_value = NULL;

  if (is_array($attrs) && isset($attrs["dk:gov:saml:attribute:$field_name}"])) {
    if (is_array($attrs["dk:gov:saml:attribute:$field_name"]) && isset($attrs["dk:gov:saml:attribute:$field_name"][0])) {
      $field_value = $attrs["dk:gov:saml:attribute:$field_name"][0];
    }
  }

  return $field_value;
}



