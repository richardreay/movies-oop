<?php

class Pagination {
	// Method that paginates query results using AJAX
	
	// ajax or non ajax pagination
	public $method = 'ajax';
	
	// how many records per page
	public $rows_per_page = 5;
	
	// number of pages
	public $pages = 0;
	
	// current page number, default 1
	public $current_page_number = 1;
	
	// how many records to display in sql
	public $sql_offset = 0;
	
	// this will be appended to sql queries run to retrieve records
	public $sql_append = '';
	
	// how many records are returned by the query
	public $query_total_records = 0;
	
	// holds the output for the generated pagination links
	public $links = '';
	
	// how many page links to display before and after current page
	public $link_spread = 4;

	public function __construct() {
	
	}
	
	
	public function set_pages($query_total_records) {
		// calculates number of pages needed
		$this->query_total_records = $query_total_records;
		$this->pages = ceil($this->query_total_records / $this->rows_per_page);
	}
	
	
	public function set_query_offset_append() {
		// sets sql_append with correct offset to append to the query so nav works
		if ($this->current_page_number > $this->pages) {
			$this->current_page_number = $this->pages;
		} elseif ($this->current_page_number < 1) {
			$this->current_page_number = 1;
		}
		// calculate offset based on rows per page
		$this->sql_offset = ($this->current_page_number - 1) * $this->rows_per_page;
		// if we have more records than rows per page: append offset
		if ($this->query_total_records > $this->rows_per_page) {
			$this->sql_append = " LIMIT {$this->sql_offset}, {$this->rows_per_page}";
		}
	}
	
	
    /**
     * @param   array $params used to give extra options
     *          class = span class
     *          class_current = span class of the current page number
     *          function = name of the function that will do the AJAX magic whatever(pageNum)
     */
	 public function build_pagination_links($params = array()) {
		// builds pagination links
		if ($this->current_page_number > 1) {
			$this->links = '<span ';
			$this->links .= (!empty($params['class']))      ? 'class="'.$params['class'].'"' : '';
			$this->links .= '><a href="#" ';
			$this->links .= (!empty($params['function']))   ? 'onclick="'.$params['function'].'(1);"' : '';
			$this->links .= '><< First</a></span> <span ';
			$this->links .= (!empty($params['class']))      ? 'class="'.$params['class'].'"' : '';
			$this->links .= '><a href="#" ';
			$prev_page = $this->current_page_number - 1;
			$this->links .= (!empty($params['function']))   ? 'onclick="'.$params['function'].'(' . $prev_page . ');"' : '';
			$this->links .= '>< Prev</a></span> ';
		}
		
		// loop over the rest of the links
		for ($i=($this->current_page_number - $this->link_spread); $i<(($this->current_page_number + $this->link_spread) + 1); $i++) {
			if (($i > 0) && ($i <= $this->pages)) {
                if ($i == $this->current_page_number) {
                    // current page link
                    $this->links .= '<span ';
                    $this->links .= (!empty($params['class_current'])) ? 'class="'.$params['class_current'].'"' : ''; 
                    $this->links .= '><b>'.$i.'</b></span> ';
                } else {
                    // not current link
                    $this->links .= '<span ';
                    $this->links .= (!empty($params['class']))      ? 'class="'.$params['class'].'"' : '';
                    $this->links .= '><a href="#" ';
                    $this->links .= (!empty($params['function']))   ? 'onclick="'.$params['function'].'(' . $i . ');"' : '';
                    $this->links .= '>' . $i . '</a></span> ';
                }
            }
		}
		
        if ($this->current_page_number != $this->pages) {
            // not on last page         
            $this->links .= '<span ';
            $this->links .= (!empty($params['class']))      ? 'class="'.$params['class'].'"' : '';
            $this->links .= '><a href="#" ';
            $next_page = $this->current_page_number + 1;
            $this->links .= (!empty($params['function']))   ? 'onclick="'.$params['function'].'(' . $next_page . ');"' : '';
            $this->links .= '>Next ></a></span> ';
            $this->links .= '<span ';
            $this->links .= (!empty($params['class']))      ? 'class="'.$params['class'].'"' : '';
            $this->links .= '><a href="#" ';
            $this->links .= (!empty($params['function']))   ? 'onclick="'.$params['function'].'(' . $this->pages . ');"' : '';
            $this->links .= '>Last >></a></span> ';
        }

	}

}

?>