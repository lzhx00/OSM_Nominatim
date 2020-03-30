<?php
namespace lzhx00\OSM_Nominatim;

use \GuzzleHttp\Client;

class Geocode{
    protected $acceptLanguage = 0;

    protected $addressDetails = 0;

    protected $debug = 0;

    protected $email = null;

    protected $extraTags = 0;

    protected $format = 'json';

    protected $jsonCallback = null;

    protected $nameDetails = 0;

    protected $reqUrl = 'https://nominatim.openstreetmap.org/';

    public static function make()
    {
        return new static();
    }

    public function search($query, $params = [])
    {
        if(empty($query)){
            throw new \Exception('Empty arguments.');
        }

        $client = new Client();
        $params = array_merge($params, ['q'               => $query,
                                        'limit'           => 1,
                                        'format'          => $this->format,
                                        'json_callback'   => $this->jsonCallback,
                                        'addressdetails'  => $this->addressDetails,
                                        'extratags'       => $this->extraTags,
                                        'namedetails'     => $this->nameDetails,
                                        'accept-language' => $this->acceptLanguage,
                                        'email'           => $this->email,
                                        'debug'           => $this->debug,]);
        
        $response = $client->get($this->reqUrl.'search', [
            'query' => $params
        ]);

        if ($response->getStatusCode() != 200)
        {
            throw new \Exception('HTTP status code: ' . $response->getStatusCode());
        }
        return new Response($response->getBody()->getContents());
    }

    public function reverse($lat, $lon, $params = [])
    {
        if (empty($lat) || empty($lon)) {
            throw new \Exception('Empty arguments.');
        }

        $client = new Client();
        $params = array_merge($params, ['lat'             => $lat,
                                        'lon'             => $lon,
                                        'format'          => $this->format,
                                        'json_callback'   => $this->jsonCallback,
                                        'addressdetails'  => $this->addressDetails,
                                        'extratags'       => $this->extraTags,
                                        'namedetails'     => $this->nameDetails,
                                        'accept-language' => $this->acceptLanguage,
                                        'email'           => $this->email,
                                        'debug'           => $this->debug,]);
        
        $response = $client->get($this->reqUrl.'reverse', [
            'query' => $params
        ]);
        
        if ($response->getStatusCode() != 200)
        {
            throw new \Exception('HTTP status code: ' . $response->getStatusCode());
        }
        return new Response($response->getBody()->getContents());
    }

    public function lookup($osm_ids, $params = [])
    {
        if (empty($osm_ids)) {
            throw new \Exception('Empty arguments.');
        }
        
        $client = new Client();
        $params = array_merge($params, ['osm_ids'         => $osm_ids,
                                        'format'          => $this->format,
                                        'json_callback'   => $this->jsonCallback,
                                        'addressdetails'  => $this->addressDetails,
                                        'extratags'       => $this->extraTags,
                                        'namedetails'     => $this->nameDetails,
                                        'accept-language' => $this->acceptLanguage,
                                        'email'           => $this->email,
                                        'debug'           => $this->debug,]);
        
        $response = $client->get($this->reqUrl.'lookup', [
            'query' => $params
        ]);
        
        if ($response->getStatusCode() != 200)
        {
            throw new \Exception('HTTP status code: ' . $response->getStatusCode());
        }
        return new Response($response->getBody()->getContents());
    }

    public function details($place_id, $params = [])
    {
        if (empty($place_id)) {
            throw new \Exception('Empty arguments.');
        }

        $client = new Client();
        $params = array_merge($params, ['place_id'        => $place_id,
                                        'format'          => $this->format,
                                        'json_callback'   => $this->jsonCallback,
                                        'addressdetails'  => $this->addressDetails,
                                        'accept-language' => $this->acceptLanguage,]);
        
        $response = $client->get($this->reqUrl.'details', [
            'query' => $params
        ]);
        
        if ($response->getStatusCode() != 200)
        {
            throw new \Exception('HTTP status code: ' . $response->getStatusCode());
        }
        return new Response($response->getBody()->getContents());
    }
    
    public function setAcceptLanguage($value)
    {
        $this->acceptLanguage = $value;

        return $this;
    }

    public function setAddressDetails($value)
    {
        if (!in_array($value, array('1','0')))
        {
            throw new \InvalidArgumentException("Invalid value for \$addressDetails.");
        }

        $this->addressDetails = $value;

        return $this;
    }

    public function setDebug($value)
    {
        if (!in_array($value, array('1','0')))
        {
            throw new \InvalidArgumentException("Invalid value for \$debug.");
        }

        $this->debug = $value;

        return $this;
    }

    public function setEmail($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
        {
            throw new \InvalidArgumentException("Invalid value for \$email.");
        }

        $this->email = $value;

        return $this;
    }

    public function setExtraTags($value)
    {
        if (!in_array($value, array('1','0')))
        {
            throw new \InvalidArgumentException("Invalid value for \$extraTags.");
        }

        $this->extraTags = $value;

        return $this;
    }

    public function setJsonCallback($value)
    {
        $this->jsonCallback = $value;

        return $this;
    }

    public function setNameDetails($value)
    {
        if (!in_array($value, array('1','0')))
        {
            throw new \InvalidArgumentException("Invalid value for \$nameDetails.");
        }

        $this->nameDetails = $value;

        return $this;
    }

}