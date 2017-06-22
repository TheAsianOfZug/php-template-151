<?php
namespace dhu\Controller;

use dhu\SimpleTemplateEngine;
class GameController
{
        
    /**
     *
     * @var dhu\SimpleTemplateEngine Template engines to render output
     */
    private $template;
    
    /**
     *
     * @param
     *            dhu\SimpleTemplateEngine
     */
    public function __construct(SimpleTemplateEngine $template)
    {
        $this->template = $template;
    }
    public function showGameField()
    {
        echo $this->template->render("game.html.php");
    }
}