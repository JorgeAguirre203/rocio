<?php
/**
 * Smarty compiler exception class
 * @package Smarty
 */
class SmartyCompilerException extends SmartyException
{
    /**
     * The line number of the template error
     * @var int
     */
    public int $line = 0;  // Cambiado a int con valor inicial 0

    /**
     * The template source snippet relating to the error
     * @var string|null
     */
    public ?string $source = null;

    /**
     * The raw text of the error message
     * @var string|null
     */
    public ?string $desc = null;

    /**
     * The resource identifier or template name
     * @var string|null
     */
    public ?string $template = null;

    /**
     * @return string
     */
    public function __toString()
    {
        return ' --> Smarty Compiler: ' . $this->message . ' <-- ';
    }
}
