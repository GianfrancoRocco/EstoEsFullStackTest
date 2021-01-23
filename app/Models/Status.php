<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Status extends Model
{
    protected $table = "project_status";
    
    protected $fillable = [
        'idstatus',
        'status',
    ];
    public function getAll(){
        $sql = "SELECT
                    idstatus,
                    status
                FROM
                    project_status";
        $lstResponse = DB::select($sql);
        return $lstResponse;
    }
}

?>