<?php
// Load autoload dari dompdf manual
require_once APPPATH . '../vendor/autoload.php';

use Dompdf\Dompdf;

class Dompdf_gen {
    public $dompdf;

    public function __construct()
    {
        $this->dompdf = new Dompdf();
    }
}
