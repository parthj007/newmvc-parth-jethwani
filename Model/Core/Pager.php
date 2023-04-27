<?php
class Model_Core_Pager 
{
    protected $_totalRecords = 0;
    protected $_currentPage = 10;
    protected $_numberOfPages = 0; 
    protected $_start = 1;
    protected $_prev = 0;
    protected $_next = 0;
    protected $_end = 0;
    protected $_recordPerPage = 10;
    protected $_startLimit = 0;
    protected $_recordPerPageOptions = [10,20,50,100,200];



    function __construct()
    {
       $this->setCurrentPage();
    }

    public function getRecordPerPageOptions()
    {
        return $this->_recordPerPageOptions;
    }



    public function getCurrentPage()
    {
        return $this->_currentPage;
    }
    public function setCurrentPage()
    {
        $this->_currentPage = (int) Ccc::getModel("Core_Request")->getParams("page",1);
        return $this;
    }


    public function getToalRecords()
    {
        return $this->_totalRecords;
    }
    public function setTotalRecords($totalRecords)
    {
        $this->_totalRecords = $totalRecords;
        return $this;
    }



    public function getNumberOfPages()
    {
        return $this->_numberOfPages;
    }
    public function setNumberOfPages($numberOfPages)
    {
        $this->_numberOfPages = $numberOfPages;
        return $this;
    }



    public function getStart()
    {
        return $this->_start;
    }
    public function setStart($start)
    {
        $this->_start = $start;
        return $this;
    }


    public function getPrev()
    {
        return $this->_prev;
    }
    public function setPrev($prev)
    {
        $this->_prev = $prev;
        return $this;
    }


     public function getNext()
    {
        return $this->_next;
    }
    public function setNext($next)
    {
        $this->_next = $next;
        return $this;
    }


     public function getEnd()
    {
        return $this->_end;
    }
    public function setEnd($end)
    {
        $this->_end = $end;
        return $this;
    }


     public function getRecordPerPage()
    {
        return $this->_recordPerPage;
    }
    public function setRecordPerPage($recordPerPage)
    {
        $this->_recordPerPage = $recordPerPage;
        return $this;
    }


     public function getStartLimit()
    {
        return $this->_startLimit;
    }

    //calculate start
    public function caculate()
    {

        $this->setNumberOfPages(ceil($this->_totalRecords/$this->_recordPerPage));


        if($this->getNumberOfPages() == 0){
            $this->setCurrentPage(0);
        }
  
        if($this->_numberOfPages == 1 || ($this->_numberOfPages > 1 && $this->_currentPage <= 0)){
            $this->_currentPage = 1;
        }

        if($this->_currentPage > $this->_numberOfPages){
            $this->_currentPage = $this->_numberOfPages;
        }


        //start
        $this->_start = 1;
        if(!$this->_numberOfPages){
            $this->_start = 0;
        }

        if($this->_currentPage == 1){
            $this->_start = 0;
        }


        //end
        $this->_end = $this->_numberOfPages;
        if($this->_currentPage == $this->_numberOfPages){
            $this->_end = 0;
        }


        //prev
        $this->_prev = ($this->getCurrentPage())-1;
        if($this->getCurrentPage() <= 1){
            $this->_prev = 0;
        }


        //next
        $this->_next = ($this->getCurrentPage())+1;
        if($this->_currentPage >= $this->_numberOfPages){
            $this->_next = $this->_numberOfPages;
        }


        //Limit
        $this->_startLimit = ($this->getCurrentPage()-1)*($this->getRecordPerPage());
    }
}