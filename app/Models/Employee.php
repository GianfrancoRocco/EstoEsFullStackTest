<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Employee extends Model
{
    protected $table = "employees";
    
    protected $fillable = [
        'idemployee',
        'name',
        'lastname',
        'profile_pic'
    ];
    public function getAll(){
        $sql = "SELECT
                    idemployee,
                    name,
                    lastname,
                    profile_pic
                FROM
                    employees";
        $lstResponse = DB::select($sql);
        return $lstResponse;
    }
}

?>