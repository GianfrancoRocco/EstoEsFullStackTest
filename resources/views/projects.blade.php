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
    <style>
        .uploaded_at{
            font-size: 14px;
            color: gray;
        }
        table{
            background: #fff;
        }
        table thead{
            background: #fafafa;
        }
        #main-section{
            background: #f0f2f5;
            height: 90vh
        }
        .edit-btn{
            font-size: 20px;
        }
        .dialog-btn{
            font-size: 15px;
            color: gray;
        }
        .dialog-btn:hover{
            text-decoration: none;
        }
        .actionDialog{
            width: 150px;
            z-index: 99;
        }
        .edit-btn i:hover{
            cursor: pointer;
        }
    </style>
</head>
<body class="container-fluid px-0">
    <section id="head-section">
        <div class="py-3 px-lg-5 px-4 border-bottom">
            <div class="row">
                <div class="col-12">
                    <p class="mb-0">LOGO</p>
                </div>
            </div>
        </div>
        <div class="py-3 px-lg-5 px-4 border-bottom">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <h5 class="font-weight-bold mb-lg-0 mb-3 text-lg-left text-center">{{$title}}</h5>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="float-lg-right text-lg-right text-center">
                        <a href="/projects" class="btn-danger btn"><i class="fas fa-sync-alt"></i> Reload</a>
                        <a href="/projects/new" class="btn-danger btn"><i class="fas fa-plus"></i> Add project</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="main-section">
        <div class="row">
            <div class="col-12">
                <?php if(isset($msg)): ?>
                <div class="mx-lg-5 mt-5 alert alert-{{$msg['status']}}">{{$msg["msg"]}}</div>
                <?php endif; ?>
            </div>
            <div class="col-12">
                <div class="mx-5 d-lg-block d-none" id="projects-grid"></div>
                <div id="projects-grid-mobile" class="d-lg-none d-block mt-3"></div>
            </div>
        </div>
    </section>
</body>
<script>

    $(document).ready(function(){
        getProjects();
    });

    function getProjects(){
        $.ajax({
            type: "GET",
            url: "/projects/getProjects",
            dataType: "json",
            async: true,
            success: function(data){
                let htmlResponse = "<p class='m-5 text-center'>No projects found!</p>";
                let htmlResponseMobile = "<p class='m-5 text-center'>No projects found!</p>";
                if(data.length){
                    htmlResponseMobile = "";
                    htmlResponse = `
                    <table class="table table-hover table-bordered my-3">
                        <tr>
                            <thead>
                                <th>Project info</th>
                                <th>Project Manager</th>
                                <th>Assigned to</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>                        
                        </tr>
                        <tbody>
                    `;                    
                    data.forEach(element => {
                        let creationDate = new Date(element.uploaded_at);
                        let ampm = (creationDate.getHours() >= 0 || creationDate.getHours() <= 11) ? "AM" : "PM";
                        htmlResponse+=`
                        <tr>
                            <td>${element.project_info}<br><span class="uploaded_at">Creation date: ${creationDate.getDate()}/${creationDate.getMonth() + 1}/${creationDate.getFullYear()} ${creationDate.getHours()}:${creationDate.getMinutes()} ${ampm}</span></td>
                            <td>${element.manager}</td>
                            <td>${element.assigned_to}</td>
                            <td>${element.status}</td>
                            <td>
                                <div class="col-2 text-center edit-btn position-relative">
                                    <i class="fas fa-ellipsis-v" onclick="openActionDialog(${element.idproject})"></i>
                                    <div id="actionDialog_${element.idproject}" class="d-none bg-white position-absolute border rounded actionDialog actionDialog_${element.idproject}" style="right: 0;">
                                        <a class="pr-5 dialog-btn" href="/projects/${element.idproject}"><i class="far fa-edit"></i> Edit</a>
                                        <div class="border-bottom"></div>
                                        <button class="btn pl-3 pr-5 dialog-btn" onclick="deleteProject(${element.idproject})"><i class="far fa-trash-alt"></i> Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
                        htmlResponseMobile += `
                        <div class="px-4 py-3 bg-white">
                        <div class="row">
                            <div class="col-10">
                                <p class="mb-0">${element.project_info}<br><span class="uploaded_at">Creation date: ${creationDate.getDate()}/${creationDate.getMonth() + 1}/${creationDate.getFullYear()} ${creationDate.getHours()}:${creationDate.getMinutes()} ${ampm}</span></p>
                                <p class="mb-0">${element.manager}</p>
                            </div>
                            <div class="col-2 text-center edit-btn position-relative">
                                <i class="fas fa-ellipsis-v" onclick="openActionDialog(${element.idproject})"></i>
                                <div id="actionDialog_${element.idproject}" class="d-none bg-white position-absolute border rounded actionDialog actionDialog_${element.idproject}" style="right: 0;">
                                    <a class="pr-5 dialog-btn" href="/projects/${element.idproject}"><i class="far fa-edit"></i> Edit</a>
                                    <div class="border-bottom"></div>
                                    <button class="btn pl-3 pr-5 dialog-btn" onclick="deleteProject(${element.idproject})"><i class="far fa-trash-alt"></i> Delete</button>
                                </div>
                            </div>
                        </div>
                        
                        </div>
                        `;
                    });
                    htmlResponse+=`
                        </tbody>
                    </table> `;
                }
                $("#projects-grid").empty().append(htmlResponse);
                $("#projects-grid-mobile").empty().append(htmlResponseMobile);
            }
        });
    }

    function deleteProject(idProject){
        $.ajax({
            type: "GET",
            url: "/projects/delete",
            data: {idProject: idProject},
            async: true,
            dataType: "json",
            success: function(response){
                window.location.href = "/projects";
            }
        });
    }

    function openActionDialog(id){
        $(".actionDialog_"+id).toggleClass("d-none");
    }

</script>
</html>