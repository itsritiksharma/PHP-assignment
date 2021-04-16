<?php

  /**
  *
  * @file
  *
  * Encode and decode a password.
  *
  */

  namespace EncryptData;

  class Encryption{
    public $skey, $encryption_iv, $iv_length, $ciphering, $options = 0;

    /**
    *
    * Set public variables for encryption.
    *
    * @param NULL
    *
    */
    public function __construct(){
      // Set the ciphering algo
      $this->ciphering = "AES-128-CTR";
      // Set iv length for ciphering
      $this->iv_length = openssl_cipher_iv_length($this->ciphering);
      // Set encryption iv
      $this->encryption_iv = '1234567891011121';
      // Set encrytion key
      $this->skey = "EncryptionKey";
    }

    /**
    *
    * Encode password.
    *
    * @param array of strings $form [stores form data]
    *
    * @return $encryption [encrypted password]
    *
    */
    public function encode($form){
      // Get password from form
      $password = $form['password'];
      // Encrypt password using OpenSSl encryption method
      $encryption = openssl_encrypt($password, $this->ciphering,$this->skey, $this->options, $this->encryption_iv);
      return $encryption;
    }

    /**
    *
    * Decode password.
    *
    * @param string $encryptpass [encrypted password]
    *
    * @return $decryption [decoded password]
    *
    */
    public function decode($encryptpass){
      // decrypt password using OpenSSl encryption method
      $decryption = openssl_decrypt ($encryptpass, $this->ciphering,$this->skey, $this->options, $this->encryption_iv);
      return $decryption;
    }
  }
?>
