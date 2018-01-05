# msSimplePayInvoice

msSimplePayInvoice - пакет для компонента minishop2


#### 1.0.0 - 05.01.2018
:: Initial release



#### Отправляет заказчику счет на оплату дополнительным письмом
Создает pdf файл в указаной в настройках папке. Данный файл отправляется заказчику на почту отдельным письмом.
Используется библиотека mpdf 6.0


### Системные настройки

Ключ | Наименование | Значение по умолчанию
------------ | ------------- | -------------
mssimplepayinvoice_payment | Id оплаты (Укажите id оплат через запятую, для которых будет применяться плагин) | - 
mssimplepayinvoice_tplWrapper | Обертка для формирования PDF | tpl.mssimplepayinvoiceWrapper 
mssimplepayinvoice_tplRow | Чанк для товара в PDF | tpl.mssimplepayinvoiceRow 
mssimplepayinvoice_pdfPath | Путь к сохранению pdf файла  | MODX_ASSETS_PATH.'pdf/'.$year.'/'.$month.'/'
mssimplepayinvoice_emailFrom | Email отправителя | $modx->getOption('emailsender') 
mssimplepayinvoice_nameFrom | Имя отправителя | $modx->getOption('site_name') 
mssimplepayinvoice_mailSubject | Тема письма | Pay Invoice 
mssimplepayinvoice_mailBody | Текст письма | Pay Invoice 