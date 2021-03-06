<?php
$root = HTTP_ROOT;
$home = HTTP_ROOT.'/home/';
$about = HTTP_ROOT.'/about/';
$login = HTTP_ROOT.'/login/';
if(isset(self::init()->page))
    $page = self::init()->page;

if(Laika_Access::is_logged_in())
    $user_tab = Laika_User::active()->firstname();
else
    $user_tab = "user";
    
$links = array("Home","About","Login",$user_tab);

foreach( $links as $key => $tab ){
    if(isset($page))
        $nav[] = style_change($page,$tab);
    else $nav[] = " ";
}

function style_change($page,$tab){
    if(ucfirst($page) == $tab)
        return "current";
    return " ";        
}
if(Laika_Access::is_logged_in()){
    $links[2] = "Logout";
    $login = HTTP_ROOT.'/logout/';
    $user = HTTP_ROOT.'/user/';
    $hidden = '<li class="'.$nav[3].'"><a href="'.$user.'">'.$links[3].'</a></li>';
}
else $hidden = "";