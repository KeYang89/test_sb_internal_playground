<?php

namespace SBWebApplication\Site\Model;

use SBWebApplication\Application as App;
use SBWebApplication\System\Model\DataModelTrait;
use SBWebApplication\System\Model\NodeInterface;
use SBWebApplication\System\Model\NodeTrait;
use SBWebApplication\User\Model\AccessModelTrait;
use SBWebApplication\User\Model\User;

/**
 * @Entity(tableClass="@system_node")
 */
class Node implements NodeInterface, \JsonSerializable
{
    use AccessModelTrait, DataModelTrait, NodeModelTrait, NodeTrait;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column(type="integer") */
    public $parent_id = 0;

    /** @Column(type="integer") */
    public $priority = 0;

    /** @Column(type="integer") */
    public $status = 0;

    /** @Column(type="string") */
    public $slug;

    /** @Column(type="string") */
    public $path;

    /** @Column(type="string") */
    public $link;

    /** @Column(type="string") */
    public $title;

    /** @Column(type="string") */
    public $type;

    /** @Column(type="string") */
    public $menu = '';

    /** @var array */
    protected static $properties = [
        'accessible' => 'isAccessible'
    ];

    /**
     * Gets the node URL.
     *
     * @param  mixed  $referenceType
     * @return string
     */
    public function getUrl($referenceType = false)
    {
        return App::url($this->link, [], $referenceType);
    }

    public function isAccessible(User $user = null)
    {
        return $this->status && $this->hasAccess($user ?: App::user());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray(['url' => $this->getUrl('base')]);
    }
}
