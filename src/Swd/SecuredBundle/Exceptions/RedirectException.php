<?php

namespace Swd\SecuredBundle\Exceptions;

class RedirectException extends \Exception
{
  /**
   *
   * @var string
   */
  protected $uri;

  /**
   * 
   * @param string $uri
   */
  public function __construct($uri)
  {
    $this->uri = $uri;
  }
  
  /**
   * 
   * @param string $uri
   * @return \Swd\SecuredBundle\Exceptions\RedirectException
   */
  public function setUri($uri)
  {
    $this->uri = $uri;
    return $this;
  }
  
  /**
   * 
   * @return string
   */
  public function getUri()
  {
    return $this->uri;
  }
}
