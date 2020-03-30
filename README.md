# OSM_Nominatom

## Installation
You can install the package via composer:
```sh
composer require lzhx00/OSM_Nominatim
```

## Usage
```php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use lzhx00\OSM_Nominatim\GeoCode;

class GeoController extends Controller
{
    public function geocoding(){
        $response = GeoCode::make()->reverse(37.3316697,-122.03009820215502);
        return $response;
    }
}
```

/search - search OSM objects by name or type
```php
GeoCode::make()->search('1 Infinite Loop, Cupertino, CA 95014'); 
```
/reverse - search OSM object by their location
```php
GeoCode::make()->reverse(37.3316697,-122.03009820215502);
```
/lookup - look up address details for OSM objects by their ID
```php
GeoCode::make()->lookup('R146656,W104393803,N240109189');
```
/details - show internal details for an object (for debugging only)
```php
GeoCode::make()->details(85993608);
```

## Setting
```php 
GeoCode::make()->setAcceptLanguage('en-US')->search('1 Infinite Loop, Cupertino, CA 95014');
```
### Language
setAcceptLanguage($value)
### AddressDetails
Default:0
setAddressDetails($value)
### Debug
Default:0
setDebug($value)
### Email
Default:null
setEmail($value)
### ExtraTags
Default:0
setExtraTags($value)
### JsonCallback
Default:null
setJsonCallback($value)
### NameDetails
Default:0
setNameDetails($value)

