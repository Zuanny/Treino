<?php
namespace Source\Export;
class Export
{
    public function exportFile(string $Expression) : string
    {
        return match ($Expression){
            'pdf' => 'PDF',
            'csv' => 'CSV',
            default => 'Error'
        };
    }
}