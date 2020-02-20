<?php

include_once './Header.php';

?>

<html>

<head>
    <link href="../css/Tabs.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>



    <div class="container">
        <div>
            <div class="row justify-content-center " style="margin-top:1%;">
                <div class="col-lg-12  col-center ">
                    <div class="card ">
                        <div class="card-body">
                            <form name="importa" id="importa" method="post" enctype="multipart/form-data">
                                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!------ Include the above in your HEAD tag ---------->

    <section id="tabs" class="project-tab">
        <div class="container" style="margin-top:1%;">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs md-tabs " id="myTabMD" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md" aria-selected="true  ">
                                <div class="alert alert-warning " role="alert">
                                    <font id="fuente"><b>1</b></font>
                                </div>
                                ESPERANDO APROBACION
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md" aria-selected="false">
                                <div class="alert alert-success " role="alert">
                                    <font id="fuente"><b>1</b></font>
                                </div>
                                APROBACIONES
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md" aria-selected="false">
                                <div class="alert alert-danger" role="alert">
                                    <font id="fuente"><b>1</b></font>
                                </div>
                                RECHAZADAS
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content card pt-5" id="myTabContentMD">
                        <div class="tab-pane fade show active" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">

                            <div class="container" style="margin-top:-3%;">
                                <fieldset class=" section-content-bar ">
                                    <div class="panel panel-default">
                                        <div class="col-lg-5">
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                          
                            <div class="card item-card" style="margin-top:3%; margin-bottom:10px">
                                <fieldset class="">
                                    <div class="">
                                        <div class="">

                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">

                        </div>
                        <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div>
            <div class="row justify-content-center " style="margin-top:1%;">
                <div class="col-lg-12  col-center ">
                    <div class="card ">
                        <div class="card-body">
                            <form name="importa" id="importa" method="post" enctype="multipart/form-data">
                                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>