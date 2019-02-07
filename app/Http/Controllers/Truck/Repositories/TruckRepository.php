<?php
/**
 * Created by PhpStorm.
 * User: mrasvi
 * Date: 2019-02-06
 * Time: 2:07 PM
 */

namespace App\Http\Controllers\Truck\Repositories;

use Illuminate\Http\Response;
use App\Http\Controllers\Truck\Requests\TruckRequest;
use App\Http\Controllers\Truck\Models\Truckers;
use App\Http\Controllers\Truck\Requests\TruckFilterRequest;


class TruckRepository
{

    /**
     * The google map api-key.
     *
     * @var $api_key
     */

    protected $api_key;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->api_key = env('GMAP_API_KEY');
    }

    /**
     * Display a list of all truckers.
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        try {
            $response = Truckers::all();
            if ($response->isEmpty()) {
                return response(['error' => false, 'body' => 'No results found'], Response::HTTP_OK);
            }
            return response(['error' => false, 'body' => $response], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response(['error' => true, 'body' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Register trucker.
     * @param TruckRequest $request
     * @return \Illuminate\Http\Response
     */
    public function registerTrucker(TruckRequest $request)
    {
        try {
            //add a address to get lat and long
            $address = $request->street . ', ' . $request->number . ' - ' . $request->neighborhood . ', ' . $request->city . ' - ' . $request->state . ' ' . $request->country;
            $response = $this->getGeoCoding($address);
            $create = Truckers::create([
                'name' => $request->name,
                'age' => $request->age,
                'sex' => $request->sex,
                'trucks_code' => $request->trucks_code,
                'cnh' => $request->cnh,
                'is_own' => $request->is_own,
                'is_loaded' => $request->is_loaded,
                'number' => $request->number,
                'street' => $request->street,
                'neighborhood' => $request->neighborhood,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'lat' => $response['lat'],
                'lng' => $response['lng'],
            ]);
            return response(['error' => false, 'body' => $create], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response(['error' => true, 'body' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get all trucks not loaded.
     * @return \Illuminate\Http\Response
     */
    public function truckNotLoaded()
    {
        try {
            $unloadedTrucks = Truckers::where('is_loaded', '=', 'N')->get();
            if ($unloadedTrucks->isEmpty()) {
                return response(['error' => false, 'body' => 'No results found unloaded trucks'], Response::HTTP_OK);
            }
            return response(['error' => false, 'body' => $unloadedTrucks], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response(['error' => true, 'body' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Get all trucks by filter.
     * @param TruckFilterRequest $requestFilter
     * @return \Illuminate\Http\Response
     */
    public function filter(TruckFilterRequest $requestFilter)
    {
        try {
            $filteredTrucks = Truckers::where(function ($query) use ($requestFilter) {
                ($requestFilter->has('is_own')) ? $query->where('is_own', '=', $requestFilter->is_own) : '';
                ($requestFilter->has('is_loaded')) ? $query->where('is_loaded', '=', $requestFilter->is_loaded) : '';
                ($requestFilter->has('cnh')) ? $query->where('cnh', '=', $requestFilter->cnh) : '';
                ($requestFilter->has('trucks_code')) ? $query->where('trucks_code', '=', $requestFilter->trucks_code) : '';
                \Carbon\Carbon::setWeekStartsAt(\Carbon\Carbon::SUNDAY);
                \Carbon\Carbon::setWeekEndsAt(\Carbon\Carbon::SATURDAY);
                ($requestFilter->has('date') and $requestFilter->date == 'daily') ? $query->whereDate('created_at', '=', \Carbon\Carbon::now()->format('Y-m-d')) : '';
                if ($requestFilter->has('date') and $requestFilter->date == 'weekly') {
                    $query->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek()->format('Y-m-d'), \Carbon\Carbon::now()->endOfWeek()->format('Y-m-d')]);
                }
                ($requestFilter->has('date') and $requestFilter->date == 'monthly') ? $query->whereMonth('created_at', '=', \Carbon\Carbon::now()->format('m')) : '';
            })->get();
            if ($filteredTrucks->isEmpty()) {
                return response(['error' => false, 'body' => 'No results found for specific filter'], Response::HTTP_OK);
            }
            return response(['error' => false, 'body' => $filteredTrucks], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response(['error' => true, 'body' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * get trucker lat and long from google map api
     * $var $address
     * @return object
     */
    public function getGeoCoding($address)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=' . rawurlencode($address) . '&sensor=false&key=' . $this->api_key);
        $body = json_decode($res->getBody(), true);
        return $body['results']['0']['geometry']['location'];
    }
}