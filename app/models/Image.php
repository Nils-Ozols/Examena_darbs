<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Image extends Eloquent {

	protected $table = 'images';
	
	public function gallery() {
		return $this->belongsTo('Gallery');
	} 

}
