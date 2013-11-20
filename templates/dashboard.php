<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Freakybox</title>

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900,300italic,400italic,900italic' rel='stylesheet' type='text/css'>

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
                            <li role="presentation"><a data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">Create a Team</a></li>
                            <li class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Create a Project</a></li>
                            <li class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Create a Task</a></li>
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
                    
                    <div class="row workspace-wrapper">
                        
                        <div class="team-wrapper">
                            
                            <div class="team-name">
                                <a href="#" title="Team Name">Team Name</a>
                            </div><!-- / Team Name -->
                            
                            <div class="team-content">
                            
                                <div class="team-people">
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a>   
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a>   
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a>   
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a class="add-user" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1"></a>
                                </div><!-- / team people -->
                                
								<span class="clearfix"></span>
								
                                <a class="add-project" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                    PROJECT
                                </a>
                                
                                <ul class="projects-team">
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                </ul><!-- / projects team -->
                                
                            </div><!-- / team content -->        
                        
                        </div><!-- / team wrapper -->
                        
                        <div class="team-wrapper">
                            
                            <div class="team-name">
                                <a href="#" title="Team Name">Another Team Name</a>
                            </div><!-- / Team Name -->
                            
                            <div class="team-content">
                            
                                <div class="team-people">
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a>   
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a>   
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a>   
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a class="add-user" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1"></a>
                                </div><!-- / team people -->
								
								<span class="clearfix"></span>
                                
                                <a class="add-project" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                    PROJECT
                                </a>
                                
                                <ul class="projects-team">
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                </ul><!-- / projects team -->
                                
                            </div><!-- / team content -->        
                        
                        </div><!-- / team wrapper -->
                        
                        <div class="team-wrapper">
                            
                            <div class="team-name">
                                <a href="#" title="Team Name">Another Team Name</a>
                            </div><!-- / Team Name -->
                            
                            <div class="team-content">
                            
                                <div class="team-people">
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a>   
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a>   
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a>   
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a href="" class="">
                                        <img src="../images/thumb-user.jpg" alt="User" title="User Name">
                                     </a> 
                                     <a class="add-user" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1"></a> 
                                </div><!-- / team people -->
								
								<span class="clearfix"></span>
                                
                                <a class="add-project" data-toggle="modal" href="#myModal" role="menuitem" tabindex="-1">
                                    PROJECT
                                </a>
                                
                                <ul class="projects-team">
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                    <li>
										<a href="" title="">Project 1</a>
										<div class="dropdown project-options">
										  <a data-toggle="dropdown" class="options-arrow" href="#"></a>
										  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<li role="presentation"><a href="">Archive Project</a></li>
											<li class="divider"></li>
											<li role="presentation"><a href="">Delete Project</a></li>
										  </ul>
										</div><!-- / dropdown -->
									</li>
                                </ul><!-- / projects team -->
                                
                            </div><!-- / team content -->        
                        
                        </div><!-- / team wrapper -->
                        
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
            
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/freakybox.js"></script>
	
	<script src="/socket.io/socket.io.js"></script>
	<script type="text/javascript" src="/js/frontend.js"></script>
	<script>
		var Frontend = new Core();
		Frontend.init('192.168.0.107:5000');
		var proyecto = {name:"Nombre del proyecto"};
		Frontend.createProject(proyecto);
	</script>
  </body>
</html>