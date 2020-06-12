<?php
namespace AliceIT\Domains\Handles;

use AliceIT\Client;

class SingleDomainHandleHandler
{
    private $client;
    private $id;
    private $basePath;

    /**
     * SingleDomainHandleHandler constructor.
     * @param $id
     * @param Client $client
     */
    public function __construct($id, Client $client)
    {
        $this->id = $id;
        $this->client = $client;
        $this->basePath = 'services/domains/handles/'.$id;       
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->client->get($this->basePath);
    }

    /**
     * @return mixed
     */
    public function update($street, $street_no, $postalcode, $city, $countrycode, $phone, $fax, $email, $organisation = null, $idcard = null, $idcardissuedate = null, $idcardauthority = null, $region = null, $taxnr = null, $birthdate = null, $birthcountry = null, $birthplace = null, $birthregion = null, $registernumber = null)
    {
        $data = [
            'street' => $street,
            'street_no' => $street_no,
            'postalcode' => $postalcode,
            'city' => $city,
            'countrycode' => $countrycode,
            'phone' => $phone,
            'fax' => $fax,
            'email' => $email
        ];

        $data['organisation'] = $organisation;
        $data['idcard'] = $idcard;
        $data['idcardissuedate'] = $idcardissuedate;
        $data['idcardauthority'] = $idcardauthority;
        $data['region'] = $region;
        $data['taxnr'] = $taxnr;
        $data['birthdate'] = $birthdate;
        $data['birthcountry'] = $birthcountry;
        $data['birthplace'] = $birthplace;
        $data['birthregion'] = $birthregion;
        $data['registernumber'] = $registernumber;

        return $this->client->put($this->basePath, $data);
    }
}