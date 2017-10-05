<?php

namespace SBsearch\Search\Model;

use SBWebApplication\Application as App;
use SBWebApplication\Database\ORM\ModelTrait;
//use SBWebApplication\System\Model\DataModelTrait;

/**
 * @Entity(tableClass="@search_keywords")
 */
class SearchKeywords implements \JsonSerializable
{
	//use DataModelTrait, ModelTrait;
	use ModelTrait;
	
	/** @Column(type="integer") @Id */
    public $id;
	
    /** @Column(type="string") */
    public $word;

    /** @Column(type="integer") */
    public $ip;

    /** @Column(type="datetime") */
    public $putdate;

}
