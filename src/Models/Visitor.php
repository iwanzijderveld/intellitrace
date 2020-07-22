<?php

namespace Insanetlabs\IntelliTrace\Models;

/**
 * @author Iwan van Zijderveld <iwanzijderveld@gmail.com>
 * @package insanetlabs/intellitrace
 */

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = array(
        'created_at',
        'updated_at',
        'deleted_at',
        'timestamp'
    );

    /**
     * Hidden attributes
     */
    protected $hidden = array(
        'created_at', 'updated_at'
    );

    /**
     * Fill data from extern host
     *
     * @return void
     */
    public function fillDataFromIP()
    {

        $data = $this->parseURLJSON();
        
        $this->isp = $data->isp;
        $this->organisation = $data->org;
        $this->latitude = $data->lat;
        $this->longitude = $data->lon;
        $this->postalcode = $data->zip;
        $this->city = $data->city;
    }


    /**
     * Get data from remote URL
     * For more info look at: http://ip-api.com/docs/api:json
     *
     * @return JSON
     */
    public function parseURLJSON()
    {
        if ($this->ip !== '127.0.0.1') {
            $url = "http://ip-api.com/json/{$this->ip}";
        } else {
            $url = "http://ip-api.com/json/";
        }

        $client = new Client();
        $response = $client->get($url);

        return json_decode($response->getBody()->getContents());
    }
}
