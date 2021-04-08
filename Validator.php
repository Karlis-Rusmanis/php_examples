<?php
class Validator extends DataManager
{
    private $count = 0;

    /*
    * @param int $r - id of current row
    * @param int $c - id of current column
    * @param string $current - "x" or "o"
    */
    public function validate($r, $c, $current_value)
    {
        $rules = [
            [[0, -1], [0, 1]],
            [[1, 0]],
            [[1, 1], [-1, -1]],
            [[1, -1], [-1, 1]]
        ];
        foreach ($rules as $rule) {
            foreach ($rule as $cords) {
                $this->check($r, $c, $current_value, $cords[0], $cords[1]);
            }
            if ($this->count >= 3) {
                echo "Spēle ir uzvarēta!";
                return;
            }
            $this->count = 0;
        }
    }



    /*
    * @param int $r - id of current row
    * @param int $c - id of current column
    * @param string $current - "x" or "o"
    * @param float $r_diff - (0 or 1 or -1) increases or decreases $r
    * @param float $c_diff - (0 or 1 or -1) increases or decreases $c
    */
    public function check(int $r, int $c, string $current, $r_diff, $c_diff)
    {
        $r_new = $r;
        $c_new = $c;
        for ($i = 1; $i <= 3; $i++) {
            $r_new = $r_new + $r_diff;
            $c_new = $c_new + $c_diff;
            if ($current === $this->get($r_new, $c_new)) {
                $this->count++;
            } else {
                break;
            }
        }
    }
}
