<?php
class Counter
{
	private $count_date;
	private $day;
	private $week;
	private $month;
	private $yesterday;
	private $total_count;
	
	public function __construct()
	{

	}
	
	public function display()
	{
		$db = new Database();	
		$db->connect();

		$where = "counter_id=1";
		$rs = $db -> select('rln_counter','*',$where);
		
		$row = mysql_fetch_array($rs);
		$pr = "<div class='counter'>";
		$pr .= "<h4>Visitor Counter</h4>";
		$pr .= "<table>";
		$pr .= "<tr><td>Today</td><td>:</td><td>" .$row["counter_day"] . "</td></tr>";
		$pr .= "<tr><td>Total</td><td>:</td><td>" . $row["counter_total"] . "</td></tr>";
		$pr .= "</table>";
		$pr .= "</div>";

		echo $pr;
	}

	public function calulate()
	{
		$db = new Database();	
		$db->connect();

		$where = "counter_id=1";
		$rs = $db -> select('rln_counter','*',$where);
		
		$row = mysql_fetch_array($rs);
		$current = date('Y-m-d',strtotime($row['counter_date']));
		$day = $row["counter_day"];
		$week = $row["counter_week"];
		$month = $row["counter_month"];
		$yesterday = $row["counter_yesterday"];
		$total_count = $row["counter_total"];

		if($this->is_yesterday($current)){
			$this->yesterday = $day + 1;
			$this->update_yesterday();
		}

		if($this->is_today($current)){
			$this->day = $day + 1;
		}
		else { 
			$this->day = 1;
			$this->count_date = date('Y-m-d H:i:s');
			$this->update_date();
		}

		if($this->is_this_week($current))
			$this->week = $week + 1;
		else $this->week = 1;

		if($this->is_this_month($current))
			$this->month = $month + 1;
		else $this->month = 1;

		$this->total_count = $total_count + 1;

		$this->update();

	}

	public function update()
	{
		$db = new Database();
		$db->connect();
		$rs = $db->update('rln_counter',array('counter_day'=>$this->day,'counter_week'=>$this->week,'counter_month'=>$this->month,'counter_total'=>$this->total_count),array('counter_id',1));
		if(!$rs) echo mysql_error();	
	}

	public function update_date()
	{
		$db = new Database();
		$db->connect();
		$rs = $db->update('rln_counter',array('counter_date'=>$this->count_date),array('counter_id',1));
		if(!$rs) echo mysql_error();
	}

	public function update_yesterday()
	{
		$db = new Database();
		$db->connect();
		$rs = $db->update('rln_counter',array('counter_yesterday'=>$this->yesterday),array('counter_id',1));
		if(!$rs) echo mysql_error();
	}

	public function is_today($date)
	{
		$now = date('Y-m-d');
		$current = date('Y-m-d',strtotime($date));
		if($current==$now) return true;
		return false;
	}

	public function is_yesterday($date)
	{
		$time_difference = time() - $date;
		$days = round($time_difference / 86400 );

		if($days >= 1) return true;
		else return false;
	}

	public function is_this_week($date)
	{
		$current = date('d',strtotime($date));
		if($current%7 == 0) return false;
		return true;
	}

	public function is_this_month($date)
	{
		$now = date('Y-m');
		$current = date('Y-m',strtotime($date));
		if($current==$now) return true;
		return false;
	}
	
}
?>