<?php

namespace Webkul\Product\Helpers;

class Toolbar extends AbstractProduct
{
    /**
     * Returns available sort orders
     *
     * @return array
     */
    public function getAvailableOrders($type = 'product')
    {
        $orders = [
            'name-asc'        => 'from-a-z',
            'name-desc'       => 'from-z-a',
            'created_at-desc' => 'newest-first',
            'created_at-asc'  => 'oldest-first',
        ];

        if (!$type || $type === 'product') {
            $orders['productPrice-asc'] = 'cheapest-first';
            $orders['productPrice-desc'] = 'expensive-first';
        }



        return $orders;
    }
    /**
     * Returns available limits
     *
     * @return array
     */
    public function getAvailableLimits()
    {
        return [12, 24, 36, 48, 96];
    }

    /**
     * Returns the sort order url
     *
     * @param  string $key
     * @return string
     */
    public function getOrderUrl($key)
    {
        $keys = explode('-', $key);

        return request()->fullUrlWithQuery([
            'sort'  => current($keys),
            'order' => end($keys),
        ]);
    }

    /**
     * Returns the limit url
     *
     * @param  int  $limit
     * @return string
     */
    public function getLimitUrl($limit)
    {
        return request()->fullUrlWithQuery([
            'limit' => $limit,
        ]);
    }

    /**
     * Returns the mode url
     *
     * @param  string $mode
     * @return string
     */
    public function getModeUrl($mode)
    {
        return request()->fullUrlWithQuery([
            'mode' => $mode,
        ]);
    }

    /**
     * Checks if sort order is active
     *
     * @param  string $key
     * @return bool
     */
    public function isOrderCurrent($key)
    {
        $params = request()->input();
        if(!isset($params['order'])){
            $params['order']='desc';
        }
        if (isset($params['sort']) && $key == $params['sort'] . '-' . $params['order']) {
            return true;
        } elseif (! isset($params['sort']) && $key == 'created_at-desc') {
            return true;
        }

        return false;
    }

    /**
     * Checks if limit is active
     *
     * @param  int  $limit
     * @return bool
     */
    public function isLimitCurrent($limit)
    {
        $params = request()->input();

        if (isset($params['limit']) && $limit == $params['limit']) {
            return true;
        }

        if (!isset($params['limit']) && $limit === 24) {
            return true;
        }

        return false;
    }

    /**
     * Checks if mode is active
     *
     * @param  string  $key
     * @return bool
     */
    public function isModeActive($key)
    {
        $params = request()->input();

        if (isset($params['mode']) && $key == $params['mode']) {
            return true;
        }

        return false;
    }

    /**
     * Returns the current mode
     *
     * @return string
     */
    public function getCurrentMode()
    {
        $params = request()->input();

        if (isset($params['mode'])) {
            return $params['mode'];
        }

        return 'grid';
    }
}