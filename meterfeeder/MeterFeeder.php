<?php

include("protected/humhub/modules/user/models/forms/random-username-generator/RandomUsernameGenerator.php");

if (!function_exists('meterfeeder')) {
    $num_get_intent_calls = 0;
    function meterfeeder_get_intent($type = "") {
        $med_serials = array(
            "QWR4A013"
        );
        global $num_get_intent_calls;

        if ($num_get_intent_calls > 10) {
            return "nointent";
        }

        $cmd_output = array();
        if ($type == "match") {
            // get entropy from matches redis pool
            exec("redis-cli -h nashi.fp2.dev lpop sls_entropy_silos_matches | sed 's/\"//g'", $cmd_output, $res);  
        } else if ($type == "signup") {
            // get entropy from signups redis pool
            exec("redis-cli -h nashi.fp2.dev lpop sls_entropy_silos_matches | sed 's/\"//g'", $cmd_output, $res);  
        } else {
            exec("protected/modules/souls/meterfeeder/meterfeeder " . $med_serials[rand(0, count(array($med_serials)) - 1)] . " 256", $cmd_output, $res);
        }
        
        if ($res == 0) {
            $random_walk_results = random_walk($cmd_output[0]);
            return $random_walk_results;
        } else {
            // TODO: a proper backoff algorithm at least...
            $num_get_intent_calls++;
            return meterfeeder_get_intent($type);
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
        
        $corr = $axb / sqrt($a2*$b2);
        
        return $corr;
    }

    function find_closest_intent($your_intent) {
        // Get random intent and match
        $redis = new Redis(); 
        $redis->connect('127.0.0.1', 6379);
        $baselines = $redis->lrange("sls_baselines", 0, -1);
        $best_match = "";
        $last_match_score = -1;
        for ($i = 0; $i < count($baselines) - 1; $i++) {
            $json = json_decode($baselines[$i], true);
            if ($json["entropy"] == "") {
                continue;
            }
            $this_baseline = $json["entropy"];
            $correlation_score = cross_correlation($this_baseline, $your_intent);
            if ($correlation_score >= $last_match_score) {
                $best_match = $json;
                $last_match_score = $correlation_score;
            }
        }
        return array($best_match, $last_match_score);
    }

    //
    // TESTING
    //

    // Get random intent
    // print_r(meterfeeder_get_intent());

    // Get random intent and match
    // $redis = new Redis(); 
    // $redis->connect('127.0.0.1', 6379);
    // $baselines = $redis->lrange("sls_baselines", 0, -1);
    // $new_user = generate_random_username();
    // echo "looking for someone for $new_user\n\n";
    // $new_intent = meterfeeder_get_intent();
    // $best_match = "";
    // $last_match_score = -1;
    // for ($i = 0; $i < /*count($baselines) - 1*/100; $i++) {
    //     $json = json_decode($baselines[$i], true);
    //     if ($json["entropy"] == "") {
    //         echo $i . " empty entropy\n";
    //         continue;
    //     }
    //     $this_baseline = explode(",", json_decode($baselines[$i], true)["entropy"]);
    //     $correlation_score = cross_correlation($this_baseline, $new_intent);
    //     if ($correlation_score >= $last_match_score) {
    //         $best_match = $json;
    //         $last_match_score = $correlation_score;
    //     }
    // }
    // print("\nscore:" . $last_match_score . "\n");

    // Insert random users with random names with random intents into redis
    // $redis = new Redis(); 
    // $redis->connect('nashi.fp2.dev', 6379);
    // for ($i = 0; $i < 1000; $i++) {
    //     echo $i."\n";
    //     //$redis->set(generate_random_username(), implode(",", meterfeeder_get_intent())); 
    //     $json = '{"username":"'.generate_random_username().'", "entropy":['.implode(",", meterfeeder_get_intent()).']}';
    //     // echo $json."\n"; 
    //     $redis->rpush("sls_baselines", $json);
    // }
}

?>
