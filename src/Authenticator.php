<?php
namespace booosta\authenticator;
use \booosta\Framework as b;
b::init_module('authenticator');

abstract class Authenticator extends \booosta\base\Module
{
  use moduletrait_authenticator;

  protected $crypter;

  public function __construct($crypter = null)
  {
    parent::__construct();

    $crypterclass = $this->config('crypter_class') ?? 'aes256';

    if(is_object($crypter)) $this->crypter = $crypter;
    else $this->crypter = $this->makeInstance($crypterclass);

    if($this->crypter->error()) $this->error($this->crypter);
  }

  public function authenticate($username, $password) { return false; }
  public function get_crypter() { return $this->crypter; }
}
