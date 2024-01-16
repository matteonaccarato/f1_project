<?php
if (!set_include_path("{$_SERVER['DOCUMENT_ROOT']}"))
    error("500", "set_include_path()");

const BASE_URL = "https://www.formula1.com/en/drivers.html";

function f1_scrape_drivers($base_url): array
{

    // Init arrays of interest
    $team_list = [];
    $img_list = [];
    $number_list = [];
    $name_list = [];
    $lastname_list = [];
    $flag_list = [];

    $page = file_get_contents($base_url);
    $html = new DOMDocument();
    @$html->loadHtml($page);
    $xpath = new DOMXPath($html);

    $node_list = $xpath->query('//div[@class="listing-item--team f1--xxs f1-color--gray5"]');
    foreach ($node_list as $n) {
        $team = $n->nodeValue;

        $team = preg_replace("/\s+/", ";", $team, 2);
        $team = explode(";", $team);

        $team_list[] = $team;
    }

    $node_list = $xpath->query('//span[@class="d-block f1--xxs f1-color--carbonBlack"]');
    foreach ($node_list as $n) {
        $name = $n->nodeValue;

        $name_list[] = $name;
    }


    $node_list = $xpath->query('//span[@class="d-block f1-bold--s f1-color--carbonBlack"]');
    foreach ($node_list as $n) {
        $lastname = $n->nodeValue;

        $lastname_list[] = $lastname;
    }


    $node_list = $xpath->query('//picture[@class="listing-item--photo"]//img');

    for ($i=0; $i<20; ++$i) {
        $link = $node_list->item($i)->getAttribute("data-src");

        $img_list[] = $link;
    }
    //echo $img_list[1] . "<br><br>";

    $node_list = $xpath->query('//picture[@class="listing-item--number"]//img');

    for ($i=0; $i<20; ++$i) {
        $link = $node_list->item($i)->getAttribute("data-src");

        $number_list[] = $link;
    }

    $node_list = $xpath->query('//picture[@class="coutnry-flag--photo"]//img');

    for ($i=0; $i<20; ++$i) {
        $link = $node_list->item($i)->getAttribute("data-src");

        $flag_list[] = $link;
    }

    return [$name_list, $lastname_list, $flag_list, $team_list, $number_list, $img_list];
}