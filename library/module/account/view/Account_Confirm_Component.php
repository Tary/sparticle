<?php
if(isset($status) && $status):
    $text = "You are now logged in.";
    $content = "<div id=container><p>$text</p></div>";
else:
    $text = "<b>We've sent a confirmation key to your email address.</b><br />
    <b>Please click on the link in the email to activate your account.</b><br /><br />
    <b>To request a new confirmation key, please enter your username below.</b>";        
    $url = HTTP_ROOT.'/account/resend_confirmation/';
    $content = <<<CONTENT
<div id=container>
    <p>$text</p>
    <br/>
    <form id="login" method="post" action="{$url}" >
        <fieldset>
            <div>
                <!--<label>Email
                    <input type="email" name="email" id="email" required="true"/>
                </label>&nbsp;&nbsp;-->  
                <label>Username
                    <input type="text"  name="user"  id="user"  required="true"/>
                <label>&nbsp;&nbsp;
                    <input type="submit" name="button" id="login_button" value="send" class="button gray bigrounded"/>
                </label>
            </div>        
         </fieldset>       
    </form>
</div>
CONTENT;
endif;

echo $content;