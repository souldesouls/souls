<?php

if (!function_exists('meterfeeder')) {
    $num_get_intent_calls = 0;
    function meterfeeder_get_intent() {
        $med_serials = array(
            "QWR4A003"
        );
        global $num_get_intent_calls;

        if ($num_get_intent_calls > 10) {
            return "nointent";
        }

        $cmd_output = array();
        exec("protected/modules/souls/meterfeeder/meterfeeder " . $med_serials[rand(0, count(array($med_serials)) - 1)] . " 256", $cmd_output, $res);
        
        if ($res == 0) {
            $random_walk_results = random_walk($cmd_output[0]);
            return $random_walk_results;
        } else {
            // TODO: a proper backoff algorithm at least...
            $num_get_intent_calls++;
            return meterfeeder_get_intent();
        }
    }

    function random_walk($entropy_hex_str) {
        $byte_str = hex2bin($entropy_hex_str);
        $byte_arr = unpack("C*", $byte_str);
        $walk = array();
        $counter = 0;
        for ($i = 1; $i < count($byte_arr)+1; $i++) {
            $bin = str_split(sprintf('%08d', base_convert($byte_arr[$i], 10, 2)));
            for ($j = 0; $j < 8; $j++) {
                if ($bin[$j] == "1") {
                    $counter++;
                } else if ($bin[$j] == "0") {
                    $counter--;
                }
                array_push($walk, $counter);
            }
        }
        return $walk;
    }

    // href: https://www.php.net/manual/en/function.stats-stat-correlation.php comment
    // compare two intent signals (random walk results)
    function cross_correlation($x, $y) {
        $length = count($x);
        $mean1 = array_sum($x) / $length;
        $mean2 = array_sum($y) / $length;
        
        $a = 0;
        $b = 0;
        $axb = 0;
        $a2 = 0;
        $b2 = 0;
        
        for ($i = 0; $i < $length; $i++) {
            $a = $x[$i] - $mean1;
            $b = $y[$i] - $mean2;
            $axb = $axb + ($a * $b);
            $a2 = $a2 + pow($a, 2);
            $b2 = $b2 + pow($b, 2);
        }
        
        $corr= $axb / sqrt($a2*$b2);
        
        return $corr;
    }

    // print_r(meterfeeder_get_intent());
}

?>
