<?php
require_once '../lib/Kendo/Autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_GET['type'];
    if ($type == 'save') {
        $fileName = $_POST['fileName'];
        $contentType = $_POST['contentType'];
        $base64 = $_POST['base64'];

        $data = base64_decode($base64);

        header('Content-Type:' . $contentType);
        header('Content-Length:' . strlen($data));
        header('Content-Disposition: attachment; filename=' . $fileName);

        echo $data;
    }
    exit;
}

require_once '../include/header.php';

$transport = new \Kendo\Data\PivotDataSourceTransport();

$read = new \Kendo\Data\PivotDataSourceTransportRead();

$read->url('http://demos.telerik.com/olap/msmdpump.dll')
     ->contentType('text/xml')
     ->dataType('text')
     ->type('POST');

$connection = new \Kendo\Data\PivotDataSourceTransportConnection();

$connection->catalog('Adventure Works DW 2008R2')
            ->cube('Adventure Works');

$discover = new \Kendo\Data\PivotDataSourceTransportDiscover();

$discover->url('http://demos.telerik.com/olap/msmdpump.dll')
     ->contentType('text/xml')
     ->dataType('text')
     ->type('POST');

$transport ->read($read)
            ->connection($connection)
            ->discover($discover);

$schema = new \Kendo\Data\PivotDataSourceSchema();
$schema->type('xmla');

$dateColumn = new \Kendo\Data\PivotDataSourceColumn();
$dateColumn->name('[Date].[Calendar]')
            ->expand(true);

$productColumn = new \Kendo\Data\PivotDataSourceColumn();
$productColumn->name('[Product].[Category]');

$dataSource = new \Kendo\Data\PivotDataSource();

$dataSource->transport($transport)
            ->type("xmla")
            ->addColumn($dateColumn, $productColumn)
            ->addRow('[Geography].[City]')
            ->addMeasure('[Measures].[Reseller Freight Cost]')
            ->schema($schema);

$pdf = new \Kendo\UI\GridPdf();
$pdf->fileName('Kendo UI Grid Export.pdf')
    ->proxyURL('pdf-export.php?type=save');

$pivotgrid = new \Kendo\UI\PivotGrid('pivotgrid');
$pivotgrid->dataSource($dataSource)
     ->pdf($pdf)
    ->columnWidth(200)
    ->configurator("#configurator")
    ->filterable(true)
    ->sortable(true)
    ->height(580);
?>

<button id="export" class="k-button k-button-icontext"><span class="k-icon k-i-pdf"></span>Export to PDF</button>
<?php
echo $pivotgrid->render();
?>
<script>
    $(function() {
        $("#export").click(function() {
            $("#pivotgrid").getKendoPivotGrid().saveAsPDF();
        });
    });
</script>

<style>
    #export
    {
        padding: 0 0 10px 1px;
    }
</style>
<?php require_once '../include/footer.php'; ?>
