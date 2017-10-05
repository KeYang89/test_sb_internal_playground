<?php

namespace SBWebApplication\Widget\Model;

use SBWebApplication\Database\ORM\ModelTrait;
use SBWebApplication\System\Model\DataModelTrait;
use SBWebApplication\User\Model\AccessModelTrait;

/**
 * @Entity(tableClass="@system_widget")
 */
class Widget implements \JsonSerializable
{
    use AccessModelTrait, DataModelTrait, ModelTrait;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column */
    public $title = '';

    /** @Column(type="string") */
    public $type;

    /** @Column(type="integer") */
    public $status = 1;

    /** @Column(type="simple_array") */
    public $nodes = [];
}
