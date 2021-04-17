<?php
class DataManager
{

    /*
     * Mainīgais satur visas datubāzes tabulu divdimensionālā masīvā
     */
    private $table = [];
    private $file_name = '';

    public function __construct($filename)
    {
        $this->file_name = $filename;
        if (file_exists($this->file_name)) {
            $content = file_get_contents($this->file_name);
            $data = json_decode($content, true);
            if (is_array($data)) {
                $this->table = $data;
            }
        }
    }

    /*
     * Saglabā vērtību datubāzē ar atslēgām $r un $c
     * @param int $r
     * @param int $c
     * @param mixed $value - vērtība tiks saglabāta datubāzē
     */

    public function save($r, $c, $value)
    {
        $this->table[$r][$c] = $value;
        $content = json_encode($this->table, JSON_PRETTY_PRINT);
        file_put_contents($this->file_name, $content);
    }

    /*
     * Atgriež vērtību no datubāzes, kas atbilst atslēgām $r un $c
     * @param int $r
     * @param int $c
     * 
     * @return mixed vērtība no datubāzēs || tukšu stringu
     */

    public function get($r, $c)
    {
        if (array_key_exists($r, $this->table) && array_key_exists($c, $this->table[$r])) {
            return $this->table[$r][$c];
        }

        return '';
    }

    public function count()
    {
        $count = 0;
        foreach ($this->table as $row) {
            foreach ($row as $value) {
                $count++;
            }
        }

        return $count;
    }



    public function deleteAll()
    {
        $this->table = [];
        file_put_contents($this->file_name, '');
    }
}
