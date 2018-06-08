
<script>
    function HideContent() 
    {
        document.getElementById("BandeauMentionsLegales").style.display = "none";
    }
</script>
<div class="row" id="BandeauMentionsLegales">
    <div class="col-sm-12 PiedDePage">
        <a href="<?=base_url();?>index.php/Visiteur/MentionsLegales">Mentions légales</a>
        <div class="ok" onclick='HideContent()'>
            Ok
        </div>
    </div>
</div>
</body>