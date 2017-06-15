<?php
namespace dhu\Controller;

use dhu\SimpleTemplateEngine;

class IndexController
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

    public function showHomepage()
    {
        echo $this->template->render("homepage.html.php");
    }
}
