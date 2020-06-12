<?php
namespace AliceIT\Domains\Handles;

use AliceIT\Client;
use AliceIT\Domains\SingleDomainHandler;

class DomainHandleHandler
{
    private $client;
    private $id;
    private $basePath;

    /**
     * DomainHandleHandler constructor.
     * @param $id
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->basePath = 'services/domains/handles';
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->client->get($this->basePath);
    }

    public function create($type, $fname, $lname, $street, $street_no, $postalcode, $city, $countrycode, $phone, $fax, $email, $sex, $organisation = null, $idcard = null, $idcardissuedate = null, $idcardauthority = null, $region = null, $taxnr = null, $birthdate = null, $birthcountry = null, $birthplace = null, $birthregion = null, $registernumber = null)
    {
        $data = [
            'type' => $type,
            'fname' => $fname,
            'lname' => $lname,
            'street' => $street,
            'street_no' => $street_no,
            'postalcode' => $postalcode,
            'city' => $city,
            'countrycode' => $countrycode,
            'phone' => $phone,
            'fax' => $fax,
            'email' => $email,
            'sex' => $sex
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

        return $this->client->post($this->basePath, $data);
    }

    public function single($id)
    {
        return new SingleDomainHandleHandler($id, $this->client);
    }
}