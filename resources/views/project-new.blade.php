<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php $id = (isset($id) && $id > 0) ? $id : 0; ?>
    <style>
        #main-section{
            background: #f0f2f5;
            height: 90vh
        }
        form{
            background: #fff;
            width: 30%;
            margin: auto !important;
        }
        .back-btn{
            color: gray;
        }
        .back-btn:hover{
            color: gray;
        }
        @media(max-width: 1000px){
            form{
                width: unset;
            }
        }
    </style>
</head>
<body class="container-fluid px-0">
    <section id="head-section">
        <div class="py-3 px-lg-5 px-3 border-bottom">
            <div class="row">
                <div class="col-12">
                    <p class="mb-0">LOGO</p>
                </div>
            </div>
        </div>
        <div class="py-3 px-lg-5 px-3 border-bottom">
            <div class="row">
                <div class="col-lg-1 col-4">
                    <a href="/projects" class="back-btn"><i class="fas fa-arrow-left"></i> <span style="font-size: 15px;">Back</span></a>
                </div>
                <div class="col-lg-11 col-8">
                    <h5 class="font-weight-bold">{{$title}}</h5>
                </div>
            </div>
        </div>
    </section>
    <section id="main-section">
        <div class="row">
            <div class="col-12">
                @if($exists)
                    <form action="/projects/save" method="post" id="project-form" class="p-4 rounded shadow my-5">
                        <div class="row">
                            <div class="col-12">
                                <?php if(isset($msg)): ?>
                                    <div class="alert alert-{{$msg['status']}}">{{$msg["msg"]}}</div>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="id" value="{{$id}}">
                            @csrf
                            <div class="form-group col-12">
                                <label for="txtProjectInfo">Project info</label>
                                <input class="form-control" type="text" name="txtProjectInfo" value="{{$project->project_info}}" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="txtDescription">Description</label>
                                <input class="form-control" type="text" name="txtDescription" value="{{$project->description}}" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="txtProjectInfo">Project Manager</label>
                                <select name="lstProjectManager" class="form-control" required>
                                <option selected disabled>Select a person</option>
                                @foreach($aManager as $manager)
                                    @if($project->fk_idproject_manager == $manager->idmanager)
                                        <option value="{{$manager->idmanager}}" selected>{{$manager->name}} {{$manager->lastname}}</option>
                                    @else
                                    <option value="{{$manager->idmanager}}">{{$manager->name}} {{$manager->lastname}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="txtProjectInfo">Assigned to</label>
                                <select name="lstAssignedTo" class="form-control" required>
                                <option selected disabled>Select a person</option>
                                @foreach($aEmployee as $employee)
                                    @if($project->fk_idassigned_to == $employee->idemployee)
                                        <option value="{{$employee->idemployee}}" selected>{{$employee->name}} {{$employee->lastname}}</option>
                                    @else
                                    <option value="{{$employee->idemployee}}">{{$employee->name}} {{$employee->lastname}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="txtProjectInfo">Status</label>
                                <select name="lstStatus" class="form-control" required>
                                <option selected disabled>Select</option>
                                @foreach($aStatus as $status)
                                    @if($project->fk_idstatus == $status->idstatus)
                                        <option value="{{$status->idstatus}}" selected>{{$status->status}}</option>
                                    @else
                                    <option value="{{$status->idstatus}}">{{$status->status}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                            <button type="submit" class="btn-danger btn float-left"><i class="bi bi-plus"></i><?php echo (isset($id) && $id > 0) ? "Save changes" : "Create project" ?></button>
                            </div>
                        </div>                    
                    </form>
                @else
                    <div class="text-center">
                        <p class="m-5">Oh no, there's no project with that ID :(</p>
                    </div>
                @endif            
            </div>
        </div>
    </section>
</body>
</html>