<?php

namespace dhu\Controller;

use dhu\SimpleTemplateEngine;

class LoginController 
{
  /**
   * @var dhu\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  /**
   * @param dhu\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template)
  {
     $this->template = $template;
  }

  public function showlogin() {
  	echo $this->template->render("login.html.php");
  }

  public function greet($name) {
  	echo $this->template->render("hello.html.php", ["name" => $name]);
  }
}
