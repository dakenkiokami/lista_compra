<?php

require_once(__DIR__ . '/../Model/Report.php');

class ReportController extends Controller
{

    public function create()
    {
        return $this->view(__DIR__ . '/../View/Report/ReportCreate');
    }

    public function report()
    {
        $initialDate = $this->request->initialDate;
        $finalDate = $this->request->finalDate;

        $reportList = Report::generateReport($initialDate, $finalDate);
        return $this->view(__DIR__ . '/../View/Report/ReportList', ['reportList' => $reportList]);
    }
}
