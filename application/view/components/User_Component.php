<?php
$id   = self::init()->user;
$user = Laika_User::load($id);
$avatar = Laika_Avatar::img($user->email(),120);
self::init()->counter = 0;
?>
<? self::add_style('user'); ?>
<div id="container">
    <article id="page-content">
        <? echo $avatar; ?>
        <table id="user_data">
            <tr>
                <td><h2 id="username"><? echo $user->username(); ?>.</h2></td>
            </tr>            
            <tr>
                <td><h3 id="realname"><? echo $user->name(); ?></h3></td>
            </tr>
            <tr>
                <td <? echo $user->logged_in() ? 'class=online' : 'class=offline' ?> >
                    <h4 id="login"><? echo $user->logged_in() ? USER_ICON." online" : USER_ICON." offline"; ?></h4>
                </td>
            </tr>
        </table>
    </artice>
    <br />
</div>
<div id="ui-container">
    <div class="controls light upper">
        <div class="toolbar center light">
            Content Stream
        </div>
        <div id="pagination" class="toolbar right light">
        <? Sparticle_Media::render_pagination(9,array('user'=>$id),"user/{$user->username}"); ?>
        
        
        </div>
    </div>
    <table id="contact-sheet">     
        <? self::paginate('Sparticle_Media', 9, array('user'=>$id),'user_content', array('DESC'=>'created')); ?>
    </table>
    <div class="controls light lower">
    </div>
</div>