<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Manager extends Model
{
    protected $table = "managers";
    
    protected $fillable = [
        'idmanager',
        'name',
        'lastname',
        'profile_pic'
    ];
    public function getAll(){
        $sql = "SELECT
                    idmanager,
                    name,
                    lastname,
                    profile_pic
                FROM
                    managers";
        $lstResponse = DB::select($sql);
        return $lstResponse;
    }
}

?>