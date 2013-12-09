<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Freakybox</title>

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900,300italic,400italic,900italic' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="/js/colorpicker.js"></script>
	<script type="text/javascript" src="/js/freakybox.js"></script>
	
	<script src="http://192.168.0.107:5000/socket.io/socket.io.js"></script>
	<script type="text/javascript" src="/js/frontend.js"></script>
	<script>
		var Frontend = new Core();
		Frontend.init('192.168.0.107:5000', <?php echo $_SESSION['uid']; ?>);
	</script>
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body> 
  
  	<div id="wrap">    

        <div class="container">
        
            <div id="header" class="row">
                
                <div class="col-md-2 main-logo">
                    
                   <h1><a href="#" title="Freakybox"><img src="../images/freaky-logo.png" alt="Freakybox Logo" title="Freakybox"></a></h1>
                    
                </div><!-- / col 2 -->
                
                <div class="col-md-10 main-bar">
                
                    <div class="buttons left">
                
                        <div class="dropdown add-new">
                          <a data-toggle="dropdown" class="btn" href="#">Add New<span></span></a>
                          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                         	 <span class="caret"></span>
                            <li role="presentation"><a data-toggle="modal" href="#modal-create-team" role="menuitem" tabindex="-1">Crear Equipo</a></li>
                            <li class="divider"></li>
                            <li role="presentation"><a data-toggle="modal" href="#modal-create-project" role="menuitem" tabindex="-1">Crear Proyecto</a></li>
                            <li class="divider"></li>
                            <li role="presentation"><a data-toggle="modal" href="#modal-create-task" role="menuitem" tabindex="-1">Crear Tarea</a></li>
                          </ul>
                        </div><!-- / dropdown -->
                        
                        <a href="#" class="btn team-builder" title="Team Builder">Team Builder</a>
                    
                    </div><!-- / buttons -->
                    
                    <div class="nav right">
                        
                        <div class="user-profile dropdown">
                            <img src="../images/marcelo.png" alt="Marcelo" title="Marcelo">
                            <a data-toggle="dropdown" class="btn" href="#">Marcelo Angel</a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                              	<span class="caret"></span>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Settings</a></li>
                                <li class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Profile</a></li>
                                <li class="divider"></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Logout</a></li>
                              </ul>
                        </div><!-- / user profile -->
                        
                         <div class="notifications dropdown">
                            <a data-toggle="dropdown" class="notification-btn" href="#"></a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                              	<span class="caret"></span>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#">
                                    	<img src="../images/fed.jpg" alt="Fede">
                                        <div class="notification excerpt"><div class="name">Federico:</div>the lightweight, feature-rich and easy to use..</div>
                                        <div class="date-update">Monday at 12:22 pm</div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#">
                                    	<img src="../images/fed.jpg" alt="Fede">
                                        <div class="notification excerpt"><div class="name">Federico:</div>the lightweight, feature-rich and easy to use..</div>
                                        <div class="date-update">Monday at 12:22 pm</div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" href="#">
                                    	<img src="../images/fed.jpg" alt="Fede">
                                        <div class="notification excerpt"><div class="name">Federico:</div>the lightweight, feature-rich and easy to use..</div>
                                        <div class="date-update">Monday at 12:22 pm</div>
                                    </a>
                                </li>
                                <li class="view-all-messages" role="presentation"><a href="" title="">Ver todos los mensajes</a></li>
                              </ul>
                        </div><!-- / notifications -->
                        
                        <div class="upgrade-plan right">
                            <button type="button" class="btn">Upgrade Plan</button>
                        </div><!-- / calendar -->
                        
                        <div class="calendar right">
                            <a href="#" title="Calendar"></a>
                        </div><!-- / calendar -->
                    
                    </div><!-- right buttons -->
                    
                </div><!-- / col 10 -->
                
            </div><!-- / row -->
        
            <div class="row">
            
                <div class="col-md-2 sidebar">
                    
                    <div class="row">
                    
                        <div class="search-form">
                            
                            <form role="form">
                                <input type="text" class="form-control" id="search-imput" placeholder="Search">
                            </form>
                            
                        </div><!-- / search form -->
                        
                    </div><!-- / row -->
                    
                    <div class="row company-wrapper">
                    
                        <div class="company">
                          <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Company Name</a>
                        </div><!-- / company -->
                    
                    </div><!-- / row -->
                    <script type="">
							$(document).ready(function(){
								$.ajax({
									url: '/ajax/sidebar',
									dataType: 'html',
									success: function(data){
										$('.workspace-wrapper').html(data);
									}									
								});
							});
						</script>
                    <div class="row workspace-wrapper">
                        
                        
                    </div><!-- / row -->
                    
                </div><!-- col 2 -->
                
                <div class="col-md-10 app-content">
                
                    <div class="row">
                    
                        <div class="module states">
                        
                            <div class="title">
                                <strong>Featured</strong> Projects States
                                <a class="right all-projects-states" href="#" title="All Projects States">All Projects States</a>
                            </div><!-- / title -->
                            
                            <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
								<div class="project-state color-1">
									<span class="name left">Project Name Here</span>
									<span class="percentage right">78%</span>
									<div class="progress">
									  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
										<span class="sr-only">60% Complete</span>
									  </div><!-- / progress bar -->
									</div><!-- / progress -->
								</div><!-- / project State -->
							</a>
                            
							<a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                            <div class="project-state color-2">
                                <span class="name left">Project Name Here</span>
                                <span class="percentage right">78%</span>
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    <span class="sr-only">60% Complete</span>
                                  </div><!-- / progress bar -->
                                </div><!-- / progress -->
                            </div><!-- / project State -->
							</a>
                            
							<a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                            <div class="project-state color-3">
                                <span class="name left">Project Name Here</span>
                                <span class="percentage right">78%</span>
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    <span class="sr-only">60% Complete</span>
                                  </div><!-- / progress bar -->
                                </div><!-- / progress -->
                            </div><!-- / project State -->
							</a>
                            
							<a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                            <div class="project-state color-4">
                                <span class="name left">Project Name Here</span>
                                <span class="percentage right">78%</span>
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    <span class="sr-only">60% Complete</span>
                                  </div><!-- / progress bar -->
                                </div><!-- / progress -->
                            </div><!-- / project State -->
							</a>
                            
							<a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                            <div class="project-state color-5 last">
                                <span class="name left">Project Name Here</span>
                                <span class="percentage right">78%</span>
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    <span class="sr-only">60% Complete</span>
                                  </div><!-- / progress bar -->
                                </div><!-- / progress -->
                            </div><!-- / project State -->
							</a>
                            
                            <div id="other-projects-states">
                            
                                <div class="clearfix"></div>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                    <div class="project-state">
                                        <span class="name left">Project Name Here</span>
                                        <span class="percentage right">78%</span>
                                        <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div><!-- / progress bar -->
                                        </div><!-- / progress -->
                                    </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state last">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <div class="clearfix"></div>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                    <div class="project-state">
                                        <span class="name left">Project Name Here</span>
                                        <span class="percentage right">78%</span>
                                        <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div><!-- / progress bar -->
                                        </div><!-- / progress -->
                                    </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state last">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <div class="clearfix"></div>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                    <div class="project-state">
                                        <span class="name left">Project Name Here</span>
                                        <span class="percentage right">78%</span>
                                        <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div><!-- / progress bar -->
                                        </div><!-- / progress -->
                                    </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                                <a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                <div class="project-state last">
                                    <span class="name left">Project Name Here</span>
                                    <span class="percentage right">78%</span>
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        <span class="sr-only">60% Complete</span>
                                      </div><!-- / progress bar -->
                                    </div><!-- / progress -->
                                </div><!-- / project State -->
                                </a>
                                
                       		</div><!-- / other projects states -->         
                        
                        </div><!-- / module -->
                        
                    </div><!-- / row -->
                    
                    <div class="row">
                    
                        <div class="col-md-6 module">
                        
                            <div class="row">
                        
                                <div class="title">
                                    <strong>Marcelo'</strong>Tasks
                                     <div class="options dropdown">
                                        <a data-toggle="dropdown" class="btn" href="#"></a>
                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Imprimir</a></li>
											<li class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Enviar por Email</a></li>
                                          </ul>
                                    </div><!-- / options -->
									<div class="filter dropdown">
                                        <a data-toggle="dropdown" class="btn" href="#"></a>
                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Mis Tareas</a></li>
											<li class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver todas las tareas</a></li>
											<li class="divider"></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver por fecha</a></li>
											<li class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver por Proyecto</a></li>											
                                          </ul>
                                    </div><!-- / filter -->
                                </div><!-- / title -->
                                
                            </div><!-- / row -->    
                            
                             <div class="row">
                             
                             	<div id="tasks">
                                
                                	<div class="task completed">
                                        <div class="task-number">1</div>
                                        <div class="task-state"><input type="checkbox" value=""></div>
                                        <div class="task-title">Task title</div>
                                        <div class="view-task"><a class="view-task-btn" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" title="Remove Task"></a></div>
                                        <div class="task-due-date">Jul 13</div>
                                        <div class="task-project"><span class="label label-default"><a class="color-1" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Project Name</a></span></div>
                                    </div><!-- / task -->
                                    
                                    <div class="task has-subtask">
                                    
                                        <div class="task-number">1</div>
                                        <div class="task-state"><input type="checkbox" value=""></div>
                                        <div class="task-title"><span>Task title</span><a href="#" class="view-subtask" title="View Subtask"></a></div>
                                        <div class="view-task"><a class="view-task-btn" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" title="Remove Task"></a></div>
                                        <div class="task-due-date">Jul 13</div>
                                        <div class="task-project"><span class="label label-default"><a class="color-2" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Project Name</a></span></div>
                                        
                                        <div class="subtask-wrapper">
                                        
                                            <div class="subtask">
                                                <div class="task-state"><input type="checkbox" value=""></div>
                                                <div class="task-title">SubTask title</div>
                                                <div class="view-task"><a class="view-task-btn" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" title="Remove Task"></a></div>
                                                <div class="task-due-date">Jul 13</div>
                                            </div><!-- / sub task -->
                                            
                                            <div class="subtask">
                                                <div class="task-state"><input type="checkbox" value=""></div>
                                                <div class="task-title">SubTask title</div>
                                                <div class="view-task"><a class="view-task-btn" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" title="Remove Task"></a></div>
                                                <div class="task-due-date">Jul 13</div>
                                            </div><!-- / sub task -->
                                            
                                    	</div><!-- / subtask wrapper -->
										
                                    </div><!-- / task -->
                                    
                                    <div class="task">
                                        <div class="task-number">1</div>
                                        <div class="task-state"><input type="checkbox" value=""></div>
                                        <div class="task-title">Task title</div>
                                        <div class="view-task"><a class="view-task-btn" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" title="Remove Task"></a></div>
                                        <div class="task-due-date">Jul 13</div>
                                        <div class="task-project"><span class="label label-default"><a class="color-3" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Project Name</a></span></div>
                                    </div><!-- / task -->
                                    
                                    <div class="task">
                                        <div class="task-number">1</div>
                                        <div class="task-state"><input type="checkbox" value=""></div>
                                        <div class="task-title">Task title</div>
                                        <div class="view-task"><a class="view-task-btn" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" title="Remove Task"></a></div>
                                        <div class="task-due-date">Jul 13</div>
                                        <div class="task-project"><span class="label label-default"><a class="color-4" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Project Name</a></span></div>
                                    </div><!-- / task -->
                                    
                                    <div class="task">
                                        <div class="task-number">1</div>
                                        <div class="task-state"><input type="checkbox" value=""></div>
                                        <div class="task-title">Task title</div>
                                        <div class="view-task"><a class="view-task-btn" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1" title="View Task"></a><a class="remove-task-btn" href="" title="Remove Task"></a></div>
                                        <div class="task-due-date">Jul 13</div>
                                        <div class="task-project"><span class="label label-default"><a class="color-5" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Project Name</a></span></div>
                                    </div><!-- / task -->
                                
                                </div><!-- / tasks -->
                                
                                  <div class="add-new-task-btn">
                                  	<a class="add-new-task" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">ADD NEW TASK</a>
                                  </div><!-- / add new task btn -->  
                                
                            </div><!-- / row -->    
                        
                        </div><!-- / col 6 -->
                        
                        <div class="col-md-6 module">
                        
                            <div class="row">
                        
                                <div class="title">
                                    <strong>Latest</strong> Teams Updates
                                    <div class="options dropdown">
                                        <a data-toggle="dropdown" class="btn" href="#"></a>
                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Imprimir</a></li>
											<li class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Enviar por Email</a></li>
                                          </ul>
                                    </div><!-- / options -->
									<div class="filter dropdown">
                                        <a data-toggle="dropdown" class="btn" href="#"></a>
                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver todo</a></li>
											<li class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver mis updates</a></li>
											<li class="divider"></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver las tareas que me gustan</a></li>
											<li class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Ver las tareas que sigo</a></li>	
                                          </ul>
                                    </div><!-- / filter -->
                                </div><!-- / title -->
                                
                            </div><!-- / row -->
                            
                            <div class="row">
                            
                                <div class="teams-updates">
                                
                                    <div class="task-update">
                                        
                                        <div class="task-update-header">
                                            
                                            <div class="task-update-title left">
                                                Task Title
                                            </div><!-- / task update title -->
                                            
                                            <a class="view-task-btn right" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1"></a>
                                            
                                            <div class="project-name-update right">
                                                <span class="label label-default"><a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Project Name</a></span>
                                            </div><!-- / project name update -->
                                            
                                        </div><!-- task update header -->
                                        
                                        <div class="update-notification">
                                        
                                            <div class="user left">
                                                <img src="../images/fed.jpg" alt="Fede">
                                            </div><!-- / user -->
                                            
                                            <div class="update-body right">
                                            
                                                <div class="name">
                                                    Federico <span class="task-completed-message">completed this task.</span>
                                                </div><!-- / name -->
                                                
                                                <div class="update-content">
                                                    <p>Marce mucho mejor que en el otro me parece mejor organado pero seguimos sin tener subpages? tenemos que teenr subpages, yo pensaba que ibas a dejar los main menus arriba como estaban y las subsecciiones a la izquierda.</p>
                                                </div><!-- / update content -->
                                                
                                                <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                                                <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                                                <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                                                
                                            </div><!-- / update body -->
                                            
                                        </div><!-- / update notification -->
                                        
                                    </div><!-- / task update -->
                                    
                                    <div class="task-update">
                                        
                                        <div class="task-update-header">
                                            
                                            <div class="task-update-title left">
                                                Task Title
                                            </div><!-- / task update title -->
                                            
                                            <a class="view-task-btn right" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1"></a>
                                            
                                            <div class="project-name-update right">
                                                <span class="label label-default"><a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Project Name</a></span>
                                            </div><!-- / project name update -->
                                            
                                        </div><!-- task update header -->
                                        
                                        <div class="update-notification">
                                        
                                            <div class="user left">
                                                <img src="../images/fed.jpg" alt="Fede">
                                            </div><!-- / user -->
                                            
                                            <div class="update-body right">
                                            
                                                <div class="name">
                                                    Federico <span class="task-completed-message">completed this task.</span>
                                                </div><!-- / name -->
                                                
                                                <div class="update-content">
                                                    <p>Marce mucho mejor que en el otro me parece mejor organado pero seguimos sin tener subpages? tenemos que teenr subpages, yo pensaba que ibas a dejar los main menus arriba como estaban y las subsecciiones a la izquierda.</p>
                                                </div><!-- / update content -->
                                                
                                                <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                                                <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                                                <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                                                
                                            </div><!-- / update body -->
                                            
                                        </div><!-- / update notification -->
                                        
                                        <div class="update-notification">
                                        
                                            <div class="user left">
                                                <img src="../images/marce.jpg" alt="Marce">
                                            </div><!-- / user -->
                                            
                                            <div class="update-body right">
                                            
                                                <div class="name">
                                                    Federico <span class="task-completed-message">completed this task.</span>
                                                </div><!-- / name -->
                                                
                                                <div class="update-content">
                                                    <p>Marce mucho mejor que en el otro me parece mejor organado pero seguimos sin tener subpages? tenemos que teenr subpages, yo pensaba que ibas a dejar los main menus arriba como estaban y las subsecciiones a la izquierda.</p>
                                                </div><!-- / update content -->
                                                
                                                <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                                                <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                                                <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                                                
                                            </div><!-- / update body -->
                                            
                                        </div><!-- / update notification -->
										
										</div><!-- / task update -->
										
										<div class="task-update">
                                        
                                        <div class="task-update-header">
                                            
                                            <div class="task-update-title left">
                                                Task Title
                                            </div><!-- / task update title -->
                                            
                                            <a class="view-task-btn right" data-toggle="modal" href="#modal-task" role="menuitem" tabindex="-1"></a>
                                            
                                            <div class="project-name-update right">
                                                <span class="label label-default"><a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Project Name</a></span>
                                            </div><!-- / project name update -->
                                            
                                        </div><!-- task update header -->
                                        
                                        <div class="update-notification">
                                        
                                            <div class="user left">
                                                <img src="../images/fed.jpg" alt="Fede">
                                            </div><!-- / user -->
                                            
                                            <div class="update-body right">
                                            
                                                <div class="name">
                                                    Federico <span class="task-completed-message">completed this task.</span>
                                                </div><!-- / name -->
                                                
                                                <div class="update-content">
                                                    <p>Marce mucho mejor que en el otro me parece mejor organado pero seguimos sin tener subpages? tenemos que teenr subpages, yo pensaba que ibas a dejar los main menus arriba como estaban y las subsecciiones a la izquierda.</p>
                                                </div><!-- / update content -->
                                                
                                                <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                                                <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                                                <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                                                
                                            </div><!-- / update body -->
                                            
                                        </div><!-- / update notification -->
                                        
                                        <div class="update-notification">
                                        
                                            <div class="user left">
                                                <img src="../images/marce.jpg" alt="Marce">
                                            </div><!-- / user -->
                                            
                                            <div class="update-body right">
                                            
                                                <div class="name">
                                                    Federico <span class="task-completed-message">completed this task.</span>
                                                </div><!-- / name -->
                                                
                                                <div class="update-content">
                                                    <p>Marce mucho mejor que en el otro me parece mejor organado pero seguimos sin tener subpages? tenemos que teenr subpages, yo pensaba que ibas a dejar los main menus arriba como estaban y las subsecciiones a la izquierda.</p>
                                                </div><!-- / update content -->
                                                
                                                <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                                                <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                                                <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                                                
                                            </div><!-- / update body -->
                                            
                                        </div><!-- / update notification -->
										
										</div><!-- / task update -->
                                        
                                       <div class="clear"></div>
                                
                                </div><!-- / teams updates -->
                            
                            </div><!-- / row -->    
                        
                        </div><!-- / col 6 --> 
                        
                    </div><!-- / row -->
                
                </div><!-- col 10 -->
                
            </div><!-- / row -->      
            
            <div id="footer" class="row"> 
                
                <div class="shortcodes left">
                
                    <span><strong>SOME MAGIC</strong> SHORTCODES</span>  
                    <ul>
                        <li><strong>Tab+Q</strong> Quick Add</li>
                        <li><strong>Tab+bksp</strong>  Delete Task</li>
                        <li><strong>Tab+DownArrow</strong> Move Down</li>
                        <li><strong>Tab+Enter</strong> Mark Complete</li>
                        <li><a href="" title="More Shortcodes">+More</a></li>
                    </ul>
                    
                </div><!-- / shortcodes -->
                
                <div class="nav-footer right">
                    <ul>      
                        <li><a href="" title="ABOUT">ABOUT</a></li>
                        <li><a href="" title="BLOG">BLOG</a></li>
                        <li><a href="" title="TERMS">TERMS</a></li>
                        <li><a href="" title="PRIVACY">PRIVACY</a></li>
                        <li><a href="" title="HELP">HELP</a></li>
                        <li><a href="" title="CONTACT">CONTACT</a></li>
                    </ul>
                </div><!-- / nav footer -->
            
            </div><!-- / row footer -->  
            
              <div class="modal fade" id="modal-create-team" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Create Team</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" role="form">
                          <div class="form-group">
                            <label for="team-name" class="col-lg-3 control-label">Team Name</label>
                            <div class="col-lg-9">
                              <input type="text" name="team" class="form-control" id="team-name" placeholder="Team Name">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="team-name" class="col-lg-3 control-label">Team Members</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control tagsearch" id="user-name" placeholder="User or E-mail">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>
							<style>

								.ui-menu .ui-menu-item a {
								  font-size: 12px;
								}
								.ui-autocomplete {
								  position: absolute;
								  top: 0;
								  left: 0;
								  z-index: 1510 !important;
								  float: left;
								  display: none;
								  min-width: 160px;
								  width: 160px;
								  padding: 4px 0;
								  margin: 2px 0 0 0;
								  list-style: none;
								  background-color: #ffffff;
								  border-color: #ccc;
								  border-color: rgba(0, 0, 0, 0.2);
								  border-style: solid;
								  border-width: 1px;
								  -webkit-border-radius: 2px;
								  -moz-border-radius: 2px;
								  border-radius: 2px;
								  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
								  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
								  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
								  -webkit-background-clip: padding-box;
								  -moz-background-clip: padding;
								  background-clip: padding-box;
								  *border-right-width: 2px;
								  *border-bottom-width: 2px;
								}
							</style>
							<script type="text/javascript">
								$(document).ready(function(){
									$(".tagsearch").each(function() {
										var el = $(this);
										el.autocomplete({
											source: "/ajax/getMembers",
											minLength: 3,
											select: function(event, ui) {
												var tag = '<span class="tag" data-id="'+ui.item.id+'" data-nombre="'+ui.item.nombre+'" data-avatar="'+ui.item.avatar+'"><img src="http://www.gravatar.com/avatar/'+ui.item.avatar+'?d=identicon&s=22" title="'+ui.item.nombre+'" alt="'+ui.item.nombre+'" /><a href="#" class="removetag" title="Quitar">x</a></span>';
												el.val("");
												el.next().append(tag);
												return false;
											},
											messages: {
												noResults: '',
												results: function() {}
											},
											create: function () {
												$(this).data('ui-autocomplete')._renderItem = function (ul, item) {
													return $('<li>')
														.data( "item.autocomplete", item )
														.append( '<a><img src="http://www.gravatar.com/avatar/'+item.avatar+'?d=identicon&s=22" title="'+item.nombre+'" alt="'+item.nombre+'" />' + item.nombre + '</a>' )
														.appendTo(ul);
												};
											}
										});
									});
									$(".tagsearch").keypress(function (e){
										if (e.which == 13) {
											e.preventDefault();
											var tag = '<span class="tag" data-id="0" data-nombre="" data-email="'+$(this).val()+'"><img src="http://www.gravatar.com/avatar/000?d=identicon&s=22" title="'+$(this).val()+'" alt="'+$(this).val()+'" /><a href="#" class="removetag" title="Quitar">x</a></span>';
											$(this).next().append(tag);
											$(this).val("");
											return false;
										}
									});
									$(document).on('click', '.removetag', function(){
										$(this).parent().remove();
										return false;
									});

									$("div#modal-create-team button.btn-submit").click(function(e){
										e.preventDefault();
										var members = [];
										$("div#modal-create-team span.tag").each(function(index, value){
											var member = {
												id: $(this).data("id"),
												nombre: $(this).data("nombre"),
												avatar: $(this).data("avatar"),
												email: $(this).data("email")
											};
											members.push(member);
										});
										
										var team = {
											nombre: $("div#modal-create-team input[name=team]").val(),
											privado: $("div#modal-create-team input[name=private]:checked").val(),
											members: members
										};

										Frontend.createTeam(team);
										
										$("div#modal-create-team input[name=team]").val('');
										$("div#modal-create-team div.tagholder").html('');
										$('div#modal-create-team').modal('hide');
									});		
								});
							</script>
                          <div class="form-group">
                          	<label for="team-privacy" class="col-lg-3 control-label">Team Privacy</label>
                            <div class="col-lg-9">
                              <div class="radio">
                              	<label>
                                <input type="radio" name="private" id="optionsRadios1" value="0" checked>
                                Public
                                </label>
                                </div>
                                <div class="radio">
                                <label>
                                <input type="radio" name="private" id="optionsRadios2" value="1">
                                Private
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                              <button type="submit" class="btn btn-default btn-submit">Create New Team</button>
                            </div>
                          </div>
                    </form>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
			  
			  <div class="modal fade" id="modal-create-project" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Crear Proyecto</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" role="form">
                          <div class="form-group">
                            <label for="project-name" class="col-lg-3 control-label">Nombre Proyecto</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="project-name" name="nombre" placeholder="Nombre del Proyecto">
                            </div>
                          </div>
						  <div class="form-group">
                            <label for="subtask" class="col-lg-3 control-label">Equipo</label>
                            <div class="col-lg-9">
                            <select name="team" class="form-control">
								<option></option>
								<?php foreach($teams as $team){ ?>
									<option value="<?php echo $team['team_id']; ?>"><?php echo $team['team_nombre']; ?></option>
								<? } ?>
                            </select>
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>
						  <div class="form-group date">
                            <label for="start-date" class="col-lg-3 control-label">Inicio</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="inicio" value="02-16-2012" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                            <label for="due-date" class="col-lg-3 control-label due-date">Fin</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="fin" value="02-16-2012" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>		
                          <div class="form-group color-project">
                            <label for="project-color" class="col-lg-3 control-label">Color</label>
                            <div class="col-lg-9">
                              <span class="color-1"></span>
                              <span class="color-2"></span>
                              <span class="color-3"></span>
                              <span class="color-4"></span>
                              <span class="color-5"></span>
                            </div>
                          </div>
							<div class="form-group">
                                <label for="project-description" class="col-lg-3 control-label">Descripcion</label>
                                <div class="col-lg-9">
                                  <textarea id="project-description" class="form-control" name="descripcion" placeholder="Descripcion" rows="3"></textarea>
                                </div>
                            </div>
							<div class="form-group">
								<label for="team-privacy" class="col-lg-3 control-label">Privado</label>
								<div class="col-lg-9">
								  <div class="radio">
									<label>
									<input type="radio" id="project-private" name="private" value="0" checked>
									Public
									</label>
									</div>
									<div class="radio">
									<label>
									<input type="radio" id="project-private" name="private" value="1">
									Private
									</label>
								  </div>
								</div>
							  </div>
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                              <button type="submit" class="btn btn-default add-submit">Crear nuevo Proyecto</button>
                            </div>
                          </div>
                    </form>
					<script type="text/javascript">
							$(document).ready(function(){
								$(document).on("click", ".add-project", function () {
									 var teamId = $(this).data('team');
									 $("div#modal-create-project select[name=team]").val(teamId);
								});

								$("div#modal-create-project button.add-submit").click(function(e){
									e.preventDefault();
									var proyecto = {
										
										nombre: $("div#modal-create-project input[name=nombre]").val(),
										team_id: $("div#modal-create-project select[name=team]").val(),
										inicio: $("div#modal-create-project input[name=inicio]").val(),
										fin: $("div#modal-create-project input[name=fin]").val(),
										color: $("div#modal-create-project input[name=color]").val(),
										privado: $("div#modal-create-project input[name=private]:checked").val(),
										descripcion: $("div#modal-create-project textarea[name=descripcion]").val()
									};
									Frontend.createProject(proyecto);
									$('input#project-name').val('');
									$('div#modal-create-project').modal('hide');
								});

								$("div#modal-create-project button.close").click(function(e){
									$("div#modal-create-project input[name=nombre]").val('');
									$("div#modal-create-project select[name=team]").val(0);
									$("div#modal-create-project input[name=inicio]").val('');
									$("div#modal-create-project input[name=fin]").val('');
									$("div#modal-create-project input[name=color]").val('');
									$("div#modal-create-project :radio[name=private]").prop('checked', false);
									$("div#modal-create-project textarea[name=descripcion]").val('');
								});
							});
						</script>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
			  
			  <div class="modal fade" id="modal-create-task" tabindex="-1" role="dialog" aria-labelledby="modal-create-teamLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Crear Tarea</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" role="form">
                          <div class="form-group">
                            <label for="task-name" class="col-lg-3 control-label">Tarea</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="task-name" name="nombre" placeholder="Nombre de la tarea">
                            </div>
                          </div>
						  <div class="form-group">
                            <label for="project-name" class="col-lg-3 control-label">Proyecto</label>
                            <div class="col-lg-9">
								<select name="proyecto" class="form-control">
									<option></option>
									<?php foreach($projects as $project){ ?>
										<option value="<?php echo $project['proyecto_id']; ?>"><?php echo $project['proyecto_nombre']; ?></option>
									<?php } ?>
								</select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="user-name" class="col-lg-3 control-label">Responsable</label>
                            <div class="col-lg-9">
								<select name="responsable" class="form-control">
								</select>
                            </div>
                          </div>
						  <div class="form-group date">
                            <label for="start-date" class="col-lg-3 control-label">Inicio</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="inicio" value="02-16-2012" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                            <label for="due-date" class="col-lg-3 control-label due-date">Fin</label>
                            <div class="col-lg-3">
                              <input type="text" class="datepicker form-control" name="fin" value="02-16-2012" id="dp1">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>		
                          <div class="form-group">
                            <label for="tags" class="col-lg-3 control-label">Tags</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control tagsearch" id="tags" placeholder="Tags">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>		
                          <div class="form-group">
                            <label for="followers" class="col-lg-3 control-label">Seguidores</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control members" id="followers" placeholder="Seguidores">
							  <div class="tagholder">
							  </div>
                            </div>
                          </div>		
                          <div class="form-group">
                            <label for="exampleInputFile" class="col-lg-3">Adjuntar Archivo</label>
                            <div class="col-lg-9">
                            <input type="file" id="exampleInputFile">
                            </div>
                          </div>	  
                          <div class="form-group">
                            <label for="subtask" class="col-lg-3 control-label">Subtarea de</label>
                            <div class="col-lg-9">
								<select name="maintask" class="form-control subtasks">
								</select>
                            </div>
                          </div>		
                          <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                              <button type="submit" class="btn btn-default add-submit">Crear nueva tarea</button>
                            </div>
                          </div>
                    </form>
					<script type="text/javascript">
						$(document).ready(function(){						
							$(document).on("click", ".add-task", function () {
								var teamId = $(this).data('team');
								$("div#modal-create-task select[name=team]").val(teamId);
							});
							
							$("input.members").each(function() {
								var el = $(this);
								el.autocomplete({
									source: function(request, response) {
										$.getJSON("/ajax/getMembers", {project: $('div#modal-create-task select[name=proyecto]').val()},response);
									},
									minLength: 3,
									select: function(event, ui) {
										var tag = '<span class="tag" data-id="'+ui.item.id+'" data-nombre="'+ui.item.nombre+'" data-avatar="'+ui.item.avatar+'"><img src="http://www.gravatar.com/avatar/'+ui.item.avatar+'?d=identicon&s=22" title="'+ui.item.nombre+'" alt="'+ui.item.nombre+'" /><a href="#" class="removetag" title="Quitar">x</a></span>';
										el.val("");
										el.next().append(tag);
										return false;
									},
									messages: {
										noResults: '',
										results: function() {}
									},
									create: function () {
										$(this).data('ui-autocomplete')._renderItem = function (ul, item) {
											return $('<li>')
											.data( "item.autocomplete", item )
											.append( '<a><img src="http://www.gravatar.com/avatar/'+item.avatar+'?d=identicon&s=22" title="'+item.nombre+'" alt="'+item.nombre+'" />' + item.nombre + '</a>' )
											.appendTo(ul);
										};
									}
								});
							});
							
							$("div#modal-create-task select[name=proyecto]").change(function(){
								$.getJSON("/ajax/getMembers", {project: $(this).val()},function(data){
									var options = '<option></option>';
									$.each( data, function(key, item) {
										options += '<option value="'+item.id+'">'+item.nombre+'</option>'
									});
									$("div#modal-create-task select[name=responsable]").html(options);
								});
								
								$.getJSON("/ajax/getTasks", {project: $(this).val()},function(data){
									var options = '<option></option>';
									$.each( data, function(key, item) {
										options += '<option value="'+item.id+'">'+item.nombre+'</option>'
									});
									$("div#modal-create-task .subtasks").html(options);
								});
							});

							$("div#modal-create-task button.add-submit").click(function(e){
								e.preventDefault();
								
								var members = [];
								$("div#modal-create-team span.tag").each(function(index, value){
									var member = {
										id: $(this).data("id"),
										nombre: $(this).data("nombre"),
										avatar: $(this).data("avatar"),
										email: $(this).data("email")
									};
									members.push(member);
								});
								
								var tarea = {
									nombre: $("div#modal-create-task input[name=nombre]").val(),
									proyecto_id: $("div#modal-create-task select[name=proyecto]").val(),
									responsable_id: $("div#modal-create-task select[name=responsable]").val(),
									inicio: $("div#modal-create-task input[name=inicio]").val(),
									fin: $("div#modal-create-task input[name=fin]").val(),
									followers: members,
									tarea_id: $("div#modal-create-task select[name=maintask]").val()
								};
								
								Frontend.createTask(tarea);
								
								$("div#modal-create-task input[name=nombre]").val('');
								$("div#modal-create-task select[name=proyecto]").val(0);
								$("div#modal-create-task select[name=responsable]").val(0);
								$("div#modal-create-task input[name=inicio]").val('');
								$("div#modal-create-task input[name=fin]").val('');
								$("div#modal-create-task div.tagholder").html('');
								$("div#modal-create-task select[name=maintask]").val(0);
								
								$('div#modal-create-task').modal('hide');
							});

							$("div#modal-create-task button.close").click(function(e){
								$("div#modal-create-task input[name=nombre]").val('');
								$("div#modal-create-task select[name=proyecto]").val(0);
								$("div#modal-create-task select[name=responsable]").val(0);
								$("div#modal-create-task input[name=inicio]").val('');
								$("div#modal-create-task input[name=fin]").val('');
								$("div#modal-create-task div.tagholder").html('');
								$("div#modal-create-task select[name=subtasks]").val(0);
							});
						});
						</script>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
			                
              <div class="modal fade" id="modal-task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Modal Task</h4>
                    </div>
                    <div class="modal-body">
                    
                    	<div class="col-md-6">
                          <form class="form-horizontal" role="form">
                              <div class="form-group">
                                <label for="team-name" class="col-lg-3 control-label">Team Name</label>
                                <div class="col-lg-9">
                                  <input type="text" class="form-control" id="team-name" placeholder="Team Name">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="members-team" class="col-lg-3 control-label">Members</label>
                                <div class="col-lg-9">
                                  <textarea id="members-team" class="form-control" placeholder="Name or Email" rows="3"></textarea>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="team-privacy" class="col-lg-3 control-label">Team Privacy</label>
                                <div class="col-lg-9">
                                  <div class="radio">
                                    <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                    Public
                                    </label>
                                    </div>
                                    <div class="radio">
                                    <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    Private
                                    </label>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                  <button type="submit" class="btn btn-default">Create New Team</button>
                                </div>
                              </div>
                        </form>
                        
                     </div><!-- / col 6 -->   
                     
                     <div class="col-md-6 teams-update-wrapper">
                     	
                        <div class="teams-updates">
                            
                            <div class="task-update">
                                
                                <div class="task-update-header">
                                    
                                    <div class="task-update-title left">
                                        Task Title
                                    </div><!-- / task update title -->
                                    
                                </div><!-- task update header -->
                                
                                <div class="update-notification">
                                
                                    <div class="user left">
                                        <img src="../images/fed.jpg" alt="Fede">
                                    </div><!-- / user -->
                                    
                                    <div class="update-body right">
                                    
                                        <div class="name">
                                            Federico <span class="task-completed-message">completed this task.</span>
                                        </div><!-- / name -->
                                        
                                        <div class="update-content">
                                            <p>Marce mucho mejor que en el otro me parece mejor organado pero.</p>
                                        </div><!-- / update content -->
                                        
                                        <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                                        <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                                        <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                                        
                                    </div><!-- / update body -->
                                    
                                </div><!-- / update notification -->
                                
                                <div class="update-notification">
                                
                                    <div class="user left">
                                        <img src="../images/marce.jpg" alt="Marce">
                                    </div><!-- / user -->
                                    
                                    <div class="update-body right">
                                    
                                        <div class="name">
                                            Federico <span class="task-completed-message">completed this task.</span>
                                        </div><!-- / name -->
                                        
                                        <div class="update-content">
                                            <p>Marce mucho mejor que en el otro me parece mejor organado pero seguimos sin tener subpages? tenemos que teenr subpages, yo pensaba que ibas a dejar.</p>
                                        </div><!-- / update content -->
                                        
                                        <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                                        <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                                        <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                                        
                                    </div><!-- / update body -->
                                    
                                </div><!-- / update notification -->
                                
                                <div class="update-notification">
                                
                                    <div class="user left">
                                        <img src="../images/marce.jpg" alt="Marce">
                                    </div><!-- / user -->
                                    
                                    <div class="update-body right">
                                    
                                        <div class="name">
                                            Federico <span class="task-completed-message">completed this task.</span>
                                        </div><!-- / name -->
                                        
                                        <div class="update-content">
                                            <p>Marce mucho mejor que en el otro me parece mejor organado pero seguimos sin tener subpages? tenemos que teenr subpages, yo pensaba que ibas a dejar.</p>
                                        </div><!-- / update content -->
                                        
                                        <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                                        <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                                        <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                                        
                                    </div><!-- / update body -->
                                    
                                </div><!-- / update notification -->
                                
                                <div class="update-notification">
                                
                                    <div class="user left">
                                        <img src="../images/marce.jpg" alt="Marce">
                                    </div><!-- / user -->
                                    
                                    <div class="update-body right">
                                    
                                        <div class="name">
                                            Federico <span class="task-completed-message">completed this task.</span>
                                        </div><!-- / name -->
                                        
                                        <div class="update-content">
                                            <p>Marce mucho mejor que en el otro me parece mejor organado pero seguimos sin tener subpages? tenemos que teenr subpages, yo pensaba que ibas a dejar.</p>
                                        </div><!-- / update content -->
                                        
                                        <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                                        <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                                        <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                                        
                                    </div><!-- / update body -->
                                    
                                </div><!-- / update notification -->
                                
                                <div class="update-notification">
                                
                                    <div class="user left">
                                        <img src="../images/marce.jpg" alt="Marce">
                                    </div><!-- / user -->
                                    
                                    <div class="update-body right">
                                    
                                        <div class="name">
                                            Federico <span class="task-completed-message">completed this task.</span>
                                        </div><!-- / name -->
                                        
                                        <div class="update-content">
                                            <p>Marce mucho mejor que en el otro me parece mejor organado pero seguimos sin tener subpages? tenemos que teenr subpages, yo pensaba que ibas a dejar.</p>
                                        </div><!-- / update content -->
                                        
                                        <div class="date-update">Monday at 12:22 pm &middot;</div><!-- / date update -->
                                        <div class="like-update"><a href="" title="like"></a></div><!-- / like update -->
                                        <div class="follow-task right"><a href="" title="Follow Task">Follow Task</a></div>
                                        
                                    </div><!-- / update body -->
                                    
                                </div><!-- / update notification -->
                                
                                </div><!-- / task update -->
                                
                               <div class="clear"></div>
                        
                        </div><!-- / teams updates -->
                        
                     </div><!-- / col 6 -->
                     
                     <div class="clear"></div>
                     
                    </div><!-- / modal body -->
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
    
        </div> <!-- /container -->
        
     </div><!-- / wrap -->   
  </body>
</html>