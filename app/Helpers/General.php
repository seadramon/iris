<?php

use Illuminate\Support\Facades\Storage;

function cekDir($dir, $disk = "local")
{
    /*if (!\Storage::disk('sftp')->exists($dir)) {
        Storage::disk('sftp')->makeDirectory($dir);
    }*/

    if (!Storage::disk($disk)->exists($dir)) {
        Storage::disk($disk)->makeDirectory($dir, 0777, true);
    }
}

function setCombo($params, $placeHolder = "- Choose -")
{
	$ret = ['' => $placeHolder];

	foreach ($params as $param) {
		$ret[$param] = $param;
	}

	return $ret;
}

function full_url_from_path($path)
{
    if($path == null){
        return null;
    }
	return route('api.file.viewer', ['path' => str_replace("/", "|", $path)]);;
}

function getMonth($number)
{
    switch ($number) {
        case '1':
            $res = "Januari";
            break;
        case '2':
            $res = "Februari";
            break;
        case '3':
            $res = "Maret";
            break;
        case '4':
            $res = "April";
            break;
        case '5':
            $res = "Mei";
            break;
        case '6':
            $res = "Juni";
            break;
        case '7':
            $res = "Juli";
            break;
        case '8':
            $res = "Agustus";
            break;
        case '9':
            $res = "September";
            break;
        case '10':
            $res = "Oktober";
            break;
        case '11':
            $res = "November";
            break;
        case '12':
            $res = "Desember";
            break;
        default:
            $res = "";
            break;
    }

    return $res;
}