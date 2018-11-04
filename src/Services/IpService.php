<?php

namespace App\Services;

use App\Entity\IpAddress;
use Doctrine\ORM\EntityManagerInterface;

class IpService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getInfo(string $ip, bool $save = false) {
        $ip = urlencode($ip);
        if ($curl = curl_init("http://api.2ip.ua/geo.json?ip={$ip}")) {
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($result);
            if ($result != null && $save) {
                $result->latitude = isset($result->latitude) ? $result->latitude : '-';
                $result->longitude = isset($result->longitude) ? $result->longitude : '-';
                $ip_address = new IpAddress();
                $ip_address->setIp($result->ip)
                    ->setCity($result->city)
                    ->setCityRus($result->city_rus)
                    ->setCountry($result->country)
                    ->setCountryRus($result->country_rus)
                    ->setCountryCode($result->country_code)
                    ->setRegion($result->region)
                    ->setRegionRus($result->region_rus)
                    ->setLatitude($result->latitude)
                    ->setLongitude($result->longitude)
                    ->setZipCode($result->zip_code)
                    ->setTimeZone($result->time_zone)
                    ->setTimeCreated(time());
                $this->entityManager->persist($ip_address);
                $this->entityManager->flush();
            }
            return $result;
        }
    }
}
