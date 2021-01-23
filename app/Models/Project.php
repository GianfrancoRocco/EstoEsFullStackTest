<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Project extends Model
{
    protected $table = "projects";

    public $timestamps = false;
    
    protected $fillable = [
        'idproject',
        'project_info',
        'description',
        'fk_idproject_manager',
        'fk_idassigned_to',
        'fk_idstatus',
        'uploaded_at'
    ];

    public function loadFromRequest($request){
        $this->idproject = $request->input('id') != "0" ? $request->input('id') : $this->idproject;
        $this->project_info = $request->input('txtProjectInfo');
        $this->description = $request->input('txtDescription');
        $this->fk_idproject_manager = $request->input('lstProjectManager');
        $this->fk_idassigned_to = $request->input('lstAssignedTo');
        $this->fk_idstatus = $request->input('lstStatus');
    }

    public function insert(){
        $sql = "INSERT INTO projects (
            project_info,
            description,
            fk_idproject_manager,
            fk_idassigned_to,
            fk_idstatus,
            uploaded_at
        ) VALUES (?, ?, ?, ?, ?, ?)";
        $result = DB::insert($sql, [
            $this->project_info,
            $this->description,
            $this->fk_idproject_manager,
            $this->fk_idassigned_to,
            $this->fk_idstatus,
            $this->uploaded_at = date("Y-m-d H:i:s")
        ]);
        return $this->idproject = DB::getPdo()->lastInsertId();
    }

    public function update(array $attributes = [], array $options = []){
        $sql = "UPDATE projects SET
                    project_info = '$this->project_info',
                    description = '$this->description',
                    fk_idproject_manager = '$this->fk_idproject_manager',
                    fk_idassigned_to = '$this->fk_idassigned_to',
                    fk_idstatus = '$this->fk_idstatus'
                WHERE idproject = ?";
        $affected = DB::update($sql, [$this->idproject]);
    }

    public function delete(){
        $sql = "DELETE FROM projects WHERE idproject = ?";
        $affected = DB::delete($sql, [$this->idproject]);
    }

    public function getAll(){
        $sql = "SELECT
                    A.idproject,
                    A.project_info,
                    A.description,
                    A.fk_idproject_manager,
                    A.fk_idassigned_to,
                    A.fk_idstatus,
                    A.uploaded_at,
                    CONCAT(B.name, ' ', B.lastname) AS manager,
                    CONCAT(C.name, ' ', C.lastname) AS assigned_to,
                    D.status
                FROM
                    projects A
                    INNER JOIN managers B ON A.fk_idproject_manager = B.idmanager
                    INNER JOIN employees C ON A.fk_idassigned_to = C.idemployee
                    INNER JOIN project_status D ON A.fk_idstatus = D.idstatus";
        $lstResponse = DB::select($sql);
        return $lstResponse;
    }

    public function getById($id){
        $sql = "SELECT
                    project_info,
                    description,
                    fk_idproject_manager,
                    fk_idassigned_to,
                    fk_idstatus,
                    uploaded_at
                FROM projects
                WHERE idproject = $id";
        $result = DB::select($sql);
        if(count($result) > 0){
            $this->project_info = $result[0]->project_info;
            $this->description = $result[0]->description;
            $this->fk_idproject_manager = $result[0]->fk_idproject_manager;
            $this->fk_idassigned_to = $result[0]->fk_idassigned_to;
            $this->fk_idstatus = $result[0]->fk_idstatus;
            $this->uploaded_at = $result[0]->uploaded_at;
            return $this;
        }
        return null;
    }
}

?>