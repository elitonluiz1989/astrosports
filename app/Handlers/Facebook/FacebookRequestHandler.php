<?php

namespace App\Handlers\Facebook;

use App\Services\FacebookService;

abstract class FacebookRequestHandler
{
    use FacebookRequestFieldsHandler;

    /**
     * @var bool
     */
    public $hasPagination = true;

    /**
     * @var int
     */
    public $limit = 0;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var int
     */
    public $totalItems = 0;

    /**
     * @var FacebookService
     */
    protected $facebook;

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $pageId;

    /**
     * FacebookRequestHandler constructor.
     * @param FacebookService $facebook
     */
    public function __construct(FacebookService $facebook)
    {
        $this->facebook = $facebook;

        $this->pageId = config('facebook.page_id');
    }


    /**
     * @param string $uri
     * @return \Facebook\GraphNodes\GraphEdge
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    protected function getResponseValues(string $uri) {
        $response = $this->setRequest($uri);

        return $response->getGraphEdge();
    }

    /**
     * @param string $uri
     * @param array $params
     * @param string $method
     * @return \Facebook\FacebookResponse
     */
    protected function setRequest(string $uri, $params = [], $method = 'get')
    {
        $requestParams = (count($params) > 0) ? $params : $this->getRequestParams();

        $request = $this->facebook->request($method, $uri);
        $request->setParams($requestParams);

        return $this->facebook->getClient()->sendRequest($request);
    }

    private function getRequestParams()
    {
        $requestParams = [];

        if ($this->fields->isNotEmpty()) {
            $requestParams['fields'] = $this->getFields()->implode(',');
        }

        if ($this->hasPagination && $this->limit > 0) {
            $offset = $this->page * $this->limit;
            $offset -= $this->limit;

            $requestParams['offset'] =  $offset;

            $requestParams['limit'] = $this->limit;
        }

        return $requestParams;
    }
}