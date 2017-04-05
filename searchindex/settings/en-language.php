<?php

// Strings starting with '%'  will be automatically replaced by script. Do not translate these
$sph_messages = Array(
    "Untitled" => trans('untitled_document', TRUE),
    "Previous" => trans('previous', TRUE),
    "Next" => trans('next', TRUE),
    "Result page" => trans('result_page', TRUE),
    "Search" => trans('search', TRUE),
    "All sites" => trans('all_sites', TRUE),
    "Web pages" => trans('web_pages', TRUE),
    "noMatch" => trans('the_search', TRUE) . " \"%query\" " . trans('did_not_match_any_results', TRUE),
    "resultsFor" => trans('results_for') . ":",
    "Results" => trans('displaying_results', TRUE) . " %from - %to " . trans('of', TRUE) . " %all %matchword (%secs " . trans('seconds', TRUE) . ") ", //matchword will be replaced by match or matches (from this file), depending on the number of results.
    "match" => trans('match', TRUE),
    "matches" => trans('matches', TRUE),
    "andSearch" => "AND Search",
    "orSearch" => "OR Search",
    "phraseSearch" => "Phrase Search",
    "show" => trans('show', TRUE),
    "resultsPerPage" => trans('results_per_page', TRUE),
    "DidYouMean" => trans('did_you_mean',TRUE)
);
?>