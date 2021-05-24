<?php
function asset_url($url) {
	return base_url('assets/' . $url);
}

/**
 * simplifyDateRangeTxt
 * @param	string	$start_date
 * @param	string	$end_date
 * @return	string 
 */
function simplifyDateRangeTxt($start_date, $end_date) {
	$start_datetime = strtotime($start_date); // yyyy-mm-dd
	$end_datetime	= strtotime($end_date); // yyyy-mm-dd
	$output			= '';
	
	if($start_datetime === $end_datetime) {
		// same day - 1st April 2012
		$output	= date('j F Y', $start_datetime);	
	}
	elseif(date('Y-m', $start_datetime) === date('Y-m', $end_datetime)) {
		// same year and month - 3rd - 21st March 2012
		$output	= sprintf('%s - %s %s', date('j', $start_datetime), date('j', $end_datetime), date('F Y', $start_datetime));
	}
	elseif(date('Y', $start_datetime) === date('Y', $end_datetime)) {
		// same year - 29th January - 2nd February 2012
		$output	= sprintf('%s - %s %s', date('j F', $start_datetime), date('j F', $end_datetime), date('Y', $start_datetime));
	}
	else {
		// completely different - 8th December 2012 - 2nd Janurary 2013
		$output	= sprintf('%s - %s', date('j F Y', $start_datetime), date('j F Y', $end_datetime));
	}
	
	return $output;
}