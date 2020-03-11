<?php

namespace EtoileFilante\Wikipediaravel;

class Wikipediaravel
{

    private $format;
    private $lang;
    private $base_url;


    public function __construct($format, $lang)
    {
        $this->format = $format;
        $this->lang = $lang;
        $this->base_url = 'https://'.$this->lang.'.wikipedia.org/w/api.php?format='.$this->format.'&';
    }

    public function getPage($pageName)
    {
        return $this->callAPI('GET',$this->base_url.'action=parse&page='.urlencode($pageName).'&prop=wikitext|categories|links|images|externallinks|sections');
    }

    public function getPageCategories($pageName)
    {
        return $this->callAPI('GET', $this->base_url.'action=query&titles='.urlencode($pageName).'&prop=categories&cllimit=500');
    }

    public function getSubCategories($category, $depth = 1)
    {
        return $this->callAPI('GET',$this->base_url.'action=categorytree&category='.urlencode($category).'&options={%27depth%27:'.$depth.'}');
    }

    public function search($query, $limit = 1)
    {
        return $this->callAPI('GET', $this->base_url.'action=query&list=search&srsearch='.urlencode($query).'&srlimit='.$limit);
    }

    /**
     * @param $method
     * @param $url
     * @param bool $data
     * @return mixed
     */
    protected function callAPI($method, $url, $data = false)
    {
        try
        {
            $curl = curl_init();

            if (FALSE === $curl)
                throw new \Exception('Failed to initialize CURL');

            curl_setopt($curl, CURLOPT_HTTPHEADER,array("Content-type: application/json"));

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($curl);

            if (FALSE === $result)
                throw new \Exception(curl_error($curl), curl_errno($curl));

            curl_close($curl);

            return $result;
        } catch (\Throwable $e)
        {
            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);

        }
    }
}
