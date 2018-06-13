
<script>
    function HideContent() 
    {
        document.getElementById("BandeauMentionsLegales").style.display = "none";
    }
</script>
<nav class="navbar PiedDePage navbar-fixed-bottom" id="BandeauMentionsLegales">
<div class="container-fluid">
    <a href="<?=base_url();?>index.php/Visiteur/MentionsLegales">Mentions légales</a>
    <div class="ok" onclick='HideContent()'>
        Ok
    </div>
</div>
</nav>
</body>