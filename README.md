# Site Config 
Модуль для 1С Bitrix позволяющий хранить настройки сайта.
Все настройки генерятся разработчиком в одном xml файле
модуль сам подхватывает их и выносит на форму. 

Есть возможность разбивать настройки на группы.
В админке это будет выглядить как табы. 

Использование модуля позволяет избавиться от хранения настроек
в инфоблоках и других подозрительных местах. 
К тому же не будет дополнительных запросов в базу. 

## На данный момент модуль умеет хранить типы данных:

* boolean. Выводится в виде checkbox
* string. Выводится в виде  input
* text. Выводится в виде textarea
* html. Выводится в виде textarea на который накладывается сверху html редактор битрикса
* file. Выводится в виде input:file. После сохранения файла, регистрирует его в таблице файлов
битрикса так же, как в инфоблоках

## Пример конфигурационного файла config.xml
Сам файл храниться в корне модуля /bitrix/modules/SiteConfig/config.xml

<?xml version="1.0" encoding="utf-8"?>
<data>
	<section title="Пример вкладки настроек" id="tab1">
		<item name="textarea" type="textarea" value="textarea" cols="50" rows="6">textarea</item>
		<item name="checkbox" type="checkbox" value="0">checkbox</item>
		<item name="text" type="text" value="text">input text</item>
	</section>
        
        <section title="Пример 2 вкладки настроек" id="tab2">
		<item name="html" type="html" value="html value" cols="50" rows="6">HTML</item>
		<item name="file" type="file" value="">file</item>
	</section>
</data>

## Пример работы с модулем

if (CModule::IncludeModule('SiteConfig')) {
    $siteConfig = new SiteConfig;
    
    if ($siteConfig->getOption('show_title')) {
        ...
    }
}