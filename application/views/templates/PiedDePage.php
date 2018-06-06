<?php
function Ok()
{
    //$this->session->OkPDP=true;
}
if(!isset($this->session->OkPDP))// && $this->session->OkPDP!=true)
{?>
<div class="PiedDePage">Pour savoir quels sont vos droits, cliquez <a href="</*?=base_url();?>index.php/Visiteur/MentionsLegales">ici</a>.&nbsp;<div class="ok" onclick="document.write('<?php ok() ?>');">Ok</div></div>
<?php }
print_r($this->session);?>