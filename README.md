# YiiJasperReports

Simples extension of Yii Framework for execute and exports JasperReports.

Simple execute Jasper Reports in your Application with Yii Frameworks.

### Usage:

Import extension in main.php
```
'import'         => array(
	...
	'application.extensions.YiiJasperReports.*',
)
´´´
And call in your Controller:
```php
$report = new YiiJasperReport('/folder/id_report', array('param' => 'value'), 'pdf');
$report->execute();
´´
