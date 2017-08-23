<?php
// TODO Move to the class, services
if (!function_exists ('seedFromCSV')) {
    /**
     *  Collect data from a given CSV file and return as array
     *
     * @param $filename
     * @param string $deliminator
     * @return array|bool
     */
    function seedFromCSV($filename, $deliminator = ",")
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return FALSE;
        }

        $header = NULL;
        $data = [];

        $handle = fopen($filename, 'r');
        while (($row = fgetcsv($handle, $deliminator)) !== FALSE) {
            if (!$header) {
                $header = $row;
                continue;
            }

            $data[] = array_combine(array_intersect_key($header, $row), array_intersect_key($row, $header));
        }
        fclose($handle);

        return $data;
    }
}