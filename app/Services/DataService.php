<?php

namespace App\Services;

use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class DataService {
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function getDatabases()
	{
    	$system_databases = ['information_schema', 'DALILI', 'VOICES', 'WFP', 'homestead', 'livelyhoods', 'mysql', 'performance_schema', 'sys'];
		
		$link = mysqli_connect(
			env('DB_HOST', '127.0.0.1'), 
			env('DB_USERNAME', 'homestead'), 
			env('DB_PASSWORD', '')
		);

		$res = mysqli_query($link, "SHOW DATABASES");

		$databases = array();

		while ($row = mysqli_fetch_assoc($res)) {
			if(!in_array($row['Database'], $system_databases)) {
		    	array_push($databases, $row);
			}
		}

		return $databases;
	}

	public function getTablesInDB($db)
	{
		DB::purge('mysql');

		Config::set("database.connections.mysql", [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => $db,
            'username' => env('DB_USERNAME', 'homestead'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null
		]);

    	$tables = DB::select('SHOW TABLES');

    	$data = array();

    	foreach ($tables as $key => $table) {
    		$table_name = "Tables_in_".$db;
    		array_push($data, $table->$table_name);
    	}

    	return $data;

	}

    public function getDataFromDB($tables)
    {
		$data = array();

		$old_collection = null;
		$merged_collection = null;
		
		foreach ($tables as $key => $table) {
			$next_collection = DB::table($table)->select('*')->get();
			$merged_collection = $next_collection->merge($old_collection);
			$old_collection = $next_collection;
		}

		return $merged_collection;
    }

    public function getData()
    {
    	$databases = $this->getDatabases();

    	$test = [];

    	foreach ($databases as $key => $database) {
    		$tables_in_db = $this->getTablesInDB($database['Database']);
    		$data_in_db[$database['Database']] = $this->getDataFromDB($tables_in_db);
    		// $data_in_db[$database['Database']] = $this->getDataFromDB($tables_in_db);
    	}

    	$main_collection = null;

    	foreach ($data_in_db as $database => $collection) {
    		$main_collection = $collection->merge($main_collection);
    	}

    	return $main_collection;
    }

    public function paginate($collection)
    {
		$page = isset($this->request->page) ? $this->request->page : 1;
		$perPage = isset($this->request->perPage) ? $this->request->perPage : 100;
		$offset = ($page * $perPage) - $perPage;

		return new LengthAwarePaginator(
		    array_slice($collection->toArray(), $offset, $perPage, true), // Only grab the items we need
		    count($collection), // Total items
		    $perPage, // Items per page
		    $page, // Current page
		    ['path' => $this->request->url(), 'query' => $this->request->query()]
		);
    }

    public function findDuplicate($field)
    {
    	
    }
}