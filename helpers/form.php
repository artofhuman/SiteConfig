<form method="POST" action="site_config.php?lang=<?echo LANGUAGE_ID?><?echo $_GET["return_url"]? "&amp;return_url=".urlencode($_GET["return_url"]): ""?>"  enctype="multipart/form-data" name="editform">
  <? $tabControl->Begin();?>
  <? foreach ($xmlSections as $section){?>
    <? $tabControl->BeginNextTab(); ?>
    	<? foreach ($section as $item) { ?>
	   <tr>
		<td style="width:250px;vertical-align: top; text-align: left;"><?=$siteConfig->getLabel($item)?></td>
		<td style="vertical-align: top; text-align: left;"><?=$siteConfig->getInput($item)?></td>
	   </tr>
	<?}?>
  <?}?>
  <? $tabControl->Buttons(array("back_url"=>$_GET["return_url"]? $_GET["return_url"]: "site_config.php?lang=".LANG,)); ?>    
  <? $tabControl->End();?>
  <input type="hidden" name="lang" value="<?echo LANG?>">
  <?echo bitrix_sessid_post();?>
</form>
