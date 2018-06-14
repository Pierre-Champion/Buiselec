
<script>
    function HideContent() 
    {
        document.getElementById("BandeauMentionsLegales").style.display = "none";
    }
</script>
<div class="PiedDePage" id="BandeauMentionsLegales">
    <a href="<?=base_url();?>index.php/Visiteur/MentionsLegales">Mentions légales</a>
    <div class="ok" onclick='HideContent()'>
        Ok
    </div>
</div>
</body>