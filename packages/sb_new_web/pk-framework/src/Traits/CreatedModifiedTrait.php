<?php

namespace SB\PkFramework\Traits;


trait CreatedModifiedTrait {

	/** @Column(type="integer") */
	public $created_by = 0;

	/** @Column(type="datetime") */
	public $created = '';

	/** @Column(type="integer") */
	public $modified_by = 0;

	/** @Column(type="datetime") */
	public $modified = '';

}