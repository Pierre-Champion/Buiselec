
<script>
    function HideContent() 
    {
        document.getElementById("BandeauMentionsLegales").style.display = "none";
    }
</script>
<div class="row" id="BandeauMentionsLegales">
    <div class="col-sm-12 PiedDePage">Pour plus d'informations, cliquez 
        <a href="<?=base_url();?>index.php/Visiteur/MentionsLegales">ici</a>
        <div class="ok" onclick='HideContent()'>
            Ok
        </div>
    </div>
</div>