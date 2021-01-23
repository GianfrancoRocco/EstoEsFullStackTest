<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Manager;
use App\Models\Employee;
use App\Models\Status;

require app_path() . '/start/constants.php';

class ProjectController extends Controller
{

    public function index(){
        $title = "My projects";
        return view("projects", compact('title'));
    }

    public function getProjects(){
        $project = new Project();
        $aProject = $project->getAll();
        return json_encode($aProject);
    }

    public function new(){
        $title = "Add project";
        $project = new Project();
        
        $manager = new Manager();
        $aManager = $manager->getAll();

        $employee = new Employee();
        $aEmployee = $employee->getAll();

        $status = new Status();
        $aStatus = $status->getAll();

        $exists = true;

        return view("project-new", compact('title', 'project', 'aManager', 'aEmployee', 'aStatus', 'exists'));
    }

    public function save(Request $request){
        $project = new Project();
        $project->loadFromRequest($request);

        $id = $request->input("id");

        $title = "My projects";
        if($project->project_info != "" && $project->fk_idproject_manager != null && $project->fk_idassigned_to != null && $project->fk_idstatus != null){
            if($id > 0){
                $project->idproject = $id;
                $project->update();
                $msg["msg"] = "Project updated successfully";
                $msg["status"] = MSG_SUCCESS;
            } else {
                $project->insert();
                $msg["msg"] = "Project created successfully";
                $msg["status"] = MSG_SUCCESS;
            }
            return view("projects", compact('title', 'msg'));
        } else {
            $project = new Project();
            $project->getById($id);
    
            $manager = new Manager();
            $aManager = $manager->getAll();
    
            $employee = new Employee();
            $aEmployee = $employee->getAll();
    
            $status = new Status();
            $aStatus = $status->getAll();

            $msg["msg"] = "Fill all fields";
            $msg["status"] = MSG_ERROR;
        }        
        return view("project-new", compact('title', 'project', 'aManager', 'aEmployee', 'aStatus', 'msg'));
    }

    public function edit($id){
        $title = "Edit project";

        $project = new Project();
        $project->getById($id);

        $exists = false;

        if($project->project_info){
            $exists = true;
        }

        $manager = new Manager();
        $aManager = $manager->getAll();

        $employee = new Employee();
        $aEmployee = $employee->getAll();

        $status = new Status();
        $aStatus = $status->getAll();

        return view("project-new", compact('title', 'id', 'project', 'aManager', 'aEmployee', 'aStatus', 'exists'));
    }

    public function delete(Request $request){
        $id = $request->input('idProject');
        $project = new Project();
        $project->idproject = $id;
        $project->delete();

        return json_encode("1");
    }
}

?>