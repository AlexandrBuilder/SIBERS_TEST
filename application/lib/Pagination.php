<?php
namespace application\lib;
class Pagination {
    
    private $max = 10; //number of links to pages
    private $route; //information about url
    private $index = ''; 
    private $currentPage; 
    private $total; // number of users 
    private $limit; // number of users per page
    private $query; //get query
    public function __construct($route, $total, $limit = 10, $query = '') {
        $this->route = $route;
        $this->total = $total;
        $this->limit = $limit;
        $this->query = $query;
        $this->amount = $this->amount();
        $this->setCurrentPage();
    }
   
    //launches pagination
    public function get() {
        if ($this->amount == 1)
            return;
        $links = null;
        $limits = $this->limits();
        $html = '<ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->currentPage) {
                $links .= '<li class="active"><span class="page-link">'.$page.'</span></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }

        if (!is_null($links)) {
            if ($this->currentPage > 1) {
                $links = $this->generateHtml(1, 'Назад').$links;
            }
            if ($this->currentPage < $this->amount) {
                $links .= $this->generateHtml($this->amount, 'Вперед');
            }
        }
        $html .= $links.' </ul>';
        return $html;
    }

    //get the main links to pages
    private function generateHtml($page, $text = null) {
        if (!$text) {
            $text = $page;
        }
        $query = empty($this->query) ? '' : '?'.$this->query ;
        return '<li><a class="page-link" href="/'.$this->route['controller'].'/'.$this->route['action'].'/'.$page.$query.'">'.$text.'</a></li>';
    }

    //get the boundaries of pagination
    private function limits() {
        $left = $this->currentPage - round($this->max / 2);
        $start = $left > 0 ? $left : 1;
        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        }
        else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        return array($start, $end);
    }

    private function setCurrentPage() {
        if (isset($this->route['page'])) {
            $currentPage = $this->route['page'];
        } else {
            $currentPage = 1;
        }
        $this->currentPage = $currentPage;
        if ($this->currentPage > 0) {
            if ($this->currentPage > $this->amount) {
                $this->currentPage = $this->amount;
            }
        } else {
            $this->currentPage = 1;
        }
    }

    private function amount() {
        return ceil($this->total / $this->limit);
    }
}