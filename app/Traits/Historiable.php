<?php

namespace App\Traits;

use App\HistoryError;
use App\HistoryItem;

trait Historiable {

	private $model_name;
    private $user_type;

    public function __construct()
    {
        $this->model_name = str_singular($this->getTable());
    }

    private function setUserType()
    {
        if(auth()->guard('admin')->user()) {
            $this->user_type = 'admin';
        } else {
            $this->user_type = 'member';
        }
    }

    public function histories()
    {
        return HistoryItem::where('model_name', $this->model_name)
        		->where('model_id', $this->id)->get();
    }

    public function hasHistory()
    {
        return HistoryItem::where('model_name', $this->model_name)
        		->where('model_id', $this->id)->count() > 0? true : false;
    }

    public function makeHistory($description)
    {
        $this->setUserType();

    	try {
    		HistoryItem::create([
	    		'model_name' => $this->model_name,
	    		'model_id' => $this->id,
	    		'description' => $description,
                'performed_by' => auth()->guard($this->user_type)->user()->id
    		]);

    		return true;
    	} catch (\Exception $e) {
    		HistoryError::create([
    			'model_name' => $this->model_name,
	    		'model_id' => $this->id,
	    		'description' => $e->getMessage()
    		]);

    		return false;
    	}
    }
}