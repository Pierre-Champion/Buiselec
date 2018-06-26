<?php 
echo form_open('visiteur/ModifierMDP/'.$this->session->Client["NOCLIENT"]);

echo form_label(" Ancien mot de passe : ", 'lbltMDP').'<BR>';
echo form_password('AnciMdpClient', "", array('required'=>'required')).'<BR>';
if(isset($MDP)&&$MDP=="Incorrect")
{
    echo "<div class='echec'>Le mot de passe est incorrect.</div>";
}
echo form_label("Nouveau mot de passe : ", 'lbltMDP').'<BR>';
echo form_password('NouvMdpClient', "", array('required'=>'required')).'<BR>';

echo form_submit('boutonModificationMDP', 'Modifier').'<BR>';
echo form_close();
?>