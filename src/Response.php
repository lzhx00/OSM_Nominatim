<?php
namespace lzhx00\OSM_Nominatim;

class Response{
    public function __construct($response)
	{
        $response = json_decode($response,true);
        $this->response = isset($response[0]) ? (object) $response[0] : (object) $response;
    }

    public function raw()
	{
		return (object) $this->response;
	}
    
    public function address()
    {
        return $this->response->display_name;
    }

    public function placeid()
    {
        return $this->response->place_id;
    }

    public function latitude()
	{
		return $this->response->lat;
	}

	public function longitude()
	{
		return $this->response->lon;
    }

    public function osmtype()
    {
        return $this->response->osm_type;
    }
    
    public function osmid()
    {
        return $this->response->osm_id;
    }

    public function boundingbox()
    {
        return $this->response->boundingbox;
    }
    
}