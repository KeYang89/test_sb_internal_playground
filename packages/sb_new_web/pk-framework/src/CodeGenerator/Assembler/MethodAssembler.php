<?php

namespace SB\PkFramework\CodeGenerator\Assembler;

use Phpro\SoapClient\CodeGenerator\Assembler\AssemblerInterface;
use Phpro\SoapClient\CodeGenerator\Context\ContextInterface;
use Phpro\SoapClient\CodeGenerator\Context\PropertyContext;
use Phpro\SoapClient\CodeGenerator\Context\TypeContext;
use Phpro\SoapClient\Exception\AssemblerException;

/**
 * Class InterfaceAssembler
 * @package Phpro\SoapClient\CodeGenerator\Assembler
 */
class MethodAssembler implements AssemblerInterface {
    /**
     * @var
     */
    private $interfaceName;

    /**
     * InterfaceAssembler constructor.
     * @param $interfaceName
     */
    public function __construct ($interfaceName) {
        $this->interfaceName = $interfaceName;
    }

    /**
     * @param ContextInterface $context
     * @return bool
     */
    public function canAssemble (ContextInterface $context) {
        return $context instanceof PropertyContext and $context->getProperty()->getName() == 'credentials';
    }

    /**
     * @param ContextInterface|TypeContext $context
     */
    public function assemble (ContextInterface $context) {
        $class = $context->getClass();
        $interface = $this->interfaceName;


        try {
            if (!in_array($interface, $class->getUses())) {
                $class->addUse($interface);
            }

            $interfaces = $class->getImplementedInterfaces();
            if (!in_array($interface, $interfaces)) {
                $interfaces[] = $interface;
                $class->setImplementedInterfaces($interfaces);
            }
        } catch (\Exception $e) {
            throw AssemblerException::fromException($e);
        }
    }
}
