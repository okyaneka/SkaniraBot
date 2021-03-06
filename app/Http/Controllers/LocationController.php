<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
//
    function getProvinces()
    {
        try {
            return json_decode(Storage::get('/origin/province'));
        } catch (\Exception $e) {
            Storage::put('/origin/province', json_encode(json_decode(file_get_contents('http://dev.farizdotid.com/api/daerahindonesia/provinsi'))->semuaprovinsi));
            return $this->getProvinces();
        }
    }

    function getDistricts($id)
    {
        try {
            return json_decode(Storage::get('/origin/district/'.$id));
        } catch (\Exception $e) {
            Storage::put('/origin/district/'.$id, json_encode(json_decode(file_get_contents("http://dev.farizdotid.com/api/daerahindonesia/provinsi/$id/kabupaten"))->kabupatens));
            return $this->getDistricts($id);
        }
    }

    function getSubDistricts($id)
    {
        try {
            return json_decode(Storage::get('/origin/sub_district/'.$id));
        } catch (\Exception $e) {
            Storage::put('/origin/sub_district/'.$id, json_encode(json_decode(file_get_contents("http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/$id/kecamatan"))->kecamatans));
            return $this->getSubDistricts($id);
        }
    }

    function getVillages($id)
    {
        try {
            return json_decode(Storage::get('/origin/village/'.$id));
        } catch (\Exception $e) {
            Storage::put('/origin/village/'.$id, json_encode(json_decode(file_get_contents("http://dev.farizdotid.com/api/daerahindonesia/provinsi/kabupaten/kecamatan/$id/desa"))->desas));
            return $this->getVillages($id);
        }
    }
}
