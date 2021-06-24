<?php
$adminPages = [
    ["name" => "dashboard",       "icon" => "home", "classes" => ""],
    ["name" => "members",         "icon" => "users", "classes" => ""],
    ["name" => "districts",       "icon" => "building", "classes" => ""],
    ["name" => "chapters",        "icon" => "user-friends", "classes" => "disabled"],
    ["name" => "administrators",  "icon" => "user-shield", "classes" => "disabled"],
    ["name" => "account",         "icon" => "user-cog", "classes" => "disabled"],
    ["name" => "settings",        "icon" => "cogs", "classes" => "disabled"]
];
?>
<div class="sidebar bg-danger">
            <div class="sidebar__title d-flex justify-content-center mt-2">
                <div class="d-flex align-items-center justify-content-center p-1 text-center">
                    <div class="bg-white" style="width: 50px; height: 50px; border-radius: 50%;">
                        <img src="asset/logo.png" alt="">
                    </div>
                    <h3 class="text-white pl-1">SHAMA DISTRICT</h3>
                </div>
            </div>

            <div class="sidebar__menu p-2">

                <ul class="list-style-none">
                  <?php
                  foreach($adminPages as $page){
                    if ($page['name'] == $currentPage){
?>
                  <li class="mt-1">
                      <a href="/redcross/<?=$page['name']?>" class="nav-link active p-1 bg-white text-danger fw-700 d-flex">
                          <i class="fas fa-<?=$page['icon']?> pr-1"></i>
                          <span class="fs-0-9em"><?=ucfirst($page['name'])?></span>
                        </a>
                    </li>
                  <?php
                    }
                    else {
                  ?>
                  <li class="mt-1">
                  <a href="/redcross/<?=$page['name']?>" class="nav-link p-1 text-white d-flex <?=$page['classes']?>">
                      <i class="fas fa-<?=$page['icon']?>  pr-1"></i>
                      <span class="fs-0-9em"><?=ucfirst($page['name'])?></span>
                        </a>
                    </li>
                  <?php

                      }

                  }
                  ?>
                   <li class="mt-1">
                        <a href="/redcross/logout.php" class="nav-link p-1 text-black d-flex">
                            <i class="fa fa-sign-out-alt pr-1"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>

        </div>

