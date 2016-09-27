<?php
/**
 * Class InvalidFormException
 *
 * @category
 * @package Wbi\Api\ProductBundle\Exception
 * @author Boumaiza Majdi <boumaiza.majdi@mail.com>
 */


namespace Wbi\Api\ProductBundle\Exception;


class InvalidFormException extends \RuntimeException
{
    protected $form;
    public function __construct($message, $form = null)
    {
        parent::__construct($message);
        $this->form = $form;
    }
    /**
     * @return array|null
     */
    public function getForm()
    {
        return $this->form;
    }
}

