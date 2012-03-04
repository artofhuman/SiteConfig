<?if(!check_bitrix_sessid()) return;?>
<?
echo CAdminMessage::ShowNote('Модуль удален');
?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
	<input type="hidden" name="lang" value="<?echo LANG?>">
	<input type="submit" name="" value="Назад">
<form>
