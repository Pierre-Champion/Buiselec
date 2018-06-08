<?php
echo form_open('Visiteur/personnel');
            
echo form_label('Mail : ', 'Mail')."<BR/>";
echo form_input('MailClient', '',array('pattern' =>'^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+','required'=>'required'))."<BR/>";

echo form_label('Mot de passe : ', 'MDP')."<BR/>";
echo form_password('MDP', '', "required")."<BR/><BR/>";

if (isset($Connexion) && $Connexion==FALSE)
{
    echo "<div class=\"echec\">Mail ou mot de passe incorrect.</div>";
}

echo form_submit('boutonPersonnel', 'Se connecter');
            
echo form_close();
?>