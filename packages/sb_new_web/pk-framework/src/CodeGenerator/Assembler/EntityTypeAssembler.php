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
class EntityTypeAssembler implements AssemblerInterface {
    /**
     * @var
     */
    private $interfaceName;
    /**
     * @var
     */
    private $traitName;
    /**
     * @var
     */
    private $traitAlias;

    /**
     * InterfaceAssembler constructor.
     * @param $interfaceName
     * @param $traitName
     * @param $traitAlias
     */
    public function __construct ($interfaceName, $traitName, $traitAlias) {
        $this->interfaceName = $interfaceName;
        $this->traitName = $traitName;
        $this->traitAlias = $traitAlias;
    }

    /**
     * @param ContextInterface $context
     * @return bool
     */
    public function canAssemble (ContextInterface $context) {
        return $context instanceof PropertyContext and $context->getProperty()->getName() == 'EntityTypeId';
    }

    /**
     * @param ContextInterface|TypeContext $context
     */
    public function assemble (ContextInterface $context) {
        $class = $context->getClass();
        $interface = $this->interfaceName;
        $trait = $this->traitName;


        try {
            if (!in_array($interface, $class->getUses())) {
                $class->addUse($interface);
            }
            if (!in_array($trait, $class->getUses())) {
                $class->addUse($trait);
            }

            $interfaces = $class->getImplementedInterfaces();
            if (!in_array($interface, $interfaces)) {
                $interfaces[] = $interface;
                $class->setImplementedInterfaces($interfaces);
            }

            $traits = $class->getTraits();
            if (!in_array($this->traitAlias, $traits)) {
                $class->addTrait($this->traitAlias);
            }
        } catch (\Exception $e) {
            throw AssemblerException::fromException($e);
        }
    }
}
