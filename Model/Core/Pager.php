<?php
class Model_Core_Pager 
{
    public $totalRecords = 0; //getter setter
    public $currentPage = 10; //if page is 0 less than 1 then it will be 0 //getter setter
    public $numberOfPages = 0; //calculate and getter for it 
    public $start = 1;
    public $previous = 0;
    public $next = 0;
    public $end = 0;
    public $recordPerPage = 10;
  
    function __construct($totalRecords,$currentPage)
    {
        $this->totalRecords = $totalRecords;
        $this->currentPage = $totalRecords == 0 ? 1 : $currentPage;
        $this->currentPage = $currentPage == 0 ? 1 : $currentPage; // getter setter
        $this->calulate();
        return $this;
    }
    //calculate start
    public function calulate()
    {

        $this->numberOfPages = ceil($this->totalRecords/$this->recordPerPage);

        $this->start = $this->recordPerPage*($this->currentPage-1);

        $this->next = $this->currentPage ==  $this->numberOfPages ? $this->currentPage = $this->numberOfPages : $this->currentPage+1;

        $this->previous = $this->currentPage == 1 ?  1 : $this->currentPage-1;

        $this->end = $this->totalRecords>$this->end ? $this->recordPerPage*($this->currentPage) : $this->totalRecords;

    }
}