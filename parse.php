<?php

/*
 * Block Combinator
 * https://github.com/ip2k/Block-Combinator
 * http://seanp2k.com/
 *
 * Copyright (c) 2012 seanp2k
 * Provided under the MIT license
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Date: 2012-01-12 17:12:21 -0500 (Thu, 12 Jan 2012)
 * Revision: 3
 */

$urls = explode( "\n", $_GET['urls'] );

foreach ($urls as $url) { // for every file
    $lines = gzfile($url); // load the remote file

    foreach ($lines as $line) { // break it down into single lines
       	$ob .= $line; // buffer each line into the global buffer
    }

    // cleanup
    unset($line);
    unset($lines);
}

// gzip the output buffer and send to client
// following line might need to be uncommented depending on your server configuration
// ini_set('zlib.output_compression','Off');
$gzout = gzencode($ob,9); // gzip the output buffer
header('Content-Type: application/x-download');
header('Content-Encoding: gzip'); #
header('Content-Length: '.strlen($gzout)); #
header('Content-Disposition: attachment; filename="blocklist.p2p.gz"');
header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
header('Pragma: no-cache');
echo $gzout;

// cleanup
unset($urls);
unset($ob);
unset($gzout);
?>
