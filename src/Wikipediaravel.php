<?php

namespace EtoileFilante\Wikipediaravel;

class Wikipediaravel
{

    private $format, $lang;

    public function __construct($format, $lang)
    {
        $this->format = $format;
        $this->lang = $lang;
    }

    public function getPage($pageName)
    {
        return $this->callAPI('GET','https://'.$this->lang.'.wikipedia.org/w/api.php?action=parse&page='.$pageName.'&format='.$this->format.'&prop=wikitext|categories|links|images|externallinks|sections');
    }

    public function getSubCategories($category, $depth = 1)
    {
        return $this->callAPI('GET','https://'.$this->lang.'.wikipedia.org/w/api.php?action=categorytree&category='.$category.'&format='.$this->format.'&options={%27depth%27:'.$depth.'}');
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

            switch ($method)
            {
                case "POST":
                    curl_setopt($curl, CURLOPT_POST, 1);

                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    break;
                case "PUT":
                    curl_setopt($curl, CURLOPT_PUT, 1);
                    break;
                case "DELETE":
                    curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'DELETE');
                    break;
                default:
                    if ($data)
                        $url = sprintf("%s?%s", $url, http_build_query($data));
            }
            curl_setopt($curl, CURLOPT_HTTPHEADER,array("Content-type: application/json"));

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($curl);

            if (FALSE === $result)
                throw new \Exception(curl_error($curl), curl_errno($curl));

            curl_close($curl);

            return $result;
        } catch (\Exception $e)
        {
            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);

        }
    }
}