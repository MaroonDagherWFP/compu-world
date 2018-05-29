<?php

namespace App\Http\Controllers;

use App\Services\DataService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class DataController extends Controller
{
	public function __construct(DataService $dataService, Request $request)
	{
		$this->request = $request;
		$this->dataService = $dataService;
	}

	public function getAvailableDatabases()
	{
		return $this->dataService->getDatabases();
	}

    public function getData()
    {
    	return $this->dataService->getData();
    }

    public function getDataWithShared1()
    {
    	$data = $this->getData();
    	$collection = $data->where('shared', 1);

    	// return data in pages to display
    	$data = $this->dataService->paginate($collection);
        return View::make('shared-files')->with('data', $data);
    }

    public function getDataWithShared0()
    {
    	$data = $this->getData();
    	$collection = $data->where('shared', 0);

    	// return data in pages to display
    	$data = $this->dataService->paginate($collection);
        return View::make('unshared-files')->with('data', $data);
    }

    public function getDataWithCreator1()
    {
    	$data = $this->getData();
    	$collection = $data->where('creator', 1);

    	// return data in pages to display
    	$data = $this->dataService->paginate($collection);
        return View::make('owned-files')->with('data', $data);
    }

    public function getDataWithCreator0()
    {
    	$data = $this->getData();
    	$collection = $data->where('creator', 0);

    	// return data in pages to display
        $data = $this->dataService->paginate($collection);
        return View::make('not-owned-files')->with('data', $data);
    }

    public function findDuplicatedFileNames()
    {
    	$data = $this->getData();
    	$collection_unique = $data->unique('filename');

	    $collection_grouped = $data->groupBy('filename');

	    $dupes = $collection_grouped->filter(function (Collection $groups) {
	        return $groups->count() > 1;
	    });

	    $file_names_dups = array();

	    foreach ($dupes as $key => $value) {
	    	array_push($file_names_dups, $key);
	    }

		// $duplicated_name = $data->diff($collection_unique);
    	// return data in pages to display
    	$data = $file_names_dups;
        return View::make('duplicate-files')->with('data', $data);
    }

    public function findByDate()
    {
        try {
        	$start_date = isset($this->request->start_date) ? Carbon::parse($this->request->start_date) : Carbon::parse('1900-01-01');
        	$end_date = isset($this->request->end_date) ? Carbon::parse($this->request->end_date) : Carbon::parse('1900-01-01');
        	$data = $this->getData();

        	$start_date = new \DateTime($start_date);
        	$end_date = new \DateTime($end_date);

        	$collection = $data->where('date_modified', '>=', $start_date->getTimestamp())->where('date_modified', '<=', $end_date->getTimestamp());

    		$data = $this->dataService->paginate($collection);
            return View::make('search')->with('data', $data);
        } catch(\Exception $e) {
            return View::make('search')->with('error', 'Date String invalid Try Again');
        }
    }

    public function search()
    {
        return View::make('search');
    }
}
