<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ($type === 'all') {
    if (count($conn) > 0) {
        echo '<input type="text" placeholder="Search..." onkeyup="filter_search(\'homeconn\')" id="home_conn" class="search_conn trans" />';
        foreach ($conn as $con) {
            $this->hook->get_connection_details($con->user_one, $con->user_two, 0);
        }
    }
    else {
        echo "<h4 class='no_result'>No connections to show..!! <a class='trans' href='" . base_url('dashboard/search') . "'>Click here</a> to search for connections.</h4>";
    }
}

if ($type === 'followers') {
    if (count($conn) > 0) {
        echo '<input type="text" placeholder="Search..." onkeyup="filter_search(\'homeconn\')" id="home_conn" class="search_conn trans" />';
        foreach ($conn as $con) {
            $this->hook->get_connection_details($con->user_one, $con->user_two, 1);
        }
    }
    else {
        echo "<h4 class='no_result'>No users to show..!! <a class='trans' href='" . base_url('dashboard/search') . "'>Click here</a> to search for users.</h4>";
    }
}

if ($type === 'blocked') {
    if (count($conn) > 0) {
        echo '<input type="text" placeholder="Search..." onkeyup="filter_search(\'blockedconn\')" id="blockedconn" class="search_conn trans" />';
        foreach ($conn as $con) {
            $this->hook->get_connection_details($con->user_one, $con->user_two, 2);
        }
    }
    else {
        echo "<h4 class='no_result'>No blocked connection requests to show..!!";
    }
}
                                